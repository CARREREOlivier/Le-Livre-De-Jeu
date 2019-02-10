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
                @include('gamesessions._partials.index_card_container',['data'=> $gameSession])
            </div>
                @if ($loop->iteration % 2 == 0)
        </div>
        <div class="row">
            @endif
        @endforeach
        </div>
    </div>


@endsection