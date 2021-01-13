<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloTemperatura extends Model
{
    protected $fillable=['valor'];
    protected $table='temperatura';

    public function user()
    {
        $this->hasMany('App\User','id');
    }
}
