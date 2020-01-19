@extends('adminlte::page')

@section('title', 'Create Company')
@push('css')

@endpush
@section('content')

<section>
      <!-- Main content -->
      <section class="content">
            <div class="box box-danger">
              <div class="box-header">
                <h3 class="box-title">Create Stock</h3>
              </div>
              <div class="box-body">
                <div class="row">
                <form class="form" action="{{route('admin.subcompanystock.store')}}" method="POST">
                        {{csrf_field()}}
                    <div class="col-md-12">
                        <div class="col-lg-3">

                            <div class="form-group">
                              <label for="name">SubCompany Name</label>
                              <select name="subcompanyname" class="form-control select2" id="">
                                <option value="">Select Sub Comany</option>
                                @foreach($subcomanystock as $key=>$value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                              </select>
                              <small id="helpId" class="text-muted">Help text</small>
                            </div>
                          </div>
                  <div class="col-lg-3">

                    <div class="form-group">
                      <label for="name">Opening Balance</label>
                      <input type="text" name="opening_balance" id="opening_balance" class="form-control" placeholder="" aria-describedby="helpId">
                      <small id="helpId" class="text-muted">Help text</small>
                    </div>
                  </div>

                <button type="submit" class="btn btn-success center-block">Submit</button>
            </form>
            </div>

              </div>
              <!-- /.box-body -->
            <!-- /.box -->
          <!-- /.col (right) -->
        </div>

    </div>
        <!-- /.row -->

      </section>
      <!-- /.content -->
    <!-- /.content -->
</section>
@endsection

@push('js')

  <script>
    $(function () {

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()

    })
  </script>


@endpush
@yield('js')
