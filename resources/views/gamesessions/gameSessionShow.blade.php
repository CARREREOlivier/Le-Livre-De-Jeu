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
                        <label class="switch" id="lockSwitch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                        <div id="lockText">1st text</div>
                    @endif
                @endauth

            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-6">
                @foreach($gameTurns as $gameTurn)

                    <div class="card">
                        <h5 class="card-title">{{$gameTurn->title}}</h5>
                        <p class="card-text"> {{$gameTurn->description}}</p>
                        <p class="card-text"> {{$gameTurn->id}}</p>

                    </div>
                    @auth
                        @if(Auth::User()->id == $gameSession->user_id)
                            @include("gamesessions.modals.modalEditTurn")
                            @include("gamesessions.modals.modalDeleteTurn")
                        @endif
                    @endauth

                <!--Order Modal and Button-->
                    @auth
                        @if($gameTurn->id == $lastTurnId and $canSendOrder == true)
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

    <script>
        $('document').ready(function () {
            //variables
            var myDiv = document.getElementById("lockText");
            myDiv.innerHTML = "Content To Show";

        })


    </script>
@endsection