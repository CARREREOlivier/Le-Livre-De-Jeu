@if($isAuthor===true)
    <!--top row-->
    @include('stories.strips.show_post_top_row')

    <!-- author/coauthor/admin toolbar-->
    @include('stories.strips.user_story_post_action',['role'=>'author'])

    <!--post section-->
    @include('stories.strips.show_post_post_section')

@endif


@if($isCoAuthor===true)
    <!--top row-->
    @include('stories.strips.show_post_top_row')

    <!-- author/coauthor/admin toolbar-->
    @include('stories.strips.user_story_post_action',['role'=>'coAuthor'])

    <!--post section-->
    @include('stories.strips.show_post_post_section')

@endif

@if($canRead===true)
    <!--top row-->
    @include('stories.strips.show_post_top_row')

    <!--post section-->
    @include('stories.strips.show_post_post_section')

@endif

@if($canRead === false and $isAuthor===false and $isCoAuthor === false)
@include('stories..strips.stories.strips.non_authorized')
@endif