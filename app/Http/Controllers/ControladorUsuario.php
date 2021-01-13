<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Mail\MailRegistro;


class ControladorUsuario extends Controller
{
    public function registro(Request $request){
        $request->validate([
            'nombre'=>'required',
            'correo'=>'required',
            'password'=>'required'
        ]);
        $usuario=new User();
        $usuario->email=$request->correo;
        $usuario->nombre=$request->nombre;
        $usuario->apellido=$request->apellido;
        $usuario->verificado=false;

        $usuario->password=Hash::make($request->password);
        if($usuario->save()){
            Mail::to('19170166@uttcampus.edu.mx')->send(new MailRegistro($usuario));
            return response()->json(['usuario registrado'],200);
        }
        return response()->json(['error al registrar'],400);
    }

    public function login(Request $request){
        $request->validate([
            'correo'=>'required',
            'password'=>'required'
        ]);
        $usuario=User::where('email',$request->correo)->first();
        //dd($usuario);
        if(!$usuario||!Hash::check($request->password,$usuario->password)){
            throw ValidationException::withMessages([
                'correo|password'=>['Datos incorrectos...']
            ]);
        }
        else{
            $token=$usuario->createToken($request->correo,['user'])->plainTextToken;
            return response()->json(['Permiso'=>$usuario->verificado,'id_usuario'=>$usuario->id,'token'=>$token],200);
        }
        return response()->json(['error al generar el token'],400);
    }

    public function logout(Request $request,$id){
        $usuario=User::find($id);
        $usuario->tokens()->delete();
    }

    public function usuario(Request $request,$id){
        $usuario=User::find($id);
        return response()->json(['nombre'=>$usuario->nombre,'apellido'=>$usuario->apellido],200);
    }

    public function verificarusuario($id){
        $usu=User::find($id);
        $usu->update(['verificado'=>true]);
        $usu->save();
        return response()->json(['verificado'=>'El usuario ha sido verificado']);
    }


}
