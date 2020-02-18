<button class="btn btn-danger lined thin" title="Effacer le post" data-toggle="modal" data-target="#deletePost"><i class="fas fa-trash-alt"></i></button>

<div class="modal fade" id="deletePost" tabindex="-1" role="dialog" aria-labelledby="deletePostLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePostLabel"><i class="fas fa-trash-alt"></i>&nbsp;Effacer le post?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
             J'ai bien compris qu'effacer un post est une action irréversible et si je clique sur le gros bouton rouge, c'est terminé pour le post.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary lined thin" data-dismiss="modal">Non! n'efface rien!!!</button>
             <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
                {{ Form::open(array('method' => 'DELETE', 'route' => array('story_post.delete',$slug))) }}
                <button class="btn btn-danger lined thin">Effacer le post</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>