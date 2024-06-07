@extends('layouts.app')
@section('title', 'Settings')
@section('content')
    <div class="content-wrapper">
        <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Settings</h4>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'settings.store', 'method' => 'POST', 'files' => true]) !!}

                    @include('settings.form')

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <hr>
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Update </button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
