@extends('layouts.app')
@section('title', 'Users')

@section('content')
    <style>
        .pagination {
            float: right;
            margin-top: 10px;
        }
    </style>
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title mb-3">Search Filter</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="float-end">
                                <a class="btn btn-primary" href="{{ route('users.create') }}"><i class="fa fa-plus"></i>Add
                                    New</a>
                            </div>
                        </div>
                    </div>
                    @include('users.filter')
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-3">Users List</h5>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="table" width="100%" cellspacing="0"  id="user_table">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>User Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center user-name">
                                            <div class="avatar-wrapper">
                                                <div class="avatar me-3">
                                                    @if (!empty($user->profile_image))
                                                        <img class="img-profile rounded-circle" width="50px"
                                                            height="50px"
                                                            src='{{ asset('storage/' . $user->profile_image) }}'>
                                                    @else
                                                        <img class="img-profile rounded-circle"
                                                            src="https://ui-avatars.com/api/?name={{ $user->name }}&size=50&rounded=true&color=fff&background=fc6369">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="fw-medium">{{ $user->name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $v)
                                                <span class="badge bg-label-info me-1">{{ $v }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td><span class="badge bg-label-primary me-1">{{ $user->user_type }}</span></td>
                                    <td>{{ $user->status ? 'Active' : 'In-Active' }}</td>
                                    <td>
                                        <a title="View" href="{{ route('users.show', $user->id) }}"
                                            class="btn btn-outline-info"><i class="fa fa-eye"></i>
                                        </a>|
                                        <a title="Edit" href="{{ route('users.edit', $user->id) }}"
                                            class="btn btn-outline-primary"><i class="fa fa-edit"></i>
                                        </a>|
                                        <a title="Delete" href="{{ route('user_delete', $user->id) }}" id="usr_delete"
                                            class="btn btn-outline-danger"><i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @include('layouts.table-footer', ['linkData' => $users])
                    </table>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('pagescript')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(function() {
            $(document).on('click', '#usr_delete', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.preventDefault();
                        Swal.fire(
                            'Deleted!',
                            'Successfully Deleted.',
                            'success'
                        )
                    }
                })

            });
        });
    </script>
@endpush
