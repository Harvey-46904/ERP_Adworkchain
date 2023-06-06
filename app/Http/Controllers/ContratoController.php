<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Validator;
class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consulta=Contrato::all();

        return response (["data"=> $consulta]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guardar = [
            'id_empleado' => 'required | string',
            'Tiempo_Labo' => 'required | string',
            'Pago' => 'required | string',
            'Estado' => 'required | string',
            
         ];

         $messages = [
            'id_empleado'  => 'The :attribute and :other must match.',
            'Tiempo_Labo' => 'The :attribute must be exactly :size.',
            'Pago' => 'The :attribute value :input is not between :min - :max.',
            'Estado'=> 'The :attribute must be one of the following types: :values',
            
        ];
       
       

        $validator = Validator::make($request->all(), $guardar,  $messages);
       
        if ($validator->fails()) {
            return response(['Error de los datos'=>$validator->errors()]);
        }
        else{
        $guardar_contrato=new Contrato;
        $guardar_contrato->id_empleado=$request->id_empleado;
        $guardar_contrato->Tiempo_Labo=$request->Tiempo_Labo;
        $guardar_contrato->Pago=$request->Pago;
        $guardar_contrato->Estado=$request->Estado;
        
        $guardar_contrato->save();
        return response(["data"=>"guardado exitosamente"]);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show( $contrato)
    {
        $contrato=Contrato::findOrFail($contrato);
        return response (["data"=>$contrato]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function edit(Contrato $contrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $contrato)
    {
        $guardar = [
            'id_empleado' => 'required | string',
            'Tiempo_Labo' => 'required | string',
            'Pago' => 'required | string',
            'Estado' => 'required | string',
            
         ];

         $messages = [
            'id_empleado'  => 'The :attribute and :other must match.',
            'Tiempo_Labo' => 'The :attribute must be exactly :size.',
            'Pago' => 'The :attribute value :input is not between :min - :max.',
            'Estado'=> 'The :attribute must be one of the following types: :values',
            
        ];
        $validator = Validator::make($request->all(), $guardar,  $messages);
        if ($validator->fails()) {
            return response(['Error de los datos'=>$validator->errors()]);
        }
        else{

        $actualizar_contrato=Contrato::findOrFail($contrato);
        
        $actualizar_contrato->id_empleado=$request->id_empleado;
        $actualizar_contrato->Tiempo_Labo=$request->Tiempo_Labo;
        $actualizar_contrato->Pago=$request->Pago;
        $actualizar_contrato->Estado=$request->Estado;
        $actualizar_contrato->save();
        return response(["data"=>"datos actualizados"]);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy( $contrato)
    {
        $contrato=Contrato::findOrFail($contrato);                          
        $contrato->delete();
        return response(["data"=> "Eliminado exitosamente"]);
    }
}
