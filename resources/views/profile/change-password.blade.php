@extends('layouts.app')
@section('title', 'Change Password')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- User Sidebar -->
                <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                    <!-- User Card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="user-avatar-section">
                                <div class="d-flex align-items-center flex-column">
                                    @if (auth()->user()->profile_image)
                                        <img class="img-fluid rounded mb-3 pt-1 mt-4"
                                            src="{{ asset('storage/' . auth()->user()->profile_image) }}" height="100"
                                            width="100" alt="User avatar" />
                                    @else
                                        <img class="img-fluid rounded mb-3 pt-1 mt-4"
                                            src="{{ asset('assets/img/avatars/15.png') }}" height="100" width="100"
                                            alt="User avatar" />
                                    @endif
                                    <div class="user-info text-center">
                                        <h4 class="mb-2">{{ auth()->user()->name }}</h4>
                                        <span
                                            class="badge bg-label-secondary mt-1">{{ auth()->user()->roles()->first()->name ?? null }}</span>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-4 small text-uppercase text-muted">Details</p>
                            <div class="info-container">
                                <ul class="list-unstyled">

                                    <li class="mb-2 pt-1">
                                        <span class="fw-medium me-1">Email:</span>
                                        <span>{{ auth()->user()->email }}</span>
                                    </li>
                                    <li class="mb-2 pt-1">
                                        <span class="fw-medium me-1">Status:</span>
                                        <span
                                            class="badge bg-label-success">{{ auth()->user()->status ? 'Active' : 'InActive' }}</span>
                                    </li>
                                    <li class="mb-2 pt-1">
                                        <span class="fw-medium me-1">Role:</span>
                                        <span>{{ auth()->user()->roles()->first()->name ?? null }}</span>
                                    </li>
                                </ul>
                                {{-- <div class="d-flex justify-content-center">
                                    <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser"
                                        data-bs-toggle="modal">Edit</a>
                                    <a href="javascript:;" class="btn btn-label-danger suspend-user">Suspended</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <!-- /User Card -->
                </div>
                <!--/ User Sidebar -->

                <!-- User Content -->
                <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                    <!-- Change Password -->
                    <div class="card mb-4">
                        <h5 class="card-header">Change Password</h5>
                        <div class="card-body">
                            <form action="{{ route('change_password_update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="alert alert-warning" role="alert">
                                    <h5 class="alert-heading mb-2">Ensure that these requirements are met</h5>
                                    <span>Minimum 6 characters long</span>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                                        <label class="form-label" for="newPassword">Current Password</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" type="password" id="password"
                                                name="old_password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="ti ti-eye-off"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                                        <label class="form-label" for="newPassword">New Password</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" type="password" id="password"
                                                name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="ti ti-eye-off"></i></span>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                                        <label class="form-label" for="confirmPassword">Confirm New Password</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" type="password" name="confirm_password"
                                                id="confirmPassword"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="ti ti-eye-off"></i></span>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary me-2">Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
