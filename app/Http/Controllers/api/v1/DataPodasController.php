<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataPodasRequest;
use App\Models\DataPodas;
use Illuminate\Http\Request;

class DataPodasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'message' => 'Lista de DataPodas',
            'data' => DataPodas::all(),
            'status_code' => 200
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DataPodasRequest $request)
    {
        try {
            $dataPoda = DataPodas::where("setor_id", $request->setor_id)
                ->where("status", true)
                ->first();

            if (!empty($dataPoda)) {
                $dataPoda->status = false;
                $dataPoda->save();
            }
            return response()->json([
                'message' => 'DataPoda criada com sucesso',
                'data' => DataPodas::create($request->all()),
                'status_code' => 201
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar a DataPoda',
                'data' => $e,
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
            'message' => 'DataPoda encontrada',
            'data' => DataPodas::findOrFail($id),
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
    public function update(DataPodasRequest $request, $id)
    {
        try {
            $dataPoda = DataPodas::findOrFail($id);
            $dataPoda->update($request->all());
            return response()->json([
                'message' => 'DataPoda atualizada com sucesso',
                'data' => $dataPoda,
                'status_code' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar a DataPoda',
                'data' => $e,
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
            $dataPoda = DataPodas::findOrFail($id);
            $dataPoda->delete();
            return response()->json([
                'message' => 'DataPoda removida com sucesso',
                'data' => $dataPoda,
                'status_code' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao remover a DataPoda',
                'data' => $e,
                'status_code' => 404
            ], 404);
        }
    }
}
