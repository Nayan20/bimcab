@extends('layout')
@section('title', 'Bimcab')

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> @if(!empty($driver)) Edit Driver @else Create Driver @endif </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Driver</li>
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
                <a href="{{ route('driver_index') }}" class="btn btn-success" style="float: right;">List</a>
            </div>
            <div class="card-body">
                    @if(!empty($driver))
                        {{ Form::model($driver, ['route' => ['driver_update', $driver->id], 'method' => 'patch','enctype'=>'multipart/form-data','class'=>'form-horizontal']) }}
                    @else
                        {{ Form::open(['route' => 'driver_store','class'=>'form-horizontal','enctype'=>'multipart/form-data']) }}
                    @endif

                    <div class="card-body">
                        <div class="form-group row {{ $errors->has('first_name') ? 'has-error' : ''}}">
                            <label for="firstName" class="col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-4">
                                {!! Form::text('first_name', null, ['class' => 'form-control','id'=>'firstName','placeholder'=>'First Name']) !!}
                                {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('last_name') ? 'has-error' : ''}}">
                            <label for="lastName" class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-4">
                                {!! Form::text('last_name', null, ['class' => 'form-control','id'=>'lastName','placeholder'=>'Last Name']) !!}
                                {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('password') ? 'has-error' : ''}}">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-4">
                                {!! Form::password('password',['class' => 'form-control','id'=>'password','placeholder'=>'Password','autocomplete'=>'off']) !!}
                                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
                            <label for="confirmPassword" class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-4">
                                {!! Form::password('password_confirmation',['class' => 'form-control','id'=>'confirmPassword','placeholder'=>'Confirm Password','autocomplete'=>'off']) !!}
                                {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('contact_number') ? 'has-error' : ''}}">
                            <label for="contactNumber" class="col-sm-3 col-form-label">Contact Number</label>
                            <div class="col-sm-4">
                                {!! Form::text('contact_number',null,['class' => 'form-control','id'=>'contactNumber','placeholder'=>'Contact Number']) !!}
                                {!! $errors->first('contact_number', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>                        
                        <div class="form-group row {{ $errors->has('email') ? 'has-error' : ''}}">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-4">
                                {!! Form::text('email', null, ['class' => 'form-control','id'=>'email','placeholder'=>'Email']) !!}
                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
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
                                {!! Form::select('state_id',[""=>"Select State"]+$state, !empty(old('state_id')) ? old('state_id') : null, ['class' => 'form-control','id'=>'stateId','data-url'=>route('get-cities')]) !!}
                                {!! $errors->first('state_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('city_id') ? 'has-error' : ''}}">
                            <label for="cityId" class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-4">
                                {!! Form::select('city_id',[""=>"Select City"]+$cities, null, ['class' => 'form-control','id'=>'cityId']) !!}
                                {!! $errors->first('city_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('address') ? 'has-error' : ''}}">
                            <label for="address" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-4">
                                {!! Form::textarea('address',null, ['class' => 'form-control','id'=>'address','rows'=>3]) !!}
                                {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('vehicle_type') ? 'has-error' : ''}}">
                            <label for="vehicle_type" class="col-sm-3 col-form-label">Vehicle Type</label>
                            <div class="col-sm-4">
                                {!! Form::select('vehicle_type',[""=>"Select Vehicle"]+$vehicles,null, ['class' => 'form-control','id'=>'vehicle_type','rows'=>3]) !!}
                                {!! $errors->first('vehicle_type', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('driver_commission') ? 'has-error' : ''}}">
                            <label for="driverCommission" class="col-sm-3 col-form-label">Driver Commission (in %)</label>
                            <div class="col-sm-4">
                                {!! Form::number('driver_commission', null, ['class' => 'form-control','id'=>'driverCommission','placeholder'=>'Driver Commission (in %)']) !!}
                                {!! $errors->first('driver_commission', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('account_holder_name') ? 'has-error' : ''}}">
                            <label for="driverCommission" class="col-sm-3 col-form-label">Account Holder Name</label>
                            <div class="col-sm-4">
                                {!! Form::text('account_holder_name', null, ['class' => 'form-control','id'=>'driverCommission','placeholder'=>'Account Holder Name']) !!}
                                {!! $errors->first('account_holder_name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('account_number') ? 'has-error' : ''}}">
                            <label for="driverCommission" class="col-sm-3 col-form-label">Account Number</label>
                            <div class="col-sm-4">
                                {!! Form::text('account_number', null, ['class' => 'form-control','id'=>'driverCommission','placeholder'=>'Account Number']) !!}
                                {!! $errors->first('account_number', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('bank_name') ? 'has-error' : ''}}">
                            <label for="driverCommission" class="col-sm-3 col-form-label">Bank Name</label>
                            <div class="col-sm-4">
                                {!! Form::text('bank_name', null, ['class' => 'form-control','id'=>'driverCommission','placeholder'=>'Bank Name']) !!}
                                {!! $errors->first('bank_name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('bank_location') ? 'has-error' : ''}}">
                            <label for="driverCommission" class="col-sm-3 col-form-label">Bank Location</label>
                            <div class="col-sm-4">
                                {!! Form::text('bank_location', null, ['class' => 'form-control','id'=>'driverCommission','placeholder'=>'Bank Location']) !!}
                                {!! $errors->first('bank_location', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('bic_swift_code') ? 'has-error' : ''}}">
                            <label for="driverCommission" class="col-sm-3 col-form-label">BIC/SWIFT Code</label>
                            <div class="col-sm-4">
                                {!! Form::text('bic_swift_code', null, ['class' => 'form-control','id'=>'driverCommission','placeholder'=>'BIC/SWIFT Code']) !!}
                                {!! $errors->first('bic_swift_code', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('payment_email') ? 'has-error' : ''}}">
                            <label for="driverCommission" class="col-sm-3 col-form-label">Payment Email</label>
                            <div class="col-sm-4">
                                {!! Form::text('payment_email', null, ['class' => 'form-control','id'=>'driverCommission','placeholder'=>'Payment Email']) !!}
                                {!! $errors->first('payment_email', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('profile_image') ? 'has-error' : ''}}">
                            <label for="exampleInputFile" class="col-sm-3 col-form-label">Image</label>
                            <div class="input-group col-sm-4">
                                <div class="custom-file">
                                    <input type="file" name="profile_image" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                {!! $errors->first('profile_image', '<p class="help-block">:message</p>') !!}
                            </div>
                            @if (!empty($driver->profile_image))
                                <img src="{{asset('/driver-image/'.$driver->profile_image)}}" height="40" width="50">                                
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
    $("#driver-module").addClass("active");
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
$('#stateId').change(function() {
    var stateId = $(this).val();
    var url = $(this).attr('data-url');
    $('#cityId').find('option').not(':first').remove();
    if (stateId != "" && url != undefined) {
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                stateId: stateId
            },
            dataType: 'json',
            success: function(data) {
                if (data['cities'] != "") {
                    var cityOpt = $('<option />');
                    cityOpt.val('');
                    cityOpt.text('Select City');
                    $.each(data['cities'], function(subSubKey, subSubValue) {
                        var cityOpt = $('<option />');
                        cityOpt.val(subSubValue);
                        cityOpt.text(subSubKey);
                        $('#cityId').append(cityOpt);
                    });
                }
            }
        });
    }
});
</script>

@endsection