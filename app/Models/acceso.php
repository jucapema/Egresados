<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class acceso extends Model
{
    protected $table ='accesos';
    protected $fillable = ['id_usuario', 'login',
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }
}
