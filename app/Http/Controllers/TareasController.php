<?php

namespace App\Http\Controllers;

use App\Models\Tareas;
use Illuminate\Http\Request;
use App\Models\taskusers;
use Illuminate\support\Facades\Validator;
use DB;
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
            'tablero_id' => 'required|integer',
            'Fecha_inicio' => 'required|date',
            'Fecha_fin' => 'required|date',
            'Descripcion' => 'required|string',
            'Tarea' => 'required|string',
        ];

        $messages = [
            'tablero_id' => 'Digite id tablero',
            'Fecha_inicio' => 'Digite fecha inicio',
            'Fecha_fin' => 'Digite fecha fin',
            'Descripcion' => 'Digite descripcion',
            'Tarea' => 'Digite tarea',
        ];

        $validator = Validator::make( $request->all(), $rules,  $messages );
        if ( $validator->fails() ) {
            return response( [ 'Error de los datos'=>$validator->errors() ] );
        } else {
            $agregar_tareas = new Tareas;
            $agregar_tareas->tablero_id = $request->tablero_id;
            $agregar_tareas->Fecha_inicio = $request->Fecha_inicio;
            $agregar_tareas->Fecha_fin = $request->Fecha_fin;
            $agregar_tareas->Descripcion = $request->Descripcion;
            $agregar_tareas->Tarea = $request->Tarea;
            $agregar_tareas->positions = 0;
            $agregar_tareas->save();
            if(is_array($request->participantes)){
                self::agregar_usuarios_tarea($agregar_tareas->id,$request->participantes);
             }
          
            return self::get_task_board( $request->tablero_id);
            return response( [ 'data'=>'Agregado exitosamente' ] );
        }
    }
    public function agregar_usuarios_tarea($id_tarea,$usuarios){
        $selectedOptions = $usuarios;
        foreach ($selectedOptions as $option) {
            $users= new taskusers;
            $users->id_tarea=$id_tarea;
            $users->id_user=$option;
            $users->save();
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
        return response( [ 'data'=>$consultar ] );
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
            'tablero_id' => 'required|integer',
            'Fecha_inicio' => 'required|date',
            'Fecha_fin' => 'required|date',
            'Responsables' => 'required|string',
            'Tarea' => 'required|string',
        ];

        $messages = [
            'tablero_id' => 'Digite id tablero',
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
            $actualizar_tareas->tablero_id = $request->tablero_id;
            $actualizar_tareas->Fecha_inicio = $request->Fecha_inicio;
            $actualizar_tareas->Fecha_fin = $request->Fecha_fin;
            $actualizar_tareas->Responsables = $request->Responsables;
            $actualizar_tareas->Tarea = $request->Tarea;
            $actualizar_tareas->save();
            return response( [ 'data'=>'Registro actualizado exitosamente' ] );
       }
    }

    public function update_posicion(Request $request){
        $tareas = Tareas::findOrFail( $request->Id_tarea );
        $tareas->positions = $request->Hacia;
        $tareas->save();
        return self::get_task_board( $tareas->tablero_id);
        return response(["data"=>$request->all()]);
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

    public function  get_task_board($id){
       /* $tareas = DB::table('tareas')
        ->select('tareas.*')
        ->join('taskusers', 'taskusers.id_tarea', '=', 'tareas.id')
        ->where("tareas.tablero_id","=",$id)
        ->get();*/
        $tareas = Tareas::where('tablero_id', $id)->get();
        foreach ($tareas as $tarea) {

            $participante_tarea= DB::table('users')
            ->select('users.id','users.name')
            ->join('taskusers', 'taskusers.id_user', '=', 'users.id')
            ->where("taskusers.id_tarea","=",$tarea->id)
            ->get();
           // $participante_tarea=taskusers::where("id_tarea",$tarea->id)->get();
            $tarea->participante=$participante_tarea;
        }
        return response($tareas);
    }
}
