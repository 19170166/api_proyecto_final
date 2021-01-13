<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloLuminosidad extends Model
{
    protected $fillable=['valor'];
    protected $table='luminosidad';

    public function user()
    {
        $this->hasMany('App\User','id');
    }
}
