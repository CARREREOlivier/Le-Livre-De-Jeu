@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row row-title"><h2 class="title big">Contacter l'Admin</h2></div>

        @if(session('message'))
            <div class='alert alert-success'>
                {{ session('message') }}
            </div>
        @endif
        <div class="row strip">

            <div class="col-12 vignette blue-bg">
                {!! Form::open(array('route' => 'contact-mail', 'method' => 'POST')) !!}
                {!! csrf_field() !!}


                <div class="form-group">
                    {!! Form::label('Name', 'Votre Nom:') !!}
                    {!! Form::text('name','taper votre nom ici', array('required'=>'required','class'=>'form-control')) !!}
                </div>

                <div class="form-group">

                    {!! Form::label('email', 'Votre Email:') !!}
                    {!! Form::text('email','john@example.com', array('required'=>'required','class'=>'form-control')) !!}
                </div>
                <script>$("#textarea_id").tinymce().remove();</script>
                <div class="form-group">
                    {!! Form::label('message', 'Votre Message:') !!}
                    {!! Form::textarea('message','Votre message ici', array('required'=>'required')) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Envoyer le mail', array('class'=>'btn btn-warning lined thick')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div> <!-- /container -->

    </div>
@endsection