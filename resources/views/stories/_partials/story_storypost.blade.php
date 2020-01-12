<div class="green-bg vignette full-height">
{!! $story->description !!}
<!--Collapse-->
    @include('stories._partials.btn_story_storypost_list')
    <div class="collapse" id="collapseExample">
        @foreach($storyPosts as $storyPost)
            <div class="col-md-12 box-left">
                <div class="yellow-bg story-posts-vignette word-wrap:break-word ">
                    @include('stories._partials.story_storypost_listing')
                </div>
            </div>
            <br/>


        @endforeach

    </div>


   <!-- @include('stories._partials.btn_read_story')-->

</div>