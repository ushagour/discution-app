@extends('layouts.app')

@section('content')

            <div class="card">
                <div class="card-header">
                <a href="{{Route('discussions.create')}}"> <span class="badge badge-primary"> add discution</span></a>
            
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>



</div>
@endsection
