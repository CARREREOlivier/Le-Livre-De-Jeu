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
                    <p>Créé le {{$gameTurn->created_at}}</p>

                    @if($gameTurn->updated__at != null)
                        <p>Dernière modification :{{$gameTurn->updated__at}}</p>
                    @endif
                    <p>par : <strong>{{$gamemaster->name}}</strong></p>

                </div>
            </div>
        </div>
        <!--end top strip-->
        <!--gamemaster actions strip-->
        @auth

            @if($gamemaster->id == Auth::User()->id)
                <div class="row strip white-bg">
                    <div class="col-lg-12 vignette red-bg">
                        <a href="{{route('gameturn.edit',$gameTurn->id)}}" role="button" class="btn btn-secondary lined thin">Editer le tour</a>

                        {{ Form::open(['route' => ['gameturn.destroy', $gameTurn->id], 'method' => 'delete']) }}
                        <button type="submit" class="btn btn-danger lined thin">Effacer le tour</button>
                        {{ Form::close() }}
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
                    @if($gamemaster_files != null)
                        <p>{!! $gamemaster_files->original_name !!}</p>
                    @else
                        <p>pas de fichier associé</p>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 box-right">
                <div class="vignette yellow-bg full-height"></div>
                <div class="evenboxinner-turn">Ordres Passés</div>
                <br/>
                @if($orders != null)
                    <table class="table-hover">
                        <tbody>
                        @foreach($orders as $order)
                            @if($order->message != "")
                                <tr>
                                    <td><p>{!! $order->updated_at !!} par {{$order->name}}</p></td>
                                    <td><p>{!! $order->message !!}</p></td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <!--end description and orders strip-->
        <!--long description-->
        <div class="row strip white-bg">
            <div class="col-lg-12 vignette green-bg">
                <div class="evenboxinner-turn">
                    Description Détaillée
                </div>
                {!! $gameTurn->long_description !!}
            </div>
        </div>
        <!--end long description-->
    </div>
@endsection