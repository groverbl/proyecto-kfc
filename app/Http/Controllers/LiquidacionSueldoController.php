<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Liquidaciondesueldo;
use App\Models\Contrato;
use App\Models\LiquidacionBono;
use App\Models\Bono;
use Carbon\Carbon;

class LiquidacionSueldoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $liquidaciones = Liquidaciondesueldo::orderBy("fecha_liquidacion")->get();
       return $liquidaciones;
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ultimaliquidacion=Liquidaciondesueldo::first();
        
       Liquidaciondesueldo::create([
            'idLiquidacion'=> $ultimaliquidacion != null ? $ultimaliquidacion->idLiquidacion+1 : 1,
            'liq_status' => 1,
            'nom_nombre' =>$request['nom_nombre'],
            'urlLiquidacion' =>'',
            'fecha_liquidacion' =>Carbon::now()->format('Y-m-d')

        ]);
        $bonos = [];
        $bonos_nombre=[];
        $bonos_valores=[];
        $asignaciones=0;
        $data=[];
        foreach($request['bonos'] as $bono){

            LiquidacionBono::create([

                'idLiquidacion'=> $ultimaliquidacion != null ? $ultimaliquidacion->idLiquidacion+1 : 1,
                'rut'=> $request['rut'],
                'idBono' => $bono
                
            ]);
            $b=Bono::where('idBono', $bono)->get('monto');
            json_decode($b, true);
            $bonos_valores[]=$b;
            
            
           array_push($bonos, Bono::where('idBono', $bono)->get());
        }
        
        for ($i=0; $i < count($bonos) ; $i++) { 
            $asignaciones= $bonos[$i][0]->monto + $asignaciones;
        }
        


        $cont_aux=Contrato::where('rut', $request['rut'])->first();
        
        $data['sueldobase']=(int)$cont_aux->sueldoBase;
        
        $data['gratificacionlegal']= $data['sueldobase']*0.25;
        $data['baseimponible']= $data['sueldobase']+$data['gratificacionlegal'];
        $data['asignaciones']=$asignaciones;
        $data['total_haber']= $data['asignaciones'] + $data['baseimponible'];
        $data['descuento_afp']= $data['baseimponible']*0.1;
        $data['descuento_salud']=$data['baseimponible']*0.07;
        $data['descuento_seguros']=$data['baseimponible']*0.006;
        $data['total_descuento']=$data['descuento_afp']+$data['descuento_salud']+$data['descuento_seguros'];
        $data['anticipos']=$request['anticipo'];
        $data['sueldo_liquido']=$data['total_haber']-$data['total_descuento']-$data['anticipos'];
        return $data;
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
}
