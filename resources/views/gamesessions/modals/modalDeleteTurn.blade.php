<!-- Button HTML (to Trigger Modal) -->
<a class="btn btn-danger" href="#modalDeleteTurn" data-toggle="modal" role="button"><i class="fas fa-trash"></i>Effacer le tour</a>

<!-- Modal HTML -->
<div class="modal fade" id="modalDeleteTurn" style="display: none;">
    <div class="modal-dialog modal-confirm">
    <div class="modal-content">
        <div class="modal-header">
            <div class="icon-box">
                <i class="fas fa-trash fa-2x"></i>
            </div>
            <h4 class="modal-title">Certain de vouloir effacer ce tour?</h4>
            <button class="close" aria-hidden="true" type="button" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body">
            <p>Voulez-vous vraiment effacer ce tour? Cette opération est <a href="https://www.larousse.fr/dictionnaires/francais/irréversible/44347">irréversible</a></p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-info" type="button" data-dismiss="modal">Annuler</button>
            {{ Form::open(['route' => ['gameturn.destroy', $gameTurn->id], 'method' => 'delete']) }}
            <button type="submit" class="btn btn-danger">Effacer</button>
            {{ Form::close() }}
        </div>
    </div>
</div>
</div>