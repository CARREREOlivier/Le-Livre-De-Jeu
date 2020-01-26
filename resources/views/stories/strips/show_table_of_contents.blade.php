<div class="row strip">
    <div class="col-12 vignette yellow-bg">
        <div class="evenboxinner-turn">Table des matières</div>
        <br/>
        <table style="float:left;">
            @if(count($posts) === 0)
                <tr>
                    <td><p>Aucun post pour le moment</p></td>
                </tr>
            @else

                @foreach($posts as $post)
                    <tr>
                        <td> @include('stories._partials.btn_read_story_post')</td>
                        @auth
                            @if(Auth::User()->status=='Admin' or Auth::user()->id === $story->user_id  )
                                <td>@include('stories._partials.btn_edit_story_post',['slug'=>$post->slug])</td>
                                <td>@include('stories._partials.btn_delete_story_post',['slug'=>$post->slug])</td>
                            @endif
                        @endauth


                        <td>  {!! $post->title !!} par {{$post->author}}</td>
                        @if($post->co_author !== 'none')
                            <td> et {{$post->co_author}}</td>
                        @endif
                    </tr>



                @endforeach

            @endif
        </table>
    </div>
</div>