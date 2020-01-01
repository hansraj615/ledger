@extends('adminlte::page')

@section('title', 'Show Permission')

@section('content')

    <section class="fortis-search-container">
        <div class="header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h1>Permission Details</h1>
                    </div>
                    <div class="float-right">
                        <a href="{{route('permissions.index')}}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="fortis-doctor-profile-container">
        <div class="fortis-content-box">
            <div class="fortis-doctor-name text-center pt-3">
                <label>{{ ucfirst($permission->display_name) }}</label><br />
                @permission('permission-edit')
                <a href="{{route('permissions.edit',$permission->id)}}" class="btn btn-primary">Edit</a>
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
                                                 <label class="form-value" data-value="{{$permission->display_name}}">{{$permission->display_name}}</label>
                                             </div>
                                         </div>--}}
                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <label class="text-grey form-label w-100">Permission Name <span class="float-right">:</span></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-value" data-value="{{$permission->name}}">{{$permission->name}}</label>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <label class="text-grey form-label w-100">Description <span class="float-right">:</span></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-value" data-value="{{$permission->description}}">{{ !empty($permission->description) ? $permission->description : '-'}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                   {{-- <div class="col-md-12">
                        <div class="panel panel-primary fortis-panel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="fortis-panel-header">Permissions</label>
                                    </div>

                                    <div class="col-md-12 editable-section">
                                        @foreach($permission->permissions as $permission)

                                            <span class="label label-primary" style = "font-size:13px;">{{ $permission->display_name }}</span>

                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>

@endsection