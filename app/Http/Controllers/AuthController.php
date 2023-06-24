<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use App\Models\Empleados;
use \stdClass;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function index(){
        $consulta=User::all();
        return response($consulta);
    }

    public function register(Request $request){
        $validator= Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user =User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        $validator= Validator::make($request->all(),[
            'Nombre_completo'=>'required|string|max:255',
            'Cedula'=>'required|string',
            'Cargo'=>'required|string',
            'Fecha_ingreso'=>'required|string',
            'Fecha_finalizacion'=>'required|string',
            'Email'=>'required|string',
            'Telefono_personal'=>'required|string',
            'Contacto_emergencia'=>'required|string',
            'Numero_contacto_emergencia'=>'required|string',    
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $empleado = Empleados::create([
            'id_user' => $user->id,
            'Nombre_completo' => $request->Nombre_completo,
            'Cedula' => $request->Cedula,
            'Cargo' => $request->Cargo,
            'Fecha_ingreso' => $request->Fecha_ingreso,
            'Fecha_finalizacion' => $request->Fecha_finalizacion,
            'Email' => $request->Email,
            'Telefono_personal' => $request->Telefono_personal,
            'Contacto_emergencia' => $request->Contacto_emergencia,
            'Numero_contacto_emergencia' => $request->Numero_contacto_emergencia,

            
        ]);
    

        $token=$user->createToken("auth_tojen")->plainTextToken;



        return response()->json(['data'=>$user,'token'=>$token,'token_type'=>'Bearer']);
    }

    public function Login(Request $request){
            if( !Auth::attempt($request->only('email','password'))){
                return response()->json(['message'=>'Unauthorized']);
            }

            $user=User::where('email',$request['email'])->firstOrFail();
            $token=$user->createToken("auth_token")->plainTextToken;

            return response()->json([
                'message' => "Hi".$user->name,
                'accessToken'=>$token,
                'token_type'=>'Bearer',
                'user'=>$user
            ]);
    }

    public function Logout(){
        auth()->user()->tokens()->delete();
        return response()->json(["message"=>"Logout correct"]);
    }
}
