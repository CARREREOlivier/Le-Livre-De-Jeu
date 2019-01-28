<div class="modal-content">
    {!! Form::open(array('route' => 'gameturn.store', 'method' => 'POST')) !!}
    <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-pen-alt"></i>Ajouter un tour </h4>
        <button class="close" aria-hidden="true" type="button" data-dismiss="modal">×</button>
    </div>
    <div class="modal-body">


        {!! Form::hidden('gamesessions_id',$gameSession->id) !!}


        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title') !!}
        <br/>
        {!! Form::label('description', 'Description:') !!}
        {!! Form::textarea('description') !!}


    </div>
    <div class="modal-footer">
        <button class="btn btn-primary lined thin" type="button" data-dismiss="modal">Annuler</button>
        {!! Form::submit('Ajouter', array('class'=>'btn btn-secondary lined thin')) !!}

    </div>
    {!! Form::close() !!}
</div>