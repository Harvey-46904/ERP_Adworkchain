<?php

namespace App\Http\Controllers;

use App\Models\Nomina;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Validator;
class NominaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultar = Nomina::all();
        return response (["data"=>$consultar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'id_contrato' => 'required | string',
            'Fecha' => 'required | date',
            'Monto' => 'required | string',
            'Acta' => 'required | string',
            
         ];

         $messages = [
            'id_contrato'  => 'The :attribute and :other must match.',
            'Fecha' => 'The :attribute must be exactly :size.',
            'Monto' => 'The :attribute value :input is not between :min - :max.',
            'Acta' => 'The :attribute value :input is not between :min - :max.',
           
            
        ];
       
       

        $validator = Validator::make($request->all(), $guardar,  $messages);
       
        if ($validator->fails()) {
            return response(['Error de los datos'=>$validator->errors()]);
        }
        else{
        $guardar_nomina=new Nomina;
        $guardar_nomina->id_contrato=$request->id_contrato;
        $guardar_nomina->Fecha=$request->Fecha;
        $guardar_nomina->Monto=$request->Monto;
        $guardar_nomina->Acta=$request->Acta;
        $guardar_nomina->save();
        return response(["data"=>"guardado exitosamente"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nomina  $nomina
     * @return \Illuminate\Http\Response
     */
    public function show( $nomina)
    {
        $nomina=Nomina::findOrFail($nomina);
        return response (["data"=>$nomina]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nomina  $nomina
     * @return \Illuminate\Http\Response
     */
    public function edit(Nomina $nomina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nomina  $nomina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $nomina)
    {
        $guardar = [
            'id_contrato' => 'required | string',
            'Fecha' => 'required | date',
            'Monto' => 'required | string',
            'Acta' => 'required | string',
            
         ];

         $messages = [
            'id_contrato'  => 'The :attribute and :other must match.',
            'Fecha' => 'The :attribute must be exactly :size.',
            'Monto' => 'The :attribute value :input is not between :min - :max.',
            'Acta' => 'The :attribute value :input is not between :min - :max.',
           
            
        ];
        $validator = Validator::make($request->all(), $guardar,  $messages);
       
        if ($validator->fails()) {
            return response(['Error de los datos'=>$validator->errors()]);
        }
        else{
        $actualizar=Nomina::findOrFail($nomina);
        $actualizar->id_contrato=$request->id_contrato;
        $actualizar->Fecha=$request->Fecha;
        $actualizar->Monto=$request->Monto;
        $actualizar->Acta=$request->Acta;
        $actualizar->save();
        return response (["data"=>"dato actualizado"]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nomina  $nomina
     * @return \Illuminate\Http\Response
     */
    public function destroy( $nomina)
    {
        $nomina=Nomina::findOrFail($nomina);
        $nomina->delete();
        return response(["data"=> "Eliminado exitosamente"]);
    }
}
