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
                        <h5 class="card-title">{{$gameTurn->title}} </h5>
                        <!-- turn lock management-->
                        @auth
                            @if($gameTurn->locked == true and Auth::User()->id == $gameSession->user_id )
                                <p>statut : <i class="fas fa-lock"></i></p>
                                {{ Form::open(['route' => ['gameturn.lock', $gameTurn->id], 'method' => 'post']) }}
                                {!! Form::submit('Déverrouiller', array('class'=>'btn btn-primary')) !!}
                                {{ Form::close() }}
                            @elseif($gameTurn->locked == false and Auth::User()->id == $gameSession->user_id)
                                <p>statut : <i class="fas fa-lock-open"></i></p>
                                {{ Form::open(['route' => ['gameturn.lock', $gameTurn->id], 'method' => 'post']) }}
                                {!! Form::submit('Verrouiller', array('class'=>'btn btn-primary')) !!}
                                {{ Form::close() }}
                            @endif
                            <p class="card-text"> {{$gameTurn->description}}</p>
                        @endauth
                    </div>
                    @auth
                        @if(Auth::User()->id == $gameSession->user_id and $gameTurn->locked == false)

                            @include("gamesessions.modals.modalEditTurn")
                            @include("gamesessions.modals.modalDeleteTurn")

                        @endif
                    @endauth

                <!--Order Modal and Button-->
                    @auth
                        @if($gameTurn->id == $lastTurnId and $canSendOrder == true and $gameTurn->locked == false)
                            @include("gamesessions.modals.modalTurnOrders")
                        @endif
                    @endauth
                    <div>
                        <table>
                            <thead>
                            <th scope="col">Joueur</th>
                            <th scope="col">Message</th>
                            <th>actions</th>
                            </thead>
                            <tbody>


                            @foreach($orders as $order)
                                @if($order->gameturn_id == $gameTurn->id)
                                    <tr>
                                        <td>{{$order->name}}</td>
                                        <td>
                                            {{$order->message}}</td>
                                        <td>Editer - Supprimer.</td>
                                    </tr>

                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>

@endsection