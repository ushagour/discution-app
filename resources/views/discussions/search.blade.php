@extends('layouts.app')
@section('header')
<header class="page-header">
    <h2> Results </h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="{{route('discussions.index')}}">
                    <i class="fa fa-home"></i>
                </a>
            </li>
        </ol>
        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
</header>
@endsection

@section('content')


<div class="tab-content">
    <div id="everything" class="tab-pane active">

        <ul class="list-unstyled search-results-list">
            @foreach($results as $discussion)




            <li>

            <p class="result-type">
            <a  href="{{route('discussions.show',$discussion->slug)}}">See more</a>
											<!-- <span class="label label-primary" href="{{route('discussions.show',$discussion->slug)}}"> </span> -->
										</p>
                <div class="has-thumb">

             
                    <div class="result-thumb">
                    @if($discussion->author->profile->avatar)
                            <img src="{{$discussion->author->profile->avatar}}" alt="{{$discussion->author->name}}"
                            height="40px" width="40px" style="border-radius:50%;"	 data-lock-picture="src={{$discussion->author->profile->avatar}}" />
                                @else
                                <img src="{{ Gravatar::src($discussion->author->email) }}" alt="{{$discussion->author->name}}"
                                height="40px" width="40px" style="border-radius:50%;" data-lock-picture="src={{ Gravatar::src($discussion->author->email) }}" />
                                @endif
                    </div>
                    <div class="result-data">
                    <p class="h3 title text-primary">{{$discussion->title}}</p>
                        <p class="description">
                            <small> {{$discussion->created_at->diffForHumans()}}</small>
                            <br />
                            {!!$discussion->content!!}
                        </p>


                    </div>
                    </div>
<div class="col-md-offset-2">

    <i class="fa fa-user"></i> By {{$discussion->author->name}} &nbsp;&nbsp; <i class="fa fa-tag"></i> {{$discussion->channel->name}} &nbsp;&nbsp;
              <i class="fa fa-comments"></i> {{ $discussion->replies->count()}} Reply
</div>


            </li>


            @endforeach
        </ul>

        <hr class="solid mb-none" />
        <div class="pagination-wrapper col-md-offset-4">
            {{$results->links()}}
            <!--pagination with query of filter  -->
        </div>
    </div>

</div>







@endsection
