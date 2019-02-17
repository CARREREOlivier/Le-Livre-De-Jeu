@extends('layouts.app')


@section('content')
    @if(session('message'))
        <div class='alert alert-success'>
            {{ session('message') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @auth
        <div class="container mt-5 mb-5">

            <h2 class="title">{!! $user->username !!}</h2>

            <div class="row strip">
                <div class="vignette yellow-bg pencil">
                    <div class="row">
                        <div class="col-lg-2"><label>Email : </label></div>
                        <div class="col-lg-10"><p class="text-left">{!! $user->email !!}</p></div>
                    </div>
                    <br/>
                    <button class="btn btn-secondary lined thin">Modifier mon email - en construction</button>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12"> {{Form::open(array('route'=>'profile.reset.password'))}}
                            {{csrf_field()}}
                            {{Form::submit('Réinitialiser mon mot de passe', ['class'=>'btn btn-danger lined thin'])}}
                            {{Form::close()}}</div>
                    </div>
                </div>
            </div>
            <div class="row strip">
                <div class="vignette blue-bg pencil">
                    Mes fichiers-en construction
                </div>
            </div>
        </div>


        </div>
    @endauth
@endsection