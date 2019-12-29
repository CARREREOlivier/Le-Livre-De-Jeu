<button class="btn btn-secondary lined thin" data-toggle="collapse" data-target="#table_gamesessions">Voir la
    liste
</button>
<div class="collapse" id="table_gamesessions">
    @foreach($gameSessions as $gameSession)

        <div class="row strip yellow-bg">
            <div class="col-6 vignette">
                <div class="row"><p>id# {!! $gameSession->id !!}</p>
                    <h3 class="title">{!! $gameSession->title !!}</h3></div>
                <div class="row"><p>créé le {{$gameSession->created_at}}</p>, <p>dernière mise à jour
                        le {{$gameSession->updated_at}}</p></div>
            </div>
            <div class="col-6 vignette">{!! $gameSession->description !!}</div>
            <button class="btn btn-secondary lined thin" data-toggle="collapse"
                    data-target="#table_gameturns_{{$gameSession->id}}">Voir les tours
            </button>
            <a href="{{route('admin.update_gamesession',$gameSession->id)}}" role="button" class="btn btn-primary lined thin">Editer cette partie</a>
            <div class="collapse col-lg-12" id="table_gameturns_{{$gameSession->id}}">
                @include('admin._partials.table_gameturns')
            </div>
        </div>


    @endforeach
</div>
