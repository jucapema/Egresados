<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
  protected $table = 'publicaciones';

  protected $fillable = ['id_administrador','titulo','cuerpo','fecha','multimedia',
  ];

  public function administrador(){
    return $this->belongsTo('App\Models\Administrador','id_administrador');
  }

}
