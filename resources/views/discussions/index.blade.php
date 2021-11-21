@extends('layouts.app')

@section('content')

@foreach($discussions as $discussion)
              <div class="card my-2">
                  <div class="card-header">

                  <div class="d-flex justify-content-between"> 
                      <!-- //class bootstrap create div with space between content  -->
 
                  <div>
                  <img height="40px" width="40px" style="border-raduis:50%;" src="{{ Gravatar::src($discussion->author->email) }}">
                  <span class="ml-2 font-weight-bold">{{$discussion->author->name}}</span>
                 
                  </div>
                  <div>

                  <a name="show" id="show" class="btn btn-success" href="{{route('discussions.show',$discussion->slug)}}" role="button">show</a>
                  </div>
                  </div>
                 

                  </div>
                  <div class="card-body">
                      <p class="card-text">{{$discussion->title}}</p>
                  </div>
              </div>

@endforeach
<div class="pagination-wrapper d-flex justify-content-center">

{{$discussions->links('pagination::bootstrap-4')}}
</div>
@endsection
