<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Prescription</title>
   <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
   <style>

      @media print {
         body {-webkit-print-color-adjust: exact;}
      }
   </style>
</head>
<body>
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-globe"></i>Ledger
              <small class="pull-right">Date: 2/10/2014</small>
            </h2>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                <td>
                   <table border="0" width ="85%"cellspacing="0" cellpadding="0">
                        <thead>
                                <tr>
                                    <th>From</th>
                                    <th>To</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td width='10%'>
                                            {{$getpdf[0]->subcompanyname->name}}<br>
                                            {{$getpdf[0]->subcompanyname->address}}
                                    </td>
                                    <td width='10%'>
                                            {{$getpdf[0]->clientname->name}}<br>
                                            {{$getpdf[0]->clientname->address}}</td>
                                    </tr>
                            </tbody>
                   </table>
                </td>
                <td>
                   <table border="0" width="15%"cellspacing="0" cellpadding="0">
                      <tr>
                           <td>Invoice #007612<br>
                           Order ID: 4F3S8J<br>
                           Payment Due: 2/22/2014<br>
                           Account: 968-34567</td>
                      </tr>

                    </table>
                </td>
                </tr>
               </table>
               <br>
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table border="2" style="width:100%; margin: 0 auto;  font-family: 'Roboto', sans-serif, Helvetica; border: none; border-collapse: collapse;">
              <thead>
              <tr style="background: #2fa6c3;">
                <th>Qty</th>
                <th>Product</th>
                <th>Price</th>
                <th>Serial #</th>
                <th>Description</th>
                <th>Subtotal</th>
              </tr>
              </thead>
              <tbody>
                  @foreach($getpdf as $data)
                  <tr>
                        <td>{{$data->quantity}}</td>
                        <td>{{$data->productname->name}}</td>
                        <td>{{$data->price}}</td>
                        <td>{{$data->productname->serial_number}}</td>
                        <td>{{$data->description}}</td>
                        <td>{{$data->amount}}</td>
                  </tr>
                  @endforeach

              </tbody>
            </table>


          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <!-- accepted payments column -->
          <div class="col-xs-6">
            <p class="lead">Payment Methods:</p>


            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
              Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
              dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
            </p>
          </div>
          <!-- /.col -->
          <div class="col-xs-6">
            <p class="lead">Amount Due 2/22/2014</p>
            <p class="lead">Note:Price is inclusive of service tax and GST.
            </p>

            <div class="table-responsive">
              <table class="table">
                <tr class="subtotal">
                  <th style="width:50%">Subtotal:</th>
                <td>Rs {{$getpdf[0]->totalamout}}</td>
                </tr>
                {{-- <tr>
                  <th>Tax (9.3%)</th>
                  <td>$10.34</td>
                </tr>
                <tr>
                  <th>Shipping:</th>
                  <td>$5.80</td>
                </tr> --}}
                <tr class="total">
                  <th>Total:</th>
                  <td>Rs {{$getpdf[0]->totalamout}}</td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    </body>
    </html>
