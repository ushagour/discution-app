@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">


        <img height="40px" width="40px" style="border-raduis:50%;"
            src="{{ Gravatar::src($discussion->author->email) }}">
        <strong>{{$discussion->author->name}}</strong>

    </div>

    <div class="text-center "> <strong>{{$discussion->title}}</strong></div>

    <div class="card-body">
        <p class="card-text">{!!$discussion->content!!}</p>
    </div>
    @if($discussion->BestReply)

    <div class="card text-white bg-success">
     <div class="card-header d-flex justify-content-between">  <!-- les element li fwsst had div ghaykoon wahd esspac biinathom  -->
<div>   <img height="40px" width="40px" style="border-raduis:50%;" src="{{Gravatar::src( $discussion->BestReply->owner->email)}}" alt="">   <!--  discussion->(bestreply)reply->(owner)user ->email -->
          <strong>{{$discussion->BestReply->owner->name}}</strong></div>
      <div>
          <strong>
              BEST REPLY
          </strong>
      </div>
          </div>

          <div class="card-body">
            <p class="card-text">{!!$discussion->BestReply->content!!}</p>
        </div>
    </div>
    @endif
</div>
<br>
@foreach($discussion->replies()->paginate(3) as $reply)
<div class="card">
    <div class="card-header d-flex justify-content-between">

        <div>
            <img height="40px" width="40px" style="border-raduis:50%;" src="{{ Gravatar::src($reply->owner->email) }}">
            <strong>{{$reply->owner->name}}</strong>

        </div>
        <div
            @if(auth::id() == $discussion->user_id)


            <form action="{{route('discussion.best-reply',['discussion'=>$discussion->slug,'reply'=>$reply->id])}}"
                method="POST">

                @csrf
                <button class="btn btn-sm btn-warning" type="submit"> Mark as best reply</button>

            </form>
            @endif
        </div>
    </div>
    <div class="card-body">
        <p class="card-text">{!!$reply->content!!}</p>
    </div>
    {{$discussion->replies()->paginate(3)->links()}}
</div>
@endforeach
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Reply</h5>

    </div>
    <div class="card-body">
        @auth
        <form action="{{route('replies.store',$discussion->slug)}}" method="POST">
            @csrf
            <input id="x" type="hidden" name="content">
            <trix-editor input="x"></trix-editor>
            <button class="btn btn-success my-2" type="submit">reply</button>
            <!-- //my = margin left and right only  -->
        </form>
        @else
        <a href="{{route('login')}}" style="width: 100%;" class="btn  btn-info my-2">loging to add reply</a>

        @endauth


    </div>
</div>


<!-- </div> -->
@endsection
<script>

</script>
