@extends('adminlte::page')

@section('title', 'Create Ledger Entry')
@push('css')

@endpush
@section('content')

<section>

    <!-- Content Header (Page header) -->
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

    <!-- Main content -->
    <section class="content-header">
        <h1>
          Advanced Form Elements
          <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Forms</a></li>
          <li class="active">Advanced Elements</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">


        <!-- /.box -->
            <div class="box box-danger">
              <div class="box-header">
                <h3 class="box-title">Input masks</h3>
              </div>
              <div class="box-body">
                <div class="row">
                <form class="form" action="{{route('admin.ledger.store')}}" method="POST">
                        {{csrf_field()}}
                    <div class="col-md-12">
                        <div class="col-lg-3">

                            <div class="form-group">
                              <label for="name">SubCompany Name</label>
                              {{-- <input type="text" name="name" id="companyname" class="form-control" placeholder="" aria-describedby="helpId"> --}}
                              <select name="subcompanyname" class="form-control select2" id="">
                                <option value=""></option>
                                @foreach($subcompanies as $key=>$value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                              </select>
                              <small id="helpId" class="text-muted">Help text</small>
                            </div>
                          </div>
                  <div class="col-lg-3">

                    <div class="form-group">
                        <label for="name">Client Name</label>
                        {{-- <input type="text" name="name" id="companyname" class="form-control" placeholder="" aria-describedby="helpId"> --}}
                        <select name="clientname" class="form-control select2" id="">
                          <option value=""></option>
                          @foreach($clients as $key=>$value)
                          <option value="{{$value->id}}">{{$value->name}}</option>
                          @endforeach
                        </select>
                        <small id="helpId" class="text-muted">Help text</small>
                      </div>
                  </div>
                <div class="col-md-3">
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                    <label for="name">Amount Type</label>
                    {{-- <input type="text" name="name" id="companyname" class="form-control" placeholder="" aria-describedby="helpId"> --}}
                    <select name="amounttype" class="form-control select2" id="">
                      <option value=""></option>
                      @foreach(config('constant.amount_type') as $key => $value)
                      <option value="{{$key}}">{{$value}}</option>
                      @endforeach
                    </select>
                    <small id="helpId" class="text-muted">Help text</small>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>
            <div class="col-md-3">
                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                      <label>Amount:</label>

                      <div class="input-group">
                        
                        <input type="text" name="amount" id="amount" class="form-control" >
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>
            </div>
           
                <button type="submit" class="btn btn-success center-block">Submit</button>
            </form>
            </div>

              </div>
              <!-- /.box-body -->
            <!-- /.box -->
          <!-- /.col (right) -->
        </div>

    </div>
        <!-- /.row -->

      </section>
      <!-- /.content -->
    <!-- /.content -->
</section>
@endsection

@push('js')
<script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
    $(document).ready(function () {
      $(".country-select2").select2({
        ajax: {
            url: function (params) {
                return "{{route('admin.search-country').'/'}}" + params.term;
            },
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {q: params.term, };
            },
            processResults: function (data, params) {
                return {results: data};
            },
            cache: true
        },
        minimumInputLength: 3,
    });


    $( ".country-select2" ) .change(function () {
        $("#state_name").val('');
        $("#city_name").val('');
        let param_new = $(this).val();
        var param_country = "?country_id="+param_new;
        $(".state-select2").select2({
        ajax: {
            url: function (param) {
                return "{{route('admin.search-state').'/'}}" + param.term + param_country;
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

    $( ".state-select2" ) .change(function () {
        $("#city_name").val('');
        let param_new = $(this).val();
        var param_state = "?state_id="+param_new;
        $(".city-select2").select2({
        ajax: {
            url: function (param) {
                return "{{route('admin.search-city').'/'}}" + param.term + param_state;
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
    })
  </script>
  <script>
    $(function () {

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()

    })
  </script>


@endpush
@yield('js')