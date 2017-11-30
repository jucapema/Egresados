<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
  protected $table = 'notificaciones';

  protected $fillable = ['id_usuario','tipo','informacion',
  ];

  public function User(){
    return $this->belongsTo('App\User','id_usuario');
  }
}
