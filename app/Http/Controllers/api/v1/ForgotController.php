<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\ResetRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotController extends Controller
{

    public function forgot(ForgotRequest $request)
    {
        $email = $request->email;

        if (!User::where('email', $email)->exists()) {
            return response()->json([
                'message' => 'Email não cadastrado no sistema',
                'status' => 'error',
            ], 400);
        }

        $token = Str::random(60);
        try {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => now(),
            ]);

            Mail::send('Mails.forgot', ["token" => $token], function (Message $message) use ($email) {
                $message->to($email)->subject('Recuperação de senha');
            });

            return response()->json([
                'message' => 'Um email foi enviado para você com instruções para recuperar sua senha',
                'status' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao tentar enviar o email',
                'data' => $e->getMessage(),
                'status' => 'error',
            ], 404);
        }
    }

    /**
     * @var User $user	 
     */

    public function reset(ResetRequest $request)
    {
        $token = $request->token;
        if (!$passawordResets = DB::table('password_resets')->where('token', $token)->first()) {
            return response()->json([
                'message' => 'Token inválido',
                'status' => 'error',
            ], 400);
        }

        if(!$user = User::where('email', $passawordResets->email)->first()){
            return response()->json([
                'message' => 'Email não cadastrado no sistema',
                'status' => 'error',
            ], 400);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'message' => 'Senha alterada com sucesso',
            'status' => 'success',
            'staus_code' => 200
        ], 200);
    }
}
