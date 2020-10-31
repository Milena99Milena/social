@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    
                    
                   <hr>
                        <h5>{{$event->name}}<br>{{$event->date}}</h5>
                        
                        @if($event->user->id==Auth::user()->id)
                            <p style='color:green'>{{$event->user->name}} ({{$event->user->email}})</a></p>
                        @else
                            <p style='color:purple'>{{$event->user->name}} ({{$event->user->email}})</a></p>
                        @endif
                        <small>{{$event->created_at->format("d.m.Y.")}}</small>
                        <small>{{$event->created_at->diffForHumans()}}</small>
                        <hr>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
