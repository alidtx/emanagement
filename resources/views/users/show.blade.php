@extends('layouts.app')
@section('title', 'Users')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Users/</span> Profile</h4>

            <!-- Header -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="user-profile-header-banner">
                            <img src="{{ asset('assets/img/pages/profile-banner.jpg')}}" alt="Banner image" class="rounded-top"
                                width="100%" />
                        </div>
                        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                @if($user->profile_image)
                                    <img src="{{ asset('storage/'.$user->profile_image)}}" alt="user image"
                                        class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img"  width="100px" height="50px"/>
                                @else
                                <img src="{{ asset('assets/img/avatars/14.png')}}" alt="user image"
                                    class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                                @endif
                            </div>
                            <div class="flex-grow-1 mt-3 mt-sm-5">
                                <div
                                    class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                    <div class="user-profile-info">
                                        <h4>{{$user->name}}</h4>
                                        <ul
                                            class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                            <li class="list-inline-item d-flex gap-1">
                                                <i class="ti ti-mail"></i> {{$user->email}}
                                            </li>
                                            <li class="list-inline-item d-flex gap-1"><i class="ti ti-phone-call"></i>{{$user->phone}}</li>
                                            <li class="list-inline-item d-flex gap-1">
                                                <i class="ti ti-calendar"></i> Joined {{date('d-M-Y',$user->created_at->timestamp)}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Header -->
            <!-- User Profile Content -->
            <div class="row">
                <div class="col-xl-6 col-lg-5 col-md-5">
                    <!-- About User -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <small class="card-text text-uppercase">About</small>
                            <ul class="list-unstyled mb-4 mt-3">
                                <li class="d-flex align-items-center mb-3">
                                    <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Full
                                        Name:</span> <span>{{$user->name}}</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <i class="ti ti-check text-heading"></i><span
                                        class="fw-medium mx-2 text-heading">Status:</span> <span>{{$user->status ? 'Active' : 'In-Active'}}</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <i class="ti ti-crown text-heading"></i><span
                                        class="fw-medium mx-2 text-heading">Role:</span> <span>{{$user->roles()->first()->name ?? 'N/A'}}</span>
                                </li>
                            </ul>
                            <small class="card-text text-uppercase">Contacts</small>
                            <ul class="list-unstyled mb-4 mt-3">
                                <li class="d-flex align-items-center mb-3">
                                    <i class="ti ti-phone-call"></i><span
                                        class="fw-medium mx-2 text-heading">Contact:</span>
                                    <span>{{$user->phone}}</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <i class="ti ti-mail"></i><span class="fw-medium mx-2 text-heading">Email:</span>
                                    <span>{{$user->email}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--/ About User -->

                </div>
                <div class="col-xl-6 col-lg-5 col-md-5">
                    <!-- Profile Overview -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <p class="card-text text-uppercase">Company Details</p>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center mb-3">
                                    <i class="ti ti-check"></i><span class="fw-medium mx-2">Company Name:</span>
                                    <span>{{$user->company->name ?? 'N/A'}}</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <i class="ti ti-layout-grid"></i><span class="fw-medium mx-2">Owner Name:</span>
                                    <span>{{$user->company->owner_name ?? 'N/A'}}</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="ti ti-mail"></i> <span class="fw-medium mx-2">Email:</span>
                                    <span>{{$user->company->email ?? 'N/A'}}</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="ti ti-phone-call"></i> <span class="fw-medium mx-2">Phone:</span>
                                    <span>{{$user->company->phone ?? 'N/A'}}</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="ti ti-calendar"></i> <span class="fw-medium mx-2">Address:</span>
                                    <span>{{$user->company->address ?? 'N/A'}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--/ Profile Overview -->
                </div>
            </div>
        </div>
    </div>
@endsection
