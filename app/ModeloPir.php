<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloPir extends Model
{
    protected $fillable=['valor'];
    protected $table='pir';

    public function user()
    {
        $this->hasMany('App\User','id');
    }
}
