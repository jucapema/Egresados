<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Egresado extends Model
{
  protected $table = 'egresados';

  use softDeletes;
  protected $dates = ['deleted_at'];
  protected $fillable = ['id_usuario', 'intereses','fecha_nacimiento','genero','carrera','baja',
  ];

  public function user(){
    return $this->belongsTo('App\User','id_usuario');
  }

  public function mensaje(){
    return $this->hasMany('App\Models\Mensaje','id_egresado');
  }
}
