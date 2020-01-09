@extends('adminlte::page')

@section('title', 'User Profile')

@section('content')

<section class="content">

        <div class="row">
                @php
                $usercompany = \App\Traits\CommonTrait::getUserCompany($user->id);
                $usersubcompany = \App\Traits\CommonTrait::getUserSubCompany($user->id);
            @endphp
          <!-- /.col -->
          {{-- @include('admin.alertToastrMessage') --}}
          <div class="col-md-9">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li  @if( Request::get('tab')=="password")) class="" @else class="active"@endif><a href="#profile" data-toggle="tab" aria-expanded="true">Profile</a></li>
                <li @if( Request::get('tab')=="password")) class="active" @else class=""@endif><a href="#password" data-toggle="tab" >Password</a></li>
              </ul>
              <div class="tab-content">

                <div id="profile" @if( Request::get('tab')=="password")) class="tab-pane" @else class="tab-pane active"@endif>
                  <!-- The timeline -->
                  <form class="form-horizontal">
                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Name</label>

                      <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" value ="{{$user->name}}" placeholder="Name" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" value="{{$user->email}}" placeholder="Email" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Company</label>

                      <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" value ="{{$usercompany}}" placeholder="Name" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">SubCompany</label>

                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" value ="{{$usersubcompany}}" placeholder="Name" readonly>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                      <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                      <div class="col-sm-10">
                        <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                      </div>
                    </div> --}}

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-danger" disabled>Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
{{-- {{dd(Request::get('tab'))}} --}}
                <div  id="password" @if( Request::get('tab')=="password")) class="tab-pane active" @else class="tab-pane"@endif>
                    <form class="form-horizontal" method="POST" action="{{route('password.update')}}" enctype="multi/form-data" id="userPasswordForm">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="old_password" class="col-sm-2 control-label">Old Password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="old_password" id="old_password" value=""placeholder="Enter Old Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">New Password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="password" id="password" value=""placeholder="Enter New Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password" class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="confirm_password" id="confirm_password" value=""placeholder="Enter New Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-danger">Update </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </section>
@endsection
@push('js')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {{-- {!! JsValidator::formRequest('App\Http\Requests\User\UpdatePasswordRequest', '#userPasswordForm') !!} --}}
@endpush
@yield('js')
