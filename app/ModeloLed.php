<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloLed extends Model
{
    protected $fillable=['valor'];
    protected $table='led';

    public function user()
    {
        $this->hasMany('App\User','id');
    }
}
