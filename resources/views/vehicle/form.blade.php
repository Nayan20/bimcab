@extends('layout')
@section('title', 'Bimcab')

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> @if(!empty($vehicle)) Edit Vehicle @else Create Vehicle @endif </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Vehicle</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('vehicle_index') }}" class="btn btn-success" style="float: right;">List</a>
            </div>
            <div class="card-body">
                    @if(!empty($vehicle))
                        {{ Form::model($vehicle, ['route' => ['vehicle_update', $vehicle->id], 'method' => 'patch','enctype'=>'multipart/form-data','class'=>'form-horizontal']) }}
                    @else
                        {{ Form::open(['route' => 'vehicle_store','class'=>'form-horizontal','enctype'=>'multipart/form-data']) }}
                    @endif

                    <div class="card-body">
                        
                        <div class="form-group row {{ $errors->has('name') ? 'has-error' : ''}}">
                            <label for="vehicleName" class="col-sm-3 col-form-label">Vehicle Name</label>
                            <div class="col-sm-4">
                                {!! Form::text('name', null, ['class' => 'form-control','id'=>'vehicleName','placeholder'=>'Vehicle Name']) !!}
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('cost') ? 'has-error' : ''}}">
                            <label for="cost" class="col-sm-3 col-form-label">Cost Per Km</label>
                            <div class="col-sm-4">
                                {!! Form::number('cost', null, ['class' => 'form-control','id'=>'cost','placeholder'=>'Cost Per Km']) !!}
                                {!! $errors->first('cost', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('image') ? 'has-error' : ''}}">
                            <label for="exampleInputFile" class="col-sm-3 col-form-label">Image</label>
                            <div class="input-group col-sm-4">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                            </div>
                            @if (!empty($vehicle->image))
                                <img src="{{asset('/vehicle-image/'.$vehicle->image)}}" height="40" width="50">                                
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
          </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function() {
    $("#module").removeClass("menu-close");
    $("#module").addClass("menu-open");
    $("#vehicle-module").addClass("active");
});
</script>
@endsection