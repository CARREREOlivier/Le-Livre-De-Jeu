<div class="row">
    <div class="col-md-4 nopadding">
        <div id="card_container_auto">
            <div id="card">

                <div class="shine"></div>
                <div class="text-block gamesession-description">

                    <h3 class="last-turn-title yellow">{{$news->title}}
                    </h3>
                    <p>Créée le:@include('utils.date_french',['date'=>$news->created_at])</p>
                    <p>par {!! $author !!}</p>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-8 nopadding">
        <div id="card_container_auto">
            <div id="card">
                <div class="evenboxinner-turn pencil">Résumé</div>
                <div class="shine"></div>
                <div class="text-block gamesession-description">
                    <p>{!! $news->summary !!}</p>
                </div>
            </div>

        </div>
    </div>
</div>
@auth
    @if(Auth::user()->status == 'Admin')
        @include('news.strips.news_add_post')
    @endif
@endauth
@foreach($posts->reverse() as $post)
    <div class="row strip">
        <div class="col-12 vignette yellow-bg">
            <div class="evenboxinner-turn">Le:@include('utils.date_french',['date'=>$post->created_at])</div>
            <br/>
            {!! $post->text !!}



            @auth
                @include('news._partials.btn_add_comment')
                @if(Auth::User()->status=='Admin')
                    @include('news._partials.btn_edit_post')
                    @include('news._partials.btn_delete_post')
                @endif
            @endauth
        </div>
    </div>
    @foreach($post->getcomments->reverse() as $comment)
        <div class="row strip">
            <div class="col-12 vignette green-bg">
                <div class="evenboxinner-turn">Le:@include('utils.date_french',['date'=>$comment->created_at]) par {!! $comment->user->username!!}</div>
                <br/>
                {!! $comment->text!!}</div>
        </div>


    @endforeach
@endforeach