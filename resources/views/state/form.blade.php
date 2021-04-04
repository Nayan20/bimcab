@extends('layout')
@section('title', 'Bimcab')

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> @if(!empty($state)) Edit State @else Create State @endif </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">State</li>
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
                <a href="{{ route('state_index') }}" class="btn btn-success" style="float: right;">List</a>
            </div>
            <div class="card-body">
                    @if(!empty($state))
                        {{ Form::model($state, ['route' => ['state_update', $state->id], 'method' => 'patch','enctype'=>'multipart/form-data','class'=>'form-horizontal']) }}
                    @else
                        {{ Form::open(['route' => 'state_store','class'=>'form-horizontal','enctype'=>'multipart/form-data']) }}
                    @endif

                    <div class="card-body">
                        <div class="form-group row {{ $errors->has('country_id') ? 'has-error' : ''}}">
                            <label for="countryId" class="col-sm-3 col-form-label">Country</label>
                            <div class="col-sm-4">
                                {!! Form::select('country_id',[""=>"Select Country"]+$countries, null, ['class' => 'form-control','id'=>'countryId']) !!}
                                {!! $errors->first('country_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>                        
                        <div class="form-group row {{ $errors->has('name') ? 'has-error' : ''}}">
                            <label for="stateName" class="col-sm-3 col-form-label">State Name</label>
                            <div class="col-sm-4">
                                {!! Form::text('name', null, ['class' => 'form-control','id'=>'stateName','placeholder'=>'State Name']) !!}
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
    $("#state-module").addClass("active");
});
</script>

@endsection