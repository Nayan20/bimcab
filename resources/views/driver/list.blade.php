@extends('layout')
@section('title', 'Bimcab')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{$title}}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @if (\Session::get('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ \Session::get('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List</h3>
            	<a href="{{ route('driver_create')}}" class="btn btn-success" style="float: right;">Add New</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="driver_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Online/Offline</th>
                            <th>Status</th>
                            <th width="50">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!$drivers->isEmpty())
                            @foreach($drivers as $key => $driver)
                            <tr>
                                <td> {{ $driver->id }}</td>
                                <td> {{ $driver->first_name }}</td>
                                <td> {{ $driver->last_name }}</td>
                                <td> {{ $driver->email }}</td>
                                <td> {{ $driver->contact_number }}</td>
                                <td> {!! ($driver->is_online == 1) ? '<div class="driver-online-status offline">Offline</div>' : '<div class="driver-online-status online">Online</div>' !!}</td>
                                <td>
                                    @if($driver->status == 1)
                                        <button type="button" data-href="{{ route('driver-status-change',$driver->id) }}" class="form-control btn-success driver-status" data-status="1" style="width: 86px">Approved</button>
                                    @else
                                        <button type="button" data-href="{{ route('driver-status-change',$driver->id) }}" class="form-control btn-warning driver-status" data-status="0" style="width: 86px">Pending</button>
                                    @endif
                                </td>                                
                                <td>
                                    <a href="{{ route('driver_edit',$driver->id) }}" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-success btn-xs">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                    <button data-href="{{ route('driver_delete',$driver->id) }}" data-original-title="Delete" class="delete btn btn-danger btn-xs delete-record">
                                        <span class="ion-trash-a"></span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>

<script>
$(document).ready(function() {
    $('#driver_datatable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        columnDefs: [
            { 
                targets: 7,
                orderable: false
            }
        ]
    });
    $('.delete-record').on('click',function() {
        var dataUrl = $(this).data('href');
        var token   = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Are you sure want to delete driver ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: dataUrl,
                    data: { _token: token },
                    global:false,
                    success: function (data) {
                        swal("Deleted!", "Your driver has been deleted.", "success");
                        window.location.reload();
                    }
                });
            }
        });
    });

    $('.driver-status').on('click',function() {
        var dataUrl = $(this).data('href');
        var token   = $('meta[name="csrf-token"]').attr('content');
        var status  = $(this).attr('data-status');
        swal({
            title: "Are you sure want to change status ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: dataUrl,
                    data: { _token: token, status:status },
                    global:false,
                    success: function (data) {
                        swal("Changed!", "status has been deleted.", "success");
                        window.location.reload();                        
                    }
                });
            }
        });
    });
    $("#module").removeClass("menu-close");
    $("#module").addClass("menu-open");
    $("#driver-module").addClass("active");
});

</script>

@endsection