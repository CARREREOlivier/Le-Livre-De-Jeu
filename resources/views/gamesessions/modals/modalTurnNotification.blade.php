<!-- Button trigger modal -->
<button type="button" class="btn btn-secondary lined thin" data-toggle="modal" data-target="#sendNotification">
    Avertir les joueurs
</button>

<!-- Modal -->
<div class="modal fade" id="sendNotification" tabindex="-1" role="dialog" aria-labelledby="sendNotificationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendNotificationLabel"><i class="fas fa-envelope"></i><i class="fas fa-arrow-right"></i>Envoyer une notification aux joueurs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Vous êtes sur le point d'envoyer une notification à tous les joueurs de la partie qu'un nouveau tour est disponible.
                <br/>
                Avant de le faire assurez-vous que tout est prêt pour l'envoi.
                <br/>
                Etes vous sur de vouloir faire ceci?

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary lined thin" data-dismiss="modal">Annuler</button>
                {{ Form::open(['route' => ['gamesession.sendnotification', $gameTurn->id], 'method' => 'get']) }}
                <button type="submit" class="btn btn-danger lined thin">Envoyer les mails<</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>