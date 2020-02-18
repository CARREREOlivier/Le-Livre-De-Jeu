@include('stories.strips.show_header')

@auth
    @include('stories.strips.stories_manager')
@endauth

@include('stories.strips.show_introduction')
@include('stories.strips.show_table_of_contents')


@include('utils.tooltip_script')