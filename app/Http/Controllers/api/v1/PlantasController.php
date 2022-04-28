<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlantasRequest;
use App\Models\Plantas;
use Illuminate\Http\Request;

class PlantasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plantas = Plantas::with('grupoPlanta')->paginate(10);

        return response()->json([
            'message' => 'lista de plantas',
            'data' => $plantas,
            'status_code' => 200
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlantasRequest $request)
    {
        try {
            $planta = Plantas::create($request->all());

            return response()->json([
                'message' => 'Planta criada com sucesso',
                'data' => $planta,
                'status_code' => 201
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar planta',
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
        $planta = Plantas::with('grupoPlanta')->find($id);

        return response()->json([
            'message' => 'Planta encontrada',
            'data' => $planta,
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
        $planta = Plantas::find($id);

        if (!$planta) {
            return response()->json([
                'message' => 'Plantas não encontrado',
                'data' => null,
                'status_code' => 404
            ], 404);
        }

        try {
            $planta->update($request->all());

            return response()->json([
                'message' => 'Grupo de plantas atualizado com sucesso',
                'data' => $planta,
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
        $planta = Plantas::find($id);

        if (!$planta) {
            return response()->json([
                'message' => 'Grupo de plantas não encontrado',
                'data' => null,
                'status_code' => 404
            ], 404);
        }

        try {
            $planta->delete();

            return response()->json([
                'message' => 'Grupo de plantas excluído com sucesso',
                'data' => $planta,
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
