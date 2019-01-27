@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center row-title">
            <div class="col-lg-10 offset-1">
                <h1 class="title big">Liste des parties</h1>
                @auth
                    <a href="{{route('gamesession.create')}}" class="btn btn-primary lined thin" role="button">
                        Créer une nouvelle partie
                    </a>
                @endauth
            </div>
        </div>
        @foreach($gamesessions->reverse() as $gameSession)
            <div class="row justify-content-center">
                <div class="col-lg-10 offset-1">
                    <div class="card w-75">
                        <div class="card-header">{{$gameSession->title}}</div>
                        <div class="card-body">
                            <h5 class="card-title">{{$gameSession->game}} </h5>
                            <p class="card-text"> Créé le: {{$gameSession->created_at}}</p>
                            <p class="card-text">Avec : {{$gameSession->getUserNames->name}}</p>
                            <a href="{{route('gamesession.show', $gameSession->slug)}}"
                               class="btn btn-primary lined thin">Lire</a>
                        </div>
                    </div>
                    <br/>
                </div>

            </div>
        @endforeach
    </div>



@endsection