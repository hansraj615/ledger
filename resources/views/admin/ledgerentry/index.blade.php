@extends('adminlte::page')

@section('title', 'LedgerEntry')

@section('content')

<section>

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
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>


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
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Data Table With Full Features</h3>
                  </div>
      
      
                  <div class="box-body">
                      <div class="row">
<div class="col-lg-12">
  <div class="col-lg-4 border-right bordered-bottom-2 border-primary" style='border-bottom:1px solid #ccc;'>
<span> hjdfsjksdf</span>: <p>asd</p>
  </div>
  <div class="col-lg-4 border-right">
sdf sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg 
  </div>
  <div class="col-lg-4 border-right">
sdf sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg 
  </div>
</div>


                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="col-lg-4 border-bottom border-right">
                      sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg 
                        </div>
                        <div class="col-lg-4 border-right">
                      sdf sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg 
                        </div>
                        <div class="col-lg-4 border-right">
                      sdf sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg sd sdgds sdrg df dfg 
                        </div>
                      </div>
                      
                      
                                            </div>
                                          </div>
                  </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</section>
@endsection
@push('css')
<style>
.country {
    margin: 10px;
    padding: 4px 6px;
    border: 1px solid #999;
    border-radius: 5px;
    display: inline-block;
    font-family: tahoma;
    font-size: 12px
}

</style>
@endpush
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
  </script>
  <script>

(function ($) {
    // size = flag size + spacing
    var default_size = {
        w: 20,
        h: 15
    };

    function calcPos(letter, size) {
        return -(letter.toLowerCase().charCodeAt(0) - 97) * size;
    }

    $.fn.setFlagPosition = function (iso, size) {
        size || (size = default_size);

        var x = calcPos(iso[1], size.w),
            y = calcPos(iso[0], size.h);

        return $(this).css('background-position', [x, 'px ', y, 'px'].join(''));
    };
})(jQuery);

// USAGE:

  </script>
 
@endpush
@yield('js')
