@extends('adminlte::page')

@section('title', 'LedgerEntry')

@section('content')

<section>
  {{-- {{dd($ledger[0]->amount_type)}} --}}
{{-- {{dd(config('constant.amount_type')[$ledger[0]->amount_type])}} --}}

{{-- @foreach(config('constant.amount_type') as $key => $value)
{{dd($value)}}
@endforeach --}}
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
                                    Create <span class="badge badge-primary">new</span>
                            </button>
                        </a>
                            <button class="btn btn-success pull-left">
                                    Total SubCompany <span class="badge badge-primary">{{count($ledger)}}</span>
                            </button>
                    </div>
                </div>
                <div class="row">&nbsp;</div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                   
                  <th>SubCompany Name <span class="text-red">[SubCompany Code]</span> </th>
                  <th>Client Name <span class="text-red">[Client Code]</span> </th>
                  <th>Amount Type <i class="fa fa-phone text-green" aria-hidden="true"></i> </th>
                  <th>Amount</th>
                  <th>Final Amount</th>
                  <th>AmountHealth</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($ledger as $ledgers)
                    <tr> 
                        <td class="text-capitalize">{{($ledgers->subcompany->name)}}<span class="text-red">[{{$ledgers->subcompany->subcompany_code??""}}]</span></td>
                        <td class="text-capitalize">{{($ledgers->client->name)}}<span class="text-red">[{{$ledgers->client->client_code??""}}]</span></td>
                        <td class="text-capitalize">{{config('constant.amount_type')[$ledgers->amount_type]}} </span></td>
                        <td class="text-capitalize">{{($ledgers->amount)}}</td>
                        <td class="text-capitalize">{{($ledgers->finalamount)}}</td>
                        <td class="text-capitalize">{{config('constant.amount_health')[$ledgers->amounthealth]}} </span></td>
                    
                    <td>{{$ledgers->created_at?$ledgers->created_at->diffForHumans():''}}</td>
                    <td>{{$ledgers->updated_at?$ledgers->updated_at->diffForHumans():''}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                        <a href="{{route('ledger.edit',$ledgers->id)}}" class="edit-model btn btn-warning btn-sm " ><i class="fa fa-edit"></i></a>
                                <button class="delete-model btn btn-danger btn-sm " type="button" onclick="deleteLedger({{ $ledgers->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $ledgers->id }}" action="{{ route('ledger.destroy',$ledgers->id) }}" method="POST" style="display: none;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                        </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                   
                    <th>SubCompany Name</th>
                    <th>Amount Type <i class="fa fa-phone text-green" aria-hidden="true"></i> </th>
                    <th>Amount</th>
                    <th>Final Amount</th>
                    <th>AmountHealth</th>
                    <th>Creted At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>
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
  <script type="text/javascript">
  function deleteLedger(id) {
   const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
    event.preventDefault();
      document.getElementById('delete-form-'+id).submit();
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})
  }</script>
@endpush
@yield('js')
