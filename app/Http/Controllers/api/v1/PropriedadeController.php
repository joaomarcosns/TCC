<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropriedadeRequest;
use App\Models\Propriedade;
use Illuminate\Http\Request;

class PropriedadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "message" => "Lista de propriedades",
            "data" => Propriedade::with("medidas")->get(),
            "status_code" => 200
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropriedadeRequest $request)
    {
        try {
            return response()->json([
                "menssage" => "Propriedade criada com sucesso",
                "data" => Propriedade::create($request->all()),
                "status_code" => 201
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Erro ao criar propriedade",
                "data" => $e->getMessage(),
                "status_code" => 404
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
                "message" => "Propriedade encontrada",
                "data" => Propriedade::with("medidas","contatos")->findOrFail($id),
                "status_code" => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Propriedade não encontrada",
                "data" => $e->getMessage(),
                "status_code" => 404
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
    public function update(PropriedadeRequest $request, $id)
    {
        try {
            $propriedade = Propriedade::findOrFail($id);
            $propriedade->update($request->all());
            return response()->json([
                "menssage" => "Propriedade atualizada com sucesso",
                "data" => $propriedade,
                "status_code" => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Erro ao atualizar propriedade",
                "data" => $e->getMessage(),
                "status_code" => 404
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
            $propriedade = Propriedade::findOrFail($id);
            $propriedade->delete();
            return response()->json([
                "menssage" => "Propriedade deletada com sucesso",
                "data" => $propriedade,
                "status_code" => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Erro ao deletar propriedade",
                "data" => $e->getMessage(),
                "status_code" => 404
            ], 404);
        }
        
    }
}
