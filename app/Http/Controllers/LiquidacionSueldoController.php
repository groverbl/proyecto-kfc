<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Liquidaciondesueldo;
use App\Models\Contrato;
use App\Models\LiquidacionBono;
use App\Models\Bono;
use App\Models\Usuario;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;

class LiquidacionSueldoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $liquidaciones = Liquidaciondesueldo::where('liq_status', 1)->orderBy("fecha_liquidacion")->get();
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
        $ultimaliquidacion=Liquidaciondesueldo::orderBy('idLiquidacion',"desc")->first();
        
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
        
        $usuario=Usuario::find($request['rut']);
        

        $data['sueldobase']=(int)$cont_aux->sueldoBase;
        
        $data['gratificacionlegal']= $data['sueldobase']*0.25;
        $data['baseimponible']= $data['sueldobase']+$data['gratificacionlegal'];
        $data['asignaciones']=$asignaciones;
        $data['total_haber']= $data['asignaciones'] + $data['baseimponible'];
        $data['descuento_afp']= $data['baseimponible']*$usuario->porcentaje_afp;
        $data['descuento_salud']=$data['baseimponible']*$usuario->porcentaje_salud;
        if($usuario->ahorro_voluntario==0)
        {
            $data['descuento_seguros']=0;
        }else{
            $data['descuento_seguros']=$data['baseimponible']*$usuario->porcentaje_ahorro_voluntario;
        }
        
        $data['anticipo']=$request['anticipo'];
        $data['total_descuento']=$data['descuento_afp']+$data['descuento_salud']+$data['descuento_seguros']+ $data['anticipo'];
        
        $data['sueldo_liquido']=$data['total_haber']-$data['total_descuento']-$data['anticipo'];

        $data['nombre'] = $usuario->usu_nombre .  " " . $usuario->apellidoPaterno . " " . $usuario->apellidoMaterno;
        $data['rut'] = $request['rut'];
        $data['cargo']= $cont_aux->nombre_cargo;
        $data['afp']= $usuario->prevision;
        $data['salud']= $usuario->plan_salud;
        $data['fecha_contrato']= $cont_aux->fecha_contrato;

        $pdf = new Dompdf();
        $pdf = \PDF::loadView('/informes/template-liquidacion', compact('data'));
        $pdf->setPaper('letter');
        $nombreArchivo = 'Liquidacion' . date("d/m/y") . '.pdf';
        return $pdf->stream();
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
        
        Liquidaciondesueldo::find($id)->update($request->all());
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Liquidaciondesueldo::find($id)->update([
            "liq_status"=>0
        ]);
        return;
    }

    public function storeFile(Request $request, $id){

        $lq=Liquidaciondesueldo::find($id);
        if($request->file()) {
            $file_name = 'liquidacion'.time().'.'.$request->file('l_file')->extension();
            $file_path = $request->file('l_file')->storeAs('liquidacion', 'liquidacion_'.time().'.'.$request->file('l_file')->extension(), 'public');
            $lq->urlLiquidacion=$file_path;
            $lq->save();
        }
        return;
    }
}
