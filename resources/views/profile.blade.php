@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$user->name}}
                <img src='/img/{{$user->id}}.png' width='100px'></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Dobro dosli!
                    
                   @foreach($posts as $objava)
                  
                        <h5>({{$objava->user->email}})</h5>
                        <p>{{$objava->content}}</p>
                        <small>{{$objava->created_at->format("d.m.Y.")}}</small>
                        <small>{{$objava->created_at->diffForHumans()}}</small>
                        <hr>

                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
