@extends('layouts.app_manager')


@section('style')

<link rel="stylesheet" href="{{asset('asset/css/normalize.css')}}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/main.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/all.min.css')}}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{asset('asset/fonts/flaticon.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/animate.min.css')}}">
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/select2.min.css')}}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/datepicker.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('asset/style.css')}}">
    <!-- Modernize js -->
    <script src="{{asset('asset/js/modernizr-3.6.0.min.js')}}"></script>
    
@endsection
@section('content')
<div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
       <!-- Header Menu Area Start Here -->
            @include('layouts.nav')
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            @include('layouts.menu')
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>User</h3>
                    <ul>
                        <li>
                            <a href="index.html">@lang('Home')</a>
                        </li>
                        <li>@lang('Add New User')</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Add New Teacher Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>@lang('Add New User')</h3>
                            </div>
                           <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" 
                                data-toggle="dropdown" aria-expanded="false">...</a>
        
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>@lang('Close')</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>@lang('Edit')</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>@lang('Refresh')</a>
                                </div>
                            </div>
                        </div>
                        <form class="new-added-form" method="POST" action="{{ route('users.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-left">@lang('Avatar')</label>
                                <div class="col-lg-9 col-xl-9">
                                    <div style="width: 120px;height: 120px;border-radius: 0.42rem;background-repeat: no-repeat;background-size: cover;border: 3px solid #ffffff; -webkit-box-shadow: 0 0.5rem 1.5rem 0.5rem rgb(0 0 0 / 8%); box-shadow: 0 0.5rem 1.5rem 0.5rem rgb(0 0 0 / 8%);" class="image-input image-input-outline" id="kt_user_add_avatar">
                                        <div class="image-input-wrapper" style="background-image: url({{asset('assets/media/users/100_6.jpg')}}"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                        <i style="position: absolute;right: 620px;top: -0.4px;"class="fa fa-pen icon-sm text-muted"></i>
                                            <input style="display: none;" type="file" placeholder="@lang('choose file')" name="avatar" id="avatar" class="@error('avatar') is-invalid @enderror" accept=".png, .jpg, .jpeg" value="
                                            {{old('avatar')}}">
                                        </label>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                    @error('avatar')
                                        <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                    <span class="form-text text-muted" role="alert"><strong class="text-danger avatar" ></strong></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-6 col-12 form-group">
                                    <label>@lang('Name') *</label>
                                    <input type="text" value="{{old('name')}}" name="name" placeholder="" class="form-control">
                                    @error('name')
                                    <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                    <span class="form-text text-muted" role="alert"><strong class="text-danger avatar" ></strong></span>
                                <div class="col-xl-4 col-lg-6 col-12 form-group">
                                    <label>Email *</label>
                                    <input type="email" value="{{old('email')}}" name="email" placeholder="" class="form-control">
                                    @error('email')
                                        <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                </div>  
                                <div class="col-xl-4 col-lg-6 col-12 form-group">
                                    <label>@lang('Password ')*</label>
                                    <input type="password"  name="password" placeholder="" class="form-control">
                                    @error('password')
                                        <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-xl-4 col-lg-6 col-12 form-group">
                                    <label>@lang('Confirm Password') *</label>
                                    <input type="password" name="password_confirmation" placeholder="" class="form-control">
                                </div>
                                    <span class="form-text text-muted" role="alert"><strong class="text-danger avatar" ></strong></span>
                                <div class="col-xl-4 col-lg-6 col-12 form-group">
                                    <label>@lang('Status') *</label>
                                    <select name="active" class="select2"  required>
                                        <option disabled value=" ">@lang('Please Select state') *</option>
                                        <option value="1">@lang('Yes')</option>
                                        <option value="0">@lang('No')</option>
                                    </select>
                                    @error('active.*')
                                        <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-xl-4 col-lg-6 col-12 form-group">
                                    <label>@lang('Roles') *</label>
                                    <select name="roles[]" class="select2" multiple required>
                                        <option disabled value="multiselect">@lang('Please Select roles') *</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}"> {{ $role->name }}</option>
                                    @endforeach
                                    </select>
                                    @error('roles.*')
                                        <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">@lang('Save')</button>
                                    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">@lang('Reset')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Add New Teacher Area End Here -->
                <footer class="footer-wrap-layout1">
                    <div class="copyright">© @lang('Copyrights') <a href="#">akkhor</a> 2019. @lang('All rights reserved'). @lang('Designed by') <a href="#">PsdBosS</a></div>
                </footer>
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
@endsection
@section('script')
  <!-- jquery-->
  <script src="{{asset('asset/js/jquery-3.3.1.min.js')}}"></script>
    <!-- Plugins js -->
    <script src="{{asset('asset/js/plugins.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('asset/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('asset/js/bootstrap.min.js')}}"></script>
    <!-- Select 2 Js -->
    <script src="{{asset('asset/js/select2.min.js')}}"></script>
    <!-- Date Picker Js -->
    <script src="{{asset('asset/js/datepicker.min.js')}}"></script>
    <!-- Smoothscroll Js -->
    <script src="{{asset('asset/js/jquery.smoothscroll.min.html')}}"></script>
    <!-- Scroll Up Js -->
    <script src="{{asset('asset/js/jquery.scrollUp.min.js')}}"></script>
    <!-- Custom Js -->
    <script src="{{asset('asset/js/main.js')}}"></script>
@endsection
