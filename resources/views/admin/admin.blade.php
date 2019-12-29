@extends('layouts.app')

@section('content')

    @if(session('message'))
        <div class='alert alert-success'>
            {{ session('message') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @auth
        @if(Auth::user()->status == 'Admin')
            <div class="container mt-5 mb-5">

                @if( Route::currentRouteName()=='admin.main')
                    @include('admin.content.main')
                @endif

                @if( Route::currentRouteName()=='admin.update_gamesession')
                    @include('admin.content.update_gamesession')
                @endif

                @if( Route::currentRouteName()=='admin.update_gameturn')
                    @include('admin.content.update_gameturn')
                @endif

            </div>

        @else {{ Redirect::to('/dashboard') }}

        @endif
    @endauth
    @guest

        {{ Redirect::to('/dashboard') }}

    @endguest
@endsection