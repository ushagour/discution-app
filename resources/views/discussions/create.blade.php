@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{Route('discussion.create')}}"> <span class="badge badge-primary"> add discution</span></a>

    </div>

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif


        <form  action="{{route('discussion.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">title</label>
                <input id="title" class="form-control" type="text" name="title">
            </div>
            <div class="form-group">
                <textarea  class="form-control" name="content" ></textarea>
   
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


@section('more_css')
@endsection 
@section('more_js')
@endsection 