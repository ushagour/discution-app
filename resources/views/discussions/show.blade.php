@extends('layouts.app')
@section('more_css')
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/dropzone/css/basic.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/dropzone/css/dropzone.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/summernote/summernote.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/summernote/summernote-bs3.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/codemirror/lib/codemirror.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/codemirror/theme/monokai.css')}}" />

@endsection

@section('content')


<section class="panel">
    <header class="panel-heading">
        @auth
        <div class="panel-actions">
            <a id="edit" class="fa fa-edit  fa-lg"
                href="{{route('discussions.edit',['discussion'=>$discussion->slug])}}" role="button"></a>
        </div>
@endauth
        <h2 class="panel-title"> <img height="40px" width="40px" style="border-radius:50%;"
                src="{{ Gravatar::src($discussion->author->email) }}"> <strong>{{$discussion->author->name}}</strong>
        </h2>
        <p class="panel-subtitle"> <small>{{$discussion->created_at->diffForHumans()}}</small></p>
    </header>
    <div class="panel-body">
        <p class="panel-text">{!!$discussion->content!!}</p>

        @if($discussion->BestReply)
        BEST REPLY

        <blockquote class="b-thin success">
            <img height="20px" width="20px" style="border-radius:50%;"
                src="{{Gravatar::src( $discussion->BestReply->owner->email)}}" alt="">
            <p>{!!$discussion->BestReply->content!!}</p>
            <small>{{$discussion->BestReply->owner->name}}, <cite
                    title="{{$discussion->BestReply->owner->email}}"></cite></small>
        </blockquote>


        @endif

    </div>
</section>
<!-- replay -->
@foreach($discussion->replies as $reply)
<div class="panel panel-dark ">
    <header class="panel-heading">
        <div>
            <img height="20px" width="20px" style="border-radius:50%;" src="{{ Gravatar::src($reply->owner->email) }}">
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
        <a class="mb-xs mt-xs mr-xs btn btn-danger" href="{{ Route('reply.unlike',['id'=>$reply->id])}}"
            role="button"><i class="fa fa-thumbs-down"></i> <span class="badge badge-primary ">{{ $reply->likes->count()}}</span></a>

        @else
        <a  class="mb-xs mt-xs mr-xs btn btn-success" href="{{ Route('reply.like',['id'=>$reply->id])}}" role="button"> <i class="fa fa-thumbs-up"></i>
            <span class="badge badge-primary ">{{ $reply->likes->count()}}</span></a>


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
                <textarea class="summernote" data-plugin-summernote
                                data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" }, "name":"content"  }'
                                name="content"></textarea>            
<br>
<center>
<button class="btn btn-success my-2" type="submit">reply</button>

</center>
        </form>
        @else

        <a href="{{route('login')}}" style="width: 100%;" class="btn  btn-info my-2">loging to add reply</a>

        @endauth


    </div>
</section>
@endsection
@section('more_js')
<!-- Specific Page Vendor -->
<script src="{{asset('assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js')}}"></script>
<script src="{{asset('assets/vendor/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-maskedinput/jquery.maskedinput.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js')}}"></script>
<script src="{{asset('assets/vendor/fuelux/js/spinner.js')}}"></script>
<script src="{{asset('assets/vendor/dropzone/dropzone.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap-markdown/js/markdown.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap-markdown/js/to-markdown.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js')}}"></script>
<script src="{{asset('assets/vendor/codemirror/lib/codemirror.js')}}"></script>
<script src="{{asset('assets/vendor/codemirror/addon/selection/active-line.js')}}"></script>
<script src="{{asset('assets/vendor/codemirror/addon/edit/matchbrackets.js')}}"></script>
<script src="{{asset('assets/vendor/codemirror/mode/javascript/javascript.js')}}"></script>
<script src="{{asset('assets/vendor/codemirror/mode/xml/xml.js')}}"></script>
<script src="{{asset('assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js')}}"></script>
<script src="{{asset('assets/vendor/codemirror/mode/css/css.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js')}}"></script>
<script src="{{asset('assets/vendor/summernote/summernote.js')}}"></script>
<script src="{{asset('assets/vendor/ios7-switch/ios7-switch.js')}}"></script>


<!-- Examples -->
<script src="{{asset('assets/javascripts/forms/examples.advanced.form.js')}}"></script>



@endsection
