<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloUltraSonico extends Model
{
    protected $fillable=['valor'];
    protected $table='distancia';

    public function user()
    {
        $this->hasMany('App\User','id');
    }
}
