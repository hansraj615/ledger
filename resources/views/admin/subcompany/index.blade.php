@extends('adminlte::page')

@section('title', 'SubCompany')

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
                    <a href="{{route('admin.subcompany.create')}}">
                            <button class="btn btn-success pull-right">
                                    Create <span class="badge badge-primary">new</span>
                            </button>
                        </a>
                            <button class="btn btn-success pull-left">
                                    Total SubCompany <span class="badge badge-primary">{{count($subcompanies)}}</span>
                            </button>
                    </div>
                </div>
                <div class="row">&nbsp;</div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Company Name <span class="text-red">[Company Code]</span> </th>
                  <th>SubCompany Name <span class="text-red">[SubCompany Code]</span> </th>
                  <th>Contact Details <i class="fa fa-phone text-green" aria-hidden="true"></i> | <i class="fa fa-mobile text-green" aria-hidden="true"></i></th>
                  <th>Address</th>
                  <th>Creted At</th>
                  <th>Updated At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($subcompanies as $subcompany)
                    <tr> 
                        <td class="text-capitalize">{{$subcompany->company->name??""}} <span class="text-red">[{{$subcompany->company->company_code??""}}]</span></td>
                    <td class="text-capitalize">{{$subcompany->name_code}} </span></td>
                    <td>
                        <li> Phone Number <i class="fa fa-phone text-green" aria-hidden="true"></i> :-  {{$subcompany->phone_no}}</li>
                        <li> Mobile Number <i class="fa fa-mobile text-green" aria-hidden="true"></i> :- {{$subcompany->mobile_no}}</li>
                        <li>Email <i class="fa fa-envelope text-green" aria-hidden="true"></i>:- {{$subcompany->email}}</li>
                    </td>
                    <td>
                    <li>Country <i class="fa  fa-map-pin text-green" aria-hidden="true"></i> :- {{$subcompany->country_name}} <div class="country{{$subcompany->country_code}}"><i></i> <b></b></div></li>
                        <li>State <i class="fa  fa-map-pin text-green" aria-hidden="true"></i> :- {{$subcompany->state_name}}</li>
                        <li>City <i class="fa  fa-map-pin text-green" aria-hidden="true"></i> :- {{$subcompany->city_name}}</li>
                        <li>Address <i class="fa fa-map text-green" aria-hidden="true"></i> :- {{$subcompany->address}}</li>
                    </td>
                    <td>{{$subcompany->created_at?$subcompany->created_at->diffForHumans():''}}</td>
                    <td>{{$subcompany->updated_at?$subcompany->updated_at->diffForHumans():''}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                        <a href="{{route('subcompany.edit',$subcompany->id)}}" class="edit-model btn btn-warning btn-sm " ><i class="fa fa-edit"></i></a>
                                <button class="delete-model btn btn-danger btn-sm " type="button" onclick="deleteSubCompany({{ $subcompany->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $subcompany->id }}" action="{{ route('subcompany.destroy',$subcompany->id) }}" method="POST" style="display: none;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                        </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Company Name</th>
                    <th>SubCompany Name</th>
                    <th>Contact Details</th>
                    <th>Address</th>
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
<?php
foreach($subcompanies as $subcompany) { ?>
.country{{$subcompany->country_code}} {
    margin: 10px;
    padding: 4px 6px;
    border: 1px solid #999;
    border-radius: 5px;
    display: inline-block;
    font-family: tahoma;
    font-size: 12px
}
.country{{$subcompany->country_code}} i {
    background: url(https://dl.dropboxusercontent.com/s/izcyieh1iatr4n5/flags.png) no-repeat;
    display: inline-block;
    width: 16px;
    height: 11px;
}
<?php }
?>
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

(function ($) {

    $(function () {
        // var $target = $('.country');

        // on load:
       // $target.find('i').setFlagPosition('es');
     <?php foreach($subcompanies as $subcompany) {

         ?>
         var $target = $('.country{{$subcompany->country_code}}');
       var value= "{{$subcompany->country_code}}";
       $target.find('i').setFlagPosition(value);
      <?php } ?>
    //   $target.find('i').setFlagPosition(value);
    });

})(jQuery);

  </script>
  <script type="text/javascript">
  function deleteSubCompany(id) {
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
