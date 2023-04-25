@extends('layouts.app_admin')

@section('title') Ajouter un role @endsection

@section('content')
<div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li><a href="{{ route('roles.index') }}">Roles</a></li>
                                    <li class="active">Ajouter un role</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">

                <div class="row">

                    <div class="col-xs-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Ajouter un role</strong>
                            </div>
                            <form method="POST" action="{{ route('roles.store') }}">
                                @csrf
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label class=" form-control-label">Nom</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="menu-icon ti-direction-alt"></i></div>
                                            <input class="form-control" type="text" value="{{ old('name') }}"  name="name">
                                        </div>
                                        @error('name')
                                            <li style="color:red;">{{ $message }}</li>
                                        @enderror
                                        <div class="card-title">Permissions</div>
                                        <select data-placeholder="Assign permissions..." name="permissions[]" value="{{ old('permissions.*') }}" multiple class="standardSelect">
                                            <option value="" label="default"></option>
                                            @foreach($permissions as $permission)
                                                <option value="{{ $permission->id }}"  >{{ $permission->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('permissions.*')
                                            <li style="color:red;">{{ $message }}</li>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary offset-md-5 btn-lg" type="submit">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
  </div>


</div><!-- .animated -->
</div><!-- .content -->
@endsection