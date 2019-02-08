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
                </div>
            </div>
            <div class="col-lg-3  box-right">
                <div class="vignette green-bg full-height">
                    <div class="evenboxinner-descriptive ">{{$gameSession->game}}</div>
                    <br/>
                    <p>Créé le {{$gameTurn->created_at}}</p>

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
                    @if($gamemaster_files != null)
                        @foreach($gamemaster_files as $file)
                            <tr><td><p>{!! $file->original_name !!}
                            </p></td><td><a href="/images/{{$file->filename}}" download="{{$file->original_name}}">
                                    <i class="fas fa-download"></i></a></td>

                               <td> @if(Auth::User()->id == $gameSession->user_id) &nbsp;&nbsp;&nbsp; <a
                                        class="delete-link"
                                        href="{{route('upload.delete_file',$file->id)}}"
                                        onclick="confirmDeletion()"> <i
                                            class="fas fa-trash-alt"></i></a></td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <p>pas de fichier associé</p>
                    @endif
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="col-lg-6 box-right">
                <div class="vignette yellow-bg full-height">
                    <div class="evenboxinner-turn">Ordres Passés</div>
                    <br/>
                    @if($orders != null)
                        <table class="table-hover">
                            <tbody>
                            @foreach($orders as $order)
                                @if($order->message != "" and $order->gameturn_id == $gameTurn->id)
                                    <tr>

                                        <td><p>{!! $order->updated_at !!} par {{$order->username}}</p></td>
                                        <td><p>{!! $order->message !!}</p></td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    @endif
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