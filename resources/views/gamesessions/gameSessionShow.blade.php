@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-title">{{$gameSession->title}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$gameSession->game}}</h6>
                <p class="card-text">{{$gameSession->description}}</p>
                @auth
                    @if(Auth::User()->id == $gameSession->user_id)
                        @include("gamesessions.modals.modalAddTurn")
                    @endif
                @endauth

            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-6">
                @foreach($gameTurns as $gameTurn)

                    <div class="card">
                        <h5 class="card-title">{{$gameTurn->title}}</h5>
                        <p class="card-text"> {{$gameTurn->description}}</p>
                    </div>
                    @auth
                        @if(Auth::User()->id == $gameSession->user_id)
                            @include("gamesessions.modals.modalEditTurn")
                            @include("gamesessions.modals.modalDeleteTurn")
                        @endif
                    @endauth
                @endforeach
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
    </div>

@endsection