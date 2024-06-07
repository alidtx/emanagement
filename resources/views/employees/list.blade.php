@extends('layouts.app') 
@section('title', 'Add Employee')
@section('content')
<div class="content-wrapper">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Employees/</span> Add New</h4>
        <div class="addbutton" style="text-align:left; margin-bottom:5px;"><a href="{{ route('employees.create') }}" class="btn bg-gradient-success btn-flat waves-effect waves-light">Add Employee</a></div>
        <div class="card shadow mb-4">
            <h5 class="card-header">Employees Details </h5>
           
            <div class="card-body">
                <div class="card-datatable table-responsive">
                    <table class="table" width="100%" cellspacing="0"  id="user_table">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Employee Unique Id</th>
                                <th>Telegram</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emaployees as $item)
                            <tr>  
                                <td>{{$loop->iteration }}</td> 
                                <td>{{ $item->name }}</td> 
                                <td>{{ $item->email }}</td> 
                                <td>{{ $item->employee_unique_id }}</td> 
                                <td>{{ $item->telegram }}</td> 
                                <td>
                                    <a href="{{ route('employees.edit', ['id' => $item->id]) }}"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
                                    @if ($item->status==1)
                                    <a href="{{url('employees/status/0', ['id' => $item->id])}}"><button type="button" class="btn btn-primary btn-sm">Active</button></a>
                                    @elseif($item->status==0)
                                    <a href="{{url('employees/status/1', ['id' => $item->id])}}"><button type="button" class="btn btn-danger btn-sm">Deactive</button></a>
                                    @endif
                                    
                                </td>
                            </tr>
                            @endforeach
                            @include('layouts.table-footer', ['linkData' => $emaployees])
                        </tbody>
                    </table>
                </div>      
            </div>
            </div>
            </div>
            </div>
@endsection