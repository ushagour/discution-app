@extends('layouts.app')

@section('content')

<div class="card">
                  <div class="card-header">

            
                  <img height="40px" width="40px" style="border-raduis:50%;" src="{{ Gravatar::src($discussion->author->email) }}">
                  <strong>{{$discussion->author->name}}</strong>
                 
                  </div>
               
              <div class="text-center "> <strong>{{$discussion->title}}</strong></div>                   

                  <div class="card-body">
                      <p class="card-text">{{$discussion->content}}</p>
                  </div>
              </div>



</div>
@endsection
