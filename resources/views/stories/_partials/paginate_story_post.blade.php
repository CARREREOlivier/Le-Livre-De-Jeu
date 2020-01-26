<div class="row strip white-bg">
    <div class="col-md-1 nopadding">
        @if(count($previousPost)==0)
            <span style="text-align:left;">
            <button type="button" class="btn btn-info" disabled><i class="fas fa-chevron-left"></i></button></span>
        @else
            <a href="{{route('story.show.post',$previousPost->slug)}}" class="btn btn-info"><i class="fas fa-chevron-left"></i></a>
        @endif
    </div>
    <div class="col-md-5"  align="center" >retouner à l'index </div>
    <div class="col-md-5" align="center" > table des matières</div>
    <div class="col-md-1 nopadding">
        @if(count($nextPost)==0)
            <span style="float:right;">  <button type="button" class="btn btn-info"
                                                 disabled> <i class="fas fa-chevron-right"></i></button></span>
        @else
            <span style="float:right;"> <a href="{{route('story.show.post',$nextPost->slug)}}" class="btn btn-info"><i class="fas fa-chevron-right"></i></a></span>
        @endif
    </div>
</div>
