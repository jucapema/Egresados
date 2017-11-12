<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
  protected $table = 'mensajes';

  protected $fillable = ['id_egresado','contenido','title',
  ];

  public function egresado(){
    return $this->belongsTo('App\Models\Egresado');
  }
}
