@extends('layouts.app')

@section('content')
    @auth
        @if(Auth::user()->status == 'Admin')
        <div class="container mt-5 mb-5">

                @if( Route::currentRouteName()=='admin.main')
                    @include('admin.content.main')
                @endif

        </div>

        @else {{ Redirect::to('/dashboard') }}

        @endif
    @endauth
    @guest
        
        {{ Redirect::to('/') }}

    @endguest
@endsection