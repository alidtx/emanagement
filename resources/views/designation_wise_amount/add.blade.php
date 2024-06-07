@extends('layouts.app') 
@section('title', 'Add Employee')
@section('content')
<div class="content-wrapper">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Designation Wise Amount/</span> Add New</h4>
        <div class="card shadow mb-4">
            <h5 class="card-header">Designation Wise Amount Details </h5>
            <div class="card-body">
                <form action="{{ route('designation.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="row">

                        <div class="form-group col-sm-4">
                            <label>Designation<small style="color: brown">*</small></label>
                             <select name="designation_id" id="designation_id"  class="form-control ">
                                <option value="">----Select Designation----</option>
                                 <option value="1">software Specialist</option>
                                 <option value="2">software Engineer</option>
                             </select>
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Event<small style="color: brown">*</small></label>
                             <select name="event_id" id="event_id"  class="form-control ">
                                <option value="">----Select Designation----</option>
                                 <option value="1">software Specialist</option>
                                 <option value="2">software Engineer</option>
                             </select>
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Amount<small style="color: brown">*</small></label>
                            <input type="text" class="form-control " name="amount"> 
                        </div>
                        
                    </div>
                    <br>
                    <button class="btn bg-gradient-success btn-flat"><i class="fas fa-save"></i>Save</button>
                </form>
            </div>
            </div>
            </div>
            </div>
@endsection