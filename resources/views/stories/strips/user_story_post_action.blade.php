@switch($role)

    @case('author')
    <div class="row strip white-bg">
        <div class="col-lg-12 vignette green-bg">

            @include('stories._partials.btn_delete_story_post',['slug'=>$story_post->slug])
            @include('stories._partials.btn_edit_story_post',['slug'=>$story_post->slug])
            @include('stories._partials.btn_manage_coauthors_story_post')
            @include('stories._partials.btn_manage_visibility')

        </div>


    </div>
    @break;

    @case('coAuthor')
    <div class="row strip white-bg">
        <div class="col-lg-12 vignette green-bg">

            @include('stories._partials.btn_edit_story_post')

        </div>

    </div>
    @break;


@endswitch