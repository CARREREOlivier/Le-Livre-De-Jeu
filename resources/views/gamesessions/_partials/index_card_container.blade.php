<div id="card_container_large">
    <div class="evenboxinner">{{$data->game}}</div>
    <div id="card">

        <div class="shine"></div>
        <div class="text-block">

            <h3 class="welcome-card-title yellow">{{$data->title}}
            </h3>
            <p>Créée le: @include('utils.date_french',['date'=>$data->created_at])</p>
            <p>Avec : {{$data->getUserNames->username}}</p>
            <a href="{{route('gamesession.show', $data->slug)}}"
               class="btn btn-primary lined thin">Lire</a>
        </div>
    </div>

</div>