@extends('egresados.EgresadoMain')

@section('recuadro')
<div class="cuadro">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
    </div>
</div>
@endsection
