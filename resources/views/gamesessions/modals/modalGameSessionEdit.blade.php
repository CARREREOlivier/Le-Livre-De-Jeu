<a class="btn btn-warning lined thin" href="#modalGameSessionEditTurn" data-toggle="modal" role="button">
    <i class="fas fa-edit"></i>Editer la partie</a>


<!-- Modal HTML -->
<div class="modal fade" id="modalGameSessionEditTurn" style="display: none;">
    <div class="modal-dialog modal-confirm">
        {!! Form::model($gameSession, array('route' => array('gamesession.update', $gameSession->id),'method' => 'PUT')) !!}
        {!! csrf_field() !!}
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-pen-alt"></i>Editer un tour </h4>
                <button class="close lined thin" aria-hidden="true" type="button" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                @include("gamesessions.form.gamesessionsEdit")
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary lined thin" type="button" data-dismiss="modal">Annuler</button>
                {!! Form::submit('Mettre à jour', array('class'=>'btn btn-secondary lined thin')) !!}
            </div>
        </div>
    </div>

    {!! Form::close() !!}
</div>