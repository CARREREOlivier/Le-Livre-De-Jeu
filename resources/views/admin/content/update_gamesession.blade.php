{{Form::model($gameSession, array('route' => array('admin.store_update_gamesession', $gameSession->id),'method' => 'PUT'))}}

{!! csrf_field() !!}

<div class="row strip">
    <div class="vignette blue-bg">
        {!! Form::label('title', 'Titre :') !!}
        {!! Form::text('title', $gameSession->title) !!}
        <br/>
        {!! Form::label('description', 'Description :') !!}
        {!! Form::textarea('Description',$gameSession->description) !!}
        <br/>
        {{Form::submit('Mettre à Jour', ['class'=>'btn btn-primary lined thin float-right'])}}
    </div>
</div>
{{Form::close()}}