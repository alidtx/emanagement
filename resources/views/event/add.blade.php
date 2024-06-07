@extends('layouts.app') 
@section('title', 'Add Event')
@section('content')


<style>

    .button{
        margin-top:25px;
    }
</style>

<div class="content-wrapper">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Event/</span> Add New</h4>
        <div class="card shadow mb-4">
            <h5 class="card-header">Event Details </h5>
            <div class="card-body">
                <form action="{{ route('event.store') }}" method="post" id="formData" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="row" id="row">
                        <div class="form-group col-sm-4">
                            <label>Name<small style="color: brown">*</small></label>
                            <input type="text" class="form-control " name="name"> 
                        </div>
                        
                        <div class="form-group col-sm-4">
                            <label>Start Date<small style="color: brown">*</small></label>
                            <input type="date" class="form-control " name="start_date"> 
                        </div>

                        <div class="form-group col-sm-4">
                            <label>End Date<small style="color: brown">*</small></label>
                            <input type="date" class="form-control " name="end_date" > 
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Type<small style="color: brown">*</small></label>
                             <select name="type" id="type"  class="form-control " onchange="onchangeType()">
                                  <option value="">----Select type----</option>
                                 <option value="1">Plat Amount</option>
                                 <option value="2">Designation Wise amount</option>
                             </select>
                        </div>
                       
                       

                    </div>
                    <br>
                    <button class="btn bg-gradient-success btn-flat"><i class="fas fa-save"></i>Save</button>
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
        $(".hiddv").empty();
         var html1=`<div class="form-group col-sm-4  ammh" id="amount" >
                            <label>Amount<small style="color: brown">*</small></label>
                            <input type="text" class="form-control" name="amount">
                        </div>`
    $("#row").append(html1);
    }else if (type === '2')

    {
       $(".ammh").empty();
        var html=`<div class="row hiddv">
                        <div class="form-group col-sm-4" id="designation">
                            <label>Designation<small style="color: brown">*</small></label>
                             <select name="designation_id[]" id="designation_id"  class="form-control" required>
                                <option value="">----Select Designation----</option>
                                @foreach ($designation as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach   
                             </select>
                        </div>
                        <div class="form-group col-sm-4" id="amount" required>
                            <label>Amount<small style="color: brown">*</small></label>
                            <input type="text" class="form-control" name="amount[]">
                        </div>
                        
                        <div class="form-group col-sm-2">
                            <button type="button" class="btn btn-success btn-sm button" onclick="add_more()">
                                <i class="fa fa-plus"></i>&nbsp; Add</button>
                        </div>   
                       </div>`
     $("#row").append(html);
    }     
  }
   function add_more()
   {
    var html=`<div class="row hiddv">
                        <div class="form-group col-sm-4" id="designation">
                            <label>Designation<small style="color: brown">*</small></label>
                             <select name="designation_id[]" id="designation_id"  class="form-control" required>
                                <option value="">----Select Designation----</option>
                                @foreach ($designation as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach   
                             </select>
                        </div>
                        <div class="form-group col-sm-4" id="amount" required>
                            <label>Amount<small style="color: brown">*</small></label>
                            <input type="text" class="form-control" name="amount[]">
                        </div>  
                       </div>
                       `
    $("#row").append(html);

   }


</script>

@endsection