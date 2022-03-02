@extends('layouts.app')
@section('header')
<header class="page-header">
    <h2> Discussions </h2>

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

    <ul class="list-unstyled search-results-list">
        @foreach($discussions as $discussion)




        <li>

        <a href="{{route('discussions.show',$discussion->slug)}}" class="has-thumb">


                <div class="result-thumb">
                    <img height="40px" width="40px" style="border-radius:50%;"
                        src="{{ Gravatar::src($discussion->author->email) }}">
                </div>
                <div class="result-data">

                    <p  class="h4 title text-primary">{{$discussion->title}}</p>
                    <p class="description">
                        {!!$discussion->content!!}
                    </p>


                </div>
</a>
            <div class="col-md-offset-2">

                <i class="fa fa-clock-o"></i> {{$discussion->created_at->diffForHumans()}} &nbsp;&nbsp;
                <i class="fa fa-user"></i> By {{$discussion->author->name}} &nbsp;&nbsp; 
                <i class="fa fa-tag"></i>{{$discussion->channel->name}} &nbsp;&nbsp;
                <i class="fa fa-comments"></i> {{ $discussion->replies->count()}} 
            </div>


        </li>


        @endforeach
    </ul>

    <hr class="solid mb-none" />
    <div class="pagination-wrapper col-md-offset-4">
        {{$discussions->appends(['channel'=> request()->query('channel')])->links('pagination::bootstrap-4')}}
        <!--pagination with query of filter  -->
    </div>

</div>







@endsection
