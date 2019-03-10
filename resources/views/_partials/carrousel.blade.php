<div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
        <li data-target="#carousel" data-slide-to="2"></li>
        <li data-target="#carousel" data-slide-to="3"></li>
        <li data-target="#carousel" data-slide-to="4"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <h1 class="title float-left">Le Livre De Jeu</h1>
        </div>
        <div class="carousel-item">
            <h3 class="carrousel-title yellow">Partie: {{$gameSession->title}}</h3>
            <h4>Tour : {!! $lastTurn->title!!} créé le {!! $lastTurn->created_at!!}</h4>
            <p>{!! $lastTurn->description !!}</p>

        </div>
        <div class="carousel-item">
            @if(!empty($story))<h3 class="carrousel-title blue">AAR : {!! $story->title!!}</h3>
            <p>{!! $story->description!!}</p>
            @else
                <h3 class="carrousel-title blue">AARs</h3>
                <p>section AAR en construction</p>
            @endif
        </div>

        <div class="carousel-item">
            @if(!empty($tutorial))<h3 class="carrousel-title orange">Tuto/Guide: {!! $tutorial->title !!}</h3>
            <p>{!! $tutorial->description!!}</p>
            @else
                <h3 class="carrousel-title orange">Tuto/Guide</h3>
                <p>section Tuto en construction</p>
            @endif
        </div>

        <div class="carousel-item">
            @if(!empty($news))<h3 class="carrousel-title violet">News: {!! $news->title !!}</h3>
            <p>{!! $news->summary!!}</p>
            @else
                <h3 class="carrousel-title violet">News</h3>
                <p>section News en construction</p>
            @endif
        </div>
    </div>
    <br/>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>




