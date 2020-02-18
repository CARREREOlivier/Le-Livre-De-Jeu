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
                        @include('stories._partials.table_of_content_actions')

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