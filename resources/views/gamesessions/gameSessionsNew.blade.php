@extends('layouts.app')

@section('content')

    @auth
        @include('gamesessions.form.gamesessions')
    @endauth
    @guest
        <p>Authentification requise. Petit malin.</p>
    @endguest



@endsection