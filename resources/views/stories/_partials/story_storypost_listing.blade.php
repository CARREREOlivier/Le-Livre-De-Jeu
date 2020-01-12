@if($storyPost->story_id == $story->id)
    <div class="evenboxinner-turn">{!! $storyPost->created_at !!} </div>
    <h4>{!! $storyPost->title!!}</h4>
    <table>
        <tr>
            <td><p>Par {!! $storyPost->username !!}
                    et {!! $storyPost->co_author !!}
                    visible par {!! $storyPost->visible_by !!}</p></td>
            <td> @include('stories._partials.btn_read_post')</td>
        </tr>
    </table>
@endif