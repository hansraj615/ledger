@extends('adminlte::page')

@section('title', 'Create New Permission')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Permission</div>
                    <div class="panel-body">
                        <a href="{{ route('permissions.index') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @include('admin.alertMessage')

                        {!! Form::open(['route' => 'permissions.store', 'class' => 'form-horizontal','method'=>'POST','id'=>'permissionRegistrationForm']) !!}

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('name', null, ['class' => 'form-control','maxlength'=>'255']) !!}
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div><div class="form-group {{ $errors->has('display_name') ? 'has-error' : ''}}">
                            {!! Form::label('display_name', 'Display Name', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('display_name', null, ['class' => 'form-control','maxlength'=>'255']) !!}
                                {!! $errors->first('display_name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div><div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                            {!! Form::label('description', 'Description', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::textarea('description', null, ['class' => 'form-control','maxlength'=>'2048']) !!}
                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-success">Register</button>
                        </div>


                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\Admin\Permission\CreatePermissionRequest', '#permissionRegistrationForm') !!}
@endsection
