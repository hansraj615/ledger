@extends('adminlte::page')

@section('title', 'Edit Permission')

@section('content')
<section>
    <section class="content-header">
        <div class="header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h1>Edit Permission</h1>
                        <h2>Please edit the form below then update.</h2>
                    </div>
                    <div class="float-right">
                        <a href="{{route('permissions.index')}}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content-header">
        <h1>
          Data Tables
          <small>advanced tables</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Tables</a></li>
          <li class="active">Data tables</li>
        </ol>
      </section>
      <section class="content">
        <div class="box box-danger">
          <div class="box-header">
            <h3 class="box-title">Input masks</h3>
          </div>
          <div class="box-body">
            <div class="row">

                <div class="centered col-md-12 col-md-offset-4">
        {!! Form::model($permission,array('route' => ['permissions.update', $permission->id], 'class' => 'form-horizontal','method'=>'PATCH','enctype' => 'multipart/form-data','id'=>'permissionUpdateForm')) !!}
        <div class="patient-form-section">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                        {!! Html::decode(Form::label('name', 'Name <span class="required">*</span>', ['class' => 'control-label'])) !!}
                                        <div>
                                            {!! Form::text('name', null, ['class' => 'form-control','maxlength'=>'255', 'readonly']) !!}
                                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('display_name') ? 'has-error' : ''}}">
                                        {!! Html::decode(Form::label('display_name','Display Name <span class="required">*</span>', ['class' => ' control-label'])) !!}
                                        <div>
                                            {!! Form::text('display_name', null, ['class' => 'form-control','maxlength'=>'128',"placeholder" => "Display Name"]) !!}
                                            {!! $errors->first('display_name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                        {!! Html::decode(Form::label('description', 'Description <span class="required">*</span>', ['class' => 'control-label'])) !!}
                                        <div>
                                            {!! Form::textarea('description', null, ['class' => 'form-control','maxlength'=>'2048']) !!}
                                            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <div class="form-button-container text-center mt-4 mb-4">
            <!-- <a href="#" class="btn btn-default">Cancel</a> -->
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
        <div class="form-note">
            <label class="text-primary">Note:</label>
            <label class="text-grey"><span class="text-danger">*</span>Marked fields are required.</label>
        </div>
        {!! Form::close() !!}
    </div>
    </section>
</section>
@endsection
@push('js')

    {{--{!! Html::script('vendor/select2/dist/js/select2.min.js') !!}--}}
    {!! Html::script('js/bootstrap3-wysihtml5.all.min.js') !!}
    {!! Html::style('vendor/formvalidation/css/formValidation.min.css') !!}
    {!! Html::script('vendor/formvalidation/js/formValidation.min.js') !!}
    {!! Html::script('vendor/formvalidation/js/framework/bootstrap.min.js') !!}

    <script>

        $(document).ready(function() {
//            $(".select2").select2();
           // $('.SumoSelect').SumoSelect({search: true, searchText: 'Enter here.'});
        });

        $('#permissionUpdateForm')
            .formValidation({
                framework: 'bootstrap',
                excluded: ':disabled',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    display_name: {
                        validators: {
                            stringLength: {
                                min: 3,
                                max: 128,
                                message: 'Display name must be minimum 3 and maximum 128 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z ]+$/,
                                message: 'Display name can only consist of alphabets'
                            }
                        }
                    },
                    description: {
                        validators: {
                            stringLength: {
                                min: 3,
                                max: 1024,
                                message: 'Description must be minimum 3 characters and maximum 1024 characters long'
                            }
                        }
                    },
                    /* 'permissions[]' : {
                     validators : {
                     file: {
                     extension: 'pdf',
                     type: 'application/pdf',
                     maxSize: 2097152, // 2048 * 1024
                     message: 'Selected file type is not valid'
                     }
                     }
                     },*/
                }
            });
    </script>
@endpush
@yield('js')
