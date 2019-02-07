@extends('layouts.app')


@section('content')




    <div class="container mt-5 mb-5">
        <div class="row row-title"><h1 class="big title">Ajouter un tour</h1></div>

        {!! Form::open(array('route' => 'gameturn.store', 'method' => 'POST')) !!}

        {!! Form::hidden('gamesessions_id',$gameSessionId) !!}
        <div class="row strip">
            <div class="vignette red-bg">
                <div class="row">
                    <div class="col-lg-1 pencil">
                    {!! Form::label('title', 'Titre:', ['id'=>'title-label']) !!}
                </div>
                <div class="col-lg-11 pencil">
                {!! Form::text('title','', array('required'=>'required', 'class'=>'gameSessionTitleInput')) !!}
                </div>
                </div>
            </div>
        </div>
        <div class="row strip ">
            <div class="vignette blue-bg full-height pencil">
                {!! Form::label('description', 'Résumé:') !!}
                {!! Form::textarea('description') !!}
            </div>
        </div>

        <div class="row strip">
            <div class="vignette blue-bg full-height pencil">
                {!! Form::label('long_description', 'Description détaillée:') !!}
                {!! Form::textarea('long_description') !!}
                <br/>
                {!! Form::submit('Ajouter', array('class'=>'btn btn-secondary lined thin float-right')) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>


@endsection
