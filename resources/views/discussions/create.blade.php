@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        
<div class="card-title">  Add discussions</div>
    </div>

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif


        <form  action="{{Route('discussions.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">title</label>
                <input id="title" class="form-control" type="text" name="title">
            </div>
            <div class="form-group">
                <input id="x" type="hidden" name="content">
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