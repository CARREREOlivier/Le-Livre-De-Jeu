@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">

        @switch(Route::currentRouteName())

            @case('info.index')
            @include('news.content.index')
            @break;

            @case('info.show')
            @include('news.content.show')
            @break;

            @case('info.create')
            @include('news.content.create')
            @break;

            @case('info.edit')
            @include('news.content.edit')
            @break;

            @case('news.add.post')
            @include('news.content.create_post')
            @break;

            @case('infopost.edit')
            @include('news.content.edit_post')
            @break;

        @endswitch

    </div>
@endsection
