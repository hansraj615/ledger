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
                            @foreach($ledger as $ledgerrntry)
                            <div class="ledger-list-item ledger-patient-details">
                                <div class="row">
                                    <div class="col-md-3 br-1-white ">
                                        <div class="row text-center">
                                            <div class="col-md-12 ">
                                                <div>
                                                    <span class="text-grey">Client Name : </span>
                                                    <label class="text-default">{{$ledgerrntry->client->name}}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                            <a href="{{route('client.index')}}" class="text-primary"><i class="fas fa-eye"></i></a>  |
                                                <a href="{{ route('client.edit',$ledgerrntry->client_id) }}" class="text-primary"><i class="fas fa-edit"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 br-1-white">
                                        <div class="text-center">
                                            <span class="text-grey">Total Earning as of Today : </span>
                                            <label class="text-default">{{$ledgerrntry['clientTotalAmount']}}
                                                @if($ledgerrntry['subcompanyhealth'] === 1)
                                                    <i class="fas fa-long-arrow-alt-up text-success" style="font-size: 18px"></i>
                                                @elseif($ledgerrntry['subcompanyhealth'] === 0)
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
                                            <p class="text-center">Recent 2 Transaction</p><hr>
                                                @foreach($ledgerrntry['latesttranaction'] as $key => $lasttransaction)
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="col-lg-4">
                                                                <p>{{$lasttransaction->amount}} |
                                                                    @if($lasttransaction->amount_type==1)
                                                                        <span class="text-success">{{config('constant.amount_type')[$lasttransaction->amount_type]}}</span>
                                                                    @else
                                                                        <span class="text-danger">{{config('constant.amount_type')[$lasttransaction->amount_type]}}</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <a href="#" class="">Settle Up</a>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <span class="text-grey">Description : </span>
                                                                <label class="text-default">{{$lasttransaction->description}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <hr>
                                                @endforeach
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="align-center p-3 px-2 ml-1">
                                            <a href="#" class="btn mb-3 btn-block btn-primary">View</a>
                                        </div>
                                        <div class="ml-1">
                                            <a href="#" class="btn mb-3 btn-block btn-info">Cancel</a>
                                        </div>
                                        <button type="submit" class="btn mb-3 btn-block btn-primary" title="View Request" style="padding: 0.5rem 0rem;">View Request</button>
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
    </section>
    <!-- /.content -->


@endsection
@push('css')
<style>
.br-1-white {
    border-right: 1px solid #fff;
    height: 200px;
}
.ledger-list-view .ledger-list-item, .ledger-patient-details, .ledger-doctor-details {
    padding: 1rem;
    background-color: #d5dbef;
    margin-bottom: 1.5rem;
    border: 1px solid #e1eae5;
    border-radius: 3px;
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
