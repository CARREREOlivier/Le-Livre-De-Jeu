@include('stories.strips.show_header')
@auth
    @if(Auth::user()->status === 'Admin' OR Auth::user()->id === $story->user_id )
        @include('stories.strips.stories_manager')
    @endif
@endauth
@include('stories.strips.show_introduction')
@include('stories.strips.show_table_of_contents')


<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })


</script>