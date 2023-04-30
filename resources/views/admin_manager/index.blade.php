@extends('layouts.app_manager')
@section('style')
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/normalize.css')}}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/main.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/all.min.css')}}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{asset('asset/fonts/flaticon.css')}}">
    <!-- Full Calender CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/fullcalendar.min.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/animate.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('asset/style.css')}}">
    <!-- Modernize js -->
    <script src="js/modernizr-3.6.0.min.js"></script>
@endsection
@section('script')
<script src="{{asset('asset/js/jquery-3.3.1.min.js')}}"></script>
    <!-- Plugins js -->
    <script src="{{asset('asset/js/plugins.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('asset/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('asset/js/bootstrap.min.js')}}"></script>
    <!-- Counterup Js -->
    <script src="{{asset('asset/js/jquery.counterup.min.js')}}"></script>
    <!-- Moment Js -->
    <script src="{{asset('asset/js/moment.min.js')}}"></script>
    <!-- Waypoints Js -->
    <script src="{{asset('asset/js/jquery.waypoints.min.js')}}"></script>
    <!-- Scroll Up Js -->
    <script src="{{asset('asset/js/jquery.scrollUp.min.js')}}"></script>
    <!-- Full Calender Js -->
    <script src="{{asset('asset/js/fullcalendar.min.js')}}"></script>
    <!-- Chart Js -->
    <script src="{{asset('asset/js/Chart.min.js')}}"></script>
    <!-- Custom Js -->
    <script src="{{asset('asset/js/main.js')}}"></script>
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
                    <h3>@lang('Dashboard')</h3>
                    <ul>
                        <li>
                            <a href="{{ route('accueil') }}">@lang('Home')</a>
                        </li>
                        <li><a href="{{ route('dashboard') }}">Panel {{ auth()->user()->name }}</a></li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard teachers Start Here -->

                {{-- DASHBOARD ADMIN SYSTEM --}}
                @can("access-admin")
                    <div class="row gutters-20">
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="item-icon bg-light-green ">
                                            <i class="flaticon-classmates text-green"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">Students</div>
                                            <div class="item-number"><span class="counter" data-num="{{ $users->count() }}"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan

                {{-- DASHBOARD MANAGER ETABLISHMENT --}}
                @can("access-manager")
                    <div class="row gutters-20">
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="item-icon bg-light-blue">
                                            <i class="flaticon-multiple-users-silhouette text-blue"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">@lang('Teachers')</div>
                                            <div class="item-number"><span class="counter" data-num="{{ $teachers->count() }}"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan

                {{-- DASHBOARD ENSEIGNANT --}}
                @can("access-teacher")
                    <div class="row gutters-20">
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <div class="text-center">
                                            <div class="text-black">@lang('Vie de classe')</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <a href="#" data-toggle="modal" data-target="#appeldeclasse">
                                <div class="dashboard-summery-one mg-b-20">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <div class="text-black">@lang('Appel de Classe')</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <div class="text-center">
                                            <div class="text-black">@lang('Sanctions')</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <a href="{{ route('dashboard_manage.textbookTeacher.index') }}">
                                <div class="dashboard-summery-one mg-b-20">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <div class="text-black">@lang('Cahier de Texte')</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <a href="#" data-toggle="modal" data-target="#evaluation">
                                <div class="dashboard-summery-one mg-b-20">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <div class="text-black">@lang('Remplir les notes')</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endcan
                <div class="modal fade" id="appeldeclasse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg"  role="document">
                        <div class="modal-content">
                        <div style="background-color: #042954;" class="modal-header text-center border-bottom-0 btn-secondary">
                            <h5 style="color:white;" class="modal-title text-center" id="exampleModalLabel">@lang('Evaluations')</h5>
                            <button style="background-color: #042954;color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div>
                            <form name="YearForm" action="{{ route('dashboard_manage.absences.data_prev') }}" enctype="multipart/form-data"  method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">@lang('Classes')</label>
                                        <select name="classe"  style="background-color: #f0f1f3;height: 50px; width:100%; border:none;border-radius: 4px;" class="select2">
                                            <option selected>@lang('select classe')</option>
                                                @foreach($classes as $classe)
                                                    <option value="{{$classe->id}}">{{$classe->nom}}</option>
                                                @endforeach
                                        </select>
                                        @error('classe')
                                        <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">@lang('Matieres')</label>
                                        <select name="matiere" style="background-color: #f0f1f3;height: 50px; width:100%; border:none;border-radius: 4px;" class="select2">
                                            <option selected>@lang('select matiere')</option>
                                                @foreach($matieres as $matiere)
                                                    <option value="{{$matiere->id}}">{{$matiere->nom}}</option>
                                                @endforeach
                                        </select>
                                        @error('matiere')
                                        <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="typedecour">@lang('Type de Seance')</label>
                                        <select name="typedecour" style="background-color: #f0f1f3;height: 50px; width:100%; border:none;border-radius: 4px;" class="select2">
                                            <option selected>@lang('select matiere')</option>
                                                @foreach($typedecours as $typedecour)
                                                    <option value="{{$typedecour->id}}">{{$typedecour->nom}}</option>
                                                @endforeach
                                        </select>
                                        @error('typedecour')
                                        <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0 d-flex justify-content-center">
                                    <button style="font-size: 2rem;background-color: #ffae01; border:none;" class="btn btn-secondary mr-4" class="close" data-dismiss="modal" title="@lang('Don\'t forget to submit your data before closing the modal.')">
                                    @lang('Close')
                                    </button>
                                    <button style="font-size: 2rem;background-color: #042954;border:none;" type="submit" id="formSubmit" class="btn btn-success">@lang('Submit ')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="evaluation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg"  role="document">
                        <div class="modal-content">
                        <div style="background-color: #042954;" class="modal-header text-center border-bottom-0 btn-secondary">
                            <h5 style="color:white;" class="modal-title text-center" id="exampleModalLabel">@lang('Evaluations')</h5>
                            <button style="background-color: #042954;color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div>
                            <form name="YearForm" action="{{ route('dashboard_manage.notes.data_prev') }}" enctype="multipart/form-data"  method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">@lang('Evaluations')</label>
                                        <select name="evaluation" style="background-color: #f0f1f3;height: 50px; width:100%; border:none;border-radius: 4px;" class="select2">
                                            <option selected>@lang('select evaluation')</option>
                                                @foreach($evaluations as $evaluation)
                                                    <option value="{{$evaluation->id}}">{{$evaluation->name}}</option>
                                                @endforeach
                                        </select>
                                        @error('evaluation')
                                        <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">@lang('Classes')</label>
                                        <select name="classe"  style="background-color: #f0f1f3;height: 50px; width:100%; border:none;border-radius: 4px;" class="select2">
                                            <option selected>@lang('select classe')</option>
                                                @foreach($classes as $classe)
                                                    <option value="{{$classe->id}}">{{$classe->nom}}</option>
                                                @endforeach
                                        </select>
                                        @error('classe')
                                        <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">@lang('Matieres')</label>
                                        <select name="matiere" style="background-color: #f0f1f3;height: 50px; width:100%; border:none;border-radius: 4px;" class="select2">
                                            <option selected>@lang('select matiere')</option>
                                                @foreach($matieres as $matiere)
                                                    <option value="{{$matiere->id}}">{{$matiere->nom}}</option>
                                                @endforeach
                                        </select>
                                        @error('matiere')
                                        <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0 d-flex justify-content-center">
                                    <button style="font-size: 2rem;background-color: #ffae01; border:none;" class="btn btn-secondary mr-4" class="close" data-dismiss="modal" title="@lang('Don\'t forget to submit your data before closing the modal.')">
                                    @lang('Close')
                                    </button>
                                    <button style="font-size: 2rem;background-color: #042954;border:none;" type="submit" id="formSubmit" class="btn btn-success">@lang('Submit ')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Social Media End Here -->
                <!-- Footer Area Start Here -->
                <footer class="footer-wrap-layout1">
                    <div class="copyright">© Copyrights <a href="#">akkhor</a> 2019. All rights reserved. Designed by <a
                            href="#">PsdBosS</a></div>
                </footer>
                <!-- Footer Area End Here -->
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
@endsection
