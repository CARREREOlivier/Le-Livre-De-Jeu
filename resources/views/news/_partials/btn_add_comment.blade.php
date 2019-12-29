<!-- Button trigger modal -->
<button type="button" class="btn btn-primary lined thin" data-toggle="modal" data-target="#commentModal">
    Laisser un commentaire
</button>

<!-- Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
    {{Form::open(array('route' => 'infocomment.store', 'method' => 'POST'))}}
    {!! csrf_field() !!}
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel"><i class="fas fa-pencil-alt"></i>Commentaire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::hidden('info_post_id', $post->id) !!}
                {!! Form::textarea('text') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary lined thin" data-dismiss="modal">Annuler</button>
                {{Form::submit('Ajouter un commentaire', array('class'=>'btn btn-secondary lined thin float-right'))}}

            </div>
        </div>
    </div>
    {{Form::close()}}
</div>

