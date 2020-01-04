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