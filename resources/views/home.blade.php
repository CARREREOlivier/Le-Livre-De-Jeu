@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Le livre de jeu</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

               <h2>{{$greetings}} {{Auth::user()->name}}</h2>

                    <a href="{{url('/')}}" class="btn btn-primary lined thin">Aller à l'accueil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
