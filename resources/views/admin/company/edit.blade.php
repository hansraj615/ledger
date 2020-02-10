@extends('adminlte::page')

@section('title', 'Edit Company')
@push('css')

@endpush
@section('content')

<section>
      <!-- Main content -->
      <section class="content">
            <div class="box box-danger">
              <div class="box-header">
                <h3 class="box-title">Edit Company</h3>
              </div>
              <div class="box-body">
                <a href="{{ route('company.index') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a><br><br>
                <div class="row">
                <form class="form" action="{{route('admin.company.store')}}" method="POST">
                        {{csrf_field()}}
                    <div class="col-md-12">
                  <div class="col-lg-4">

                    <div class="form-group">
                      <label for="name">Company Name</label>
                      <input type="text" name="name" id="name" value= "{{$companies->name}}" class="form-control" placeholder="" aria-describedby="helpId" autocomplete="off">
                      <small id="helpId" class="text-muted">Help text</small>
                    </div>
                  </div>
                <div class="col-md-4">
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                  <label>Mobile Number:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-mobile"></i>
                    </div>
                    <input type="text" id="mobile_number" name="mobile_number" class="form-control" value= "{{$companies->mobile_no}}" data-inputmask='"mask": "(+\\91) 999-9999999"' data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>
            <div class="col-md-4">
                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                      <label>Phone Number:</label>

                      <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" id="phone_number" name="phone_number" class="form-control" value= "{{$companies->phone_no}}" data-inputmask='"mask": "(099) 999-99999"' data-mask>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value= "{{$companies->email}}" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">Help text</small>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select id="country_name" class="selectpicker form-control country-select2"
                        data-show-subtext="true" name="country_name" data-live-search="true" title="">
                    </select>
                        <small id="helpId" class="text-muted">Help text</small>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="state">State</label>
                        <select id="state_name" class="selectpicker form-control state-select2"
                        data-show-subtext="true" name="state_name" data-live-search="true" title="">

                    </select>
                        <small id="helpId" class="text-muted">Help text</small>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="city">City</label>
                        <select id="city_name" class="selectpicker form-control city-select2"
                        data-show-subtext="true" name="city_name" data-live-search="true" title="">

                    </select>
                        <small id="helpId" class="text-muted">Help text</small>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="address">Address</label>
                    <input type="text" name="address" value="{{$companies->address}}" id="address" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">Help text</small>
                    </div>
                </div>
            <input type="hidden" name="edit" value="{{$companies->id}}">

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="pincode">Pincode</label>
                        <input type="text" name="pincode" value="{{$companies->pincode}}" id="pincode" class="form-control" placeholder="Enter Pincode" aria-describedby="helpId" autocomplete="off">
                        <small id="helpId" class="text-muted">Help text</small>
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
@if(!empty($companies))
<script>

     $(document).ready(function () {
        var country = "{{$companies->country}}";
        var country_name = "{{$companies->country_name}}";
        var state = "{{$companies->state}}";
        var state_name = "{{$companies->state_name}}";
        var city = "{{$companies->city}}";
        var city_name = "{{$companies->city_name}}";
        $('.country-select2').append("<option value="+country+" selected>"+country_name+"</option>").trigger('change');
        $('.state-select2').append("<option value="+state+" selected>"+state_name+"</option>").trigger('change');
        $('.city-select2').append("<option value="+city+" selected>"+city_name+"</option>").trigger('change');
     })
</script>
@endif
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
