@extends('layouts.app') 
@section('title', 'Add Expense')
@section('content')
<div class="content-wrapper">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Expense/</span> Add New</h4>
        <div class="addbutton" style="text-align:left; margin-bottom:5px;"><a href="{{ route('expense.create') }}" class="btn bg-gradient-success btn-flat waves-effect waves-light">Add Expenses</a></div>
        <div class="card shadow mb-4">
            <h5 class="card-header">Expense Details </h5>
           
            <div class="card-body">
                <div class="card-datatable table-responsive">
                    <table class="table" width="100%" cellspacing="0"  id="user_table">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Employee Name</th>
                                <th>Total Expenses</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expense as $item)
                            <tr>  
                                <td>{{$loop->iteration }}</td> 
                                <td>{{ $item->user->name }}</td> 
                                <td>{{ $item->user->name }}</td> 
                                <td>{{ $item->amount }}</td> 
                                <td>{{ $item->date }}</td> 
                                <td>
                                    <a href="{{ route('expense.edit', ['id' => $item->id]) }}"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
                                    @if ($item->status==1)
                                    <a href="{{url('expense/status/0', ['id' => $item->id])}}"><button type="button" class="btn btn-primary btn-sm">Active</button></a>
                                    @elseif($item->status==0)
                                    <a href="{{url('expense/status/1', ['id' => $item->id])}}"><button type="button" class="btn btn-danger btn-sm">Deactive</button></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @include('layouts.table-footer', ['linkData' => $expense])
                    </table>
                </div>      
            </div>
            </div>
            </div>
            </div>
@endsection