<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
  protected $table = 'notificaciones';

  protected $fillable = ['id_usuario','tipo','id_tipo',
  ];

  public function User(){
    return $this->belongsTo('App\User','id_usuario');
  }
}
