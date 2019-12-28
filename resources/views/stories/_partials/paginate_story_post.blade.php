<p style="text-align:left;">
    @if(isset($previousPost) && $previousPost->slug <> $story_post->slug)
        <a href="{{route('story.show.post',$previousPost->slug)}}"><--précédent</a>
    @else
        <--précédent
    @endif

    <span style="float:right;">
            @if(isset($nextPost) && $nextPost->slug <> $story_post->slug)
            <a href="{{route('story.show.post',$nextPost->slug)}}">suivant--></a>
        @else
            suivant-->
        @endif
                </span>
</p>