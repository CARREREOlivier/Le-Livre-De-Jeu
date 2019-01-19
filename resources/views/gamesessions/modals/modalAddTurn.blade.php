<!-- Button HTML (to Trigger Modal) -->
<a class="btn btn-primary" href="#modalAddTurn" data-toggle="modal" role="button"><i class="fas fa-pen-alt"></i>Ajouter un tour</a>

<!-- modalAddTurn -->
<div class="modal fade" id="modalAddTurn" style="display: none;">
    <div class="modal-dialog modal-confirm">

        @include("gameturns.form.gameturns")

    </div>
</div>
<!--end modalAddTurn-->