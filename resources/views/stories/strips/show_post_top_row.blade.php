<div class="row">
    <div class="col-md-9 nopadding">
        <div id="card_container_auto">
            <div id="card">

                <div class="shine"></div>
                <div class="text-block gamesession-description">

                    <h3 class="last-turn-title yellow">{{$story_post->title}}
                    </h3>
                    <p>Créé le @include('utils.date_french',['date'=>$story_post->created_at])</p>

                </div>
            </div>

        </div>
    </div>
    <div class="col-md-3 nopadding">
        <div id="card_container_auto">

            <div id="card">
                <div class="shine"></div>
                <div class="text-block">
                    <p><strong>Auteur :</strong>
                        {{$author}}
                        <br/>
                        <strong>Co-Auteur(s):</strong>
                        {{$co_authors}}
                        <br/>
                        <strong>Visible Par:</strong>
                       @include('stories._partials.story_visibility')
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>
