@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <style>
        .select2-container .select2-selection--multiple {
            min-height: 40px;
        }
    </style>
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Users/</span> Edit User</h4>
            <div class="card shadow mb-4">
                <h5 class="card-header">User Edit</h5>

                <div class="card-body">
                    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'files' => true]) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label" for="formValidationName">Name</label>
                            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="formValidationName">Email</label>
                            {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="formValidationName">Phone</label>
                            {!! Form::text('phone', null, ['placeholder' => 'Ex.01XXXXXXXXXX', 'class' => 'form-control']) !!}

                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="formValidationSelect2">Role</label>
                            {!! Form::select('roles[]', ['' => 'Please select'] + $roles, $userRole, [
                                'class' => 'select2 form-select',
                                'data-allow-clear' => 'true',
                            ]) !!}
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="formValidationSelect2">User Type</label>
                            {!! Form::select('user_type', ['' => 'Please select'] + config('constants.user_type'), $user->user_type, [
                                'class' => 'select2 form-select',
                                'data-allow-clear' => 'true',
                            ]) !!}
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="formValidationSelect2">Status</label>
                            <select id="formValidationSelect2" name="status" class="form-select select2"
                                data-allow-clear="true">
                                <option value="">Select</option>
                                <option value="1" <?php if ($user->status == 1) {
                                    echo 'selected';
                                } ?>>Active</option>
                                <option value="0" <?php if ($user->status == 0) {
                                    echo 'selected';
                                } ?>>Inactive</option>

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="formValidationFile" class="form-label">Profile Image</label>
                            {!! Form::file('profile_image', [
                                'placeholder' => 'image',
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="col-md-6">
                            <div class="form-password-toggle">
                                <label class="form-label" for="formValidationName">Password</label>
                                <div class="input-group input-group-merge">
                                    {!! Form::password('password', [
                                        'placeholder' => 'Password',
                                        'class' => 'form-control',
                                        'aria-describedby' => 'multicol-password2',
                                    ]) !!}
                                    <span class="input-group-text cursor-pointer" id="multicol-password2"><i
                                            class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-password-toggle">
                                <label class="form-label" for="formValidationName">Confirm Password</label>
                                <div class="input-group input-group-merge">
                                    {!! Form::password('confirm-password', [
                                        'placeholder' => 'Confirm Password',
                                        'class' => 'form-control',
                                        'aria-describedby' => 'multicol-password2',
                                    ]) !!}
                                    <span class="input-group-text cursor-pointer" id="multicol-password2"><i
                                            class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                        </div>
                        @if (isset($user) && $user->profile_image)
                            <div class="col-md-6">
                                <label class="form-label" for="formValidationName">Old Image</label>
                                <img src="{{ asset('storage/' . $user->profile_image) }}" alt=" Picture" width="150px"
                                    height="150px">
                            </div>
                        @endif
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <hr>
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
