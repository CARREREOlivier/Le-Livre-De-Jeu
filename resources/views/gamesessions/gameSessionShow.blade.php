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
            <p class="lead">{!! $gameSession->description!!}</p>
            <hr class="my-4">

            @auth
                @if(Auth::User()->id == $gameSession->user_id)
                    @include("gamesessions.modals.modalAddTurn")
                @endif
            @endauth
        </div>

        <div class="row">
            <div class="col-md-10 offset-md-1">

                @foreach($gameTurns as $gameTurn)
                    <p class="float-right">{{date('H:i:s d-M-Y', strtotime($gameTurn->created_at))}}</p>
                    <h4>@include("gamesessions._partials.menuTurnActions"){{$gameTurn->title}}</h4>

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
                                <li> {{date('H:i:s d-M-Y', strtotime($order->orderDate))}} {{$order->name}}
                                    : {!! $order->message!!}
                                    @auth
                                        @if($gameTurn->locked == false and $order->user_id == Auth::User()->id)
                                            @include('gamesessions._partials.menuOrderActions')
                                            @include('gamesessions.modals.modalDropzoneOrder')
                                            @include('gamesessions.modals.modalEditOrder')
                                            @include('gamesessions.modals.modalDeleteOrder')
                                        @endif
                                    @endauth
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    @auth
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

@endsection

