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
                              <select name="subcompanyname" class="form-control subcompany-select2" id="subcompanyname">
                                <option value=""></option>
                                @foreach($subcompanies as $key=>$value)
                                <option value="{{$value->subcompany_id}}">{{$value->subcompany->name}}</option>
                                @endforeach
                              </select>
                              <small id="helpId" class="text-muted">Help text</small>
                            </div>
                          </div>
                  <div class="col-lg-3">

                    <div class="form-group">
                        <label for="name">Client Name</label>
                        {{-- <input type="text" name="name" id="companyname" class="form-control" placeholder="" aria-describedby="helpId"> --}}
                        <select name="clientname" class="form-control client-select2" id="clientname">
                          <option value=""></option>
                        </select>
                        <small id="helpId" class="text-muted">Help text</small>
                      </div>
                  </div>
                <div class="col-md-2">
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                    <label for="name">Amount Type</label>
                   
                </div>
                <div class="form-group">
                  
                 
                    @foreach(config('constant.amount_type') as $key => $value)
                    <input type="radio" name="amounttype" class="minimal" value="{{$key}}">{{$value}}
                    @endforeach
                 </div>
                <!-- /.form group -->
            </div>
            <div class="col-md-2">
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
                <div class="col-md-2">
                  <!-- Date dd/mm/yyyy -->
                  <div class="form-group">
                    <label>Description:</label>

                    <div class="input-group">
                      
                      <input type="text" name="description" id="description" class="form-control" >
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
    
    $( ".subcompany-select2" ) .change(function () {
        let param_new = $(this).val();
        console.log(param_new);
        // var subcompany_id = "?subcompany_id="+param_new;
        $(".client-select2").select2({
        ajax: {
            url: function (param) {
                return "{{route('ledger.search-client').'/'}}" +param_new ;
            },
            dataType: 'json',
            delay: 250,
            data: function (param) {
              console.log(param);
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

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
  </script>


@endpush
@yield('js')
