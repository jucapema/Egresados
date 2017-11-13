<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
  protected $table = 'notificaciones';

  protected $fillable = ['id_usuario','informacion',
  ];

  public function User(){
    return $this->belongsTo('App\User');
  }
}
