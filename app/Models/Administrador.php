<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrador extends Model
{
  protected $table = 'administradores';

  use softDeletes;
  protected $dates = ['deleted_at'];
  protected $fillable = ['id_usuario', 'direccion', 'ciudad', 'telefono',
  ];

  public function user(){
    return $this->belongsTo('App\User','id_usuario');
  }

  public function publicacion(){
    return $this->hasMany('App\Models\Publicaciones','id_administrador');
  }
}
