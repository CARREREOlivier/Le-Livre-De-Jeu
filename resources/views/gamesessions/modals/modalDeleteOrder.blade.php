<!-- Delete Order Modal HTML -->
<div class="modal fade" id="modalDeleteTurn" style="display: none;">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fas fa-trash fa-2x"></i>
                </div>
                <h4 class="modal-title">Certain de vouloir supprimer cet ordre</h4>
                <button class="close" aria-hidden="true" type="button" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <p>Voulez-vous vraiment supprimer cet ordre? Cette opération est <a href="https://www.larousse.fr/dictionnaires/francais/irréversible/44347">irréversible</a></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" type="button" data-dismiss="modal">Annuler</button>
                {{ Form::open(['route' => ['turnorder.destroy', $order->id], 'method' => 'delete']) }}
                <button type="submit" class="btn btn-danger">Supprimer</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>