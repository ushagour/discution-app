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
</div>
<br>
@foreach($discussion->replies as $reply)
<div class="card">
    <div class="card-header">
        <img height="40px" width="40px" style="border-raduis:50%;" src="{{ Gravatar::src($reply->owner->email) }}">
        <strong>{{$discussion->owner->name}}</strong> </div>
    <div class="card-body">
        <p class="card-text">{!!$reply->content!!}</p>
    </div>

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
