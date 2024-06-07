@extends('layouts.app')
@section("title","row List")
@section('content')
    <style>
        .pagination {
            float: right;
            margin-top: 10px;
        }
    </style>
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Push Notification List</h6>
                </div>
                <div class="float-right ps-4">
                    <a class="btn btn-secondary" href="{{ route('send-all-users.create') }}"><i class="fa fa-plus"></i> New</a>
                    <hr>
                    <input type="text" id="row_search" class="form-control" onkeyup="dataSearch()"
                        placeholder="Search Title.." title="Search">
                </div>
                @include('layouts.success')
                @include('layouts.error')
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover" width="100%" cellspacing="0" id="row_table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Type</th>
                                    <th>Title</th>
                                    <th>Message</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->type }}</td>
                                        <td>{{ $row->title }}</td>
                                        <td>{!! $row->body !!}</td>
                                        <td>{{ $row->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $data->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function dataSearch() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("row_search");
        filter = input.value.toUpperCase();
        table = document.getElementById("row_table");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>