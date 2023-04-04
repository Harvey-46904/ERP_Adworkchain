<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Validator;

class ClientesController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        $registro = Clientes::all();
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
            'Fecha_interaccion' => 'required|date',
            'Nombre' => 'required|string',
            'Telefono' => 'required|string',
            'Email' => 'required|string',
            'Empresa' => 'required|string',
            'Tipo_cliente' => 'required|string',
            'Servicio' => 'required|string',
            'Ultima interaccion' => 'required|date',
            'Estado' => 'required|string',
            'Notas' => 'required|string',
        ];

        $messages = [
            'Fecha_interaccion.required' => 'Digite fecha',
            'Nombre.required' => 'Digite nombre',
            'Telefono.required' => 'Digite telefono',
            'Email.required' => 'Digite correo',
            'Empresa.required' => 'Digite empresa',
            'Tipo_cliente.required' => 'Digite tipo cliente',
            'Servicio.required' => 'Digite servicio',
            'Ultima_interaccion.required' => 'Digite ultima interaccion',
            'Estado.required' => 'Digite estado',
            'Notas.required' => 'Digite notas',
        ];

        $validator = Validator::make( $request->all(), $rules, $messages );
        if ( $validator->fails() ) {
            return response ( [ 'Error de los datos'=>$validator->errors() ] );
        } else {
            $agregar_clientes = new Clientes;
            $agregar_clientes->Fecha_interaccion = $request->Fecha_interaccion;
            $agregar_clientes->Nombre = $request->Nombre;
            $agregar_clientes->Telefono = $request->Telefono;
            $agregar_clientes->Email = $request->Email;
            $agregar_clientes->Empresa = $request->Empresa;
            $agregar_clientes->Tipo_cliente = $request->Tipo_cliente;
            $agregar_clientes->Servicio = $request->Servicio;
            $agregar_clientes->Ultima_interaccion = $request->Ultima_interaccion;
            $agregar_clientes->Estado = $request->Estado;
            $agregar_clientes->Notas = $request->Notas;
            $agregar_clientes->save();
            return response( [ 'data'=>'Agregado exitosamente' ] );
        }

    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Clientes  $clientes
    * @return \Illuminate\Http\Response
    */

    public function show( $clientes ) {
        $consultar = Clientes::findOrFail( $clientes );
        return response( [ 'data'=>'Dato buscado' ] );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Clientes  $clientes
    * @return \Illuminate\Http\Response
    */

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Clientes  $clientes
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $clientes ) {
      
        $rules = [
            'Fecha_interaccion' => 'required|date',
            'Nombre' => 'required|string',
            'Telefono' => 'required|string',
            'Email' => 'required|string',
            'Empresa' => 'required|string',
            'Tipo_cliente' => 'required|string',
            'Servicio' => 'required|string',
            'Ultima interaccion' => 'required|date',
            'Estado' => 'required|string',
            'Notas' => 'required|string',
        ];

        $messages = [
            'Fecha_interaccion.required' => 'Digite fecha',
            'Nombre.required' => 'Digite nombre',
            'Telefono.required' => 'Digite telefono',
            'Email.required' => 'Digite correo',
            'Empresa.required' => 'Digite empresa',
            'Tipo_cliente.required' => 'Digite tipo cliente',
            'Servicio.required' => 'Digite servicio',
            'Ultima_interaccion.required' => 'Digite ultima interaccion',
            'Estado.required' => 'Digite estado',
            'Notas.required' => 'Digite notas',
        ];

        $validator = Validator::make( $request->all(), $rules, $messages );
        if ( $validator->fails() ) {
            return response ( [ 'Error de los datos'=>$validator->errors() ] );
        } else {
            $actualizar_tareas = Clientes::findOrFail($clientes);
            $actualizar_clientes->Fecha_interaccion = $request->Fecha_interaccion;
            $actualizar_clientes->Nombre = $request->Nombre;
            $actualizar_clientes->Telefono = $request->Telefono;
            $actualizar_clientes->Email = $request->Email;
            $actualizar_clientes->Empresa = $request->Empresa;
            $actualizar_clientes->Tipo_cliente = $request->Tipo_cliente;
            $actualizar_clientes->Servicio = $request->Servicio;
            $actualizar_clientes->Ultima_interaccion = $request->Ultima_interaccion;
            $actualizar_clientes->Estado = $request->Estado;
            $actualizar_clientes->Notas = $request->Notas;
            $actualizar->save();
            return response( [ 'data'=>'Registro actualizado exitosamente' ] );
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Clientes  $clientes
    * @return \Illuminate\Http\Response
    */

    public function destroy( Clientes $clientes ) {
        $clientes = clientes::findOrFail( $clientes );
        $clientes->delete();
        return response( [ 'data'=> 'Eliminado exitosamente' ] );
    }
}
