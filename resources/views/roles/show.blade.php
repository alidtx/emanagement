@extends('layouts.app')
@section("title","Roles")
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Show Role Information</h6>
    </div>

<div class="card-body">

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Name:</strong>

            <span>{{ strtoupper($role->name) }}</span>

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permissions:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <span class="badge rounded-pill bg-label-info">{{ $v->name }}</span>
                @endforeach
            @endif
        </div>
    </div>

</div>
</div>
</div>
    </div>
</div>
@endsection