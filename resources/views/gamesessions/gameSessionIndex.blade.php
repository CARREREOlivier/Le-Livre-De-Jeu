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

                <table class="table table-hover">

                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Titre</th>
                        <th scope="col">Jeu</th>
                        <th scope="col">Par</th>
                        <th scope="col">Créé le</th>

                        <th scope="col">Actions</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($gamesessions as $gameSession)

                        <tr>
                            <td class="clickable" aria-expanded="false" aria-controls="gameDescription"
                                data-target="#gameDescription-{{$gameSession->id}}" data-toggle="collapse"><i
                                        class="fa fa-plus" aria-hidden="true"></i></td>
                            <td>{{$gameSession->title}}</td>
                            <td>{{$gameSession->game}}</td>
                            <td>{{$gameSession->getUserNames->name}}</td>
                            <td>{{$gameSession->created_at}}</td>
                            <td>
                                <form action="{{ route('gamesession.show', $gameSession->slug) }}" method="GET">
                                    @method('GET')
                                    @csrf
                                    <button><i class="fas fa-eye"></i></button>
                                </form>
                                @auth
                                    @if(Auth::User()->id == $gameSession->getUserNames->id )
                                        <form action="{{ route('gamesession.edit', $gameSession->slug) }}" method="GET">
                                            @method('GET')
                                            @csrf
                                            <button><i class="fas fa-edit"></i></button>
                                        </form>

                                        <form action="{{ route('gamesession.destroy', $gameSession->slug) }}"
                                              method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button><i class="fas fa-trash"></i></button>
                                        </form>
                                    @endif
                                @endauth
                            </td>

                        </tr>
                        <tr>
                            <td colspan="5">
                                <div id="gameDescription-{{$gameSession->id}}"
                                     class="collapse">{{$gameSession->description}}</div>
                            </td>

                        </tr>


                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection