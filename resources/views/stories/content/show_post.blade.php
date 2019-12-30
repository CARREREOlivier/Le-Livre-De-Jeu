{{$previousPost}}
{{$nextPost}}

<!--top row-->
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
                        {{$story_post->visible_by}}
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- author/coauthor/admin toolbar-->
@include('stories.strips.user_story_post_action')

<!--post section-->
<div class="row strip white-bg">

    <!-- nav -->
    <div class="col-md-3 nopadding box-left ">
        <div class="col-lg-12 vignette green-bg full-height">
           @include('stories._partials.nav_story_post')
        </div>
    </div>

    <!-- text -->
    <div class="col-md-9 nopadding box-right">
        <div class="col-lg-12 vignette green-bg full-heigh">

            @include('stories._partials.paginate_story_post')

            {!! $story_post->text !!}

            @include('stories._partials.paginate_story_post')

        </div>
    </div>


</div>