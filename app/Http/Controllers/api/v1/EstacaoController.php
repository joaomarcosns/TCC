<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\GddRequest;
use App\Models\Medidas;
use App\Models\Plantas;
use App\Models\Propriedade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EstacaoController extends Controller
{
    public static function et0()
    {
        $diaAnterior = date('Y-m-d', strtotime('-1 day'));
        $res = Http::get("https://apitempo.inmet.gov.br/estacao/{$diaAnterior}/{$diaAnterior}/A426");
        $object = $res->object();

        $array = [];

        $temperaturaMax = 0;
        $umidadeMax = 0;
        $velocidadeMax = 0;
        $radiacaoMax = 0;

        $temperaturaMin = 9999;
        $umidadeMin = 9999;
        $velocidadeMin = 9999;
        $radiacaoMin = 9999;

        foreach ($object as $item) {
            array_push($array, [
                'Temperatura(°C)' => $item->TEM_INS,
                'Umidade(%)' => $item->UMD_INS,
                'Velocidade(m/s)' => $item->VEN_VEL,
                'Radição Solar(KJ/m²)' => $item->RAD_GLO
            ]);
            // saber qual o maior valor
            $temperaturaMax = $item->TEM_INS > $temperaturaMax ? $item->TEM_INS : $temperaturaMax;
            $umidadeMax = $item->UMD_INS > $umidadeMax ? $item->UMD_INS : $umidadeMax;
            $velocidadeMax = $item->VEN_VEL > $velocidadeMax ? $item->VEN_VEL : $velocidadeMax;
            $radiacaoMax = $item->RAD_GLO > $radiacaoMax ? $item->RAD_GLO : $radiacaoMax;

            // Saber qual e o menor valor
            $temperaturaMin = $item->TEM_INS < $temperaturaMin && $item->TEM_INS ? $item->TEM_INS : $temperaturaMin;
            $umidadeMin = $item->UMD_INS < $umidadeMin && $item->UMD_INS ? $item->UMD_INS : $umidadeMin;
            $velocidadeMin = $item->VEN_VEL < $velocidadeMin && $item->VEN_VEL ? $item->VEN_VEL : $velocidadeMin;
            $radiacaoMin = $item->RAD_GLO < $radiacaoMin && $item->RAD_GLO ? $item->RAD_GLO : $radiacaoMin;
        }
        // $arrayMax = [
        //     'temperaturaMax' => $temperaturaMax,
        //     'umidadeMax' => $umidadeMax,
        //     'velocidadeMax' => $velocidadeMax,
        //     'radiacaoMax' => $radiacaoMax
        // ];

        // $arrayMin = [
        //     'temperaturaMin' => $temperaturaMin,
        //     'umidadeMin' => $umidadeMin,
        //     'velocidadeMin' => $velocidadeMin,
        //     'radiacaoMin' => $radiacaoMin
        // ];
        // $response = [
        //     'max_data' => $arrayMax,
        //     'min_data' => $arrayMin,
        //     'data' => $array
        // ];

        //////////////////// calculo ////////////////////////////////

        $j = date('z', strtotime($diaAnterior));
        // Claculando declinação solar &
        $parteUm = ((2 * 3.1415) / 365);
        $parteDois = ($parteUm * $j) - 1.405;
        $parteTres = sin($parteDois);
        $parteQuatro =  0.4093 * $parteTres;
        $declinacaoSolar = $parteQuatro;

        // Inverso da distancia relativa entre o sol e a terra dr
        $dr = 1 + 0.033 * cos(((2 * 3.1415) / 365) * $j);
        // trasformando a latitude em radianos q
        $medidas = Medidas::select('latitude_graus', 'latitude_minutos', 'latitude_segundos', 'hemisferio', 'altura_total')
            ->join('propriedade', 'medidas.id', '=', 'propriedade.medida_id')
            ->first()
            ->get();
        $medidas = $medidas[0];
        $radinao = ($medidas->latitude_graus + ($medidas->latitude_minutos / 60) + ($medidas->latitude_segundos / 3600));
        $latitudeRadiana = deg2rad($radinao) * -1;
        $q = ($medidas->hemisferio) * $latitudeRadiana;
        // Angulo solar do por do sol ws
        $ws = acos(-tan($q) * tan($declinacaoSolar));

        // Radiação solar extraterrestre Ra
        $senoQ = sin($q);
        $senodeclinacaoSolar = sin($declinacaoSolar);
        $cosenoQ = cos($q);
        $cosenodeclinacaoSolar = cos($declinacaoSolar);
        $senoWs = sin($ws);

        $parentese = ($ws * $senoQ * $senodeclinacaoSolar) + ($cosenoQ * $cosenodeclinacaoSolar * $senoWs);
        $frente = 37.6 * $dr;
        $ra = $frente * ($parentese);

        // Trasformar radicomidação solar em KJ/m² rs
        // Obs: A api do tempo que estamos pegando ja da o valor da radiacao em KJ/m²
        // caso use outra api faça esse calculo https://youtu.be/gud5gnUNQXk?t=858
        /**
         * $rs = 86.4 * (A media das radiacoes);
         */

        $rs = 0;
        $total = 0;
        foreach ($array as $item) {
            $total += $item['Radição Solar(KJ/m²)'];
        }
        $rs = $total / count($array);
        $rs = $rs / 1000;
        // Radiacao solar global em dia de sol claro Rso
        // OBS: h = altura que esta posiciinado o sendor de radiacao
        $h = 2;
        $rso = (0.75 + 0.00002 * ($h + $medidas->altura_total)) * $ra;

        // Pressão de saturação de vapor d'agua es
        $saturacaolMax = 0.6108 * exp((17.27 * $temperaturaMax) / ($temperaturaMax + 237.3));
        $saturacaoMin = 0.6108 * exp((17.27 * $temperaturaMin) / ($temperaturaMin + 237.3));
        $es = ($saturacaolMax + $saturacaoMin) / 2;
        // Pressão parcial de vapor d'agua ea
        $temperaturaMax_  = 0.6108 * exp((17.27 * $temperaturaMax) / ($temperaturaMax + 237.3)) * ($umidadeMin / 100);

        $temperaturaMin_ = 0.6108 * (exp((17.27 * $temperaturaMin) / ($temperaturaMin + 237.3)) * ($umidadeMax / 100));

        $ea = ($temperaturaMax_ + $temperaturaMin_) / 2;
        // Radiação liquida de ondas longas Rnl ************************** corrigir aqui

        $_1 = 0.000000004903 * ((pow(($temperaturaMax + 273.16), 4) + pow(($temperaturaMin + 273.16), 4)) / 2);
        $_2 = (0.34 - 0.14 * sqrt($ea));
        $_3 = (1.35 * ($rs / $rso) - 0.35);
        $rnl = $_1 * $_2 * $_3;

        // Radiação liquida de ondas curtas Rns

        $a = 0.23;

        $rns = (1 - $a) * $rs;

        // Radiação Liquida Rn

        $rn = $rns - $rnl;

        // Temperatura Média Tmed

        $tmed = ($temperaturaMax + $temperaturaMin) / 2;

        // Inclinação da curva de pressão de vapor d'agua Delta

        $_1 = 4098 * (0.6108 * exp((17.27 * $tmed) / ($tmed + 237.3)));
        $_2 = pow(($tmed + 237.3), 2);
        $delta = $_1 / $_2;
        // pressão atmosférica Pa

        $altura_total = $medidas->altura_total;

        $_1 = pow(((293 - (0.0065 * $altura_total)) / 293), 5.26);
        $pa = $_1 * 101.3;

        // constante de psicométrica Gama(y)

        $y = 0.000665 * $pa;

        // velocidade média diária do vento u2

        $total = 0;
        foreach ($array as $item) {
            $total += $item['Velocidade(m/s)'];
        }
        $uz = $total / count($array);
        $_1 = 4.87 / log((67.8 * $h) - 5.42);
        $u2 = $uz * $_1;

        // Método de penman-monteith FAO ET0

        $_1 = $rn - 0;
        $_2 = $es - $ea;
        $_3 = 900 / ($tmed + 273);
        $_4 = (0.408 * $delta * $_1);
        $_5 = ($y * $_3 * $u2 * $_2);
        $_6 = $_4 + $_5;
        $_7 = $delta + $y;
        $_8 = (1 + (0.34 * $u2));
        $_9 = $_8 * $_7;
        $_10 = $_6 / $_9;
        $et0 = $_10;

        return $et0;
    }

    public function dadosMeteriologicos()
    {
        $diaAnterior = date('Y-m-d', strtotime('-1 day'));
        $res = Http::get("https://apitempo.inmet.gov.br/estacao/{$diaAnterior}/{$diaAnterior}/A426");
        // $res = Http::get("https://apitempo.inmet.gov.br/estacao/2022-04-29/2022-04-29/A426");
        $object = $res->object();


        $temperaturaMax = 0;
        $umidadeMax = 0;
        $velocidadeDoVentoMax = 0;
        $radiacaoSolarMax = 0;
        $pressaoAtmosfericaMax = 0;


        $temperaturaMin = 9999;
        $umidadeMin = 9999;
        $velocidadeDoVentoMin = 9999;
        $radiacaoSolarMin = 9999;
        $pressaoAtmosfericaMin = 999999;

        foreach ($object as $item) {
            // saber qual o maior valor
            $temperaturaMax = $item->TEM_INS > $temperaturaMax ? $item->TEM_INS : $temperaturaMax;
            $umidadeMax = $item->UMD_INS > $umidadeMax ? $item->UMD_INS : $umidadeMax;
            $velocidadeDoVentoMax = $item->VEN_VEL > $velocidadeDoVentoMax ? $item->VEN_VEL : $velocidadeDoVentoMax;
            $radiacaoSolarMax = $item->RAD_GLO > $radiacaoSolarMax ? $item->RAD_GLO : $radiacaoSolarMax;
            $pressaoAtmosfericaMax = $item->PRE_MAX >  $pressaoAtmosfericaMax ? $item->PRE_MAX : $pressaoAtmosfericaMax;

            // Saber qual e o menor valor
            $temperaturaMin = $item->TEM_INS < $temperaturaMin && $item->TEM_INS ? $item->TEM_INS : $temperaturaMin;
            $umidadeMin = $item->UMD_INS < $umidadeMin && $item->UMD_INS ? $item->UMD_INS : $umidadeMin;
            $velocidadeDoVentoMin = $item->VEN_VEL < $velocidadeDoVentoMin && $item->VEN_VEL ? $item->VEN_VEL : $velocidadeDoVentoMin;
            $radiacaoSolarMin = $item->RAD_GLO < $radiacaoSolarMin && $item->RAD_GLO ? $item->RAD_GLO : $radiacaoSolarMin;
            $pressaoAtmosfericaMin = $item->PRE_MIN < $pressaoAtmosfericaMin && $item->PRE_MIN ? $item->PRE_MIN : $pressaoAtmosfericaMin;
        }

        $data = [
            'radiacaoSolar' => ($radiacaoSolarMax + $radiacaoSolarMin) / 2,
            'presaoAtmosferica' => ($pressaoAtmosfericaMax + $pressaoAtmosfericaMin) / 2,
            'umidade' => ($umidadeMax + $umidadeMin) / 2,
            'velociadaDoVento' => ($velocidadeDoVentoMax + $velocidadeDoVentoMin) / 2,
            'temperaturaMax' => $temperaturaMax,
            'temperaturaMin' => $temperaturaMin,
        ];

        return response()->json($data);
    }

    public function historiocoTemperatura()
    {
        // primiero dia do ano
        $diaAnterior = date('Y-m-d', strtotime('-1 day'));
        $j = date('z', strtotime($diaAnterior)) + 1;
        $primieroDiaDoAno = date('Y-m-d', strtotime('-' . $j . ' day'));
        $hj = date('Y-m-d');
        $res = Http::get("https://apitempo.inmet.gov.br/estacao/{$primieroDiaDoAno}/{$diaAnterior}/A426");
        $object = $res->object();
        $data = [];
        $temperaturaMaxArray = [];
        $temperaturaMinArray = [];
        foreach ($object as $item) {
            array_push($data, [
                'data' => $item->DT_MEDICAO,
                'temperaturaMax' => $item->TEM_MAX,
                'temperaturaMin' => $item->TEM_MIN,
            ]);
        }
        foreach ($data as $item) {
            if($item['data'] == $item['data']){

                array_push($temperaturaMaxArray, $item['temperaturaMax']);
                array_push($temperaturaMinArray, $item['temperaturaMin']);
            }
        }

        return response()->json([
            'data' => $data,
        ]);
    }
    
}
