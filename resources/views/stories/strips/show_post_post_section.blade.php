<div class="row strip white-bg">

    <!-- nav -->
    <div class="col-md-3 nopadding box-left ">
        <div class="col-lg-12 vignette blue-bg full-height">
            @include('stories._partials.nav_story_post')
        </div>
    </div>

    <!-- text -->
    <div class="col-md-9 nopadding box-right">
        <div class="col-lg-12 vignette yellow-bg full-heigh">

            @include('stories._partials.paginate_story_post')

            {!! $story_post->text !!}

            @include('stories._partials.paginate_story_post')

        </div>
    </div>

</div>

<div class="row strip white-bg">
    <div class="col-lg-12 vignette green-bg">
        @auth
            @include('stories._partials.btn_add_comment')
        @endauth
        @guest
            <p> Connectez-vous pour pouvoir laisser un commentaire</p>
        @endguest
        <br/>
        @foreach($story_comments as $comment)
            <br/>
            <div class="col-lg-12 vignette yellow-bg">
                <div class="evenboxinner-turn">@include('utils.date_french',['date'=>$comment->created_at])
                    par {!!  $comment->username !!}</div>

                <p>{!!  $comment->text !!}</p>

            </div>

        @endforeach

    </div>


</div>