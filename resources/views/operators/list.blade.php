@extends('layout')
@section('title', 'Bimcab')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Operator</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Operator</li>
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
            	<a href="{{ route('operator_create')}}" class="btn btn-success" style="float: right;">Add New</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="operator_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th width="50">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!$operators->isEmpty())
                            @foreach($operators as $key => $operator)
                            <tr>
                                <td> {{ $operator->id }}</td>
                                <td> {{ $operator->name }}</td>
                                <td> {{ $operator->email }}</td>
                                <td> {{ $operator->contact_number }}</td>
                                <td>
                                    @if($operator->is_active == 1)
                                        <button type="button" data-href="{{ route('operator-status-change',$operator->id) }}" class="form-control btn-success operator-status" data-status="1" style="width: 86px">Active</button>
                                    @else
                                        <button type="button" data-href="{{ route('operator-status-change',$operator->id) }}" class="form-control btn-warning operator-status" data-status="0" style="width: 86px">In-Active</button>
                                    @endif
                                </td>
                                <td> 
                                    @if(!empty($operator->profile_image))
                                        <img src="user-image/{{$operator->profile_image}}" height="50" width="50">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('operator_edit',$operator->id) }}" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-success btn-xs">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                    <button data-href="{{ route('operator_delete',$operator->id) }}" data-original-title="Delete" class="delete btn btn-danger btn-xs delete-record">
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
    $('#operator_datatable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        columnDefs: [
            { 
                targets: 6,
                orderable: false
            }
        ]
    });
    $('.delete-record').on('click',function() {
        var dataUrl = $(this).data('href');
        var token   = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Are you sure want to delete operator ?",
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
                        swal("Deleted!", "Your operator has been deleted.", "success");
                        window.location.reload();
                    }
                });
            }
        });
    });

    $('.operator-status').on('click',function() {
        var dataUrl = $(this).data('href');
        var token   = $('meta[name="csrf-token"]').attr('content');
        var is_active  = $(this).attr('data-status');
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
                    data: { _token: token, is_active:is_active },
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
    $("#operator-module").addClass("active");
});

</script>

@endsection