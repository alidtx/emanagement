@extends('layouts.app') 
@section('title', 'Add Event')
@section('content')
<div class="content-wrapper">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Event/</span> Add New</h4>
        <div class="addbutton" style="text-align:left; margin-bottom:5px;"><a href="{{ route('event.create') }}" class="btn bg-gradient-success btn-flat waves-effect waves-light">Add Event</a></div>
        <div class="card shadow mb-4">
            <h5 class="card-header">Event Details </h5>
           
            <div class="card-body">
                <div class="card-datatable table-responsive">
                    <table class="table" width="100%" cellspacing="0"  id="user_table">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Event Code</th>
                                <th width="30%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $item)
                            <tr>  
                                <td>{{$loop->iteration }}</td> 
                                <td>{{ $item->name }}</td> 
                                 @if ($item->amount!=null)
                                 <td>{{ $item->amount }}</td> 
                                 @else
                                 <td>Amount Designation Wise</td>
                                 @endif
                                
                                <td>{{ $item->start_date }}</td> 
                                <td>{{ $item->end_date }}</td> 
                                <td>{{ $item->event_unique_code }}</td> 
                                <td>
                                    <a href="{{ route('event.edit', ['id' => $item->id]) }}"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
                                    @if ($item->status==1)
                                    <a href="{{url('event/status/0', ['id' => $item->id])}}"><button type="button" class="btn btn-primary btn-sm">Active</button></a>
                                    @elseif($item->status==0)
                                    <a href="{{url('event/status/1', ['id' => $item->id])}}"><button type="button" class="btn btn-danger btn-sm">Deactive</button></a>
                                    @endif
                                    <a href="javascript:void(0);"><button type="button" class="btn btn-primary btn-sm" onclick="getUrl('{{ $item->event_unique_code }}')" >getUrl</button></a>
                                    <input type="text" id="urlInput_{{ $item->event_unique_code }}" value="{{url('checkout', ['event_code' => $item->event_unique_code])}}" style="position: absolute; left: -9999px;">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @include('layouts.table-footer', ['linkData' => $events])
                    </table>
                 
                </div>      
            </div>
            </div>
</div>
</div>

 <script>
       function getUrl(eventUnCode) {
            var urlInput = document.getElementById("urlInput_" + eventUnCode);
            urlInput.select();
            urlInput.setSelectionRange(0, 99999); 
            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successfully Copied' : 'unsuccessful';
                alert(msg);
            } catch (err) {
                console.error('Unable to copy', err);
            }
        }



 </script>



@endsection