@switch($user_role)

    @case('Admin')
    <td> @include('stories._partials.btn_read_story_post')</td>
    <td>@include('stories._partials.btn_edit_story_post',['slug'=>$post->slug])</td>
    <td>@include('stories._partials.btn_delete_story_post',['slug'=>$post->slug])</td>
    @break

    @case('owner')
    <td> @include('stories._partials.btn_read_story_post')</td>
    <td>@include('stories._partials.btn_edit_story_post',['slug'=>$post->slug])</td>
    <td>@include('stories._partials.btn_delete_story_post',['slug'=>$post->slug])</td>
    @break

    @case('editor')
    <td> @include('stories._partials.btn_read_story_post')</td>
    <td>@include('stories._partials.btn_edit_story_post',['slug'=>$post->slug])</td>
    <td>@include('stories._partials.btn_delete_story_post',['slug'=>$post->slug])</td>
    @break

    @case('author')
    <td> @include('stories._partials.btn_read_story_post')</td>
    @if($post->user_id ===  Auth::user()->id)
        <td>@include('stories._partials.btn_edit_story_post',['slug'=>$post->slug])</td>
        <td>@include('stories._partials.btn_delete_story_post',['slug'=>$post->slug])</td>
    @endif
    @break

    @case('guest')
    <td> @include('stories._partials.btn_read_story_post')</td>
    @break

@endswitch

