<ul>
    @foreach ($allPosts as $post)
        <li> <a href="{{route('story.show.post',$post->slug)}}">{{$post->title}}</a></li>
    @endforeach
</ul>