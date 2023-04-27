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
                    <h3>@lang('All Classes')</h3>
                    <ul>
                        <li>
                            <a href="{{ route('dashboard_manage.eleves.create') }}">@lang('Home')</a>
                        </li>
                        <li>@lang('Classes')</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                <div class="row gutters-20">
                    @foreach ($classes as $classe)
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <a href="{{ route('dashboard_manage.class.show', $classe->id) }}">
                                    <div class="row align-items-center">
                                        <div class="col-6">     
                                            <div class="item-content">
                                                <div class="item-number "><strong>{{ $classe->nom }}</strong></div>
                                                <div class="item-title"><span>@php $nbre_eleves = App\Models\Eleve::where('classe_id', $classe->id)->count()  @endphp {{ $nbre_eleves }} /{{ $classe->limite_eleve }}</span></div>
                                            </div>  
                                        </div>
                                        <div class="col-6">
                                            <div class="item-icon bg-light-green ">
                                                <i class="flaticon-classmates text-green"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>      
                    @endforeach
                    {{-- <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-green ">
                                        <i class="flaticon-classmates text-green"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">@lang('Teachers')</div>
                                        <div class="item-number"><span class="counter" data-num=""></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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
