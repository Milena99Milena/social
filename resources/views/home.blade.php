@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                
                @if(session()->has('success'))
                    <div class="alert alert-success">
                    {{session()->get('success')}}
                    </div>
                @elseif(session()->has('error'))
                <div class="alert alert-danger">
                    {{session()->get('error')}}
                    </div>
                @endif

                    <form action="/home" method="post"> 
                    @csrf 
                        <textarea name="content" rows="5" cols="30" class="form-control" placeholder="What's on your mind.."></textarea>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Post!">
                    </form>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                Dobro dosli!

                   @foreach($objave as $objava)
                        
                        <h5><a href="user/{{$objava->user->id}}">{{$objava->user->name}} ({{$objava->user->email}})</a></h5>
                        @php
                        $id=$objava->user->id;
                        $slika="img/$id.png";
                        if(!file_exists($slika))
                        {
                            echo "<img src='img/defoult.png' width='100px'>";
                        }
                        else
                        {
                            echo "<img src='$slika' width='100px'>";
                        }
                        @endphp     


                        @if($objava->user->id==Auth::user()->id)
                            <p style='color:green'>{{$objava->content}}</p>
                        @else
                            <p style='color:purple'>{{$objava->content}}</p>
                        @endif
                        <small>{{$objava->created_at->format("d.m.Y.")}}</small>
                        <small>{{$objava->created_at->diffForHumans()}}</small>
                        <hr>

                   @endforeach
                    
                   @foreach($events as $event)
                   <hr>
                        <h5><a href="event/{{$event->id}}">{{$event->name}}<br>{{$event->date}}</a></h5>
                        
                        @if($event->user->id==Auth::user()->id)
                            <p style='color:green'>{{$event->user->name}} ({{$event->user->email}})</a></p>
                        @else
                            <p style='color:purple'>{{$event->user->name}} ({{$event->user->email}})</a></p>
                        @endif
                        <small>{{$event->created_at->format("d.m.Y.")}}</small>
                        <small>{{$event->created_at->diffForHumans()}}</small>
                        <hr>

                   @endforeach

                </div>
            </div>
        </div> 
            <div class="col-md-4">
            @if(count($mutuals))
                <div class="card">
                    <div class="card-header">
                        Mutual friends
                    </div>
                    <div class="card-body">
                        @foreach($mutuals as $follow)
                        <h5><a href="user/{{$follow->id}}">{{$follow->name}}</a></h5>
                        @endforeach
                    </div>
                </div>
            @endif
            <br>
            @if(count($following))
                <div class="card">
                    <div class="card-header">
                        User I'm following
                    </div>
                    <div class="card-body">
                        @foreach($following as $follow)
                        <h5><a href="user/{{$follow->id}}">{{$follow->name}}</a></h5>
                        @endforeach
                    </div>
                </div>
            @endif
            <br>
            @if(count($followers))
                <div class="card">
                    <div class="card-header">
                        My followers
                    </div>
                    <div class="card-body">
                        @foreach($followers as $follow)
                        <h5><a href="user/{{$follow->id}}">{{$follow->name}}</a></h5>
                        @endforeach
                    </div>
                </div>
            @endif
            <br>
            @if(count($others))
                <div class="card">
                    <div class="card-header">
                        Suggestions
                    </div>
                    <div class="card-body">
                        @foreach($others as $follow)
                        <h5><a href="user/{{$follow->id}}">{{$follow->name}}</a></h5>
                        @endforeach
                    </div>
                </div>
            @endif
            </div>
    </div>
</div>
@endsection
