@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2>liste des parties</h2>
                @auth
                    <a href="{{route('gamesession.create')}}" class="btn btn-primary btn-lg" role="button">
                        Créer une nouvelle partie
                    </a>
                @endauth
                <div class="component">
                    <ul class="align">
                        @foreach($gamesessions->reverse() as $gameSession)
                            <li>
                                <figure class='book'>

                                    <!-- Front -->

                                    <ul class='paperback_front blue'>
                                        <li>
                                            <br/><br/><br/><br/>{{$gameSession->game}}
                                            <img src="" alt="" width="100%" height="100%">
                                        </li>
                                        <li></li>
                                    </ul>

                                    <!-- Pages -->

                                    <ul class='ruled_paper'>
                                        <li></li>
                                        <li>
                                            Avec :<br/>{{$gameSession->getUserNames->name}}
                                        </li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                    </ul>

                                    <!-- Back -->

                                    <ul class='paperback_back'>
                                        <li>

                                            <img src="" alt="" width="100%" height="100%">
                                        </li>
                                        <li></li>
                                    </ul>
                                    <figcaption>
                                        <a href="{{route('gamesession.show', $gameSession->slug)}}">
                                            <h2>{{$gameSession->title}}</h2></a>

                                        <span>Créé le: {{$gameSession->created_at}}</span>
                                        <p>{!! $gameSession->description!!}</p>
                                    </figcaption>
                                </figure>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection