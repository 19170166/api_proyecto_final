<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','apellido','email','password','verificado'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function humedad(){
        return $this->hasMany('App\ModeloHumedad','id_usuario');
    }

    public function led(){
        return $this->hasMany('App\ModeloLed','id_usuario');
    }

    public function luminosidad(){
        return $this->hasMany('App\ModeloLuminosidad','id_usuario');
    }

    public function pir(){
        return $this->hasMany('App\ModeloPir','id_usuario');
    }

    public function temperatura(){
        return $this->hasMany('App\ModeloTemperatura','id_usuario');
    }

    public function distancia(){
        return $this->hasMany('App\ModeloUltraSonico','id_usuario');
    }
}
