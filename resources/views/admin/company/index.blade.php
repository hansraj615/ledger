@extends('adminlte::page')

@section('title', 'Company')
@push('css')

<link href="{{asset('css/jquery.magnify.css')}}" rel="stylesheet">
<style>
  .magnify-modal {
    box-shadow: 0 0 6px 2px rgba(0, 0, 0, 0.3);
  }

  .magnify-header .magnify-toolbar {
    background-color: rgba(0, 0, 0, .5);
  }

  .magnify-stage {
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    border-width: 0;
  }

  .magnify-footer .magnify-toolbar {
    background-color: rgba(0, 0, 0, .5);
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }

  .magnify-header,
  .magnify-footer {
    pointer-events: none;
  }

  .magnify-button {
    pointer-events: auto;
  }

  </style>
@endpush
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
            <div class="row">
                    <div class="col-lg-12">
                        <a href="{{route('admin.company.create')}}">
                            <button class="btn btn-success pull-right">
                                    Create <span class="badge badge-primary">new</span>
                            </button>
                        </a>
                    </div>
                </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Company Name <span class="text-red">[Company Code]</span> </th>
                  <th>Contact Details <i class="fa fa-phone text-green" aria-hidden="true"></i> | <i class="fa fa-mobile text-green" aria-hidden="true"></i></th>
                  <th>Address</th>
                  <th>Creted At</th>
                  <th>Updated At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                    <tr>
                    <td class="text-capitalize">{{$company->name}} <span class="text-red">[{{$company->company_code}}]</span></td>
                    <td>
                        <li> Phone Number <i class="fa fa-phone text-green" aria-hidden="true"></i> :-  {{$company->phone_no}}</li>
                        <li> Mobile Number <i class="fa fa-mobile text-green" aria-hidden="true"></i> :- {{$company->mobile_no}}</li>
                        <li>Email <i class="fa fa-envelope text-green" aria-hidden="true"></i>:- {{$company->email}}</li>
                    </td>
                    <td>
                        <li>Country <i class="fa  fa-map-pin text-green" aria-hidden="true"></i> :- {{$company->country_name}}</li>
                        <li>State <i class="fa  fa-map-pin text-green" aria-hidden="true"></i> :- {{$company->state_name}}</li>
                        <li>City <i class="fa  fa-map-pin text-green" aria-hidden="true"></i> :- {{$company->city_name}}</li>
                        <li>Address <i class="fa fa-map text-green" aria-hidden="true"></i> :- {{$company->address}}</li>
                    </td>
                    <td>{{$company->created_at?$company->created_at->diffForHumans():''}}</td>
                    <td>{{$company->updated_at?$company->updated_at->diffForHumans():''}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('company.edit',$company->id) }}" class="edit-model btn btn-warning btn-sm " ><i class="fa fa-edit"></i></a>
                                <button class="delete-model btn btn-danger btn-sm " type="button" onclick="deleteGallery({{ $company->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $company->id }}" action="{{ route('company.destroy',$company->id) }}" method="POST" style="display: none;">
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
@endpush
@yield('js')
