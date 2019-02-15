<button type="button" class="btn btn-primary lined thin" data-toggle="modal" data-target="#change-status{{$user->id}}">
    <i class="fas fa-pencil-ruler"></i>
</button>
<br/>
<!-- Modal -->
<div class="modal fade" id="change-status{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="change-statusLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        {{Form::model($user, array('route' => array('admin.update_user', $user->id),'method' => 'PUT'))  }}
        {{csrf_token()}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="change-statusLabel"><i class="fas fa-pencil-ruler"></i>
                    Editer {{$user->username}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">

                {{Form::label('username', 'Pseudo')}}
                {{Form::text('username', $user->username )}}
                <br/>
                {{Form::label('email', 'E-Mail')}}
                {{Form::text('email', $user->email )}}
                <br/>
                {{Form::label('status', 'Statut : ')}}
                {{ Form::select('status', ['Admin','User'], null, $attributes = array('class'=>'form-control')) }}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary lined thin" data-dismiss="modal">Fermer</button>
                {{Form::submit('Valider',['class'=>'btn btn-primary lined thin'])}}

            </div>
        </div>
        {{Form::close()}}
    </div>
</div>