@extends('layouts.app')


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


    @auth
        <div class="container mt-5 mb-5">

            <h2 class="title">{!! $user->username !!}</h2>

            <div class="row strip">
                <div class="vignette yellow-bg pencil">
                    <div class="row">
                        <div class="col-lg-2"><label>Email : </label></div>
                        <div class="col-lg-10"><p class="text-left">{!! $user->email !!}</p></div>
                    </div>
                    <br/>
                    @include('profile._partials.modify_email')
                    <hr>
                    <div class="row">
                        <div class="col-lg-12"> {{Form::open(array('route'=>'profile.reset.password'))}}
                            {{csrf_field()}}
                            {{Form::submit('Réinitialiser mon mot de passe', ['class'=>'btn btn-danger lined thin'])}}
                            {{Form::close()}}</div>
                    </div>
                </div>
            </div>
            <div class="row strip">
                <div class="vignette blue-bg pencil">
                    <p>Fichiers d'ordres</p>
                    <table class="table hover">
                        <thead>
                        <tr>
                            <th scope="col">Miniature</th>
                            <th scope="col">Date</th>
                            <th scope="col">Fichier</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($documents->reverse() as $document)
                            @if($document->category=='turnorders')
                                @include('profile._partials.file_table_row',["document"=>$document])
                            @endif
                        @endforeach
                        </tbody>

                    </table>

                    <p>Fichiers de tours</p>
                    <table class="table hover">
                        <thead>
                        <tr>
                            <th scope="col">Miniature</th>
                            <th scope="col">Date</th>
                            <th scope="col">Fichier</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($documents->reverse() as $document)
                            @if($document->category=='gameturns')
                                <tr>
                                    <td><img src="/uploads/{{ $document->resized_name }}"></td>
                                    <td>{{$document->created_at}}</td>
                                    <td>{{ $document->original_name}}</td>
                                    <td><a href="{{URL::to("/")."/uploads/".$document->filename}}"
                                           download="{{$document->original_name}}" role="button"
                                           class="btn btn-secondary lined thin"><i
                                                    class="fas fa-download"></i></a>@include('profile._partials.delete_file')
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>

                    </table>
                    <p>Sans categorie</p>
                    <table class="table hover">
                        <thead>
                        <tr>
                            <th scope="col">Miniature</th>
                            <th scope="col">Date</th>
                            <th scope="col">Fichier</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($documents->reverse() as $document)
                            @if($document->category==('uncategorized'))
                                <tr>
                                    <td><img src="/uploads/{{ $document->resized_name }}"></td>
                                    <td>{{$document->created_at}}</td>
                                    <td>{{ $document->original_name}}</td>
                                    <td><a href="{{URL::to("/")."/uploads/".$document->filename}}"
                                           download="{{$document->original_name}}" role="button"
                                           class="btn btn-secondary lined thin"><i
                                                    class="fas fa-download"></i></a> @include('profile._partials.delete_file')
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>


        </div>
    @endauth
@endsection