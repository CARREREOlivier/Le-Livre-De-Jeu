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
                    @foreach($gamesessions as $gamesession)

                        <tr>
                            <td class="clickable" aria-expanded="false" aria-controls="gameDescription"
                                data-target="#gameDescription-{{$gamesession->id}}" data-toggle="collapse"><i
                                        class="fa fa-plus" aria-hidden="true"></i></td>
                            <td>{{$gamesession->title}}</td>
                            <td>{{$gamesession->game}}</td>
                            <td>{{$gamesession->getUserNames->name}}</td>
                            <td>{{$gamesession->created_at}}</td>
                            <td>
                                <form action="{{ route('gamesession.show', $gamesession->slug) }}" method="GET">
                                    @method('GET')
                                    @csrf
                                    <button><i class="fas fa-eye"></i></button>
                                </form>
                                @auth
                                    @if(Auth::User()->id == $gamesession->getUserNames->id )
                                        <form action="{{ route('gamesession.edit', $gamesession->slug) }}" method="GET">
                                            @method('GET')
                                            @csrf
                                            <button><i class="fas fa-edit"></i></button>
                                        </form>

                                        <form action="{{ route('gamesession.destroy', $gamesession->slug) }}"
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
                                <div id="gameDescription-{{$gamesession->id}}"
                                     class="collapse">{{$gamesession->description}}</div>
                            </td>

                        </tr>


                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection