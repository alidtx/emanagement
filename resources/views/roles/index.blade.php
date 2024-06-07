@extends('layouts.app')
@section('title', 'Roles')
@section('content')
    <style>
        .pagination {
            float: right;
            margin-top: 10px;
        }
    </style>
    <div class="content-wrapper">
        <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
        <div class="container-xxl flex-grow-1 container-p-y">
            {{-- new --}}
            <div class="row g-4">
                @foreach ($roles as $key => $role)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-normal mb-2">Total {{ $role->users->count() }} users</h6>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        @foreach ($role->users->take(5) as $user)
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                title="{{ $user->name }}" class="avatar avatar-sm pull-up">
                                                @if (!empty($user->profile_image))
                                                    <img class="rounded-circle"
                                                        src='{{ asset('storage/' . $user->profile_image) }}'>
                                                @else
                                                    <img class="rounded-circle"
                                                        src="https://ui-avatars.com/api/?name={{ $user->name }}&size=50&rounded=true&color=fff&background=fc6369">
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-between align-items-end mt-1">
                                    <div class="role-heading">
                                        <h4 class="mb-1">{{ strtoupper($role->name) }}</h4>
                                        <a href="{{ route('roles.edit', $role->id) }}" class="role-edit-modal"><span>Edit
                                                Role</span></a>
                                    </div>
                                    {{-- <a href="{{ route('role_delete', $role->id) }}" class="text-danger"><i
                                            class="ti ti-copy ti-md"></i>Delete</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card h-100">
                        <div class="row h-100">
                            <div class="col-sm-5">
                                <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                                    <img src="{{ asset('assets/img/illustrations/add-new-roles.png') }}"
                                        class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83">
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="card-body text-sm-end text-center ps-sm-0">
                                    @can('role-create')
                                        <a class="btn btn-primary mb-2 text-nowrap add-new-role"
                                            href="{{ route('roles.create') }}"><i class="fa fa-plus"></i> Add New Role</a>
                                    @endcan
                                    <p class="mb-0 mt-1">Add role, if it does not exist</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- {!! $roles->render() !!} --}}
@endsection
