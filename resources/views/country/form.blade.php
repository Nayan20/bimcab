@extends('layout')
@section('title', 'Bimcab')

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> @if(!empty($country)) Edit Country @else Create Country @endif </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Country</li>
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
                <a href="{{ route('country_index') }}" class="btn btn-success" style="float: right;">List</a>
            </div>
            <div class="card-body">
                    @if(!empty($country))
                        {{ Form::model($country, ['route' => ['country_update', $country->id], 'method' => 'patch','enctype'=>'multipart/form-data','class'=>'form-horizontal']) }}
                    @else
                        {{ Form::open(['route' => 'country_store','class'=>'form-horizontal','enctype'=>'multipart/form-data']) }}
                    @endif

                    <div class="card-body">
                        <div class="form-group row {{ $errors->has('name') ? 'has-error' : ''}}">
                            <label for="countryName" class="col-sm-3 col-form-label">Country Name</label>
                            <div class="col-sm-4">
                                {!! Form::text('name', null, ['class' => 'form-control','id'=>'countryName','placeholder'=>'Country Name']) !!}
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
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
    $("#country-module").addClass("active");
});
</script>

@endsection