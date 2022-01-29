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
                            <li><a  href="{{route('users.notifications')}}"><span>Notifications</span>
                                </a></li>

                        </ol>
                        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
                    </div>
</header>
@endsection
@section('content')


            <div class="card">
            <div class="card-header">Notifications</div>
                <div class="card-body">
            <ul class="list-group">
            @foreach($notifications as $notification)
     
     <li class="list-group-item">


     @if($notification->type == 'App\Notifications\NewReplyAdded')     
            <!-- //affichage dyal colum data  -->

            A new replay was added to your discussions <strong>{{$notification->data['discussion']['title']}}</strong> 
    <a  href="{{route('discussions.show',$notification->data['discussion']['slug'])}}" class="btn btn-primary float-right btn-sm" >See Discussion </a>

     @endif


     @if($notification->type=='App\Notifications\ReplyMarkedAsBestReply')

            your reply to discussion: <strong>{{ $notification->data['discussion']['title']}}</strong> was marked as best reply
            <a  href="{{route('discussions.show',$notification->data['discussion']['slug'])}}" class="btn btn-primary float-right btn-sm" >See Discussion </a>

     @endif
     </li>
     

     @endforeach
            </ul>
           
                
                </div>



</div>
@endsection
