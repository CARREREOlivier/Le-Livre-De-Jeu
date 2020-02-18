<div class="row strip white-bg">
    <div class="col-md-1 nopadding">
        @if(count($previousPost)==0)
            <span style="text-align:left;">
            <button type="button"  class="btn btn-info lined thin" disabled><i class="fas fa-chevron-left"></i></button></span>
        @else
            <a href="{{route('story.show.post',$previousPost->slug)}}"  class="btn btn-info lined thin"><i
                        class="fas fa-chevron-left"></i></a>
        @endif
    </div>
    <div class="col-md-5" align="center">
        <a href="{{route('story.index')}}"
           title="retourner à l'index"
           role="button"
           class="btn btn-secondary lined thin">
            <i class="fas fa-home"></i> retourner à l'index
        </a>
    </div>

    <div class="col-md-5" align="center">
        <a href="{{route('story.show',$story_slug)}}"
           role="button"
           class="btn btn-primary lined thin"
           title="Lire l'ensemble des posts">
            <i class="fas fa-list-ol"></i> Table des matières
        </a>


    </div>
    <div class="col-md-1 nopadding">
        @if(count($nextPost)==0)
            <span style="float:right;">  <button type="button" class="btn btn-info lined thin"
                                                 disabled> <i class="fas fa-chevron-right"></i></button></span>
        @else
            <span style="float:right;"> <a href="{{route('story.show.post',$nextPost->slug)}}" class="btn btn-info lined thin"><i
                            class="fas fa-chevron-right"></i></a></span>
        @endif
    </div>
</div>
