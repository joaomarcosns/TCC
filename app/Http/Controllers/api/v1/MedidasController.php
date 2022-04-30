<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedidasRequest;
use App\Models\Medidas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedidasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "message" => "Lista de medidas",
            "data" => Medidas::with("propriedade")->get(),
            "status_code" => 200
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedidasRequest $request)
    {
        try {
            $latitudeGms = $this->gmsLatitude($request->latitude, $request->hemisferio);
            $longitudeGms = $this->gmsLongitude($request->longitude, $request->hemisferio);

            $latitude_graus = $latitudeGms['latitudeGraus'];
            $latitude_minutos = $latitudeGms['latitudeMinutos'];
            $latitude_segundos = $latitudeGms['latitudeSegundos'];
            // //
            $longitude_graus = $longitudeGms['longitudeGraus'];
            $longitude_minutos = $longitudeGms['longitudeMinutos'];
            $longitude_segundos = $longitudeGms['longitudeSegundos'];
            $medias = new Medidas();
            $medias->altura_total = $request->altura_total;
            $medias->largura_total = $request->largura_total;
            $medias->comprimento_total = $request->comprimento_total;
            $medias->hectares = $request->hectares;
            $medias->latitude = $request->latitude;
            $medias->longitude = $request->longitude;
            $medias->latitude_graus = $latitude_graus;
            $medias->longitude_graus = $longitude_graus;
            $medias->latitude_minutos = $latitude_minutos;
            $medias->longitude_minutos = $longitude_minutos;
            $medias->latitude_segundos = $latitude_segundos;
            $medias->longitude_segundos = $longitude_segundos;
            $medias->hemisferio = $request->hemisferio;
            $medias->save();
            
            return response()->json([
                "menssage" => "Medidas criada com sucesso",
                "data" => $medias,
                "status_code" => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                "menssage" => "Erro ao criar medidas",
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
        if (!Auth::user()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        return response()->json([
            "menssage" => "Medidas encontrada",
            "data" => Medidas::findOrFail($id),
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
    public function update(MedidasRequest $request, $id)
    {
        try {
            $latitudeGms = $this->gmsLatitude($request->latitude, $request->hemisferio);
            $longitudeGms = $this->gmsLongitude($request->longitude, $request->hemisferio);

            $latitude_graus = $latitudeGms['latitudeGraus'];
            $latitude_minutos = $latitudeGms['latitudeMinutos'];
            $latitude_segundos = $latitudeGms['latitudeSegundos'];
            // //
            $longitude_graus = $longitudeGms['longitudeGraus'];
            $longitude_minutos = $longitudeGms['longitudeMinutos'];
            $longitude_segundos = $longitudeGms['longitudeSegundos'];
            $medidas = Medidas::findOrFail($id);
            $medidas->altura_total = $request->altura_total;
            $medidas->largura_total = $request->largura_total;
            $medidas->comprimento_total = $request->comprimento_total;
            $medidas->hectares = $request->hectares;
            $medidas->latitude = $request->latitude;
            $medidas->longitude = $request->longitude;
            $medidas->latitude_graus = $latitude_graus;
            $medidas->longitude_graus = $longitude_graus;
            $medidas->latitude_minutos = $latitude_minutos;
            $medidas->longitude_minutos = $longitude_minutos;
            $medidas->latitude_segundos = $latitude_segundos;
            $medidas->longitude_segundos = $longitude_segundos;
            $medidas->hemisferio = $request->hemisferio;
            $medidas->save();

            return response()->json([
                "menssage" => "Medidas atualizada com sucesso",
                "data" => $medidas,
                "status_code" => 200
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                "menssage" => "Erro ao atualizar medidas",
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
            $medidas = Medidas::findOrFail($id);
            $medidas->delete();
            return response()->json([
                "menssage" => "Medidas deletada com sucesso",
                "data" => $medidas,
                "status_code" => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "menssage" => "Erro ao deletar medidas",
                "data" => $e->getMessage(),
                "status_code" => 404
            ], 404);
        }
    }
}
