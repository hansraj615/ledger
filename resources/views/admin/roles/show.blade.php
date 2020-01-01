@extends('adminlte::page')

@section('title', 'Show Role')

@section('content')

    <section class="fortis-search-container">
        <div class="header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h1>Role Details</h1>
                    </div>
                    <div class="float-right">
                        <a href="{{route('roles.index')}}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="fortis-doctor-profile-container">
        <div class="fortis-content-box">
            <div class="fortis-doctor-name text-center pt-3">
                <label>{{ ucfirst($role->display_name) }}</label><br />
                @permission('role-edit')
                <a href="{{route('roles.edit',$role->id)}}" class="btn btn-primary">Edit</a>
                @endpermission
            </div>
            <div class="mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary fortis-panel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="fortis-panel-header">Details</label>
                                    </div>
                                    <div class="col-md-12 editable-section">
                                       {{-- <div class="row form-group">
                                            <div class="col-md-6">
                                                <label class="text-grey form-label w-100">Display Name <span class="float-right">:</span></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-value" data-value="{{$role->display_name}}">{{$role->display_name}}</label>
                                            </div>
                                        </div>--}}
                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <label class="text-grey form-label w-100">Role Name <span class="float-right">:</span></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-value" data-value="{{$role->name}}">{{$role->name}}</label>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <label class="text-grey form-label w-100">Description <span class="float-right">:</span></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-value" data-value="{{$role->description}}">{{ !empty($role->description) ? $role->description : '-'}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="panel panel-primary fortis-panel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="fortis-panel-header">Permissions</label>
                                    </div>

                                    <div class="col-md-12 editable-section">
                                      <ol>
                                        @foreach($role->permissions as $permission)
                                            <li class="float-left mt-2" style="width: 33%">{{ $permission->display_name }}</li>
                                        @endforeach
                                      </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
