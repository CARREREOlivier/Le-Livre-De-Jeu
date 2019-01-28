<!--button to trigger modal delete gamesession-->

<a class="btn btn-danger lined thin" href="#modalDeleteGameSession" data-toggle="modal" role="button"><i class="fas fa-trash-alt"></i>Effacer la partie</a>

<!-- Modal delete gamesession -->
<div class="modal fade" id="modalDeleteGameSession" style="display: none;">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fas fa-trash fa-2x"></i>
                </div>
                <h4 class="modal-title">Certain de vouloir effacer cette partie?</h4>
                <button class="close" aria-hidden="true" type="button" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <p>Voulez-vous vraiment effacer cette partie? Cette opération est <a href="https://www.larousse.fr/dictionnaires/francais/irréversible/44347">irréversible</a></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary lined thin" type="button" data-dismiss="modal">Annuler</button>
                {{ Form::open(['route' => ['gamesession.destroy', $gameSession->slug], 'method' => 'delete']) }}
                <button type="submit" class="btn btn-danger lined thin">Effacer</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>