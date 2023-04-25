@extends('layouts.app_manager')


@section('style')
<link rel="shortcut icon" type="image/x-icon" href="{{asset('asset/img/favicon.png')}}">
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
<!-- Animate CSS -->
<link rel="stylesheet" href="{{asset('asset/css/animate.min.css')}}">
<!-- Select 2 CSS -->
<link rel="stylesheet" href="{{asset('asset/css/select2.min.css')}}">
<!-- Data Table CSS -->
<link rel="stylesheet" href="{{asset('asset/css/jquery.dataTables.min.css')}}">
<!-- Custom CSS -->
<link rel="stylesheet" href="{{asset('asset/style.css')}}">
<!-- Modernize js -->
<script src="{{asset('asset/js/modernizr-3.6.0.min.js')}}"></script>
<script src = "https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
 <!-- Scroll Up Js -->
 <script src="{{asset('asset/js/jquery.scrollUp.min.js')}}"></script>
 <!-- Data Table Js -->
 <script src="{{asset('asset/js/jquery.dataTables.min.js')}}"></script>
 <!-- Custom Js -->
 <script src="{{asset('asset/js/main.js')}}"></script>
    <script type="application/javascript">

        function deleteItem(e){

            let id = e.getAttribute('data-id');

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed){

                        $.ajax({
                            type:'DELETE',
                            url:'{{url("Sections")}}/' +id,
                            data:{
                                "_token": "{{ csrf_token() }}",
                            },
                            success:function(data) {
                                if (data.success){
                                    swalWithBootstrapButtons.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        "success"
                                    );
                                    $("#"+id+"").remove(); // you can add name div to remove
                                    
                                }

                            }
                        });
                        location.reload();

                    }

                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Clicked ok to cancel :)',
                        'error'
                    );
                }
            });

        }

    </script>
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
                    <h3>@lang('Permissions')</h3>
                    <ul>
                        <li>
                            <a href="index.html">@lang('Home')</a>
                        </li>
                        <li>@lang('Permissions')</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- All Subjects Area Start Here -->
                <div class="row">
                    <div class="col-4-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>@lang('Add New permission')</h3>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                            aria-expanded="false">...</a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-times text-orange-red"></i>@lang('Close')</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-cogs text-dark-pastel-green"></i>@lang('Edit')</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-redo-alt text-orange-peel"></i>@lang('Refresh')</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <form class="new-added-form" method="POST" action="{{route('permissions.update', $permission->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    @include('admin_manager.flash-message')
                                    <div class="row">
                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>@lang('Name *')</label>
                                            <input type="text" value="{{$permission->name}}" name="name" placeholder="" class="form-control">
                                        </div>
                                        <div class="col-12 form-group mg-t-8">
                                        @error('name')
                                            <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                        @enderror
                                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">@lang('Save')</button>
                                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">@lang('Reset')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- All Subjects Area End Here -->
                <footer class="footer-wrap-layout1">
                    <div class="copyright">© @lang('Copyrights') <a href="#">akkhor</a> 2019. @lang('All rights reserved'). @lang('Designed by') <a
                            href="#">PsdBosS</a></div>
                </footer>
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
@endsection
