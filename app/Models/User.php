<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    use softDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *user root : root root@localhost.com root123456, root ,activo
     */
    protected $fillable = [
        'dni','name', 'email', 'password','apellido','tipo_rol','estado_cuenta',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function egresado(){
      return $this->hasOne('App\Models\Egresado');
    }

    public function administrador(){
        return $this->hasOne('App\Models\Administrador');
    }

    public function notificacion(){
        return $this->hasMany('App\Models\Notificacion');
    }
}
