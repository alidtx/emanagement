@extends('layouts.app')
@section("title","Create Notification")
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create Notification</h6>
                </div>
                @include("layouts.success")
                <div class="card-body">
                    @include("layouts.error")

                    {!! Form::open(['route' => 'send-all-users.store', 'method' => 'POST',"files"=>true]) !!}
                        @include("user-notifications.form")
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <hr>
                            <button type="submit" class="btn btn-primary">Submit</button>                    
                        </div>  

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
