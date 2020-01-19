@extends('adminlte::page')

@section('title', 'Edit SubCompany')
@push('css')

@endpush
@section('content')

<section>
      <!-- Main content -->
      <section class="content">
        <!-- /.box -->
            <div class="box box-danger">
              <div class="box-header">
                <h3 class="box-title">Edit Company Stock</h3>
              </div>
              <div class="box-body">
                <div class="row">
                <form class="form" action="{{route('admin.subcompanystock.store')}}" method="POST">
                        {{csrf_field()}}
                    <div class="col-md-12">
                        <div class="col-lg-3">

                            <div class="form-group">
                              <label for="name">SubCompany Name</label>
                              <input type="text" name="subcompany_name" id="name" value= "{{$subcompanystock->subcompany->name}}" class="form-control" placeholder="" aria-describedby="helpId" autocomplete="off" disabled>
                              <small id="helpId" class="text-muted">Help text</small>
                            </div>
                          </div>
                          <input type="hidden" name="edit" value="{{$subcompanystock->id}}">
                        <input type="hidden" name="subcompanyname" value="{{$subcompanystock->subcompany_id}}">
                <div class="col-md-3">
                <div class="form-group">
                  <label>Opening Balance:</label>
                    <input type="number" id="opening_balance" name="opening_balance" class="form-control" value= "{{$subcompanystock->opening_balance}}" >
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
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
