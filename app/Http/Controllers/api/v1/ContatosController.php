<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContatosAtualizarRequest;
use App\Http\Requests\ContatosRequest;
use App\Models\Contatos;
use Illuminate\Http\Request;

class ContatosController extends Controller
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
                "message" => "Lista de contatos",
                "data" => Contatos::with("propriedade")->paginate(10),
                "status_code" => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Erro ao listar contatos",
                "data" => $e->getMessage(),
                "status_code" => 404
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContatosRequest $request)
    {
        try {
            return response()->json([
                "menssage" => "Contato criado com sucesso",
                "data" => Contatos::create($request->all()),
                "status_code" => 201
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Erro ao criar contato",
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
                "message" => "Contato encontrado",
                "data" => Contatos::with("propriedade")->findOrFail($id),
                "status_code" => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Erro ao encontrar contato",
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
    public function update(ContatosAtualizarRequest $request, $id)
    {
        try {
            return response()->json([
                "menssage" => "Contato atualizado com sucesso",
                "data" => Contatos::findOrFail($id)->update($request->all()),
                "status_code" => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Erro ao atualizar contato",
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
            return response()->json([
                "menssage" => "Contato removido com sucesso",
                "data" => Contatos::findOrFail($id)->delete(),
                "status_code" => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Erro ao remover contato",
                "data" => $e->getMessage(),
                "status_code" => 404
            ], 404);
        }
    }
}
