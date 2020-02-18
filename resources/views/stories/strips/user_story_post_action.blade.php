@switch($role)

    @case('author')
    <div class="row strip white-bg">
        <div class="col-lg-12 vignette green-bg">
            <table>
                <tr>
                    <td>@include('stories._partials.btn_delete_story_post',['slug'=>$story_post->slug])</td>
                    <td>@include('stories._partials.btn_edit_story_post',['slug'=>$story_post->slug])</td>
                    <td>@include('stories._partials.btn_manage_coauthors_story_post')</td>
                    <td>@include('stories._partials.btn_manage_visibility')</td>
                </tr>
            </table>
        </div>


    </div>
    @break;

    @case('coAuthor')
    <div class="row strip white-bg">
        <div class="col-lg-12 vignette green-bg">

            @include('stories._partials.btn_edit_story_post')

        </div>

    </div>
    @break;


@endswitch