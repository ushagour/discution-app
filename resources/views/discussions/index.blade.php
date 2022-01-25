@extends('layouts.app')

@section('content')

@foreach($discussions as $discussion)
<div class="col-md-12">


<section class="panel panel-featured panel-featured-info">
    <header class="panel-heading">

                <img height="40px" width="40px" style="border-radius:50%;"
                    src="{{ Gravatar::src($discussion->author->email) }}">
                    <strong class="ml-2 font-weight-bold">{{$discussion->author->name}}
                <small>{{$discussion->created_at->diffForHumans()}}</small></strong>
              
       

        
        <div class="panel-actions">
            <a href="{{route('discussions.show',$discussion->slug)}}" class="fa fa-eye"></a>
   
        </div>
    </header>
    <div class="panel-body">
    <h2 class="panel-title"><a href="{{route('discussions.show',$discussion->slug)}}">{{$discussion->title}}</a></h2>

    


    </div>

    <div class="panel-footer">

        <b>
            {{ $discussion->replies->count()}} Reply
        </b>

        <a class="pull-right btn btn-default btn-xs"
            href="{{route('discussions.index')}}?channel={{$discussion->channel->slug}}">{{$discussion->channel->name}}</a>
        <!-- route discussion.index dosnt have any parametres we have to pass it using ? url  getparams  -->

    </div>
    
</section>
</div>


@endforeach
<button id="default-primary" class="mt-sm mb-sm btn btn-primary">Primary</button>

<div class="pagination-wrapper col-md-offset-4">
    {{$discussions->appends(['channel'=> request()->query('channel')])->links('pagination::bootstrap-4')}}
    <!--pagination with query of filter  -->
</div>


@endsection
