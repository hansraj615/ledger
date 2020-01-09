@extends('adminlte::page')

@section('title', 'Product Master')

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
                        <a href="{{route('permissions.create')}}">
                            <button class="btn btn-success pull-right">
                                    Create <span class="badge badge-primary">new</span>
                            </button>
                        </a>
                            <button class="btn btn-success pull-left">
                                    Total Product <span class="badge badge-primary">{{count($products)}}</span>
                            </button>
                    </div>
                </div>
                <div class="row">&nbsp;</div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Product Serial Number</th>
                  <th>Product Description</th>
                  <th>Creted At</th>
                  <th>Updated At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                    <td class="text-capitalize">{{$product->name??""}}</td>
                    <td>
                         {{$product->serial_number??""}}
                    </td>
                    <td>
                    {{$product->description??""}}
                    </td>
                    <td>{{$product->created_at?$product->created_at->diffForHumans():''}}</td>
                    <td>{{$product->updated_at?$product->updated_at->diffForHumans():''}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('products.edit',$product->id) }}" class="edit-model btn btn-warning btn-sm " ><i class="fa fa-edit"></i></a>
                                <button class="delete-model btn btn-danger btn-sm " type="button" onclick="deleteProduct({{ $product->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy',$product->id) }}" method="POST" style="display: none;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                        </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Product Name</th>
                    <th>Product Serial Number</th>
                    <th>Product Description</th>
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

  <script type="text/javascript">
  function deleteProduct(id) {
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
