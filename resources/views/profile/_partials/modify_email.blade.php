<!-- Button trigger modal -->
<button type="button" class="btn btn-secondary lined thin" data-toggle="modal" data-target="#modifyEmailModal">
    <i class="fas fa-user-edit"></i>Modifier mon adresse email
</button>

<!-- Modal -->
<div class="modal fade" id="modifyEmailModal" tabindex="-1" role="dialog" aria-labelledby="modifyEmailModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{Form::model($user,array('route' => array('user.update', $user->id),'method' => 'PUT'))}}

            <div class="modal-header">
                <h5 class="modal-title" id="modifyEmailModalLabel"><i class="fas fa-user-edit"></i> Modifier mon adresse
                    email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                modifier mon email {{ $user->email }}
                {{Form::label('email', 'E-mail:')}}
                {{Form::text('email', $user->email)}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary lined thin" data-dismiss="modal">Annuler</button>
                {{Form::submit('Valider',['class'=>'btn btn-danger lined thin'])}}
            </div>
            {{Form::close()}}

        </div>
    </div>
</div>