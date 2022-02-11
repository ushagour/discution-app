@extends('layouts.app')
@section('header')
<header class="page-header">

                    <div class="right-wrapper pull-right">
                        <ol class="breadcrumbs">
                            <li>
                                <a  href="{{route('discussions.index')}}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                                </a></li>

                        </ol>
                        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
                    </div>
</header>
@endsection
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



<div class="row">
    <div class="col-xs-12">
        @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <section class="panel">
            <header class="panel-heading">

                <h2 class="panel-title"> editing ({{$discussion->title}}) </h2>
            </header>
            <div class="panel-body">
                <form class="form-horizontal form-bordered"
                    action="{{Route('discussions.update',['discussion'=>$discussion->slug])}}" method="POST">

                    @csrf

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="title">title</label>
                        <div class="col-md-6">
                            <input id="title" class="form-control" type="text" value="{{$discussion->title}}"
                                name="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="channel">channel</label>
                        <div class="col-md-6">
                            <select id="channel" class="form-control" name="channel_id">
                                @foreach($channels as $channel)

                                <option value="{{$channel->id}}"  {{ ($channel->id == $discussion->channel_id)? 'selected': ''}}>{{$channel->name}}</option>
                                @endforeach
                            </select> </div>
                    </div>



                    <div class="form-group">
                        <label class="col-md-3 control-label">Content</label>
                        <div class="col-md-9">
                        <textarea class="summernote"  data-plugin-summernote 
                                data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" }, "name":"content"  }' name="content"  > {!!$discussion->content!!}</textarea>
                            </div>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="mb-xs mt-xs my-2 btn btn-default col-md-offset-4 ">EDIT</button>
                    </div>
                

                </form>
            </div>
        </section>
    </div>
</div>


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





