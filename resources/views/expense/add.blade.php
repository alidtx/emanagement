@extends('layouts.app') 
@section('title', 'Add Employee')
@section('content')
<div class="content-wrapper">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Expense/</span> Add New</h4>
        <div class="card shadow mb-4">
            <h5 class="card-header">Expense Details </h5>
            <div class="card-body">
                <form action="{{ route('expense.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="row">
                        
                        <div class="form-group col-sm-4">
                            <label>Amount<small style="color: brown">*</small></label>
                            <input type="number" class="form-control " name="amount"  > 
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Responsoble Person<small style="color: brown">*</small></label>
                              <select name="employee_id" id="employee_id" class="form-control ">
                                <option value="">----Select Responsoble Person----</option>
                                  @foreach ($employee as $item)
                                  <option value="{{ $item->id }}">{{ $item->name }}</option> 
                                  @endforeach
                              </select>
                        </div>
                        
                        <div class="form-group col-sm-4">
                            <label>Date<small style="color: brown">*</small></label>
                            <input type="date" class="form-control " name="date"> 
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Comment</label>
                            <textarea name="comment" id="" cols="30" rows="10"></textarea> 
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