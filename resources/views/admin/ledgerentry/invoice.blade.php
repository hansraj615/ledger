<section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-globe"></i> AdminLTE, Inc.
              <small class="pull-right">Date: 2/10/2014</small>
            </h2>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col subcompanyinfo">
            From
            <address>

            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col clientinfo">
            To
            <address>

            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b>Invoice #007612</b><br>
            <br>
            <b>Order ID:</b> 4F3S8J<br>
            <b>Payment Due:</b> 2/22/2014<br>
            <b>Account:</b> 968-34567
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped showdata">
              <thead>
              <tr>
                <th>Qty</th>
                <th>Product</th>
                <th>Price</th>
                <th>Serial #</th>
                <th>Description</th>
                <th>Subtotal</th>
              </tr>
              </thead>
              <tbody>

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
            <img src="../../dist/img/credit/visa.png" alt="Visa">
            <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
            <img src="../../dist/img/credit/american-express.png" alt="American Express">
            <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

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
                  <td>Rs</td>
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
                  <td>Rs</td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
          <div class="col-xs-12">
            <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
            </button>
        {{-- <a href="{{ route('ledger.exportpdf', ['id' => $projects->id]) }}" class="btn btn-primary pull-right" style="margin-right: 5px;">
              <i class="fa fa-download"></i> Generate PDF
            </a> --}}
            <span id="generatepdf"></span>
          </div>
        </div>
      </section>
