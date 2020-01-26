@if($stories !=null)
    @foreach($stories->reverse() as $story)
        <div class="row strip white-bg">
            <div class="col-md-12 box-left">
                <div class="blue-bg vignette full-height">
                    @include('stories._partials.btn_read_story')@include('stories._partials.story_author_actions')&nbsp;{{$story->title}} par {{$story->username}}</div>
            </div>
        </div>
    @endforeach
@endif