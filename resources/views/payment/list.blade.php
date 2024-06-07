@extends('layouts.app') 
@section('title', 'Add Payment')
@section('content')
<div class="content-wrapper">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Payment/</span> List</h4>
            <h5 class="card-header">Payment Details </h5>
           
            <div class="card-body">
                <div class="card-datatable table-responsive">
                    <table class="table" width="100%" cellspacing="0"  id="user_table">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Event Name</th>
                                <th>Employee Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $item)
                            <tr>  
                                <td>{{$loop->iteration }}</td> 
                                <td>{{ $item->user->name }}</td> 
                                <td>{{ $item->amount }}</td> 
                                <td>{{ $item->payment_method }}</td> 
                                <td>{{ @$item->event->name }}</td> 
                                <td>{{ $item->employee->name }}</td> 
                                <td> 
                                    {{ $item->status }} 
                                </td>
                            </tr>
                            @endforeach
                            @include('layouts.table-footer', ['linkData' => $payments])
                        </tbody>
                    </table>
                </div>      
            </div>
            </div>
            </div>
            </div>
@endsection