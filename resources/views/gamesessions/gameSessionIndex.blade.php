@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 offset-1">
                <div class="row row-title">
                    <h1 class="title big">Liste des parties</h1>
                </div>
                @auth
                    <div class="row">
                        <a href="{{route('gamesession.create')}}" class="btn btn-secondary lined thin"
                                        role="button">Créer une nouvelle partie</a>
                    </div>
                @endauth
            </div>
        </div>
        <div class="row">
        @foreach($gamesessions->reverse() as $gameSession)
            <div class="col-md-6">

                <div id="card_container_large">
                    <div class="evenboxinner">{{$gameSession->game}}</div>
                    <div id="card">

                        <div class="shine"></div>
                        <div class="text-block">

                            <h3 class="welcome-card-title yellow">{{$gameSession->title}}
                            </h3>
                            <p>Créée le:{{date('d-M-Y à H:i', strtotime($gameSession->created_at))}}</p>
                            <p>Avec : {{$gameSession->getUserNames->name}}</p>
                            <a href="{{route('gamesession.show', $gameSession->slug)}}"
                               class="btn btn-primary lined thin">Lire</a>
                        </div>
                    </div>

                </div>
            </div>
                @if ($loop->iteration % 2 == 0)
        </div>
        <div class="row">
            @endif
        @endforeach
        </div>
    </div>


@endsection