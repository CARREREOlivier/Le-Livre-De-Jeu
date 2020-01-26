<div class="green-bg vignette full-height">
{!! $story->description !!}

<!--Collapse-->
    @if(isset($story->hasPost))
        @include('stories._partials.btn_story_storypost_list')
    @else
        <p>Aucun post n'a été créé pour le moment!</p>
    @endif
    <div class="collapse" id="collapse{{$story->id}}">
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

