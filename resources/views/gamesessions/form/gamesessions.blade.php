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
<div class="container create-game">
    <div class="row row-title"><h2 class="title big h2-black">Créer une partie</h2></div>
    <div class="row strip">
        <div class="vignette green-bg">
            <div class="row">
                <div class="col-lg-3">
                    {!! Form::label('title', 'Titre de la partie (obligatoire):',['id'=>'title-label']) !!}
                </div>

                <div class="col-lg-9">
                    {!! Form::text('title','', array('required'=>'required', 'class'=>'gameSessionTitleInput','id'=>'gameSessionTitleInput')) !!}
                </div>

            </div>

            <div class="row">
                <div class="col-lg-3">
                    {!! Form::label('game', 'Jeu (obligatoire):',['id'=>'game-label']) !!}
                </div>
                <div class="col-lg-9">
                    {!! Form::text('game',null,['class'=>'gameInput']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row strip">
        <div class="vignette orange-bg">
            <div class="col-lg">{!! Form::label('description', 'Description (optionnel):',["id"=>"description-label"]) !!}
                {!! Form::textarea('description','',array('id'=>'gameSessionDescriptionInput')) !!}</div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg">@include('gamesessions.modals.modalAddPlayers')</div>
        <div class="col-lg">{!! Form::submit('Créer', array('class'=>'btn btn-secondary lined thin')) !!}</div>
    </div>

</div>

{!! Form::close() !!}

<script>
    CKEDITOR.replace( 'gameSessionDescriptionInput' );
</script>

