<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailAccion;
use App\ModeloHumedad;
use App\ModeloLed;
use App\ModeloLuminosidad;
use App\ModeloPir;
use App\ModeloTemperatura;
use App\ModeloUltraSonico;


class ControladorArduino extends Controller
{
    public function distancia(Request $request){
        $accion="Distancia";
        $valor=Http::get('https://io.adafruit.com/api/v2/chekelon/feeds/distancia/data/last?x-aio-key=aio_rZax41DHGmfVTQYOiBIs5pVwUhEY')['value'];
        //return Http::get('https://io.adafruit.com/api/v2/19170166/feeds/distancia/data/last?x-aio-key=aio_XZsg322KDdsyV2g0668zDsPvYPey');
        //dd($valor);
        //$token=$request->bearerToken();
        //dd($token);
        //return Http::get('https://io.adafruit.com/api/v2/19170166/feeds/distancia/data/last?x-aio-key=aio_XZsg322KDdsyV2g0668zDsPvYPey')['value'];
        $dis=new ModeloUltraSonico();
        $dis->id_usuario=$request->user()->id;
        $dis->valor=$valor;
        $dis->save();
        Mail::to('19170166@uttcampus.edu.mx')->send(new MailAccion($request->user(),$accion));
        return response()->json(['valor'=>$valor],200);
    }

    public function movimiento(Request $request){
        $accion="Movimiento";
        $valor=Http::get('https://io.adafruit.com/api/v2/chekelon/feeds/movimiento/data/last?x-aio-key=aio_rZax41DHGmfVTQYOiBIs5pVwUhEY')['created_at'];
        //return Http::get('https://io.adafruit.com/api/v2/19170166/feeds/movimiento/data?x-aio-key=aio_XZsg322KDdsyV2g0668zDsPvYPey');
        //dd($valor);
        $dis=new ModeloPir();
        $dis->id_usuario=$request->user()->id;
        $dis->valor=$valor;
        $dis->save();
        Mail::to('19170166@uttcampus.edu.mx')->send(new MailAccion($request->user(),$accion));
        return response()->json(['valor'=>$valor],200);
    }

    public function OnOff(Request $request){
        $accion="Encender/Apagar LED";
        Http::post('https://io.adafruit.com/api/v2/chekelon/feeds/onoff/data?x-aio-key=aio_rZax41DHGmfVTQYOiBIs5pVwUhEY',[
            'value'=>$request->estado
        ]);
        //return Http::get('https://io.adafruit.com/api/v2/19170166/feeds/onoff/data/last?x-aio-key=aio_XZsg322KDdsyV2g0668zDsPvYPey')['value'];
        $dis=new ModeloLed();
        $dis->id_usuario=$request->user()->id;
        $dis->valor=$request->estado;
        $dis->save();
        Mail::to('19170166@uttcampus.edu.mx')->send(new MailAccion($request->user(),$accion));
        return response()->json(['valor_led'=>$request->estado],200);
    }

    public function humedad(Request $request){
        $accion="Humedad";
        $valor=Http::get('https://io.adafruit.com/api/v2/chekelon/feeds/humedad/data/last?x-aio-key=aio_rZax41DHGmfVTQYOiBIs5pVwUhEY')['value'];
        $dis=new ModeloHumedad();
        $dis->id_usuario=$request->user()->id;
        $dis->valor=$valor;
        $dis->save();
        Mail::to('19170166@uttcampus.edu.mx')->send(new MailAccion($request->user(),$accion));
        return response()->json(['valor'=>$valor]);
    }

    public function luminosidad(Request $request){
        $accion="Luminosidad";
        $valor=Http::get('https://io.adafruit.com/api/v2/chekelon/feeds/luminosidad/data/last?x-aio-key=aio_rZax41DHGmfVTQYOiBIs5pVwUhEY')['value'];
        $dis=new ModeloLuminosidad();
        $dis->id_usuario=$request->user()->id;
        $dis->valor=$valor;
        $dis->save();
        Mail::to('19170166@uttcampus.edu.mx')->send(new MailAccion($request->user(),$accion));
        return response()->json(['valor'=>$valor]);
    }

    public function temperatura(Request $request){
        $accion="Temperatura";
        $valor=Http::get('https://io.adafruit.com/api/v2/chekelon/feeds/temperatura/data/last?x-aio-key=aio_rZax41DHGmfVTQYOiBIs5pVwUhEY')['value'];
        $dis=new ModeloTemperatura();
        $dis->id_usuario=$request->user()->id;
        $dis->valor=$valor;
        $dis->save();
        Mail::to('19170166@uttcampus.edu.mx')->send(new MailAccion($request->user(),$accion));
        return response()->json(['valor'=>$valor]);
    }

}
