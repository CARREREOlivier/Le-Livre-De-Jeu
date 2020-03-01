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

            <div class="col-12 vignette blue-bg pencil">
                {!! Form::open(array('route' => 'contact-mail', 'method' => 'POST')) !!}
                {!! csrf_field() !!}


                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">{!! Form::label('title', 'Titre du mail(obligatoire):',['id'=>'contact-title-label']) !!}</div>
                        <div class="col-lg-9"> {!! Form::text('title',"", array('required'=>'required','class'=>'form-control', 'placeholder'=>'Votre titre')) !!}</div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('message', 'Votre Message (obligatoire):',['id'=>'message-label']) !!}
                    {!! Form::textarea('message',"Bonjour, ", array('required'=>'required', 'id'=>'contactTextarea')) !!}

                </div>

                <div class="form-group">
                    {!! Form::submit('Envoyer le mail', array('class'=>'btn btn-warning lined thin')) !!}
                </div>
                {!! Form::close() !!}


                <script>
                    CKEDITOR.replace( 'contactTextarea' );
                </script>
            </div>
        </div> <!-- /container -->

    </div>

@endsection