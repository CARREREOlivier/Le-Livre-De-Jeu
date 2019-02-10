@if($type=='not_done_yet')
    <div id="card_container">
        <div id="card">
            <div class="shine"></div>
            <div class="text-block">
                <h2 class="welcome-card-title {{$color}}">{{$title}}
                </h2>
                <button>{{$text}}</button>
            </div>
        </div>
    </div>
@elseif($type=='ready')
    <div id="card_container">
        <div id="card">
            <div class="shine"></div>
            <div class="text-block">
                <h2 class="welcome-card-title {{$color}}">{{$title}}
                </h2>
                <a href="{{route($route)}}" class="btn btn-primary lined thin" role="button"><strong>{{$text}}</strong></a>
            </div>
        </div>
    </div>
@endif

