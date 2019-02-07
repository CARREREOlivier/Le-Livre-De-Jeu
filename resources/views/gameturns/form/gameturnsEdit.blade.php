<div class="modal-content">
    {!! Form::model($gameTurn, array('route' => array('gameturn.update', $gameTurn->id),'method' => 'PUT')) !!}
    {!! csrf_field() !!}
    <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-pen-alt"></i>Editer un tour </h4>
        <button class="close" aria-hidden="true" type="button" data-dismiss="modal">×</button>
    </div>
    <div class="modal-body">


        {!! Form::hidden('gamesessions_id',$gameSession->id) !!}


        {!! Form::label('title', 'Titre:') !!}
        {!! Form::text('title') !!}
        <br/>
        {!! Form::label('description', 'Résumé:') !!}{!! Form::textarea('description') !!}

        {!! Form::label('long_description', 'Description:') !!}{!! Form::textarea('longdescription') !!}

    </div>
    <div class="modal-footer">
        <button class="btn btn-primary lined thin" type="button" data-dismiss="modal">Annuler</button>
        {!! Form::submit('Mettre à jour', array('class'=>'btn btn-secondary lined thin')) !!}

    </div>
    {!! Form::close() !!}
</div>
