@extends('layout')
@section('title', 'Bimcab')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>City</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">City</li>
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
            	<a href="{{ route('city_create')}}" class="btn btn-success" style="float: right;">Add New</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="city_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>City Name</th>
                            <th width="50">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!$cities->isEmpty())
                            @foreach($cities as $key => $city)
                            <tr>
                                <td> {{ $city->id }}</td>
                                <td> {{ @$city->country->name }}</td>
                                <td> {{ @$city->state->name }}</td>
                                <td> {{ $city->name }}</td>
                                <td>
                                    <a href="{{ route('city_edit',$city->id) }}" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-success btn-xs">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                    <button data-href="{{ route('city_delete',$city->id) }}" data-original-title="Delete" class="delete btn btn-danger btn-xs delete-record">
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
    $('#city_datatable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        columnDefs: [
            { 
                targets: 3,
                orderable: false
            }
        ]
    });
    $('.delete-record').on('click',function() {
        var dataUrl = $(this).data('href');
        var token   = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Are you sure want to delete city ?",
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
                        swal("Deleted!", "Your city has been deleted.", "success");
                        window.location.reload();
                    }
                });
            }
        });
    });
    $("#module").removeClass("menu-close");
    $("#module").addClass("menu-open");
    $("#city-module").addClass("active");
});

</script>

@endsection