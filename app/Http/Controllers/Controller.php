<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public static function diaAnterioZeroHoras()
    {
        $diaAnterior = date('Y-m-d', strtotime('-1 day'));
        $diaAnterior = $diaAnterior . ' 00:00:00';
        return $diaAnterior;
    }
    public static function diaAnterioViteTresHoras() {
        $diaAnterior = date('Y-m-d', strtotime('-1 day'));
        $diaAnterior = $diaAnterior . ' 23:59:59';
        return $diaAnterior;
    }
    public static function gmsLatitude ($latitude, $emisferio) {
        // Calculcar Latitude em graus
        $latitudeGraus = explode(".", $latitude);
        $latitudeMinutos = 0 .".".$latitudeGraus[1]; 
        $latitudeGraus = ($latitudeGraus[0] * $emisferio);

        // Calculcar Latitude em minutos
        $latitudeMinutos = ($latitudeMinutos * 60);
        $latitudeMinutos = explode(".", $latitudeMinutos);
        $latitudeSegundos = 0 .".". $latitudeMinutos[1];
        $latitudeMinutos = 0 ."". $latitudeMinutos[0];

        // Calculcar Latitude em segundos
        $latitudeSegundos = ($latitudeSegundos * 60);
        $latitudeSegundos = explode(".", $latitudeSegundos);
        $latitudeSegundos = $latitudeSegundos[0];
        ///

        $data = [ 
            'latitudeGraus' => intval($latitudeGraus),
            'latitudeMinutos' => intval($latitudeMinutos),
            'latitudeSegundos' => intval($latitudeSegundos),
        ];
        return $data;
    }

    public static function gmsLongitude ($longitude, $emisferio) {
        $longitudeGraus = explode(".", $longitude);
        $longitudeMinutos = 0 .".".$longitudeGraus[1]; 
        $longitudeGraus = ($longitudeGraus[0] * $emisferio);

        // Calculcar Latitude em minutos
        $longitudeMinutos = ($longitudeMinutos * 60);
        $longitudeMinutos = explode(".", $longitudeMinutos);
        $longitudeSegundos = 0 .".". $longitudeMinutos[1];
        $longitudeMinutos = 0 ."". $longitudeMinutos[0];

        // Calculcar Latitude em segundos
        $longitudeSegundos = ($longitudeSegundos * 60);
        $longitudeSegundos = number_format($longitudeSegundos, 0, '.', '');
        $longitudeSegundos = explode(".", $longitudeSegundos);
        $longitudeSegundos = $longitudeSegundos[0];
        ///

        $data = [
            'longitudeGraus' => intval($longitudeGraus),
            'longitudeMinutos' => intval($longitudeMinutos),
            'longitudeSegundos' => intval($longitudeSegundos),
        ];

        return $data;
    }

    public static function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
