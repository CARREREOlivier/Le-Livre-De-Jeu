@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-title">{{$gameSession->title}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$gameSession->game}}</h6>
                <p class="card-text">{{$gameSession->description}}</p>
                @include("utils.modalAddTurn")
                @include("utils.modalDeleteTurn")

            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-6">
                @foreach($gameTurns as $gameTurn)
                    <p class="card">
                    <h5 class="card-title">{{$gameTurn->title}}</h5>
                    <p class="card-text"> {{$gameTurn->description}}</p>
            </div>
            @endforeach
        </div>
        <div class="col-lg-2"></div>
    </div>
    </div>

@endsection