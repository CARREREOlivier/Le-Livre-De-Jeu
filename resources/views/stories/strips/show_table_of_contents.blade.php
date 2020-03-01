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

                    @if($post->isVisible === true)
                        <tr style="font-family: 'Patrick Hand SC'">
                            @include('stories._partials.table_of_content_actions')

                            <td style="font-size: 20px;; font-style: italic;">{!! $post->title !!}</td>
                            <td>&nbsp;&nbsp;par&nbsp;</td>
                            <td style="font-style: italic;"> {{$post->authorName}}</td>
                            @if($post->co_author !== 'none')
                                <td>&nbsp;&nbsp;et&nbsp;&nbsp;</td>
                                <td style="font-style: italic;">{{$post->co_authorsNames}}</td>
                            @endif
                        </tr>
                    @endif


                @endforeach

            @endif
        </table>
    </div>
</div>
</div>