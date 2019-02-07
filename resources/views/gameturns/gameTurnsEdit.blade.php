@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">

        <div class="row row-title"><h1 class="title big">Editer le tour</h1></div>

        {!! Form::model($gameTurn, array('route' => array('gameturn.update', $gameTurn->id),'method' => 'PUT')) !!}
        {!! csrf_field() !!}


        {!! Form::hidden('gamesessions_id',$gameTurn->gamesessions_id) !!}

        <div class="row strip">
            <div class="vignette red-bg pencil">
                <div class="row">>
                    <div class="col-lg-1">  {!! Form::label('title', 'Titre:') !!}</div>
                    <div class="col-lg-10">   {!! Form::text('title',"$gameTurn->title", array('required'=>'required', 'class'=>'gameSessionTitleInput')) !!}</div>
                </div>
            </div>
        </div>
        <div class="row strip">
            <div class="vignette blue-bg  pencil">
                {!! Form::label('description', 'Résumé:') !!}{!! Form::textarea('description') !!}</div>
        </div>
        <div class="row strip">
            <div class="vignette green-bg pencil">
                {!! Form::label('long_description', 'Description détaillée:') !!}{!! Form::textarea('long_description') !!}
                <br/>
                {!! Form::submit('Mettre à jour', array('class'=>'btn btn-secondary lined thin float-right')) !!}
            </div>
        </div>


        {!! Form::close() !!}

    </div>
@endsection