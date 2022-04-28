<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\GruposPlantasRequest;
use App\Models\GrupoPlantas;
use Illuminate\Http\Request;

class GruposPlantasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gruposPlantas = GrupoPlantas::with('plantas')->paginate(10);

        return response()->json([
            'message' => 'lista de grupos de plantas',
            'data' => $gruposPlantas,
            'status_code' => 200
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GruposPlantasRequest $request)
    {
        try {
            $grupoPlanta = GrupoPlantas::create($request->all());

            return response()->json([
                'message' => 'Grupo de plantas criado com sucesso',
                'data' => $grupoPlanta,
                'status_code' => 201
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar grupo de plantas',
                'data' => $e->getMessage(),
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
        $grupoPlanta = GrupoPlantas::find($id);

        if (!$grupoPlanta) {
            return response()->json([
                'message' => 'Grupo de plantas não encontrado',
                'data' => null,
                'status_code' => 404
            ], 404);
        }

        return response()->json([
            'message' => 'Grupo de plantas encontrado',
            'data' => $grupoPlanta,
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
    public function update(Request $request, $id)
    {
        $grupoPlanta = GrupoPlantas::find($id);

        if (!$grupoPlanta) {
            return response()->json([
                'message' => 'Grupo de plantas não encontrado',
                'data' => null,
                'status_code' => 404
            ], 404);
        }

        try {
            $grupoPlanta->update($request->all());

            return response()->json([
                'message' => 'Grupo de plantas atualizado com sucesso',
                'data' => $grupoPlanta,
                'status_code' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar grupo de plantas',
                'data' => $e->getMessage(),
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
        $grupoPlanta = GrupoPlantas::find($id);

        if (!$grupoPlanta) {
            return response()->json([
                'message' => 'Grupo de plantas não encontrado',
                'data' => null,
                'status_code' => 404
            ], 404);
        }

        try {
            $grupoPlanta->delete();

            return response()->json([
                'message' => 'Grupo de plantas excluído com sucesso',
                'data' => $grupoPlanta,
                'status_code' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao excluir grupo de plantas',
                'data' => $e->getMessage(),
                'status_code' => 404
            ], 404);
        }
    }
}
