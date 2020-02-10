@extends('adminlte::page')

@section('title', 'Create Client Mapping')
@push('css')

@endpush
@section('content')

<section>
      <!-- Main content -->
      <section class="content">
        <!-- /.box -->
            <div class="box box-danger">
              <div class="box-header">
                <h3 class="box-title">Create Client Mapping</h3>
              </div>
              <div class="box-body">
                <a href="{{ route('admin.clientmapping.index') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a><br><br>
                <div class="row">
                <form class="form" action="{{route('admin.clientmapping.store')}}" method="POST">
                        {{csrf_field()}}
                    <div class="col-md-12">
                        <div class="col-lg-3">

                            <div class="form-group">
                              <label for="name">SubCompany Name</label>
                              {{-- <input type="text" name="name" id="companyname" class="form-control" placeholder="" aria-describedby="helpId"> --}}
                              <select name="subcompanyname" class="form-control select2" id="" data-placeholder="Select Subcompany">
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
                        <select name="clientname[]" class="form-control SumoSelect" id="clientname" data-placeholder="Select Client"multiple>

                          @foreach($clients as $key=>$value)
                          <option value="{{$value->id}}">{{$value->name}}</option>
                          @endforeach
                        </select>
                        <small id="helpId" class="text-muted">Help text</small>
                      </div>
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
{!! Html::style('vendor/vendor/sumoselect/sumoselect.css') !!}
<link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/sumoselect/sumoselect.css') }}">

<script src="{{asset('vendor/vendor/sumoselect/jquery.sumoselect.js')}}"></script>
{!! Html::script('vendor/adminlte/vendor/sumoselect/jquery.sumoselect.js') !!}
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

  </script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    $('.SumoSelect').SumoSelect({search: true, searchText: 'Enter here.'});
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
