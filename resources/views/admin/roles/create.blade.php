@extends('adminlte::page')

@section('title', 'Roles')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Role</div>
                    <div class="panel-body">
                        <a href="{{ route('roles.index') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @include('admin.alertMessage')

                        {!! Form::open(['route' => 'roles.store', 'class' => 'form-horizontal','method'=>'POST','id'=>'roleRegistrationForm']) !!}

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            {!! Html::decode(Form::label('name', 'Name <span class="required">*</span>', ['class' => 'col-md-4 control-label'])) !!}
                            <div class="col-md-6">
                                {!! Form::text('name', null, ['class' => 'form-control','maxlength'=>'255']) !!}
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('display_name') ? 'has-error' : ''}}">
                            {!! Html::decode(Form::label('display_name', 'Display Name <span class="required">*</span>', ['class' => 'col-md-4 control-label'])) !!}
                            <div class="col-md-6">
                                {!! Form::text('display_name', null, ['class' => 'form-control','maxlength'=>'255']) !!}
                                {!! $errors->first('display_name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                            {!! Html::decode(Form::label('description', 'Description <span class="required">*</span>', ['class' => 'col-md-4 control-label'])) !!}
                            <div class="col-md-6">
                                {!! Form::textarea('description', null, ['class' => 'form-control','maxlength'=>'2048']) !!}
                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('permissions') ? 'has-error' : ''}}">
                            {!! Html::decode(Form::label('permissions','Permissions <span class="required">*</span>', ['class' => 'col-md-4 control-label'])) !!}
                            <div class="col-md-6">
                                {{Form::select('permissions',$permissions,null,array('multiple'=>'multiple','name'=>'permissions[]', 'class' => 'select2', 'style' => 'width: 100%'))}}
                                {!! $errors->first('permissions', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-success">Submit</button>
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

    {{-- {!! JsValidator::formRequest('App\Http\Requests\Role\CreateRoleClientRequest', '#roleRegistrationForm') !!} --}}
    {!! Html::style('vendor/select2/dist/css/select2.min.css') !!}

    {!! Html::script('vendor/select2/dist/js/select2.min.js') !!}

    <script>

        $(document).ready(function() {
            $(".select2").select2();
        });

    </script>
@endsection
