<!-- Button HTML (to Trigger Modal) -->
<a class="btn btn-warning" href="#modalEditTurn" data-toggle="modal" role="button"><i class="fas fa-edit"></i>Editer le tour</a>

<!-- Modal HTML -->
<div class="modal fade" id="modalEditTurn" style="display: none;">
    <div class="modal-dialog modal-confirm">

        @include("gameturns.form.gameturnsEdit")

    </div>
</div>