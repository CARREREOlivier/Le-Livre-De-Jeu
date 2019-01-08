<!-- Button HTML (to Trigger Modal) -->
<a class="trigger-btn" href="#modalAddTurn" data-toggle="modal"><i class="fas fa-pen-alt"></i>Ajouter un tour</a>

<!-- Modal HTML -->
<div class="modal fade" id="modalAddTurn" style="display: none;">
    <div class="modal-dialog modal-confirm">

        @include("gameturns.form.gameturns")

    </div>
</div>