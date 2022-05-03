<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\ET0;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Eto extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eto = DB::select("SELECT * FROM et0");
        $eto = $eto[0];
        $data = [
            'eto' => $eto->et0,
            'data' => date('d/m/Y', strtotime($eto->created_at))
        ];
        return response()->json([
            'message' => 'Eto retornado com sucesso.',
            'data' => $data,
            'status_code' => 200
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function filtroEto($id)
    {
        switch ($id) {
            case 1:
                $eto = DB::select("SELECT * FROM et0 LIMIT 10");
                return response()->json([
                    'message' => 'Todos os Eto dos ultimos 10 dias.',
                    'data' => $eto,
                    'status_code' => 200
                ], 200);
                break;
            case 2:
                $eto = DB::select("SELECT * FROM et0 WHERE MONTH(created_at) = MONTH(CURRENT_DATE())");
                return response()->json([
                    'message' => 'Todos os Eto do mês atual.',
                    'data' => $eto,
                    'status_code' => 200
                ], 200);
                break;
            case 3:
                // retonar todos os medida dos Eto divido por mes
                $eto = DB::select("SELECT et0 FROM et0 ");
                
                return response()->json([
                    'message' => 'Todos os Eto do ano atual.',
                    'data' => $eto,
                    'status_code' => 200
                ], 200);
                 
                break;
            case 4:
                $anos = [];
                $et0ByAno = [];
                foreach ($anos as $ano) {
                    $et0ByAno[$ano] = DB::select("SELECT AVG(et0) as ETo, YEAR(created_at) as anos FROM et0 WHERE YEAR(created_at) = $ano" . " GROUP BY YEAR(created_at)");
                }
                return response()->json([
                    'message' => 'Todos os Eto por ano.',
                    'data' => $et0ByAno,
                    'status_code' => 200
                ], 200);
                break;
            default:
                return response()->json([
                    'message' => 'Erro ao listar os Eto.',
                    'data' => [],
                    'status_code' => 200
                ], 200);
                break;
        }
    }
}
