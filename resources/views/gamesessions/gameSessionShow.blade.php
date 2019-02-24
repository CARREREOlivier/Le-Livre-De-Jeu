@extends('layouts.app')

@section('js')
    <!--<script src="{{ url('/js/jquery.js') }}"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
    <script src="{{ url('/js/dropzone-config.js') }}"></script>
@endsection

@section('content')

    @if(session('message'))
        <div class='alert alert-success'>
            {{ session('message') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Top strip -->
    <div class="container mt-5 mb-5" id="showgamessesionMain">

        <div class="row">
            <div class="col-md-9 nopadding">
                <div id="card_container_auto">
                    <div id="card">

                        <div class="shine"></div>
                        <div class="text-block gamesession-description">

                            <h3 class="last-turn-title yellow">{{$gameSession->title}}
                            </h3>
                            <p>Créée le:@include('utils.date_french',['date'=>$gameSession->created_at])</p>
                            {!!  $gameSession->description !!}
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-3 nopadding">
                <div id="card_container_auto">
                    <div class="evenboxinner">{{$gameSession->game}}</div>
                    <div id="card">

                        <div class="shine"></div>
                        <div class="text-block">
                            <br/>
                            <p><strong>Maitre de jeu :</strong>
                                @foreach($gamemaster as $gm)
                                    {{$gm->getusers->username}}
                                @endforeach
                                <br/>
                                <strong>Joueurs :</strong>
                                @foreach($players as $player)
                                    @if($loop->last)
                                        {{$player->getusers->username}}
                                    @else
                                        {{$player->getusers->username}} -

                                    @endif
                                @endforeach</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--End top strip-->
        <!-- game master actions strip -->
        @auth
            @if(Auth::User()->id == $gameSession->user_id or Auth::User()->status == 'Admin' )
                <div class="row strip">
                    <div class="col-lg-12 vignette green-bg">

                        <div class="evenboxinner-turn">Gestion de la partie</div>
                        <br/>
                        <a href="{{route("gameturn.create-turn", $gameSession->slug)}}" role="button"
                           class="btn btn-secondary lined thin"><i class="fas fa-pen-alt"></i>Ajouter un tour</a>
                        @include("gamesessions.modals.modalGameSessionEdit")
                        @include("gamesessions.modals.modalDeleteGameSession")
                        @if($lastTurnId>-1)
                            @include("gamesessions.modals.modalTurnNotification")
                        @endif
                    </div>
                </div>
            @endif
        @endauth
    <!--end game master actions strip-->

        <!--title strip-->
        @if($gameTurns->last() != null)
            <div class="row strip">
                <div class="col-lg-12 vignette red-bg turn-title-strip">
                    <div class="evenboxinner-turn">
                        Le @include('utils.date_french',['date'=> $gameTurns->last()->created_at])</div>

                    <br/>

                    <div>
                        <h3 class="last-turn-title orange">{!! $gameTurns->last()->title !!}</h3>
                    </div>
                </div>
            </div>
        @endif

    <!--end title strip-->
        <!--short description & orders strip-->
        @if($gameTurns->last() != null)
            <div class="row strip white-bg">
                <div class="col-md-6 box-left">
                    <div class="evenboxinner-turn">Résumé du tour</div>
                    <div class="vignette green-bg full-height">@auth
                            @if( Auth::User()->id == $gameSession->user_id)
                                @include("gamesessions._partials.menuTurnActions")
                            @endif
                        @endauth
                        {{--Display Lock --}}
                        @include('gamesessions._partials.lock',['lock'=>$gameTurns->last()->locked])
                        {{--End Display Lock --}}
                        {!! $gameTurns->last()->description !!}
                        @foreach($gameTurns->reverse() as $gameTurn)
                            @if($loop->iteration > 1)
                                @break
                            @endif

                            @auth
                                @if(Auth::User()->id == $gameSession->user_id and $gameTurn->id == $lastTurnId and $gameTurn->locked == false)

                                    {{--Dropzone Upload Form--}}
                                    @include('gamesessions._partials.dz_form',['id'=>$gameTurn->id, 'category'=>'gameturns','text'=>'Déposer les fichiers ici ou cliquer ou uploader'])
                                    {{--End Dropzone Upload Form--}}

                                    {{--Dropzone Preview Template--}}
                                    @include('gamesessions._partials.dz_preview_template')
                                    {{--End of Dropzone Preview Template--}}

                                    <br/>
                                    <button class="btn btn-secondary lined thin" type="button" data-toggle="collapse"
                                            data-target="#respudUpload" aria-expanded="false"
                                            aria-controls="collapseExample">
                                        Problème d'upload?
                                    </button>

                                    <div class="collapse" id="respudUpload">
                                        <div class="card card-body">
                                            @include('gamesessions._partials.respud_file_upload')
                                        </div>
                                    </div>
                                @endif

                                @if((Auth::User()->id == $gameSession->user_id or Auth::User()->status='Admin') and $gameTurn->locked == false)
                                    @include("gamesessions.modals.modalEditTurn")
                                @endif
                            @endauth
                        @endforeach
                        <table class="table-hover">

                            <tbody>
                            @foreach($gameMasterFiles as $file)
                                <tr>
                                    <td><p>{{$file->original_name}}</p></td>

                                    <td>{!! Html::link("uploads/$file->filename", "", ['download'=> $file->original_name, 'class'=>'fas fa-download'] ) !!}

                                        @auth
                                            &nbsp;&nbsp;&nbsp;@if(Auth::User()->id == $gameSession->user_id)
                                                @include('gamesessions._partials.delete_file')
                                            @endif
                                        @endauth
                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <br/>
                        <a href="{{route('gameturn.show', $gameTurns->last()->id)}}" role="button"
                           class="btn btn-warning lined thin float-right">Fiche détaillée</a>
                        <br/>

                    </div>
                </div>
                <div class="col-md-6 box-right">
                    <div class="evenboxinner-descriptive">Ordres</div>
                    <div class="vignette blue-bg full-height">

                        <div class="row player-slot white-bg col-12">
                            <div class="col-3  slot-cell-left"><p> {{$gamemaster->first()->getusers->username}}</p>

                                @auth
                                    @if(Auth::User()->id == $gameSession->user_id and $gameTurns->last()->locked == false)
                                        @include('gamesessions._partials.btn_edit_player_slot',['turn'=>$gameTurns->last()->id ,'user_id'=>$gameSession->user_id])
                                    @endif
                                @endauth
                            </div>
                            <div class="col-7">
                                @if($orders->get($gameSession->user_id)->updated_at != $orders->get($gameSession->user_id)->created_at)
                                    <p> @include('utils.date_french',['date'=>$orders->get($gameSession->user_id)->updated_at])</p>
                                @endif
                                <p> {!! $orders->get($gameSession->user_id)->message!!}</p>
                            </div>
                            <div class="col-2  slot-cell-right">
                                @auth

                                    @if(Auth::User()->id == $gameSession->user_id and $gameTurns->last()->locked == false)

                                        @include('gamesessions._partials.dz_form',['id'=>$orders->get($gameSession->user_id)->id, 'category'=>'turnorders', 'text'=>'Fichier'])
                                        {{--Dropzone Preview Template--}}
                                        @include('gamesessions._partials.dz_preview_template')
                                        {{--End of Dropzone Preview Template--}}
                                    @endif

                                @endauth
                            </div>
                        </div>


                        @foreach($players as $player)


                            <div class="row player-slot white-bg col-12">
                                <div class="col-3 slot-cell-left">
                                    <p> {{$player->getusers->username}}</p>
                                    @auth
                                        @if(Auth::User()->id == $player->user_id and $gameTurns->last()->locked == false )
                                            @include('gamesessions._partials.btn_edit_player_slot',['turn'=>$gameTurns->last()->id ,'user_id'=>$player->user_id])
                                        @endif
                                    @endauth
                                </div>
                                <div class="col-7">
                                    @if($orders->get($player->user_id)->updated_at != $orders->get($player->user_id)->created_at)
                                        <p> @include('utils.date_french',['date'=>$orders->get($player->user_id)->updated_at])</p>
                                    @endif
                                    <p>{!! $orders->get($player->getusers->id)->message!!}</p></div>
                                <div class="col-2 slot-cell-right">
                                    @auth
                                        @if(Auth::User()->id == $player->user_id and $gameTurns->last()->locked == false)
                                            @include('gamesessions._partials.dz_form',['id'=>$orders->get($player->getusers->id)->id, 'category'=>'turnorders', 'text'=>'Fichier'])
                                            {{--Dropzone Preview Template--}}
                                            @include('gamesessions._partials.dz_preview_template')
                                            {{--End of Dropzone Preview Template--}}
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    @endif
    <!--End short description & players slots strip-->
        <!--previous turns strip-->
        <div class="row strip white-bg">
            @foreach($gameTurns->reverse() as $gameTurn)
                @include('gamesessions._partials.archives_vignettes',['index'=>$loop->index,
                'nbTurn'=>$gameTurns->count(),
                'title'=>$gameTurn->title,
                'id'=>$gameTurn->id])
            @endforeach
        </div>

        <!--end previous turns strip-->
    </div>
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })


    </script>
@endsection