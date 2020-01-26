@auth
    @if(Auth::user()->status=='Admin' OR Auth::user()->id == $story->user_id)
        <table style="float: left;">
            <tr>
                <td>@include('stories._partials.btn_add_post')</td>
                <td>@include('stories._partials.btn_edit_story')</td>
                <td>@include('stories._partials.btn_delete_story')</td>
            </tr>
        </table>
    @endif
@endauth