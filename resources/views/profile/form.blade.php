@extends('layout')
@section('title', 'Bimcab')

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> Profile Update </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Profile</li>
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
            <div class="card-body">
                    <?php $user = auth()->user(); ?>
                    {{ Form::model($user, ['route' => ['profile_update', $user->id], 'method' => 'POST','enctype'=>'multipart/form-data','class'=>'form-horizontal']) }}                    

                    <div class="card-body">
                        <div class="form-group row {{ $errors->has('name') ? 'has-error' : ''}}">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-4">
                                {!! Form::text('name', null, ['class' => 'form-control','id'=>'name','placeholder'=>'Name']) !!}
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('email') ? 'has-error' : ''}}">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-4">
                                {!! Form::text('email', null, ['class' => 'form-control','id'=>'email','placeholder'=>'Email']) !!}
                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
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
                        <div class="form-group row {{ $errors->has('profile_image') ? 'has-error' : ''}}">
                            <label for="exampleInputFile" class="col-sm-3 col-form-label">Image</label>
                            <div class="input-group col-sm-4">
                                <div class="custom-file">
                                    <input type="file" name="profile_image" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                {!! $errors->first('profile_image', '<p class="help-block">:message</p>') !!}
                            </div>
                            @if (!empty(auth()->user()->profile_image))
                                <img src="{{asset('/user-image/'.auth()->user()->profile_image)}}" height="40" width="50">
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
</script>
@endsection