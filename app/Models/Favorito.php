<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    protected $table = 'favoritos';

    protected $fillable = ['id_usuario','amigo','post'];

    public function User(){
      return $this->belongsTo('App\User','id_usuario');
    }

}
