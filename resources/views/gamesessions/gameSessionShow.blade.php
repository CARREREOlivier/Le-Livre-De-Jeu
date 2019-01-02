@extends('layouts.app')

@section('content')

    {{$gameSession->title}}
    {{$gameSession->game}}
    {{$gameSession->description}}

@endsection