<!-- Button HTML (to Trigger Modal) -->
<a class="trigger-btn" href="#modalEditTurn" data-toggle="modal"><i class="fas fa-edit"></i>Editer un tour</a>

<!-- Modal HTML -->
<div class="modal fade" id="modalEditTurn" style="display: none;">
    <div class="modal-dialog modal-confirm">

        @include("gameturns.form.gameturnsEdit")

    </div>
</div>