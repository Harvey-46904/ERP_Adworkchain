<?php

namespace App\Http\Controllers;

use App\Models\Tablero;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Validator;
class TableroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consulta=Tablero::all();

        return response (["data"=> $consulta]);
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
            'Nombre' => 'required | string',
            'Imagen' => 'required | string',
             ];

         $messages = [
            'Nombre'  => 'The :attribute and :other must match.',
            'Imagen' => 'The :attribute must be exactly :size.',
        ];
       
       

        $validator = Validator::make($request->all(), $guardar,  $messages);
       
        if ($validator->fails()) {
            return response(['Error de los datos'=>$validator->errors()]);
        }
        else{
        $guardar_tablero=new Tablero;
        $guardar_tablero->Nombre=$request->Nombre;
        $guardar_tablero->Imagen=$request->Imagen;
        $guardar_tablero->save();
        return response(["data"=>"guardado exitosamente"]);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tablero  $tablero
     * @return \Illuminate\Http\Response
     */
    public function show($tablero)
    {
        $tablero=Tablero::findOrFail($tablero);
        return response (["data"=>$tablero]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tablero  $tablero
     * @return \Illuminate\Http\Response
     */
    public function edit(Tablero $tablero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tablero  $tablero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $tablero)
    {
        $guardar = [
            'Nombre' => 'required | string',
            'Imagen' => 'required | string',
             ];

         $messages = [
            'Nombre'  => 'The :attribute and :other must match.',
            'Imagen' => 'The :attribute must be exactly :size.',
        ];
        $validator = Validator::make($request->all(), $guardar,  $messages);
        if ($validator->fails()) {
            return response(['Error de los datos'=>$validator->errors()]);
        }
        else{

        $actualizar_cliente=Tablero::findOrFail($cliente);
        
        $actualizar_tablero->Nombre=$request->Nombre;
        $actualizar_tablero->Imagen=$request->Imagen;
        $actualizar_tablero->save();
        return response(["data"=>"datos actualizados"]);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tablero  $tablero
     * @return \Illuminate\Http\Response
     */
    public function destroy( $tablero)
    {
        $tablero=Tablero::findOrFail($tablero);                          
        $tablero->delete();
        return response(["data"=> "Eliminado exitosamente"]);
    }
}
