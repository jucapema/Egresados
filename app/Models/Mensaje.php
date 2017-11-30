<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
  protected $table = 'mensajes';

  protected $fillable = ['id_egresado','contenido','title','send_id'
  ];

  public function egresado(){
    return $this->belongsTo('App\Models\Egresado','id_egresado');
  }

  public function scopeMensajesid($query,$id)  //para mostrar mensajes
  {
      return $$query->where('id_egresado',$id)->get();
  }

  
}
