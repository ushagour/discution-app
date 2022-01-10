@extends('layouts.app')

@section('content')

@foreach($discussions as $discussion)
              <div class="my-3">
                  <div class="card">
                 
                  <div class="card-header">

                      <!-- //class bootstrap create div with space between content  -->
 
                  <div>
                  <img height="40px" width="40px" style="border-raduis:50%;" src="{{ Gravatar::src($discussion->author->email) }}">
                  <strong class="ml-2 font-weight-bold">{{$discussion->author->name}}</strong>
                  <small> {{$discussion->created_at->diffForHumans()}}</small>
                 
                  </div>
                  <div>

                  <a name="show" id="show" class="btn btn-success" href="{{route('discussions.show',$discussion->slug)}}" role="button">show</a>
                  </div>
                  </div>
                 

                  </div>
                  <div class="card-body">
                      <h3 >{{$discussion->title}}</h3>
                      <p class="card-text">
                      {!! \Illuminate\Support\Str::limit($discussion->content, 200, '...') !!}
                      </p>
                      
                  </div>
           
                  <div class="card-footer">
                      
                      <b>
                          {{ $discussion->replies->count()}} Reply
                        </b>
                    </div>
                </div>
                </div>

                    @endforeach
<div class="pagination-wrapper d-flex justify-content-center">

 {{$discussions->appends(['channel'=> request()->query('channel')])->links('pagination::bootstrap-4')}}<!--pagination with query of filter  -->
</div>
@endsection
