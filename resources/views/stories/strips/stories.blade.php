@if($stories !=null)
    @foreach($stories->reverse() as $story)
        <div class="row strip white-bg">

            <div class="col-md-4 box-left">
                <div class="blue-bg vignette full-height">
                    @include('stories._partials.story_infos')
                    @include('stories._partials.story_author_actions')
                </div>
            </div>

            <div class="col-md-8 box-right">
                @include('stories._partials.story_storypost')
            </div>
        </div>
    @endforeach
@endif