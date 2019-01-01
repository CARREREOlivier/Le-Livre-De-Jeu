@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-hover">

                    <thead>
                    <tr>
                        <th scopte="col"></th>
                        <th scope="col">Titre</th>
                        <th scope="col">Jeu</th>
                        <th scope="col">Par</th>
                        <th scope="col">Créé le</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($gamesessions as $gamesession)

                        <tr>
                            <td class="clickable" aria-expanded="false" aria-controls="group-of-rows-1" data-target="#gameDescription" data-toggle="collapse"><i class="fa fa-plus" aria-hidden="true">+</i></td>
                            <td>{{$gamesession->title}}</td>
                            <td>{{$gamesession->game}}</td>
                            <td>{{$gamesession->getUserNames->name}}</td>
                            <td>{{$gamesession->created_at}}</td>
                            <td>buttons</td>

                        </tr>
                        <tr>
                            <td colspan="5">
                                <div id="gameDescription" class="collapse">{{$gamesession->description}}</div>
                            </td>

                        </tr>


                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection