@if($lock == true)
    <p class="text-left statut">statut : <i class="fas fa-lock"></i></p>
@elseif($lock == false)
    <p class="text-left">statut : <i class="fas fa-lock-open"></i></p>
@endif