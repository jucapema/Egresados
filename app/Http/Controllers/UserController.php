<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Mail\Mensaje;
use App\Models\acceso;
use Mail;
use Session;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function change_password(Request $request){
      if(\Hash::check($request->Password_actual, \Auth::user()->password)){
      //if($request->Password_actual == \Auth::user()->password){
        $user=User::find(\Auth::user()->id);
        $new['password'] =bcrypt($request->password);
        $user->update($new);
          if (\Auth::user()->tipo_rol=='admin' and count(\Auth::user()->acceso)==0) {
              acceso::create(['id_usuario'=>\Auth::user()->id]);
          }
        \Auth::logout();
        session::flash('flash_message','La contraseña ha sido actualizada ');
        return view('auth.login');
      }else{
        session::flash('flash_message','La contraseña no coindide porfavor intente de nuevo');
        return redirect()->back();
      }
    }

    public function ChangePassword(){
      return view('changepassword');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    public function correo(){
      $user = User::find(1);
      Mail::to('dicoma12@yahoo.es','prueba')->send(new Mensaje($user));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
