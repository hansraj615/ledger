@extends('adminlte::page')

@section('title', 'Create Ledger Entry')
@push('css')

@endpush
@section('content')

<section>
      <section class="content">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Create Ledger Entry</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <form class="form" action="{{route('admin.ledger.store')}}" method="POST">
                        {{csrf_field()}}
                        <div class="col-lg-12">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="name">SubCompany Name</label>
                                    <select name="subcompanyname" class="form-control select2 subcompany-select2" id="subcompanyname">
                                        <option value="" class="text-blue">Select Sub-Company</option>
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
                                    <select name="clientname" class="form-control client-select2" id="clientname">
                                        <option value=""></option>
                                    </select>
                                    <small id="helpId" class="text-muted">Help text</small>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="name">Payment Type</label>
                                    <div class="form-group">
                                        @foreach(config('constant.payment_type') as $key => $value)
                                            <label> <input type="radio" name="paymenttype" id="paymenttype" class="flat-red paymenttype" value="{{$key}}">  {{$value}} </label>
                                        @endforeach
                                    </div>
                                    <small id="helpId" class="text-muted">Help text</small>
                                </div>
                            </div>
                            <div class="col-lg-3" style='display:none' id="bankname">
                                <div class="form-group">
                                    <label for="name">Bank Name</label>
                                    <div class="form-group" >
                                        <select class="form-control" name="bank" id="bank">
                                        @foreach(config('constant.bank') as $key => $value)
                                    <option value="{{$key}}">  {{$value}} </option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <small id="helpId" class="text-muted">Help text</small>
                                </div>
                            </div>
                            <div class="col-lg-3" style='display:none' id="cardtype">
                                <div class="form-group">
                                    <label for="name">Card Type</label>
                                    <div class="form-group" >
                                        <select class="form-control" name="cardtype" id="cardtype">
                                        @foreach(config('constant.card_type') as $key => $value)
                                    <option value="{{$key}}">  {{$value}} </option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <small id="helpId" class="text-muted">Help text</small>
                                </div>
                            </div>
                            <div class="col-lg-3" style='display:none' id="transactionnumber">
                                <div class="form-group">
                                    <label for="name">Transaction Number</label>
                                    <div class="form-group" >
                                        <input type="text" class="form-control" id= "transactionnumber"name="transactionnumber">
                                    </div>
                                    <small id="helpId" class="text-muted">Help text</small>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="name">Amount Type</label>
                                    <div class="form-group">
                                        @foreach(config('constant.amount_type') as $key => $value)
                                            <label> <input type="radio" name="amounttype" class="flat-red" value="{{$key}}">  {{$value}} </label>
                                        @endforeach
                                    </div>
                                    <small id="helpId" class="text-muted">Help text</small>
                                </div>
                            </div>

                            <table class="table table-striped table order-list">
                                <thead>
                                    <tr>
                                    <th>Product</th>
                                    <th>Qunatity</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th><button  id="addrow" class="btn btn-primary"><i class="fas fa-plus"></i></button> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <select name="product[]" class="form-control select2 product" id="product">

                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="quantity[]" id="quantity" class="form-control onlynumbers quantity" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="price[]" id="price" class="form-control price" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="number" name="amount[]" id="amount" class="form-control amount" readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="description[]" id="description" class="form-control" >
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-success center-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
      </section>
</section>
@endsection

@push('js')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
<script>
$(function () {
    $('input[name="paymenttype"]').on('ifClicked', function (event) {
       var value =  this.value;
       if(value == 4){
           $('#bankname').show();
           $('#transactionnumber').hide();
           $('#cardtype').hide();
       }else if(value == 3){
           $('#transactionnumber label').text('Transaction Number');
           $('#transactionnumber').show();
           $('#bankname').hide();
           $('#cardtype').hide();
       }else if(value == 2){
           $('#transactionnumber label').text('DD Number');
           $('#transactionnumber').show();
           $('#bankname').hide();
           $('#cardtype').hide();
       }else if(value == 1){
           $('#transactionnumber label').text('Transaction Number');
           $('#transactionnumber').show();
           $('#cardtype').show();
           $('#bankname').hide();
       }else{
           $('#bankname').hide();
           $('#transactionnumber').hide();
       }
    });
    $(".select2").select2();
    //iCheck for checkbox and radio inputs
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

})


    $(document).ready(function () {
        $(".product").select2({
        ajax: {
            url: function (param) {
                return "{{route('search-product')}}";
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
        minimumInputLength: 3,
    });
    var counter = 0;

    $("#addrow").on("click", function (e) {
        e.preventDefault()

        var newRow = $("<tr>");
        var cols = "";
        var col =[];

        cols += '<td><div class="form-group"><div class="input-group"><select  class="form-control select2 product" id="product" name="product[]" style="width: 127px;"></select></div></div></td>';
        cols += '<td><div class="form-group"><div class="input-group quantity"><input type="number" class="form-control" name="quantity[]"/></div></div></td>';
        cols += '<td><div class="form-group"><div class="input-group price"><input type="number" class="form-control" name="price[]"/></div></div></td>';
        cols += '<td><div class="form-group"><div class="input-group amount"><input type="number" class="form-control" name="amount[]"readonly/></div></div></td>';
        cols += '<td><div class="form-group"><div class="input-group"><input type="text" class="form-control" name="description[]"/></div></div></td>';

        cols += '<td><button  class="ibtnDel btn btn-primary"><i class="fas fa-minus"></i></button></td>';
        newRow.append(cols);
        newRow.find(".product").select2({
        ajax: {
            url: function (param) {
                return "{{route('search-product')}}";
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
        minimumInputLength: 3,
    });
    newRow.find('.quantity,.price').on('keyup change',function(){
        var price = $(this).closest('tr').find("td input[name^='price']").val();
        var quantity = $(this).closest('tr').find("td input[name^='quantity']").val();
        var tot = price * quantity;
        $(this).closest('tr').find("td input[name^='amount']").val(tot);
    });
    newRow.on('change', '.product', function (e) {
            var val = $(this).val();
            var selects = $('.product').not(this);
            for (var index = 0; index < selects.length; index++) {
                if (val === $(selects[index]).val()) {
                    toastr.error("This Product is already added.");
                    $(this).val("").trigger('change');
                    break;
                }
            }
        });

        $("table.order-list").append(newRow);
        $("table.order-list").find(".flat-red").iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });
        counter++;

    });



    $("table.order-list").on("click", ".ibtnDel", function (event) {
        event.preventDefault()
        $(this).closest("tr").remove();
        counter -= 1
    });


});

$( ".subcompany-select2" ) .change(function () {
        let param_new = $(this).val();
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



function calculateRow(row) {
    var price = +row.find('input[name^="price"]').val();

}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="price"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
}
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
    $(document).on('keyup change','.quantity,.price',function(){
        var price = $(this).closest('tr').find("td input[name^='price']").val();
        var quantity = $(this).closest('tr').find("td input[name^='quantity']").val();
        var tot = price * quantity;
        $(this).closest('tr').find("td input[name^='amount']").val(tot);
    });
    $(document).on('change', '.product', function (e) {
            var val = $(this).val();
            var selects = $('.product').not(this);
            for (var index = 0; index < selects.length; index++) {
                if (val === $(selects[index]).val()) {
                    toastr.error("This preventive health check up is already added.");
                    $(this).val("").trigger('change');
                    break;
                }
            }
        });

    // $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    //   checkboxClass: 'icheckbox_minimal-blue',
    //   radioClass   : 'iradio_minimal-blue'
    // })
  </script>
    <script>

    </script>

@endpush
@yield('js')
