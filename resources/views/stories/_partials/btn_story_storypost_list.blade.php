<p>
    <button id="see-stories-posts-{{$story->id}}" class="btn btn-primary lined thin" type="button"
            data-toggle="collapse" data-toggle-secondary="Close"
            data-target="#collapse{{$story->id}}" aria-expanded="false" aria-controls="collapseExample"
            onclick="changeStoryCollapsibleText({{$story->id}})">
        Voir la liste des posts
    </button>
</p>
