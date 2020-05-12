@extends('adminlte::page')

@section('title', 'LedgerEntry')

@section('content')

    <!-- Main content -->
    <section class="content">
            <div class="ledger-list-view ledger-list-item ">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-2">
                        <div class="form-group">
                            <label>Date range button:</label>

                            <div class="input-group">
                              <button type="button" class="btn btn-default datefetch" id="daterange-btn">
                                <span>
                                  <i class="fa fa-calendar"></i> Date range picker
                                </span>
                                <i class="fa fa-caret-down"></i>
                              </button>
                            </div>
                          </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Amount Type</label>
                            <select class="form-control" id="amounttype" class="text-capitalize">
                                <option value="" class="text-purple">All</option>
                                @foreach(config('constant.amount_type') as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Payment Type</label>
                            <select class="form-control" id="paymenttype" class="text-capitalize">
                                <option value="" class="text-purple">All</option>
                                @foreach(config('constant.payment_type') as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Product</label>
                            <select class="form-control" id="product" class="text-capitalize">
                                <option value="" class="text-purple">All</option>
                                @foreach($products as $key => $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                </div>
            </div>
      <div class="row">

            <div class="col-lg-8">
                {{-- {{dd($getClientDetails)}} --}}
             {{-- {{ dd($clientdetails = \App\Traits\CommonTrait::getClientDetails($getClientDetails[0]->client_id))}} --}}
                <div class="ledger-list-view ledger-list-item ">
                        <h4 class="text-center">New Era</h4>
                                    <div class="fancy-collapse-panel">
                                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                            <div class="ajaxdata">
                                                @php $a = 0;  @endphp
                                                @foreach($getClientDetails['AS'] as $key=>$value)
                                                {{-- {{dd($value)}} --}}
                                                <div class="panel panel-default">
                                                    <div class="ledger-panel  bg-purple" role="tab" id="heading">
                                                        <h4 class="panel-title">
                                                            <a  class="text-left page-title btn-bg-accordion w-100 collapsed"
                                                            data-toggle="collapse" data-target="#collapse{{$a+1}}" role="button"
                                                            @if($a+1==1) aria-expanded="true" @else aria-expanded="false" @endif aria-controls="collapse{{$a+1}}">
                                                            <div class="row"> <div class="col-lg-12"><div class="col-lg-4 right"><span class="text-yellow">On : </span> {{date("j M Y", strtotime($value->created_date['created_at']))}} ( {{$value->created_date['created_at']}} )</div><div class="col-lg-1 right text-center">{{ ucfirst(config('constant.amount_type')[$value->created_date['amount_type']])}}</div><div class="col-lg-2 right text-center">{{ ucfirst(config('constant.payment_type')[$value->created_date['payment_type']])}}</div><div class="col-lg-2 right text-center">Rs. {{$value->total_amount}}</div></div></div>

                                                            </a>

                                                        </h4>
                                                    </div>
                                                   @php $clientdetails = \App\Traits\CommonTrait::getClientDetails($value->client_id);
                                                //    dd($value['prod']);

                                                   @endphp
                                                    <div id="collapse{{$a+1}}" class="collapse @if($a+1==1) show @endif" role="tabpanel" aria-labelledby="heading">
                                                        <div class="panel-body">
                                                           <div class="col-lg-12">
                                                            <div class="col-lg-6 right">
                                                                <div class="text-center">
                                                                <label for="" >Products</label>
                                                                <table class="table table-bordered table-striped example2" id="example2">
                                                                    <thead>
                                                                        <tr bgcolor="#7688a8">
                                                                            <td>Name</td>
                                                                            <td>Serial Number</td>
                                                                            <td>Price</td>
                                                                            <td>Quantity</td>
                                                                            <td>Amount</td>
                                                                        </tr>
                                                                    </thead>
                                                                @php
                                                                foreach ($value['prod'] as $key => $valueprod) {
                                                                    $productdetails = \App\Traits\CommonTrait::getProductDetails($valueprod->product_id);
                                                                @endphp
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>{{$productdetails->name}}</td>
                                                                            <td>{{$productdetails->serial_number}}</td>
                                                                            <td>{{$valueprod->price}}</td>
                                                                            <td>{{$valueprod->quantity}}</td>
                                                                            <td>{{$valueprod->amount}}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                    @php  }
                                                                @endphp
                                                                    </table>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 right">
                                                                <label for="">Transaction details</label>
                                                                <p>{{$clientdetails->name}}</p>
                                                                <label for="">Total Amount</label>
                                                                <p>{{$value->total_amount}}</p>
                                                                <label for="">Final Amount</label>
                                                                <p>{{$value->finalamount}}</p>
                                                            </div>

                                                            <div class="col-lg-2 right text-center">
                                                                <div class="form-group">
                                                                <a href="#" id ="" class="viewinvoice" data-id="{{$value->transation_id}}" data-toggle="tooltip" title="Send Invoice"><img src="/images/send_invoice.png" width="18%" alt="send invoice"></a>
                                                                </div>
                                                                <div class="form-group">
                                                                <a href="#" id ="" class="viewinvoice" data-id="{{$value->transation_id}}"><img src="/images/send_invoice.png" alt="" width="18%"></a>
                                                                </div>
                                                            </div>

                                                           </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php $a++; @endphp
                                                @endforeach

                                        </div>
                                        </div>
                                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ledger-list-view ledger-list-item ">
                    <h4 class="text-center">New Era</h4>
                </div>
            </div>
        </div>
      <!-- /.row -->
      <div class="modal " id="showinvoicemodel">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Invoice</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                    <div class="row">
                                        @include('admin.ledgerentry/invoice')
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal " id="showtransationmodel">
                <div class="modal-dialog modal-dialog-centered">
                    @include('admin.ledgerentry/transation')

                </div>
            </div>
    </section>
    <!-- /.content -->


@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<style>
.box-content {
    display: inline-block;
    padding: 10px;
}

.bottom {
    border-bottom: 1px solid #ccc;
}

.right {
    border-right: 1px solid #ccc;
}
.br-1-bottom {
    border-bottom: 1px solid #dbe5e8;
    height: auto;
}
.ledger-list-view, .ledger-list-item {
    padding: 1rem;
    background-color: #fffff;
    margin-bottom: 1.5rem;
    border: 1px solid #fffff;
    border-radius: 6px;
    box-shadow: 0px 3px 9px 0 rgba(0, 0, 0, 0.2), 0 6px 37px 0 rgba(0, 0, 0, 0.19);
}
.ledger-panel {
    padding: 1rem;
    background-color: #fffff;
    border: 1px solid #fffff;
    border-radius: 6px;
    box-shadow: 0px 3px 9px 0 rgba(0, 0, 0, 0.2), 0 6px 37px 0 rgba(0, 0, 0, 0.19);
}
.ledger-patient-image>img {
    border: 2px solid #e7ecea;
    width: 100%;
    max-height: 175px;
}
.mb-3 {
    margin-bottom: 1rem!important;
}

.ml-1 {
  margin-left: ($spacer * .25) !important;
}

.px-2 {
  padding-left: ($spacer * .5) !important;
  padding-right: ($spacer * .5) !important;
}

.p-3 {
  padding: $spacer !important;
}

.outline {
    background-color: transparent;
    color: inherit;
    transition: all .25s;
}
.btn-primary.outline {
    color: #428bca;
}
.btn-success.outline {
    color: #5cb85c;
}
.btn-info.outline {
    color: #5bc0de;
}
.btn-warning.outline {
    color: #f0ad4e;
}
.btn-danger.outline {
    color: #d9534f;
}
.btn-primary.outline:hover,
.btn-success.outline:hover,
.btn-info.outline:hover,
.btn-warning.outline:hover,
.btn-danger.outline:hover {
    color: #fff;
}
</style>
@endpush
@push('js')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
      $('.example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        "scrollX": true
      })
    })
  </script>
<script src="{{ asset('vendor/adminlte/vendor/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

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
      var start = moment().subtract(10, 'years');
      var end = moment();

    function cb(start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#daterange-btn').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);


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

      //Timepicker
      $('.timepicker').timepicker({
        showInputs: false
      })
    })
  </script>

  <script>
    $('#daterange-btn, #paymenttype, #amounttype,#product').on('apply.daterangepicker change', function(ev, picker) {
        var displaydata = "";
        var direct_daterange  = $('#daterange-btn span').html().trim();
        var direct_daterange_split = direct_daterange.split('-');
        $( ".ajaxdata" ).html('');
        if(picker){
        var startdatepicker = picker.startDate._d;
        var enddatepicker = picker.endDate._d;
        }
        if(startdatepicker == '')
        {
            startdatepicker = startdatepicker;
        }else{
            startdatepicker = direct_daterange_split[0].trim();
        }
        if(enddatepicker == '')
        {
            enddatepicker = enddatepicker;
        }else{
            enddatepicker = direct_daterange_split[1].trim();
        }
        var startDate = moment(startdatepicker).format('YYYY-MM-DD');
        var endDate = moment(enddatepicker).format('YYYY-MM-DD');
        var payment_type_fetch = $('#paymenttype').val();
        var amount_type_fetch = $('#amounttype').val();
        var producte_fetch = $('#product').val();
        var client_id = "{{$getClientDetails['AS'][0]->client_id}}";
        var amount_type_constant = {!! json_encode(config('constant.amount_type')) !!};
        var payment_type_constant = {!! json_encode(config('constant.payment_type')) !!};
        $.ajax({
                type: "POST",
                url: "{{ route('ledger.viewdetailsajax') }}",
                data: {'client_id':client_id,'amount_type':amount_type_fetch,'payment_type':payment_type_fetch,'product':producte_fetch,'startDate':startDate, 'endDate':endDate,'_token':"{{ csrf_token() }}" },
                success: function(data)
                {
                    // console.log(data.created_date.amount_type);
                    if(data.length!=0) {
                        var current = 0;
                        var arrial_cond = '';
                        var show_expand = '';
                        $.each( data, function( key, value ) {
                        var arrial_expand_true = 'aria-expanded="true"';
                        var arrial_expand_false = 'aria-expanded="false"';
                        if(parseFloat(current+1)==1){ arrial_cond = arrial_expand_true;  } else{ arrial_cond = arrial_expand_false;}
                        if(parseFloat(current+1)==1){ show_expand = "show";  } else{ show_expand = "";}

                       displaydata = '<div class="panel panel-default"><div class="ledger-panel  bg-purple" role="tab" id="heading"><h4 class="panel-title"><a  class="text-left page-title btn-bg-accordion w-100 collapsed" data-toggle="collapse" data-target="#collapse'+parseFloat(current+1)+'" role="button" '+arrial_cond+'  aria-controls="collapse '+parseFloat(current+1)+'  "><div class="row"> <div class="col-lg-12"><div class="col-lg-4 right"><span class="text-yellow">On : </span>'+moment(value.created_date.created_at).format('Do MMM YYYY')+' ('+moment(value.created_date.created_at).fromNow() +') </div><div class="col-lg-1 right text-center">'+amount_type_constant[value.created_date.amount_type]+'</div><div class="col-lg-2 right text-center">'+payment_type_constant[value.created_date.payment_type]+'</div><div class="col-lg-2 right text-center">Rs .'+value.total_amount+'</div></div></div></a></h4></div><div id="collapse'+parseFloat(current+1)+'" class="collapse  '+show_expand+' " role="tabpanel" aria-labelledby="heading"><div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.'+value.transation_id+'</div></div></div>';
                       $( ".ajaxdata" ).append(displaydata);
                       current++;
                        });
                    }else
                    {
                        displaydata ="No Data Available";
                        $( ".ajaxdata" ).html(displaydata).addClass("text-center");
                    }



                }
            });
    });
      </script>
       <script>
        $('.viewinvoice').on('click', function() {
           $( ".showdata" ).find('tbody').html('');
           $( ".subcompanyinfo" ).find('address').html('');
           $( ".clientinfo" ).find('address').html('');
            var id = $(this).data('id');
            $.ajax({
               type: "GET",
               url: "{{route('ledger.getinvoicedetails')}}",
               data:{'id':id},

           success: function (data) {
               console.log(data);
               var invoiceinfo = '';
               var pdfexportlink = '';
               var amountArray = new Array();
               var subtotal = 0;
               $.each( data, function( key, value ) {
                   var priceamount = data[key].amount;
                   amountArray.push(data[key].amount);

                   // subtotal = subtotal + parseInt(amountArray);
               var dataproduct = '<tr><td>'+data[key].quantity+'</td><td>'+data[key].productname['name']+'</td><td>'+data[key].price+'</td><td>'+data[key].productname['serial_number']+'</td><td>'+data[key].description+'</td><td>'+data[key].amount+'</td></tr>';
               invoiceinfosubcompanyname = '<strong>'+data[key].subcompanyname['name']+'</strong><br>'+data[key].subcompanyname['address'].match(/.{1,25}/g).join("<br/>")+'';
               invoiceinfoclientname = '<strong>'+data[key].clientname['name']+'</strong><br>'+data[key].subcompanyname['address'].match(/.{1,25}/g).join("<br/>")+'';
               $( ".showdata" ).find('tbody').append(dataproduct);
               var url = '{{ route("ledger.exportpdf", ["id" => "id"]) }}';
               url = url.replace('id',  data[key].transation_id);
                pdfexportlink = '<a href="'+url+'" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF </a>';
               });
               for (var i = 0; i < amountArray.length; i++) {
                       subtotal += amountArray[i];
                   }
               $( ".subtotal" ).find('td').html(subtotal);
               $( ".total" ).find('td').html(subtotal);
               $( ".subcompanyinfo" ).find('address').append(invoiceinfosubcompanyname);
               $( ".clientinfo" ).find('address').append(invoiceinfoclientname);
               $( "#generatepdf" ).html(pdfexportlink);
           }
       });
           $("#showinvoicemodel").modal('show');


        });
         </script>

@endpush
@yield('js')
