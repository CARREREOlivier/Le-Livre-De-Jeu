@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row row-title"><h2 class="title big">Contacter l'Admin</h2></div>

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
        <div class="row strip">

            <div class="col-12 vignette blue-bg">
                {!! Form::open(array('route' => 'contact-mail', 'method' => 'POST')) !!}
                {!! csrf_field() !!}



                <div class="form-group">

                    {!! Form::label('title', 'Titre du mail:') !!}
                    {!! Form::text('title',"", array('required'=>'required','class'=>'form-control', 'placeholder'=>'Votre titre')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('message', 'Votre Message:') !!}
                    {!! Form::textarea('message',"Bonjour, ", array('required'=>'required', 'id'=>'contactTextarea')) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Envoyer le mail', array('class'=>'btn btn-warning lined thin')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div> <!-- /container -->

    </div>

@endsection