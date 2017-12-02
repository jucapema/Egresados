    @if(Session::has('flash_message'))
      <script type="text/javascript">
        alert("{{Session::get('flash_message')}}");
      </script>
    @endif
                    <form class="form-horizontal" action="{{ route('change_password') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('Password_actual') ? ' has-error' : '' }}">
                                   <label for="password" class="col-md-4 control-label">Password_actual</label>

                                   <div class="col-md-6">
                                       <input id="Password_actual" type="password" class="form-control" name="Password_actual" required>

                                       @if ($errors->has('Password_actual'))
                                           <span class="help-block">
                                               <strong>{{ $errors->first('Password_actual') }}</strong>
                                           </span>
                                       @endif
                                   </div>
                               </div>

                 <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Register</button>
                                <button type="reset" class="btn btn-danger">Cancelar</button>
                            </div>
                        </div>
                    </form>
