<div class="row strip">

    <div class="vignette blue-bg full-height">
        <table style="float:left;">
            <tr>


                @switch($user_role)

                    @case('Admin')
                    <td>@include('stories._partials.btn_add_post')</td>
                    <td>@include('stories._partials.btn_edit_story')</td>
                    <td>@include('stories._partials.btn_delete_story')</td>
                    <td>@include('stories._partials.btn_manage_permissions_story')</td>
                    @break

                    @case('owner')
                    <td>@include('stories._partials.btn_add_post')</td>
                    <td>@include('stories._partials.btn_edit_story')</td>
                    <td>@include('stories._partials.btn_delete_story')</td>
                    <td>@include('stories._partials.btn_manage_permissions_story')</td>
                    @break


                    @case('editor')
                    <td>@include('stories._partials.btn_add_post')</td>
                    <td>@include('stories._partials.btn_edit_story')</td>
                    @break


                    @case('author')
                    <td>@include('stories._partials.btn_add_post')</td>

                    @break

                @endswitch


            </tr>
        </table>
    </div>


</div>