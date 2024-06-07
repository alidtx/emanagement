@extends('layouts.app') 
@section('title', 'Add Employee')
@section('content')
<div class="content-wrapper">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Department/</span> Add New</h4>
        <div class="card shadow mb-4">
            <h5 class="card-header">Department Details </h5>
            <div class="card-body"> 
               {{-- @dd($employees); --}}
               <form action="{{ route('designation.update',  $edit->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row">
                    
                    <div class="form-group col-sm-4">
                        <label>Name<small style="color: brown">*</small></label>
                        <input type="text" class="form-control " name="name" value="{{ $edit->name }}"> 
                    </div>

                    <div class="form-group col-sm-4">
                        <label>Department<small style="color: brown">*</small></label>
                         <select name="department_id" id="department_id" class="form-control">
                             <option value="">---Select Department---</option>
                             @foreach ($department as $item)
                             <option value="{{$item->id}}"   {{$edit->department_id==$item->id? "selected" : ""}}>{{$item->name}}</option>
                             @endforeach
                             
                         </select>
                    </div>
                </div>
                <br>
                <button class="btn bg-gradient-success btn-flat"><i class="fas fa-save"></i>Update</button>
            </form>
            </div>
            </div>
            </div>
            </div>
@endsection