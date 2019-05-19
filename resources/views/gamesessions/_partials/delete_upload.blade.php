<!-- Delete Upload trigger modal -->
<button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalDeleteFile{{$file_id}}">
    <i class="fas fa-trash-alt red"></i>
</button>


<!-- Delete Upload Modal HTML -->
<div class="modal fade" id="modalDeleteFile{{$file_id}}" style="display: none;">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fas fa-trash fa-2x"></i>
                </div>
                <h4 class="modal-title">Certain de vouloir supprimer ce fichier</h4>
                <button class="close" aria-hidden="true" type="button" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <p>Voulez-vous vraiment supprimer ce fichier? Cette opération est <a
                            href="https://www.larousse.fr/dictionnaires/francais/irréversible/44347">irréversible</a>
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary lined thin" type="button" data-dismiss="modal">Annuler</button>
                <a class="btn btn-danger lined thin"  href="{{route('upload.delete_file',$file_id)}}" role="button">Supprimer</a>
            </div>
        </div>
    </div>
</div>