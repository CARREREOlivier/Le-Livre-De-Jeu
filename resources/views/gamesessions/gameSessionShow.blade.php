@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ url('/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ url('/css/custom.css') }}">
@endsection
@section('js')
    <!--<script src="{{ url('/js/jquery.js') }}"></script>-->
    <script src="{{ url('/js/dropzone.js') }}"></script>
    <script src="{{ url('/js/dropzone-config.js') }}"></script>
@endsection
@section('content')

    <div class="container mt-5 mb-5">
        <div class="jumbotron">
            <h1 class="display-4">{{$gameSession->title}}</h1>
            <p class="lead">{!! $gameSession->description!!}
            <hr class="my-4">

            <p class="lead">
                @auth
                    @if(Auth::User()->id == $gameSession->user_id)
                        @include("gamesessions.modals.modalAddTurn")
                    @endif
                @endauth
            </p>
        </div>

        <div class="row">
            <div class="col-md-10 offset-md-1">

                @foreach($gameTurns as $gameTurn)
                    <p class="float-right">{{$gameTurn->created_at}}</p>
                    <h4>{{$gameTurn->title}}</h4>

                    @if($gameTurn->locked == true)
                        <p class="text-left">statut : <i class="fas fa-lock"></i></p>
                    @elseif($gameTurn->locked == false)
                        <p class="text-left">statut : <i class="fas fa-lock-open"></i></p>



                    @endif


                    <p class="text-left">{!! $gameTurn->description!!}</p>

                    <ul class="timeline">
                        @auth
                            @if($gameTurn->id == $lastTurnId and $canSendOrder == true and $gameTurn->locked == false)
                                @include("gamesessions.modals.modalTurnOrders")
                            @endif
                        @endauth
                        @foreach($orders as $order)
                            @if($order->gameturn_id == $gameTurn->id)
                                <li> {{date('H:i:s d-M-Y', strtotime($order->orderDate))}}{{$order->name}}
                                    : {{$order->message}}
                                    @auth
                                        @if($order->user_id == Auth::User()->id)
                                            ajouter fichier - Editer - Supprimer
                                        @endif
                                    @endauth
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    @auth
                        <div class="row"> @if($gameTurn->locked == true and Auth::User()->id == $gameSession->user_id )
                                <p>{{ Form::open(['route' => ['gameturn.lock', $gameTurn->id], 'method' => 'post']) }}
                                    {!! Form::submit('Déverrouiller', array('class'=>'btn btn-primary')) !!}
                                    {{ Form::close() }}</p>
                            @elseif($gameTurn->locked == false and Auth::User()->id == $gameSession->user_id)
                                <p>{{ Form::open(['route' => ['gameturn.lock', $gameTurn->id], 'method' => 'post']) }}
                                    {!! Form::submit('Verrouiller', array('class'=>'btn btn-primary')) !!}
                                    {{ Form::close() }}</p>

                            @endif
                            @if(Auth::User()->id == $gameSession->user_id and $gameTurn->locked == false)
                                @include('gamesessions.modals.modalDropzone')
                                @include("gamesessions.modals.modalEditTurn")
                                @include("gamesessions.modals.modalDeleteTurn")

                            @endif</div>
                    @endauth
                    <br/>
                @endforeach

            </div>
        </div>
    </div>

    </div>

@endsection

