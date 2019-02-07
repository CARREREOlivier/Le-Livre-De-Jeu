<div class="dropdown d-inline-block">
    <button class="btn btn-warning dropdown-toggle lined thin" type="button" id="dropdownMenuButton"
            data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" data-placement="right" title="Menu du tour">
        <i class="fas fa-bars"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @if($gameTurns->last()->locked == true and Auth::User()->id == $gameSession->user_id )
            {{ Form::open(['route' => ['gameturn.lock', $gameTurns->last()->id], 'method' => 'post']) }}
            <button type="submit" class="dropdown-item pencil-small">
                <i class="fas fa-lock-open" aria-hidden="true"></i> Déverrouiller
            </button>
            {{ Form::close() }}
        @elseif($gameTurns->last()->locked == false and Auth::User()->id == $gameSession->user_id)
            {{ Form::open(['route' => ['gameturn.lock', $gameTurns->last()->id], 'method' => 'post']) }}
            <button type="submit" class="dropdown-item pencil-small">
                <i class="fas fa-lock" aria-hidden="true"></i> Verrouiller
            </button>
            {{ Form::close() }}

        @endif

        <a href="{{route('gameturn.edit',$gameTurns->last()->id)}}" role="button"
           class="dropdown-item"><i class="fas fa-edit"></i> Editer le tour</a>
        <a class="dropdown-item" href="#modalDeleteTurn" data-toggle="modal" role="button"><i class="fas fa-trash"></i>
            Effacer
            le tour</a>

        @if($gameMasterFiles->count()>0 or $orderFileExists == true)
            <a class="dropdown-item" href="/downloadZip/{{$gameTurns->last()->id}}"><i class="fas fa-file-download"></i>
                Télécharger les fichiers du tour</a>
        @endif


    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="dropdown"]').tooltip()
    })
</script>
