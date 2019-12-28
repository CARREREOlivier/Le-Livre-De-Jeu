@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">

        @switch(Route::currentRouteName())

            @case('story.index')
            @include('stories.content.index')
            @break;

            @case('story.create')
            @include('stories.content.create')
            @break;

            @case('story.show')
            @include('stories.content.show')
            @break;

            @case('story.edit')
            @include('stories.content.edit')
            @break;

            @case('story.add.post')
            @include('stories.content.create_post')
            @break;

            @case('story.show.post')
            @include('stories.content.show_post')
            @break;

            @case('story.edit.post')
            @include('stories.content.edit_post')
            @break;

        @endswitch


    </div>
@endsection




