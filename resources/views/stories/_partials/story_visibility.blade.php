@switch($story_post->visible_by)
    @case($story_post->visible_by==='all')
    tous
    @break
    @case($story_post->visible_by==='none')
    aucun
    @break
    @case($story_post->visible_by!=='none' && $story_post->visible_by!=='all' )
    {!! $story_post->visible_by !!}
    @break
@endswitch