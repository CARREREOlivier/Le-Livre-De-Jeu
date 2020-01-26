<!--post section top pagination-->
@include('stories._partials.paginate_story_post')

<div class="row strip white-bg">
    <!-- text -->
    <div class="col-md-12 vignette yellow-bg full-heigh">
        {!! $story_post->text !!}
    </div>
</div>
<!--post section bottom pagination-->
@include('stories._partials.paginate_story_post')

<div class="row strip white-bg">
    <div class="col-md-12 vignette green-bg">
        @auth
            @include('stories._partials.btn_add_comment')
        @endauth
        @guest
            <p> Connectez-vous pour pouvoir laisser un commentaire</p>
        @endguest
        <br/>
        @foreach($story_comments as $comment)
            <br/>
            <div class="col-md-12 vignette yellow-bg">
                <div class="evenboxinner-turn">@include('utils.date_french',['date'=>$comment->created_at])
                    par {!!  $comment->username !!}</div>

                <p>{!!  $comment->text !!}</p>

            </div>

        @endforeach

    </div>


</div>