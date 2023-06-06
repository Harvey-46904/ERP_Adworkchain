<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Validator;

class EmpleadosController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        $registro = Empleados::all();
        return response( $registro  );
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
            'Nombre_completo' => 'required|unique: empleados|max: 12',
            'Cedula' => 'required | string',
            'Fecha_ingreso' => 'required  | date',
            'Fecha_finalizacion' => 'required | date',
            'Email' => 'required | string',
            'Telefono_personal' => 'required | string',
            'Contacto_emergencia' => 'required | string',
            'Numero_contacto_emergencia' => 'required | string',
        ];

        $messages = [
            'Nombre_completo.required' => 'Digite su nombre',
            'Cedula.required' => 'Digite su cedula',
            'Fecha_ingreso.required' => 'Digite fecha de ingreso',
            'Fecha_finalizacion.required' => 'Digite fecha de finalizacion',
            'Email.required' => 'Digite su correo',
            'Telefono_personal.required' => 'Digite su telefono',
            'Contacto_emergencia.required' => 'Digite contacto de emergencia',
            'Numero_contacto_emergencia.required' => 'Digite contacto emergencia',

        ];
        $validator = Validator::make( $request->all(), $rules,  $messages );
        if ( $validator->fails() ) {
            return response( [ 'Error de los datos'=>$validator->errors() ] );
        } else {
            $agregar_empleados = new Empleados;
            $agregar_empleados->Nombre_completo = $request->Nombre_completo;
            $agregar_empleados->Cedula = $request->Cedula;
            $agregar_empleados->Fecha_ingreso = $request->Fecha_ingreso;
            $agregar_empleados->Fecha_finalizacion = $request->Fecha_finalizacion;
            $agregar_empleados->Email = $request->Email;
            $agregar_empleados->Telefono_personal = $request->Telefono_personal;
            $agregar_empleados->Contacto_emergencia = $request->Contacto_emergencia;
            $agregar_empleados->Numero_contacto_emergencia = $request->Numero_contacto_emergencia;
            $agregar_empleados->save();
            return response( [ 'data'=>'Agregado exitosamente' ] );
        }

    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Empleados  $empleados
    * @return \Illuminate\Http\Response
    */

    public function show( $empleados ) {
        $consultar = Empleados::findOrFail( $empleados );
        return response( [ 'data'=>'Dato buscado' ] );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Empleados  $empleados
    * @return \Illuminate\Http\Response
    */

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Empleados  $empleados
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $empleados ) {
        $rules = [
            'Nombre_completo' => 'required|unique: empleados|max: 12',
            'Cedula' => 'required | string',
            'Fecha_ingreso' => 'required  | date',
            'Fecha_finalizacion' => 'required | date',
            'Email' => 'required | string',
            'Telefono_personal' => 'required | string',
            'Contacto_emergencia' => 'required | string',
            'Numero_contacto_emergencia' => 'required | string',
        ];

        $messages = [
            'Nombre_completo.required' => 'Digite su nombre',
            'Cedula.required' => 'Digite su cedula',
            'Fecha_ingreso.required' => 'Digite fecha de ingreso',
            'Fecha_finalizacion.required' => 'Digite fecha de finalizacion',
            'Email.required' => 'Digite su correo',
            'Telefono_personal.required' => 'Digite su telefono',
            'Contacto_emergencia.required' => 'Digite contacto de emergencia',
            'Numero_contacto_emergencia.required' => 'Digite contacto emergencia',
        ];

        $validator = Validator::make( $request->all(), $rules,  $messages );
        if ( $validator->fails() ) {
            return response( [ 'Error de los datos'=>$validator->errors() ] );
        } else {
            $actualizar_tareas = Empleados::findOrFail($empleados);
            $actualizar_empleados->Nombre_completo = $request->Nombre_completo;
            $actualizar_empleados->Cedula = $request->Cedula;
            $actualizar_empleados->Fecha_ingreso = $request->Fecha_ingreso;
            $actualizar_empleados->Fecha_finalizacion = $request->Fecha_finalizacion;
            $actualizar_empleados->Email = $request->Email;
            $actualizar_empleados->Telefono_personal = $request->Telefono_personal;
            $actualizar_empleados->Contacto_emergencia = $request->Contacto_emergencia;
            $actualizar->save();
            return response( [ 'data'=>'Registro actualizado exitosamente' ] );
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Empleados  $empleados
    * @return \Illuminate\Http\Response
    */

    public function destroy( Empleados $empleados ) {
        $empleados = empleados::findOrFail( $empleados );
        $empleados->delete();
        return response( [ 'data'=> 'Eliminado exitosamente' ] );
    }
}
