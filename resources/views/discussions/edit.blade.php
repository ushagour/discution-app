@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

<div class="card-title">  Edit discussions</div>
    </div>

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif


        <form  action="{{Route('discussions.update',['discussion'=> $discussion->slug])}}" method="POST">

            @csrf
            <div class="form-group">
                <label for="title">title</label>
                <input id="title" class="form-control" type="text" name="title" value="{{$discussion->title}}">
            </div>
            <div class="form-group">
                <input id="x" type="hidden" name="content" value="{{$discussion->content}}">
  <trix-editor input="x"></trix-editor>
            </div>
            <div class="form-group">
                <label for="channel">channel</label>

                <select id="channel" class="form-control" name="channel_id">
                    @foreach($channels as $channel)

                    <option value="{{$channel->id}}">{{$channel->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>



    </div>



</div>
@endsection


<!-- -->