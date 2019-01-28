<!-- Dropzone Order Modal -->
<div class="modal fade" id="modalDropzone{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="modalDropzoneLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDropzoneLabel"><i class="fas fa-file-upload"></i>Upload de fichiers</h5>
                <button type="button" class="btn btn-primary lined thin" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('gamesessions._partials.dropzoneOrder')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary lined thin" data-dismiss="modal" value="Refresh Page" onClick="history.go(0)">Fermer</button>
            </div>
        </div>
    </div>
</div>