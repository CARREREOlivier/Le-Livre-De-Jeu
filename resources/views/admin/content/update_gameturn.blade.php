<h1 class="title">Admin: Editer un tour</h1>

{{Form::model($gameTurn, array('route' => array('admin.store_update_gameturn', $gameTurn->id),'method' => 'PUT'))}}

{!! csrf_field() !!}

<div class="row strip">
    <div class="vignette blue-bg">
        {!! Form::label('title', 'Titre :') !!}
        {!! Form::text('title', $gameTurn->title) !!}
        <br/>
        {!! Form::label('description', 'Description :') !!}
        {!! Form::textarea('description',$gameTurn->description) !!}
        <br/>
        {!! Form::label('long_description', 'Description Détaillée:') !!}
        {!! Form::textarea('long_description',$gameTurn->long_description) !!}
        <br/>
        {{Form::submit('Mettre à Jour', ['class'=>'btn btn-primary lined thin float-right'])}}
    </div>
</div>
{{Form::close()}}

