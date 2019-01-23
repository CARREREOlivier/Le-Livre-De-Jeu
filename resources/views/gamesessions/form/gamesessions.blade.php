@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Create GameSession Form -->

{!! Form::open(array('route' => 'gamesession.store', 'method' => 'POST')) !!}
{!! csrf_field() !!}
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            {!! Form::label('title', 'Titre de la partie (obligatoire):') !!}
        </div>

        <div class="col-lg-9">
           {!! Form::text('title','', array('required'=>'required', 'class'=>'gameSessionTitleInput')) !!}
        </div>

    </div>
    <div class="row">
        <div class="col-lg-3">
            {!! Form::label('game', 'Jeu (optionnel):') !!}
        </div>
        <div class="col-lg-9">
            {!! Form::text('game') !!}
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg"> {!! Form::label('description', 'Description (optionnel):') !!}</div>
    </div>
    <div class="row">
        <div class="col-lg">{!! Form::textarea('description') !!}</div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg">@include('gamesessions.modals.modalAddPlayers')</div>
        <div class="col-lg">{!! Form::submit('Créer', array('class'=>'btn btn-primary')) !!}</div>
    </div>
</div>

{!! Form::close() !!}

