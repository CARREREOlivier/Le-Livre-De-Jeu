<div class="dropdown d-inline-block">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bars"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @if($gameTurn->locked == true and Auth::User()->id == $gameSession->user_id )
            {{ Form::open(['route' => ['gameturn.lock', $gameTurn->id], 'method' => 'post']) }}
            <button type="submit" class="dropdown-item">
                <i class="fas fa-lock-open" aria-hidden="true"></i> Déverrouiller
            </button>
            {{ Form::close() }}
        @elseif($gameTurn->locked == false and Auth::User()->id == $gameSession->user_id)
            {{ Form::open(['route' => ['gameturn.lock', $gameTurn->id], 'method' => 'post']) }}
            <button type="submit" class="dropdown-item">
                <i class="fas fa-lock" aria-hidden="true"></i> Verrouiller
            </button>
            {{ Form::close() }}

        @endif

        <a class="dropdown-item" href="#modalEditTurn" data-toggle="modal" role="button"><i
                    class="fas fa-edit"></i>Editer le tour</a>
        <a class="dropdown-item" href="#modalDeleteTurn" data-toggle="modal" role="button"><i class="fas fa-trash"></i> Effacer
            le tour</a>
        <a class="dropdown-item" data-toggle="modal" data-target="#modalDropzone">
            <i class="fas fa-file-upload"></i> Ajouter Fichiers
        </a>
        <a class="dropdown-item"><i class="fas fa-file-download"></i> Télécharger les fichiers du tour</a>
    </div>
</div>

