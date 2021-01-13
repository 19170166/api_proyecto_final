<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloHumedad extends Model
{
    protected $fillable=['valor'];
    protected $table='humedad';

    public function user()
    {
        $this->hasMany('App\User','id');
    }
}
