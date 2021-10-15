@extends('layouts.app')

@section('content')

                <div class="d-flex  jusfify-content-end mb-2">
                <a href="{{Route('discussions.create')}}"> <span class="badge badge-primary"> add discution</span></a>
            
                </div>

@foreach($discussions as $discussion)
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">{{$discussion->title}}</h5>
                      <p class="card-text">{{$discussion->content}}</p>
                  </div>
              </div>
@endforeach

@endsection
