@extends('layouts.app')
@section('title', 'Roles')
@section('content')
    <div class="content-wrapper">
        <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Creat New Role</h6>
                </div>
                <div class="row">
                    <!-- data table start -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <form action="{{ route('roles.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="name">Role Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter a Role Name">
                                        </div>
                                    </div>
                                    {{-- new --}}
                                    <div class="table-responsive">
                                        <table class="table table-flush-spacing">
                                            <tbody>
                                                <tr>
                                                    <td class="text-nowrap fw-medium">Administrator Access <i
                                                            class="ti ti-info-circle" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="Allows a full access to the system"></i></td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="selectAll" />
                                                            <label class="form-check-label" for="selectAll">
                                                                Select All
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php $i = 1; @endphp
                                                @foreach ($permission_groups as $group)
                                                    <tr>
                                                        <td class="text-nowrap fw-medium">{{ strtoupper($group->name) }}
                                                        </td>
                                                        @php
                                                            $permissions = App\Models\User::getpermissionsByGroupName(
                                                                $group->name,
                                                            );
                                                            $j = 1;
                                                        @endphp
                                                        @foreach ($permissions as $permission)
                                                            <td>
                                                                <div class="d-flex">
                                                                    <div class="form-check me-3 me-lg-5">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="permission[]"
                                                                            id="checkPermission{{ $permission->id }}"
                                                                            value="{{ $permission->name }}" />
                                                                        <label class="form-check-label"
                                                                            for="checkPermission{{ $permission->id }}">
                                                                            {{ $permission->name }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            @php  $j++; @endphp
                                                        @endforeach
                                                    </tr>
                                                    @php  $i++; @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1"> <i class="fa fa-save"></i>
                                        Save Role</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- data table end -->

                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(e) {
            (function() {

                // Select All checkbox click
                const selectAll = document.querySelector('#selectAll'),
                    checkboxList = document.querySelectorAll('[type="checkbox"]');
                selectAll.addEventListener('change', t => {
                    checkboxList.forEach(e => {
                        e.checked = t.target.checked;
                    });
                });
            })();
        });
    </script>
@endsection
