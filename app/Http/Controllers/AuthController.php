<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
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
