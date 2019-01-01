@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <button type="button" class="btn btn-primary btn-lg">Créer une nouvelle partie</button>
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
                                <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>

                                <button type="button" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>
                                </button>

                                <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>
                                </button>
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