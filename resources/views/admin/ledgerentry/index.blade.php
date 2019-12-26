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

@foreach($ledger as $value)
{{dd($value)}}
@endforeach
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
                    @foreach($ledger as $ledgerrntry)
              
               <div class="container">
               
                <div class="row grid-divider">
                <div class="col-sm-4">
                  <div class="col-padding">
                  <h3>{{$ledgerrntry->client->name}}</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima expedita incidunt rerum.</p>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="col-padding">
                    <h3>Column 2</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate placeat suscipit maxime tenetur officiis asperiores quae molestias fugiat praesentium dolorum.</p>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="col-padding">
                    <h3>Column 3</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab veniam aperiam numquam cupiditate maiores repudiandae ea dicta, sunt rerum corporis. Ab veniam aperiam numquam cupiditate maiores repudiandae ea dicta, sunt rerum corporis. Ab veniam aperiam numquam cupiditate maiores repudiandae ea dicta.</p>
                  </div>
                </div>
                </div>
            
            </div>
            <hr/>
            @endforeach
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
@media ( min-width: 768px ) {
    .grid-divider {
        position: relative;
        padding: 0;
    }
    .grid-divider>[class*='col-'] {
        position: static;
    }
    .grid-divider>[class*='col-']:nth-child(n+2):before {
        content: "";
        border-left: 1px solid #DDD;
        position: absolute;
        top: 0;
        bottom: 0;
    }
    .col-padding {
        padding: 0 15px;
    }
}@media ( min-width: 768px ) {
    .grid-divider {
        position: relative;
        padding: 0;
    }
    .grid-divider>[class*='col-'] {
        position: static;
    }
    .grid-divider>[class*='col-']:nth-child(n+2):before {
        content: "";
        border-left: 1px solid #DDD;
        position: absolute;
        top: 0;
        bottom: 0;
    }
    .col-padding {
        padding: 0 15px;
    }
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
$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		
	}
})
  </script>
 
@endpush
@yield('js')
