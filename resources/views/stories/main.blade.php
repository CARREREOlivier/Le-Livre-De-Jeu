@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">

        @switch(Route::currentRouteName())

            @case('story.index')
            @include('stories.content.index')
            @break;

            @case('story.create')
            @include('stories.content.index')
            @break;

        @endswitch

    </div>
@endsection
