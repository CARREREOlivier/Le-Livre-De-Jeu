@extends('layouts.app')

@section('content')

    <div class="container mt-5 mb-5">
        <!--top strip-->
        <div class="row strip white-bg">
            <div class="col-lg-9  box-left">
                <div class="vignette blue-bg full-height">
                    <div class="evenboxinner-turn"> {{$gameSession->title}}</div>
                    <br/>
                    <h1 class="title">{{$gameTurn->title}}</h1>
                    <a href="{{route('gamesession.show',$gameSession->slug)}}" role="button"
                       class="btn btn-primary lined thin"><i class="fas fa-caret-square-left"></i>Retour</a>
                </div>
            </div>
            <div class="col-lg-3  box-right">
                <div class="vignette green-bg full-height">
                    <div class="evenboxinner-descriptive ">{{$gameSession->game}}</div>
                    <br/>

                    <p>Créé le @include('utils.date_french', ['date'=>$gameTurn->created_at])</p>

                    @if($gameTurn->updated__at != null)
                        <p>Dernière modification :{{$gameTurn->updated__at}}</p>
                    @endif
                    <p>par : <strong>{{$gamemaster->username}}</strong></p>

                </div>
            </div>
        </div>
        <!--end top strip-->
        <!--gamemaster actions strip-->
        @auth
            @if($gamemaster->id == Auth::User()->id)
                <div class="row strip white-bg">
                    <div class="col-lg-12 vignette red-bg">
                        <div class="row">
                            <div class="col-2"><a href="{{route('gameturn.edit',$gameTurn->id)}}" role="button"
                                                  class="btn btn-secondary lined thin">Editer le tour</a>
                            </div>
                            <div class="col-10">
                                {{ Form::open(['route' => ['gameturn.destroy', $gameTurn->id], 'method' => 'delete']) }}
                                <button type="submit" class="btn btn-danger lined thin">Effacer le tour</button>
                                {{ Form::close() }}


                            </div>
                        </div>
                    </div>
                </div>
        @endif
    @endauth
    <!--end gamemaster actions strip-->

        <!--description and orders strip-->
        <div class="row strip white-bg">
            <div class="col-lg-6 box-left">
                <div class="vignette orange-bg full-height">
                    <div class="evenboxinner-turn">Résumé</div>
                    <br/>
                    <p>{!! $gameTurn->description !!}</p>
                    <table>
                        <tbody>
                          @include('gameturns._partials.table_row_gamemaster_files')
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="col-lg-6 box-right">
                <div class="vignette yellow-bg full-height">
                    <div class="evenboxinner-turn">Ordres Passés</div>
                    <br/>

                    <table class="table-hover" style="font-size: 75%">
                        <tbody>

                        @guest
                            @include('gameturns._partials.table_row_gamemaster')
                            @include('gameturns._partials.table_row_players')
                        @endguest

                        @auth
                            @if($isLastTurn == false)
                                @include('gameturns._partials.table_row_gamemaster')
                                @include('gameturns._partials.table_row_players')
                            @endif

                            @if($isLastTurn == true and $isLocked == false)
                                @include('gameturns._partials.table_row_gamemaster')
                                @include('gameturns._partials.table_row_players')
                            @endif

                            @if($isLastTurn == true and $isLocked == true)
                                @include('gameturns._partials.table_row_gamemaster_allowed')
                                @include('gameturns._partials.table_row_players_allowed')
                            @endif
                        @endauth


                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <!--end description and orders strip-->
        <!--long description-->
        <div class="row strip white-bg">
            <div class="col-lg-12 vignette green-bg">
                <div class="evenboxinner-turn">
                    Description Détaillée
                </div>
                <br/>
                {!! $gameTurn->long_description !!}
            </div>
        </div>
        <!--end long description-->
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