<?php

namespace App\Http\Controllers;

use App\Models\Tablero;
use App\Models\BoardPersonal;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Validator;
use DB;
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
        return response ($consulta);
    }

    public function personal_tablero($id){
       
        $consulta = DB::table('board_personals')
        ->select('tableros.*')
        ->join('tableros', 'board_personals.id_tablero', '=', 'tableros.id')
       
        ->where("board_personals.id_user","=",$id)
        ->get();
      
        return response ($consulta);
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
            'Imagen' => 'required|image',
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
            
            $ldate = date('Y-m-d-H_i_s');
            $file = $request->file('Imagen');
            $nombre = $file->getClientOriginalName();
            \Storage::disk('local')->put("/img_tablero/".$ldate.$nombre,  \File::get($file));
        $guardar_tablero=new Tablero;
        $guardar_tablero->Nombre=$request->Nombre;
        $guardar_tablero->Imagen=$ldate.$nombre;
        $guardar_tablero->save();
            $tablero_personal=new BoardPersonal;
            $tablero_personal->id_tablero=$guardar_tablero->id;
            $tablero_personal->id_user=$request->User;
            $tablero_personal->tipo_personal="Creador";
            $tablero_personal->save();
        return self::personal_tablero($request->User);
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

        $actualizar_tablero=Tablero::findOrFail($tablero);
        
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

    public function Vista_tablero(){
        return view ('formulario');

    }
    public function guardar_imagen(Request $request){
    $request->validate([
        'imagen' => 'required|file|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen');
        $nombreImagen = $imagen->getClientOriginalName();
        $rutaImagen = $imagen->storeAs('carpeta/destino', $nombreImagen, 'public');
    }

    
    $tablero = new Tablero();
    $tablero->Nombre = $request->input('name');
    $tablero->Imagen = $nombreImagen;
    $tablero->save();

    return redirect()->back()->with('success', 'Imagen subida exitosamente');
}

}
