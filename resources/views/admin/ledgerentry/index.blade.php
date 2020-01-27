@extends('adminlte::page')

@section('title', 'LedgerEntry')

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @php
                $usersubcompanyid = \App\Traits\CommonTrait::getUserSubCompanyId();
                // dd($usersubcompanyid);
                @endphp
                <form class="form form-inline showdetails" action="{{route('ledger.index')}}" name="showdetails" method="GET">
                    <div class="box-header">
                        <h3 class="box-title">For Ledger Entry  </h3>
                        <div class="col-md-12 align-center text-center">
                        <select class="form-control col-4" name="subcompany" id="subcompany">
                            @foreach($subcompanies as $key => $company)
                            <option value="{{$company->id}}" @if(Request::get('subcompany')== $company->id) selected @elseif($usersubcompanyid==$company->id) selected @else  @endif>{{$company->name}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                    </div>
                </form>

                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{route('admin.ledger.create')}}">
                                <button class="btn btn-success pull-right">
                                        Create <span class="badge badge-primary">new </span>
                                </button>
                            </a>
                                <button class="btn btn-success pull-left">
                                        Total LedgerEntry <span class="badge badge-primary">{{count($ledger)}}</span>
                                </button>
                        </div>
                    </div>
                    <div class="row">&nbsp;</div>
                    @if(count($ledger)>0)
                    <div class="box">
                        <div class="box-body">
                            @foreach($ledger as $ledgerentry)
                            <div class="ledger-list-item ledger-patient-details">
                                <div class="row">
                                    <div class="col-md-3 br-1-white ">
                                        <div class="row text-center">
                                            <div class="col-md-12 ">
                                                <div>
                                                    <span class="text-grey">Client Name : </span>
                                                    <label class="text-default">{{$ledgerentry->client->name}}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                            <a href="{{route('client.index')}}" class="text-primary"><i class="fas fa-eye"></i></a>  |
                                                <a href="{{ route('client.edit',$ledgerentry->client_id) }}" class="text-primary"><i class="fas fa-edit"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 br-1-white">
                                        <div class="text-center">
                                            <span class="text-grey">Total Earning as of Today : </span>
                                            <label class="text-default">{{$ledgerentry['clientTotalAmount']}}
                                                @if($ledgerentry['subcompanyhealth'] === 1)
                                                    <i class="fas fa-long-arrow-alt-up text-success" style="font-size: 18px"></i>
                                                @elseif($ledgerentry['subcompanyhealth'] === 0)
                                                    <i class="fas fa-long-arrow-alt-down text-danger" style="font-size: 18px"></i>
                                                @else
                                                    <i class="fas fa-equals text-warning"></i>
                                                @endif
                                            </label>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="col-md-4 br-1-white">
                                        <div>
                                            <p class="text-center">Recent 5 Transaction</p>
                                            <p class="br-1-bottom"></p>
                                                @foreach($ledgerentry['latesttranaction'] as $key => $lasttransaction)
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="col-lg-4">
                                                                <p>{{$lasttransaction->totalamout}} |
                                                                    @if($lasttransaction->amount_type==1)
                                                                        <span class="text-success">{{config('constant.amount_type')[$lasttransaction->amount_type]}}</span>
                                                                    @else
                                                                        <span class="text-danger">{{config('constant.amount_type')[$lasttransaction->amount_type]}}</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <a href="#" id ="" class="viewinvoice" data-id="{{$lasttransaction->transation_id}}">Send Invoice</a>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                    <a href="#" class="showtransation" data-id="{{$lasttransaction->transation_id}}">View Transation</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <span class="br-1-bottom"></span>
                                                @endforeach
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="align-center p-3 px-2 ml-1">
                                            <a href="#" class="btn mb-3 btn-block btn-primary outline btn-md">View</a>
                                        </div>
                                        <div class="ml-1">
                                            <a href="#" class="btn mb-3 btn-block btn-primary outline btn-md">Cancel</a>
                                        </div>
                                        <button type="submit" class="btn mb-3 btn-block btn-primary outline btn-md" title="View Request" style="padding: 0.5rem 0rem;">View Request</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                        <div class="text-center">
                            <?php
                                $results = \App\Ledger\Helpers\customHelper::getsubcompanyName(Request::get('subcompany'));
                                ?>
                        <p> No Transaction available for Subcompany <b style="color:red" class="text-capitalize">{{$results}} </b></p>
                        </div>
                    @endif
                </div>
            </div>
        <!-- /.col -->
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
<style>
.br-1-white {
    border-right: 1px solid #dbe5e8;
    height: 200px;
}

.br-1-bottom {
    border-bottom: 1px solid #dbe5e8;
    height: auto;
}
.ledger-list-view .ledger-list-item, .ledger-patient-details, .ledger-doctor-details {
    padding: 1rem;
    background-color: #fffff;
    margin-bottom: 1.5rem;
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
        $('#showinvoicemodel').on('shown.bs.modal', function () {
        $(this).find('.modal-dialog').css({width:'90%',
                               height:'auto'
                              });
        });
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
      $(document).ready(function() {
        var getvalue = $("#subcompany option:selected").val();
        // alert({{Request::get('subcompany')}});
        var checkUrl = {{ Request::get('subcompany') !=0 ? Request::get('subcompany') : '0' }};
       if(checkUrl==0) {
            var $form = $('.showdetails').closest('form');
            $form.find('button[type=submit]').click();
        }

    $('#subcompany').on('change', function() {
        console.log($(this));
        $(this).data('clicked', true);
        if($('#subcompany').data('clicked')) {
        var $form = $('.showdetails').closest('form');
            $form.find('button[type=submit]').click();
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
  <script>

$('.showtransation').on('click',function(){

    var id = $(this).data('id');
    $.ajax({
        type: "GET",
        url: "{{route('ledger.getinvoicedetails')}}",
        data:{'id':id},

    success: function (data) {
        console.log(data);

        $.each( data, function( key, value ) {
        transationclientname = '<p>Client Name : <span class="text-red"> '+data[key].clientname['name']+'</span></p>';
        var dataproduct = '<tr><td>'+data[key].quantity+'</td><td>'+data[key].productname['name']+'</td><td>'+data[key].price+'</td><td>'+data[key].productname['serial_number']+'</td><td>'+data[key].description+'</td><td>'+data[key].amount+'</td></tr>';
        $( ".showdataproddetails" ).find('tbody').append(dataproduct);
        });
        $( ".transationclientname" ).find('h4').html(transationclientname);
    }
    });
    $("#showtransationmodel").modal('show');

})
      </script>

@endpush
@yield('js')
