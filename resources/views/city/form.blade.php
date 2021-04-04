@extends('layout')
@section('title', 'Bimcab')

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> @if(!empty($city)) Edit City @else Create City @endif </h1>
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
        <div class="card">
            <div class="card-header">
                <a href="{{ route('city_index') }}" class="btn btn-success" style="float: right;">List</a>
            </div>
            <div class="card-body">
                    @if(!empty($city))
                        {{ Form::model($city, ['route' => ['city_update', $city->id], 'method' => 'patch','enctype'=>'multipart/form-data','class'=>'form-horizontal']) }}
                    @else
                        {{ Form::open(['route' => 'city_store','class'=>'form-horizontal','enctype'=>'multipart/form-data']) }}
                    @endif

                    <div class="card-body">
                        <div class="form-group row {{ $errors->has('country_id') ? 'has-error' : ''}}">
                            <label for="countryId" class="col-sm-3 col-form-label">Country</label>
                            <div class="col-sm-4">
                                {!! Form::select('country_id',[""=>"Select Country"]+$countries, null, ['class' => 'form-control','id'=>'countryId','data-url'=>route('get-state')]) !!}
                                {!! $errors->first('country_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('state_id') ? 'has-error' : ''}}">
                            <label for="stateId" class="col-sm-3 col-form-label">State</label>
                            <div class="col-sm-4">
                                {!! Form::select('state_id',[""=>"Select State"]+$state, null, ['class' => 'form-control','id'=>'stateId']) !!}
                                {!! $errors->first('state_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>                        
                        <div class="form-group row {{ $errors->has('name') ? 'has-error' : ''}}">
                            <label for="stateName" class="col-sm-3 col-form-label">City Name</label>
                            <div class="col-sm-4">
                                {!! Form::text('name', null, ['class' => 'form-control','id'=>'stateName','placeholder'=>'City Name']) !!}
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

$('#countryId').change(function() {
    var countryId = $(this).val();
    var url = $(this).attr('data-url');
    $('#stateId').find('option').not(':first').remove();
    if (countryId != "" && url != undefined) {
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                countryId: countryId
            },
            dataType: 'json',
            success: function(data) {
                if (data['state'] != "") {
                    var stateOpt = $('<option />');
                    stateOpt.val('');
                    stateOpt.text('Select State');
                    $.each(data['state'], function(subSubKey, subSubValue) {
                        var stateOpt = $('<option />');
                        stateOpt.val(subSubValue);
                        stateOpt.text(subSubKey);
                        $('#stateId').append(stateOpt);
                    });
                }
            }
        });
    }
});
</script>

@endsection