@extends('layouts.app')

@section('content')


<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">

                <a id="edit" class="fa fa-edit  fa-lg" href="{{route('discussions.edit',['discussion'=>$discussion->slug])}}"
                    role="button"></a>
        </div>

        <h2 class="panel-title">             <img height="40px" width="40px" style="border-radius:50%;"
                src="{{ Gravatar::src($discussion->author->email) }}"> <strong>{{$discussion->author->name}}</strong></h2>
        <p class="panel-subtitle"> <small>{{$discussion->created_at->diffForHumans()}}</small></p>
    </header>
        <div class="panel-body">
        <p class="panel-text">{!!$discussion->content!!}</p>
    <!-- </div> -->
                <!-- {!!$discussion->content!!} -->
        <!-- best  -->
        BEST REPLY
        @if($discussion->BestReply)
        
        <blockquote class="b-thin success">
        <img height="20px" width="20px" style="border-radius:50%;"
                        src="{{Gravatar::src( $discussion->BestReply->owner->email)}}" alt="">    
										<p>{!!$discussion->BestReply->content!!}</p>
										<small>{{$discussion->BestReply->owner->name}}, <cite title="{{$discussion->BestReply->owner->email}}"></cite></small>
									</blockquote>


        @endif

    </div>
</section>
<!-- replay -->
    @foreach($discussion->replies as $reply)
    <div class="panel panel-dark ">
        <header class="panel-heading">
            <div>
                <img height="20px" width="20px" style="border-radius:50%;"
                    src="{{ Gravatar::src($reply->owner->email) }}">
                <strong>{{$reply->owner->name}}</strong>
                (<strong>{{$reply->owner->point}}</strong>)

            </div>
            <div class="panel-actions">
                @if(auth::id() == $discussion->user_id)
                <form action="{{route('discussion.best-reply',['discussion'=>$discussion->slug,'reply'=>$reply->id])}}"
                    method="POST">

                    @csrf
                    <button class="btn btn-sm btn-warning" type="submit"> Mark as best reply</button>

                </form>
                @endif
            </div>
        </header>
        <div class="panel-body">
            <p class="panel-text">{!!$reply->content!!}</p>
        </div>

        <div class="panel-footer">
            @auth
            @if($reply->is_liked_by_auth_user())
            <a name="" id="" class="btn btn-danger" href="{{ Route('reply.unlike',['id'=>$reply->id])}}"
                role="button">Unlike <span class="badge badge-primary ">{{ $reply->likes->count()}}</span></a>
            @else
            <a name="" id="" class="btn btn-success" href="{{ Route('reply.like',['id'=>$reply->id])}}"
                role="button">like <span class="badge badge-primary ">{{ $reply->likes->count()}}</span></a>
            @endif
            @endauth

            <!-- <a href="{{route('login')}}" class="btn  btn-info my-2"> {{ $reply->likes->count()}}-like</a>  to do  user point -->


        </div>
    </div>
    <!-- FAQs -->

    @endforeach

    <div class="pagination-wrapper d-flex justify-content-center">
{{$discussion->replies()->paginate(3)->links('pagination::bootstrap-4')}}
    </div>



<!-- add new replay -->
<section class="panel">
    <header class="panel-heading">


        <h2 class="panel-title">Add new replay</h2>
    </header>
    <div class="panel-body">

        @auth
        <form action="{{route('replies.store',$discussion->slug)}}" class="form-horizontal form-bordered" method="POST">
            @csrf

            <div class="form-group">
                <label class="col-md-3 control-label" for="content">content</label>
                <div class="col-md-6">
                    <textarea name="content" id="content" cols="30"></textarea> </div>
            </div>


            <button class="btn btn-success my-2" type="submit">reply</button>
        </form>
        @else
        <a href="{{route('login')}}" style="width: 100%;" class="btn  btn-info my-2">loging to add reply</a>

        @endauth


    </div>
</section>
@endsection
