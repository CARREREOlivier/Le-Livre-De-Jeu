@foreach ($gameTurns as $gameTurn)
    @if($gameTurn->gamesessions_id == $gameSession->id)
        <div class="col-11 offset-1 strip ">
            <div class="row orange-bg vignette">
                <div class="col-12">
                    <h3>{!! $gameTurn->title!!}</h3>
                    <hr>
                    <p>créée le {{$gameTurn->created_at}}, dernière modification
                        le {{$gameTurn->updated_at}}</p>

                    <button class="btn btn-secondary lined thin" data-toggle="collapse"
                            data-target="#table_turninfos_{{$gameTurn->id}}">Voir les infos</button>

                        <a href="{{route('admin.update_gameturn', $gameTurn->id)}}" class="btn btn-primary lined thin" role="button">Editer le tour</a>

                    <div class="collapse col-lg-12" id="table_turninfos_{{$gameTurn->id}}">
                        <div class="col-12 vignette green-bg">
                            Description
                            {!! $gameTurn->description!!}
                        </div>
                        <div class="col-12 vignette yellow-bg">
                            Description détaillée
                            {!! $gameTurn->long_description!!}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endif
@endforeach