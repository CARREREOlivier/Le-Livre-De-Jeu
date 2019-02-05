@extends('layouts.app')

@section('js')
    <!--<script src="{{ url('/js/jquery.js') }}"></script>-->
    <script src="{{ url('/js/dropzone.js') }}"></script>
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
                            <p>Créée le:{{date('d-M-Y à H:i', strtotime($gameSession->created_at))}}</p>
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
                                    {{$gm->getusers->name}}
                                @endforeach
                                <br/>
                                <strong>Joueurs :</strong>
                                @foreach($players as $player)
                                    @if($loop->last)
                                        {{$player->getusers->name}}
                                    @else
                                        {{$player->getusers->name}} -

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
                        @include("gamesessions.modals.modalAddTurn")
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
                        Le {{date('d-M-Y à H:i', strtotime($gameTurns->last()->created_at))}}</div>

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
                        @if($gameTurns->last()->locked == true)
                            <p class="text-left statut">statut : <i class="fas fa-lock"></i></p>
                        @elseif($gameTurns->last()->locked == false)
                            <p class="text-left">statut : <i class="fas fa-lock-open"></i></p>
                        @endif

                        {!! $gameTurns->last()->description !!}
                        @foreach($gameTurns->reverse() as $gameTurn)
                            @if($loop->iteration > 1)
                                @break
                            @endif

                            @auth
                                @if(Auth::User()->id == $gameSession->user_id and $gameTurn->id == $lastTurnId and $gameTurn->locked == false)
                                    <form method="post" action="{{ url('/files-save') }}"
                                          enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="category" value="gameturns">
                                        <input type="hidden" name="entity_id" value={{$gameTurn->id}}>
                                        <div class="dz-message">
                                            <div class="col-xs-8">
                                                <div class="message">
                                                    <p>Déposer les fichiers ici ou cliquer pour uploader</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fallback">
                                            <input type="file" name="file" multiple>
                                        </div>
                                    </form>


                                    {{--Dropzone Preview Template--}}
                                    <div id="preview" style="display: none;">

                                        <div class="dz-preview dz-file-preview">
                                            <div class="dz-image"><img data-dz-thumbnail/></div>

                                            <div class="dz-details">
                                                <div class="dz-size"><span data-dz-size></span></div>
                                                <div class="dz-filename"><span data-dz-name></span></div>
                                            </div>
                                            <div class="dz-progress"><span class="dz-upload"
                                                                           data-dz-uploadprogress></span></div>
                                        </div>
                                    </div>
                                    {{--End of Dropzone Preview Template--}}


                                @endif

                                @if(Auth::User()->id == $gameSession->user_id and $gameTurn->locked == false)
                                    @include("gamesessions.modals.modalEditTurn")
                                    @include("gamesessions.modals.modalDeleteTurn")
                                @endif
                            @endauth
                        @endforeach
                        <table class="table-hover">

                            <tbody>
                            @foreach($gameMasterFiles as $file)
                                <tr>
                                    <td>{{$file->original_name}}</td>
                                    @auth
                                        <td><a href="/images/{{$file->filename}}" download="{{$file->original_name}}">
                                                <i
                                                        class="fas fa-download"></i></a>
                                            &nbsp;&nbsp;&nbsp;@if(Auth::User()->id == $gameSession->user_id) <a
                                                    class="delete-link"
                                                    href="{{route('upload.delete_file',$file->id)}}"
                                                    onclick="confirmDeletion()"> <i
                                                        class="fas fa-trash-alt"></i></a>
                                            @endif
                                        </td>
                                    @endauth
                                </tr>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6 box-right">
                    <div class="evenboxinner-descriptive">Ordres</div>
                    <div class="vignette blue-bg full-height">
                        @if($orders->get($gameSession->user_id)->updated_at != $orders->get($gameSession->user_id)->created_at)

                            <div class="row player-slot white-bg col-12" data-toggle="tooltip" data-placement="left"
                                 title="{{$orders->get($gameSession->user_id)->updated_at}}">
                                @else
                                    <div class="row player-slot white-bg col-12">
                                        @endif
                                        <div class="col-3  slot-cell-left"><p> {{$gamemaster->first()->getusers->name}}
                                            </p>
                                            @auth
                                                @if(Auth::User()->id == $gameSession->user_id and $gameTurns->last()->locked == false)

                                                    <button type="button" class="btn btn-primary lined thin"
                                                            data-toggle="modal"
                                                            data-target="#modalEditOrder{{$orders->get($gameSession->user_id)->id}}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <!-- Edit Order Modal -->
                                                    <div class="modal fade"
                                                         id="modalEditOrder{{$orders->get($gameSession->user_id)->id}}"
                                                         tabindex="-1" role="dialog"
                                                         aria-labelledby="modalEditOrder{{$orders->get($gameSession->user_id)->id}}"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            {!! Form::model($orders, array('route' => array('turnorder.update', $orders->get($gameSession->user_id)->id),'method' => 'PUT')) !!}
                                                            {!! csrf_field() !!}
                                                            {!! Form::hidden('gameturn_id',$gameTurns->last()->id) !!}
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="modaleditOrder{{$orders->get($gameSession->user_id)->id}}">
                                                                        <i class="fas fa-signature"></i>Enregistrer
                                                                        mes ordres</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>

                                                                </div>
                                                                <div class="modal-body">

                                                                    <table>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td> {!! Form::label('message', 'Message:') !!}</td>
                                                                            <td> {!! Form::textarea('message', $orders->get($gameSession->user_id)->message) !!}</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>


                                                                </div>

                                                                <div class="modal-footer">

                                                                    <button type="button"
                                                                            class="btn btn-primary lined thin"
                                                                            data-dismiss="modal">Annuler
                                                                    </button>
                                                                    {!! Form::submit('Editer', array('class'=>'btn btn-secondary lined thin')) !!}
                                                                </div>

                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                        <div class="col-7">
                                            {!! $orders->get($gameSession->user_id)->message!!}
                                        </div>
                                        <div class="col-2  slot-cell-right">
                                            @auth

                                                @if(Auth::User()->id == $gameSession->user_id and $gameTurns->last()->locked == false)
                                                    <form method="post" action="{{ url('/files-save') }}"
                                                          enctype="multipart/form-data" class="dropzone"
                                                          id="my-dropzone">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="category" value="turnorders">
                                                        <input type="hidden" name="entity_id"
                                                               value={{$orders->get($gameSession->user_id)->id}}>
                                                        <div class="dz-message">
                                                            <div class="col-xs-8">
                                                                <div class="message">
                                                                    <p>Fichier</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="fallback">
                                                            <input type="file" name="file" multiple>
                                                        </div>
                                                    </form>
                                                    {{--Dropzone Preview Template--}}
                                                    <div id="preview" style="display: none;">

                                                        <div class="dz-preview dz-file-preview">
                                                            <div class="dz-image"><img data-dz-thumbnail/></div>

                                                            <div class="dz-details">
                                                                <div class="dz-size"><span data-dz-size></span></div>
                                                                <div class="dz-filename"><span data-dz-name></span>
                                                                </div>
                                                            </div>
                                                            <div class="dz-progress"><span class="dz-upload"
                                                                                           data-dz-uploadprogress></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--End of Dropzone Preview Template--}}
                                                @endif

                                            @endauth
                                        </div>

                                    </div>


                                    @foreach($players as $player)
                                        @if($orders->get($player->user_id)->updated_at != $orders->get($player->user_id)->created_at)
                                            <div class="row player-slot white-bg col-12" data-toggle="tooltip"
                                                 data-placement="left"
                                                 title="{{$orders->get($player->user_id)->updated_at}}">
                                                @else
                                                    <div class="row player-slot white-bg col-12">
                                                        @endif
                                                        <div class="col-3 slot-cell-left">
                                                            <p> {{$player->getusers->name}}</p>
                                                            @auth
                                                                @if(Auth::User()->id == $player->user_id and $gameTurns->last()->locked == false)
                                                                    <button type="button" class="btn btn-primary lined thin"
                                                                            data-toggle="modal"
                                                                            data-target="#modalEditOrder{{$orders->get($player->user_id)->id}}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                    <!-- Edit Order Modal -->
                                                                    <div class="modal fade"
                                                                         id="modalEditOrder{{$orders->get($player->user_id)->id}}"
                                                                         tabindex="-1" role="dialog"
                                                                         aria-labelledby="modalEditOrder{{$orders->get($player->user_id)->id}}"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            {!! Form::model($orders, array('route' => array('turnorder.update', $orders->get($player->user_id)->id),'method' => 'PUT')) !!}
                                                                            {!! csrf_field() !!}
                                                                            {!! Form::hidden('gameturn_id',$gameTurns->last()->id) !!}
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="modaleditOrder{{$orders->get($player->user_id)->id}}">
                                                                                        <i class="fas fa-signature"></i>Enregistrer
                                                                                        mes ordres</h5>
                                                                                    <button type="button" class="close"
                                                                                            data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>

                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <table>
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td> {!! Form::label('message', 'Message:') !!}</td>
                                                                                            <td> {!! Form::textarea('message', $orders->get($player->user_id)->message) !!}</td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>


                                                                                </div>

                                                                                <div class="modal-footer">

                                                                                    <button type="button"
                                                                                            class="btn btn-primary lined thin"
                                                                                            data-dismiss="modal">Annuler
                                                                                    </button>
                                                                                    {!! Form::submit('Editer', array('class'=>'btn btn-secondary lined thin')) !!}
                                                                                </div>

                                                                            </div>
                                                                            {!! Form::close() !!}
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endauth
                                                        </div>
                                                        <div class="col-7">{!! $orders->get($player->getusers->id)->message!!}</div>
                                                        <div class="col-2 slot-cell-right">
                                                            @auth
                                                                @if(Auth::User()->id == $player->user_id and $gameTurns->last()->locked == false)
                                                                    <form method="post"
                                                                          action="{{ url('/files-save') }}"
                                                                          enctype="multipart/form-data" class="dropzone"
                                                                          id="my-dropzone">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="category"
                                                                               value="turnorders">
                                                                        <input type="hidden" name="entity_id"
                                                                               value={{$orders->get($player->getusers->id)->id}}>
                                                                        <div class="dz-message">
                                                                            <div class="col-xs-8">
                                                                                <div class="message">
                                                                                    <p>Fichier</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="fallback">
                                                                            <input type="file" name="file" multiple>
                                                                        </div>
                                                                    </form>
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
                            @if(!$loop->first)
                                @if($loop->index%3 == 0)
                                    <div class="col-md-4 archive-right">
                                        <div class="evenboxinner-descriptive ">
                                            Tour {{$gameTurns->count()-$loop->index}}
                                        </div>
                                        <div class="vignette orange-bg  full-height">
                                            <p>{{$gameTurn->title}}</p>
                                            <a href="#" role="button" class="btn btn-warning lined thin">Lire</a>
                                        </div>
                                    </div>
                    </div>
                    <div class="row strip white-bg">

                        @elseif($loop->index%3 == 1)
                            <div class="col-md-4 archive-left">
                                <div class="evenboxinner-turn">
                                    Tour {{$gameTurns->count()-$loop->index}}
                                </div>
                                <div class="vignette blue-bg  full-height">
                                    <p>{{$gameTurn->title}}</p>
                                    <a href="#" role="button" class="btn btn-warning lined thin">Lire</a>
                                </div>
                            </div>
                        @elseif($loop->index%3 == 2)
                            <div class="col-md-4 archive-center">
                                <div class="evenboxinner-descriptive">
                                    Tour {{$gameTurns->count()-$loop->index}}
                                </div>
                                <div class="vignette green-bg  full-height">
                                    <p>{{$gameTurn->title}}</p>
                                    <a href="#" role="button" class="btn btn-warning lined thin">Lire</a>
                                </div>
                            </div>
                        @endif
                        @endif
                        @endforeach

                    </div>

                    <!--end previous turns strip-->
                </div>
                <script type="text/javascript">
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    })

                    function confirmDeletion() {
                        confirm("Souhaitez-vous effacer ce fichier?");
                    }

                </script>
@endsection