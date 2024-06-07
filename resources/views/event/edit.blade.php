@extends('layouts.app') 
@section('title', 'Add Employee')
@section('content')
<style>

    .button{
        margin-top:25px;
    }
    .btn-flat{
        width: 96px;
    margin-top: -19px;
    margin-left: 10px;
    margin-bottom: 10px;
    }
</style>
<div class="content-wrapper">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Employee/</span> Add New</h4>
        <div class="card shadow mb-4">
            <h5 class="card-header">Employee Details </h5>
            <div class="card-body"> 
               {{-- @dd($employees); --}}
               <form action="{{ route('event.update',  $edit->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                
                <div class="row" id="row">
                    <div class="form-group col-sm-4">
                        <label>Name<small style="color: brown">*</small></label>
                        <input type="text" class="form-control " name="name" value="{{ $edit->name }}"> 
                    </div>
                
                    <div class="form-group col-sm-4">
                        <label>Start Date<small style="color: brown">*</small></label>
                        <input type="date" class="form-control " name="start_date" value="{{ $edit->start_date }}"> 
                    </div>

                    <div class="form-group col-sm-4">
                        <label>End Date<small style="color: brown">*</small></label>
                        <input type="date" class="form-control " name="end_date"  value="{{ $edit->start_date }}"> 
                    </div>

                    <div class="form-group col-sm-4">
                        <label>Event Code</label>
                        <input type="text" class="form-control" name="unique_event_code" disabled value="{{ $edit->event_unique_code }}"> 
                    </div>

                  
                    <div class="form-group col-sm-4">
                        <label>Type<small style="color: brown">*</small></label>
                         <select name="type" id="type"  class="form-control " onchange="onchangeType()">
                             <option value="">----Select type----</option>
                             <option value="1" {{ $edit->type == '1' ? 'selected' : '' }}>Plat Amount</option>
                             <option value="2" {{ $edit->type == '2' ? 'selected' : '' }}>Designation Wise Amount</option>
                         </select>
                    </div>

                    <div class="form-group col-sm-4" id="designation" style="display:none">
                        <label>Designation<small style="color: brown">*</small></label>
                         <select name="designation_id" id="designation_id"  class="form-control ">
                            <option value="">----Select Designation----</option>
                            @foreach ($designation as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach   
                         </select>
                    </div>

                      @if ($edit->type=='1')
                      <div class="form-group col-sm-4 ammh" id="amount" >
                        <label>Amount<small style="color: brown">*</small></label>
                        <input type="text" class="form-control" name="amount" value="{{$edit->amount}}">
                       </div>

                       @else

                    <div class="contentforDA">
                       @foreach ($edit->designationWiseEvent as $val)
                       <div class="row wanttoremove">
                        <div class="form-group col-sm-4" id="designation">
                            <label>Designation<small style="color: brown">*</small></label>
                             <select name="designation_id[]" id="designation_id"  class="form-control"  >
                                <option value="">----Select Designation----</option>
                                @foreach ($designation as $item)
                                <option value="{{ $item->id }}" {{$item->id==$val->designation_id  ? "selected": ""  }}>{{ $item->name }}</option> 
                                @endforeach   
                             </select>
                        </div>
                        <div class="form-group col-sm-4" id="amount" >
                            <label>Amount<small style="color: brown">*</small></label>
                            <input type="text" class="form-control" name="amount[]" value="{{$val->amount  }}">
                        </div>
                       
                        @if ($loop->first)
                        <div class="form-group col-sm-2">
                            <button type="button" class="btn btn-success btn-sm button" onclick="add_more()">
                                <i class="fa fa-plus"></i>&nbsp; Add
                            </button>
                        </div>
                        @endif
                       </div>
                       @endforeach
                      @endif
                    </div>
                      
                </div>
                <br>
                <button class="btn bg-gradient-success btn-flat"><i class="fas fa-save"></i>Update</button>
            </form>
            </div>
            </div>
            </div>
            </div>



            <script>
 function  onchangeType() 
  {
   var type = $('#type').val();
    if(type === '1') {
        $(".ammh").remove();
        $(".wanttoremove").remove();
         var html1=`<div class="form-group col-sm-4  ammh" id="amount" required>
                            <label>Amount<small style="color: brown">*</small></label>
                            <input type="text" class="form-control" name="amount">
                        </div>`
    $("#row").append(html1);
    }else if (type === '2')

    {
    $(".ammh").remove();
      
    var html=` @foreach ($edit->designationWiseEvent as $val)
                       <div class="row wanttoremove">
                        <div class="form-group col-sm-4" id="designation">
                            <label>Designation<small style="color: brown">*</small></label>
                             <select name="designation_id[]" id="designation_id"  class="form-control" required>
                                <option value="">----Select Designation----</option>
                                @foreach ($designation as $item)
                                <option value="{{ $item->id }}" {{$item->id==$val->designation_id  ? "selected": ""  }}>{{ $item->name }}</option> 
                                @endforeach   
                             </select>
                        </div>
                        <div class="form-group col-sm-4" id="amount" required>
                            <label>Amount<small style="color: brown">*</small></label>
                            <input type="text" class="form-control" name="amount[]" value="{{$val->amount  }}">
                        </div>
                        @if ($loop->first)
                        <div class="form-group col-sm-2">
                            <button type="button" class="btn btn-success btn-sm button" onclick="add_more()">
                                <i class="fa fa-plus"></i>&nbsp; Add
                            </button>
                        </div>
                        @endif
                       </div>
                       @endforeach`
$(".contentforDA").append(html);
}}

   function add_more()
   {
    var html=`<div class="row wanttoremove">
                        <div class="form-group col-sm-4" id="designation">
                            <label>Designation<small style="color: brown">*</small></label>
                             <select name="designation_id[]" id="designation_id"  class="form-control" required>
                                <option value="">----Select Designation----</option>
                                @foreach ($designation as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach   
                             </select>
                        </div>
                        <div class="form-group col-sm-4" id="amount" >
                            <label>Amount<small style="color: brown">*</small></label>
                            <input type="text" class="form-control" name="amount[]" required>
                        </div>  
                       </div>
                       `
    $(".contentforDA").append(html);

   }
            
            </script>
@endsection