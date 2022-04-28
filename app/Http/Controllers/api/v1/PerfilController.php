<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PerfilRequest;
use App\Http\Requests\PropriedadeRequest;
use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "message" => "Lista de perfis",
            "data" => Perfil::paginate(10),
            "status_code" => 200
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerfilRequest $request)
    {
        return response()->json([
            "message" => "Perfil criado com sucesso",
            "data" => Perfil::create($request->all()),
            "status_code" => 201
        ], 201);
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
            "message" => "Perfil encontrado",
            "data" => Perfil::findOrFail($id),	
            "status_code" => 200 
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PerfilRequest $request, $id)
    {
        $perfil = Perfil::findOrFail($id);
        if ($perfil == false) {
            return response()->json([
                "message" => "Perfil não encontrado",
                "data" => $perfil,
                "status_code" => 404
            ], 404);
        }
        $perfil->update($request->all());
        return response()->json([
            "message" => "Perfil atualizado com sucesso",
            "data" => $perfil,
            "status_code" => 200
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perfil = Perfil::findOrFail($id);
        if ( $perfil == false) {
            return response()->json([
                "message" => "Perfil não encontrado",
                "data" => $perfil,
                "status_code" => 404
            ], 404);
        }
        
        $perfil->delete();
        return response()->json([
            "message" => "Perfil excluído com sucesso",
            "data" => $perfil,
            "status_code" => 201
        ], 200);
    }
}
