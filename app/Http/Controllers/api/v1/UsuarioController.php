<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'perfil_id' => $request->perfil_id,
            'propriedade_id' => $request->propriedade_id,
        ]);

        return response()->json([
            'message' => 'Usuário criado com sucesso!',
            'data' => $user,
            'status_code' => 201,
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
        //
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
        $usuario = User::findOrFail($id);
        $usuario->update($request->all());

        return response()->json([
            'message' => 'Usuário atualizado com sucesso!',
            'data' => $usuario,
            'status_code' => 200,
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
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return response()->json([
            'message' => 'Usuário excluído com sucesso!',
            'data' => $usuario,
            'status_code' => 200,
        ], 200);
    }


    // Retorna usuario logado
    public function usuario(Request $request)
    {
        try {
            $user = $request->user()->id;
            $usuario = User::with('perfil', 'propriedade')->find($user);
            return response()->json([
                'message' => 'Usuário atual!',
                'data' => $usuario,
                'status_code' => 200,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao logar usuário!',
                'data' => $e->getMessage(),
                'status_code' => 500,
            ], 500);
        }
    }
}
