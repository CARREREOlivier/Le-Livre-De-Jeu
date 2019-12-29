@if(!$loop->first)
    @if($index%3 == 0)
        <div class="col-md-4 archive-right">
            <div class="evenboxinner-descriptive ">
                Tour {{$nbTurn-$index}}
            </div>
            <div class="vignette orange-bg  full-height">
                <p>{{$title}}</p>
                <a href="{{route('gameturn.show', $id)}}" role="button"
                   class="btn btn-warning lined thin">Lire</a>
            </div>
        </div>
        </div>
        <div class="row strip white-bg">

            @elseif($index%3 == 1)
                <div class="col-md-4 archive-left">
                    <div class="evenboxinner-turn">
                        Tour {{$nbTurn-$index}}
                    </div>
                    <div class="vignette blue-bg  full-height">
                        <p>{{$title}}</p>
                        <a href="{{route('gameturn.show',$id)}}" role="button"
                           class="btn btn-warning lined thin">Lire</a>
                    </div>
                </div>
            @elseif($index%3 == 2)
                <div class="col-md-4 archive-center">
                    <div class="evenboxinner-descriptive">
                        Tour {{$nbTurn-$index}}
                    </div>
                    <div class="vignette green-bg  full-height">
                        <p>{{$title}}</p>
                        <a href="{{route('gameturn.show', $id)}}" role="button"
                           class="btn btn-warning lined thin">Lire</a>
                    </div>
                </div>
    @endif
@endif
