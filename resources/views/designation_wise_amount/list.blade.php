@extends('layouts.app') 
@section('title', 'Add Employee')
@section('content')
<div class="content-wrapper">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Designation Wise Amount/</span> Add New</h4>
        <div class="addbutton" style="text-align:left; margin-bottom:5px;"><a href="{{ route('designation_wise_amount.create') }}" class="btn bg-gradient-success btn-flat waves-effect waves-light">Add Designation Wise Amount</a></div>
        <div class="card shadow mb-4">
            <h5 class="card-header">Designation Wise Amount Details </h5>
           
            <div class="card-body">
                <div class="table-responsive m-b-40">
                    <table id="dataTable" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Designation</th>
                                <th>Event name</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($designation as $item)
                            <tr>  
                                <td>{{$loop->iteration }}</td> 
                                <td>{{ $item->name }}</td> 
                                <td>{{ $item->department }}</td> 
                                <td>
                                    <a href="{{ route('designation.edit', ['id' => $item->id]) }}"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
                                    <a href="{{ route('designation.delete', ['id' => $item->id]) }}"><button type="button" class="btn btn-primary btn-sm">Delete</button></a>
                                </td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>      
            </div>
            </div>
            </div>
            </div>
@endsection