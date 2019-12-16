@extends('adminlte::page')

@section('title', 'SubCompany Stock')

@section('content')

<section>
{{-- {{dd($subcompanystockleft)}} --}}
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
                    <a href="{{route('admin.subcompanystock.create')}}">
                            <button class="btn btn-success pull-right">
                                    Create <span class="badge badge-primary">new</span>
                            </button>
                        </a>
                            <button class="btn btn-success pull-left">
                                    Total SubCompany Opening Stock <span class="badge badge-primary">{{count($subcompanystockleft)}}</span>
                            </button>
                    </div>
                </div>
                <div class="row">&nbsp;</div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Company Name <span class="text-red">[Company Code]</span> </th>
                  <th>SubCompany Name <span class="text-red">[SubCompany Code]</span> </th>
                  <th>Opening Balance </th>
                  <th>Creted At</th>
                  <th>Updated At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($subcompanystockleft as $subcompanystock)
                    <tr>
                        <td class="text-capitalize">{{$subcompanystock->subCompany->company->name??""}} [{{$subcompanystock->subCompany->company->company_code??""}}]</td>
                        <td class="text-capitalize">{{$subcompanystock->subCompany->name??""}} [{{$subcompanystock->subCompany->subcompany_code??""}}]</td>
                        <td class="text-capitalize">{{$subcompanystock->opening_balance}} </td>
                    <td>{{$subcompanystock->created_at?$subcompanystock->created_at->diffForHumans():''}}</td>
                    <td>{{$subcompanystock->updated_at?$subcompanystock->updated_at->diffForHumans():''}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                        <a href="{{route('subcompanystock.edit',$subcompanystock->id)}}" class="edit-model btn btn-warning btn-sm " ><i class="fa fa-edit"></i></a>
                                <button class="delete-model btn btn-danger btn-sm " type="button" onclick="deleteSubCompany({{ $subcompanystock->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                              <form id="delete-form-{{ $subcompanystock->id }}" action="{{route('subcompanystock.destroy',$subcompanystock->id)}}" method="POST" style="display: none;">
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
                    <th>Opening Balance </th>
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