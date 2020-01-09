@extends('adminlte::page')

@section('title', 'Create New user')

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

                        {!! Form::open(['route' => 'user.store', 'class' => 'form-horizontal','method'=>'POST','id'=>'usernRegistrationForm']) !!}

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            <label for="username" class = 'col-md-4 control-label'>Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" id="username">
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            <label for="email" class = 'col-md-4 control-label'>Email</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" id="email">
                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('company') ? 'has-error' : ''}}">
                            <label for="company" class = 'col-md-4 control-label'>Company</label>
                            <div class="col-md-6">
                                <select class="selectpicker form-control company-select2 select2" name="company" id="company">
                                    <option value="" class="text-blue">Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                                </select>
                                {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('subcompany') ? 'has-error' : ''}}">
                            <label for="subcompany" class = 'col-md-4 control-label'>Sub-Company</label>
                            <div class="col-md-6">
                                <select class="selectpicker form-control subcompany-select2" name="subcompany" id="subcompany">
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
                                    <option value="{{$key}}">{{$role}}</option>
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
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\Permission\CreatePermissionRequest', '#permissionRegistrationForm') !!}

    <script>
            $(function () {
              //Initialize Select2 Elements
              $('.select2').select2()
              $( ".company-select2" ) .change(function () {
                $("#subcompany").val('');
                let param_new = $(this).val();
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

              //Datemask dd/mm/yyyy
              $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
              //Datemask2 mm/dd/yyyy
              $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
              //Money Euro
              $('[data-mask]').inputmask()

              //Date range picker
              $('#reservation').daterangepicker()
              //Date range picker with time picker
              $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
              //Date range as a button
              $('#daterange-btn').daterangepicker(
                {
                  ranges   : {
                    'Today'       : [moment(), moment()],
                    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                  },
                  startDate: moment().subtract(29, 'days'),
                  endDate  : moment()
                },
                function (start, end) {
                  $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
              )

              //Date picker
              $('#datepicker').datepicker({
                autoclose: true
              })

              //iCheck for checkbox and radio inputs
              $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
              })
              //Red color scheme for iCheck
              $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass   : 'iradio_minimal-red'
              })
              //Flat red color scheme for iCheck
              $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green'
              })

              //Colorpicker
              $('.my-colorpicker1').colorpicker()
              //color picker with addon
              $('.my-colorpicker2').colorpicker()

              //Timepicker
              $('.timepicker').timepicker({
                showInputs: false
              })
            })
          </script>
@endpush
@yield('js')
