<div class="row">
    <div class="col-md-12 nopadding">
        <div id="card_container_auto">
            <div id="card">

                <div class="shine"></div>
                <div class="text-block gamesession-description">
                    <h3 class="last-turn-title yellow">{{$story->title}}
                    </h3>
                    <p>Créée le:@include('utils.date_french',['date'=>$story->created_at])</p>
                    <p>par {!! $author !!}</p>
                </div>
            </div>

        </div>
    </div>
</div>