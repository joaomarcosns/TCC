<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SetorRequest;
use App\Models\DataPodas;
use App\Models\KcPlanta;
use App\Models\Setor;
use DateTime;
use Illuminate\Http\Request;

class SetorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $setores = DataPodas::leftJoin('setor', 'data_das_podas.setor_id', '=', 'setor.id')
            ->join('area', 'setor.area_id', '=', 'area.id')
            ->select('area.nome as area', 'setor.id', 'setor.identificador', 'data_das_podas.data_poda', 'setor.kc', 'setor.status', 'setor.etc')
            ->where('data_das_podas.status', '=', 1)
            ->orderByRaw('data_das_podas.id DESC')
            ->paginate(10);

        $kcPlata = KcPlanta::where('id', "1")->get();
        $dias_poda = $kcPlata[0]->dias_poda;
        $dias_cescimento = $kcPlata[0]->dias_cescimento;
        $dias_producao = $kcPlata[0]->dias_producao;
        foreach ($setores as  $setore) {
            $dataAtual = date_create(strval(date('Y-m-d')));
            $dataSetor = date_create(strval($setore->data_poda));
            $intervalo = date_diff($dataAtual, $dataSetor);
            $dias = intval($intervalo->format('%a'));
            $setorAtual = Setor::findOrFail($setore->id);

            $et0 = EstacaoController::et0();

            if ($dias <= $dias_poda) {
                $setorAtual->kc = $kcPlata[0]->kc_poda;
                $setorAtual->status = 'Em nível Poda';
                $setorAtual->etc = $et0 * $kcPlata[0]->kc_poda;
                $setorAtual->save();
            } elseif ($dias > $dias_poda && ($dias - $dias_poda) <= $dias_cescimento) {
                $setorAtual->kc = $kcPlata[0]->kc_cescimento;
                $setorAtual->status = 'Em nível Cescimento';
                $setorAtual->etc = $et0 * $kcPlata[0]->kc_cescimento;
                $setorAtual->save();
            } elseif ($dias > $dias_cescimento && ($dias - $dias_cescimento) <= $dias_producao) {
                $setorAtual->kc = $kcPlata[0]->kc_producao;
                $setorAtual->status = 'Em nível Produção';
                $setorAtual->etc = $et0 * $kcPlata[0]->kc_producao;
                $setorAtual->save();
            } elseif (($dias - $dias_producao) > $dias_producao) {
                $setorAtual->kc = 0;
                $setorAtual->status = 'Atualize os dados';
                $setorAtual->etc = 0;
                $setorAtual->save();
            }
        }

        return response()->json([
            'message' => 'Lista de Setores',
            'data' => $setores,
            'status_code' => 200
        ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao listar os setores',
                'data' => $e->getMessage(),
                'status_code' => 200
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SetorRequest $request)
    {
        try {
            return response()->json([
                'message' => 'Setor criado com sucesso',
                'data' => Setor::create($request->all()),
                'status_code' => 201
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao criar o Setor',
                'data' => $th,
                'status_code' => 404
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'message' => 'Setor encontrado',
            'data' => Setor::findOrFail($id),
            'status_code' => 200
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SetorRequest $request, $id)
    {
        try {
            $setor = Setor::findOrFail($id);
            $setor->update($request->all());
            return response()->json([
                'message' => 'Setor atualizado com sucesso',
                'data' => $setor,
                'status_code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao atualizar o Setor',
                'data' => $th,
                'status_code' => 404
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $setor = Setor::findOrFail($id);
            $setor->delete();
            return response()->json([
                'message' => 'Setor deletado com sucesso',
                'data' => $setor,
                'status_code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao deletar o Setor',
                'data' => $th,
                'status_code' => 404
            ], 404);
        }
    }
}
