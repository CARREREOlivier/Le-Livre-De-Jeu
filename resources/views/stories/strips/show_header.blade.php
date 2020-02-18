<div class="row">
    <div class="col-md-12 nopadding">
        <div id="card_container_auto">
            <div id="card">

                <div class="shine"></div>
                <div class="text-block gamesession-description">
                    <h1 class="last-turn-title yellow">{{$story->title}}
                    </h1>
                    <div style="line-height: 10px"><p>Créée le:@include('utils.date_french',['date'=>$story->created_at])</p>
                        <p>par {!! $author !!}</p>
                        <p> Editeur(s):
                            @foreach($editors as $editor)
                                {{$editor->username}}&nbsp;
                            @endforeach</p>
                        <p>Auteur(s):
                            @foreach($authors as $author)
                                {{$author->username}}&nbsp;
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>