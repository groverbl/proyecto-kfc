<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Horario;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horario= Horario::where('hor_status',1)->get();
        return $horario;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Horario::create([

            'hor_status'=>1,
            'rut'=>$request['rut'],
            'fecha'=>$request['fecha'],
            'horaInicio'=>$request['horaInicio'],
            'horaTermino'=>$request['horaTermino'],
            'isFeriado'=>$request['isFeriado'],
            'asistencia'=> 0

        ]);

        return ;
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
        $horario=Horario::find($id)->update([
            
            'fecha'=>$request['fecha'],
            'horaInicio'=>$request['horaInicio'],
            'horaTermino'=>$request['horaTermino'],
            'isFeriado'=>$request['isFeriado']
        ]);
        return ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $horario=Horario::find($id)->update(['hor_status'=>0]);
        return;
        
    }
}
