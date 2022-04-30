<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json([
                "menssage" => "Lista de áreas",
                "data" => Area::all(),
                "status_code" => 200,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "menssage" => "Erro ao listar áreas",
                "data" => $e->getMessage(),
                "status_code" => 404,
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request)
    {
        try {
            $area = Area::create($request->all());
            return response()->json([
                "menssage" => "Área criada com sucesso",
                "data" => $area,
                "status_code" => 201,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "menssage" => "Erro ao criar área",
                "data" => $e->getMessage(),
                "status_code" => 404,
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
        try {
            return response()->json([
                "menssage" => "Área encontrada!",
                "data" => Area::findOrFail($id),
                "status_code" => 200,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "menssage" => "Erro ao encontrar área",
                "data" => $e->getMessage(),
                "status_code" => 404,
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, $id)
    {
        try {
            $area = Area::findOrFail($id);
            $area->update($request->all());
            return response()->json([
                "menssage" => "Área atualizada com sucesso",
                "data" => $area,
                "status_code" => 200,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "menssage" => "Erro ao atualizar área",
                "data" => $e->getMessage(),
                "status_code" => 404,
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
            $area = Area::findOrFail($id);
            $area->delete();
            return response()->json([
                "menssage" => "Área deletada com sucesso",
                "data" => $area,
                "status_code" => 200,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "menssage" => "Erro ao deletar área",
                "data" => $e->getMessage(),
                "status_code" => 404,
            ], 404);
        }
    }
}
