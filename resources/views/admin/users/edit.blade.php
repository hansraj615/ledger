@extends('adminlte::page')

@section('title', 'Edit User Details')

@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New User</div>
                    <div class="panel-body">
                        <a href="{{ route('user.index') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @include('admin.alertMessage')
                        {!! Form::open(['route' => ['user.update', $user->id], 'class' => 'form-horizontal','method'=>'POST','id'=>'usernRegistrationForm']) !!}

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            <label for="username" class = 'col-md-4 control-label'>Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" id="username" value="{{$user->name}}">
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            <label for="email" class = 'col-md-4 control-label'>Email</label>
                            <div class="col-md-6">
                            <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}">
                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('company') ? 'has-error' : ''}}">
                            <label for="company" class = 'col-md-4 control-label'>Company</label>
                            <div class="col-md-6">
                                <select class="selectpicker form-control company-select2 select2" name="company" id="company">
                                    <option value="" class="text-blue">Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}" @if($company->id==$user->usercompany->company->id) selected @endif>{{$company->name}}</option>
                                @endforeach
                                </select>
                                {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('subcompany') ? 'has-error' : ''}}">
                            <label for="subcompany" class = 'col-md-4 control-label'>Sub-Company</label>
                            <div class="col-md-6">
                                <select class="selectpicker form-control subcompany-select2" name="subcompany" id="subcompany">
                                    @if($user->usercompany->company->id)
                                <option value ="{{$user->usersubcompany->subcompany->id}}"@if($user->usersubcompany->subcompany->id) selected @endif>{{$user->usersubcompany->subcompany->name}}</option>
                                    @endif
                                </select>
                                {!! $errors->first('subcompany', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
                            <label for="subcompany" class = 'col-md-4 control-label'>Assign Role</label>
                            <div class="col-md-6">
                                <select class="selectpicker form-control select2" name="role[]" id="role" multiple>
                                    <option value="" class="text-blue" disabled>Select Role</option>
                                    @foreach($roles as $key=> $role)
                                    <option value="{{$key}}" @foreach($user->roles as $rolecheck) @if($rolecheck->role_id == $key) selected @endif @endforeach>{{$role}}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
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

              //Initialize Select2 Elements
              $('.company-select2').bind('load change', function () {
                $("#subcompany").val('');
                let param_new = $( ".company-select2" ).val();
                var param_company = "?company_id="+param_new;
                $(".subcompany-select2").select2({
                ajax: {
                    url: function (param) {
                        return "{{route('admin.search-subcompany').'/'}}" + param.term + param_company;
                    },
                    dataType: 'json',
                    delay: 250,
                    data: function (param) {
                        return {q: param.term, };
                    },
                    processResults: function (data, param) {
                        return {results: data};
                    },
                    cache: true
                },
                // minimumInputLength: 3,
            });
        });
              $('.select2').select2()

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
