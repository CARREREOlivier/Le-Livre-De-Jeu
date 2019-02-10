@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">
    @if( Route::currentRouteName()=='admin.main')
        @include('admin.content.main')
    @endif
    </div>

@endsection