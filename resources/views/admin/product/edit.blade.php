@extends('adminlte::page')

@section('title', 'Edit Product')

@section('content')
<section>
    <section class="content-header">
        <div class="header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-right">
                        <a href="{{route('products.index')}}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
      <section class="content">
        <div class="box box-danger">
          <div class="box-header">
            <h3 class="box-title">Edit Product</h3>
          </div>
          <div class="box-body">
            <div class="row">
                <div class="centered col-md-12 col-md-offset-4">
        {!! Form::model($product,array('route' => ['products.update', $product->id], 'class' => 'form-horizontal','method'=>'PATCH','enctype' => 'multipart/form-data','id'=>'')) !!}
        <div class="patient-form-section">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                        {!! Html::decode(Form::label('name', 'Name <span class="required">*</span>', ['class' => 'control-label'])) !!}
                                        <div>
                                            {!! Form::text('name', null, ['class' => 'form-control','maxlength'=>'255', 'readonly']) !!}
                                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('serial_number') ? 'has-error' : ''}}">
                                        {!! Html::decode(Form::label('serial_number','Serial Number<span class="required">*</span>', ['class' => ' control-label'])) !!}
                                        <div>
                                            {!! Form::text('serial_number', null, ['class' => 'form-control','maxlength'=>'128',"placeholder" => "Serial Number"]) !!}
                                            {!! $errors->first('serial_number', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                        {!! Html::decode(Form::label('description', 'Description <span class="required">*</span>', ['class' => 'control-label'])) !!}
                                        <div>
                                            {!! Form::textarea('description', null, ['class' => 'form-control','maxlength'=>'2048']) !!}
                                            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <div class="form-button-container text-center mt-4 mb-4">
            <!-- <a href="#" class="btn btn-default">Cancel</a> -->
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
        <div class="form-note">
            <label class="text-primary">Note:</label>
            <label class="text-grey"><span class="text-danger">*</span>Marked fields are required.</label>
        </div>
        {!! Form::close() !!}
    </div>
    </section>
</section>
@endsection
@push('js')
@endpush
@yield('js')
