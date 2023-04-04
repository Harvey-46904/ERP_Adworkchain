<?php

namespace App\Http\Controllers;

use App\Models\Tareas;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Validator;

class TareasController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        $registro = Tareas::all();
        return response( [ 'data'=>$registro ] );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        $rules = [
            'Fecha_inicio' => 'required|date',
            'Fecha_fin' => 'required|date',
            'Responsables' => 'required|string',
            'Tarea' => 'required|string',
        ];

        $messages = [
            'Fecha_inicio' => 'Digite fecha inicio',
            'Fecha_fin' => 'Digite fecha fin',
            'Responsables' => 'Digite responsables',
            'Tarea' => 'Digite tarea',
        ];

        $validator = Validator::make( $request->all(), $rules,  $messages );
        if ( $validator->fails() ) {
            return response( [ 'Error de los datos'=>$validator->errors() ] );
        } else {
            $agregar_tareas = new Tareas;
            $agregar_tareas->Fecha_inicio = $request->Fecha_inicio;
            $agregar_tareas->Fecha_fin = $request->Fecha_fin;
            $agregar_tareas->Responsables = $request->Responsables;
            $agregar_tareas->Tarea = $request->Tarea;
            $agregar_tareas->save();
            return response( [ 'data'=>'Agregado exitosamente' ] );
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Tareas  $tareas
    * @return \Illuminate\Http\Response
    */

    public function show( $tareas ) {
        $consultar = Tareas::findOrFail( $tareas );
        return response( [ 'data'=>'Dato buscado' ] );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Tareas  $tareas
    * @return \Illuminate\Http\Response
    */

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Tareas  $tareas
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $tareas ) {

        $rules = [
            'Fecha_inicio' => 'required|date',
            'Fecha_fin' => 'required|date',
            'Responsables' => 'required|string',
            'Tarea' => 'required|string',
        ];

        $messages = [
            'Fecha_inicio.required' => 'Digite fecha inicio',
            'Fecha_fin.required' => 'Digite fecha fin',
            'Responsables.required' => 'Digite responsables',
            'Tarea.required' => 'Digite tarea',
        ];

        $validator = Validator::make( $request->all(), $rules,  $messages );
        if ( $validator->fails() ) {
           return response( [ 'Error de los datos'=>$validator->errors() ] );
        } else {
            $actualizar_tareas = Tareas::findOrFail($tareas);
            $actualizar_tareas->Fecha_inicio = $request->Fecha_inicio;
            $actualizar_tareas->Fecha_fin = $request->Fecha_fin;
            $actualizar_tareas->Responsables = $request->Responsables;
            $actualizar_tareas->Tarea = $request->Tarea;
            $actualizar_tareas->save();
            return response( [ 'data'=>'Registro actualizado exitosamente' ] );
       }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Tareas  $tareas
    * @return \Illuminate\Http\Response
    */

    public function destroy( $tareas ) {
        $tareas = Tareas::findOrFail( $tareas );
        $tareas->delete();
        return response( [ 'data'=> 'Eliminado exitosamente' ] );
    }
}
