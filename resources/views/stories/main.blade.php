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
        @endswitch

    </div>
@endsection
