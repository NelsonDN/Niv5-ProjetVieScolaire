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
<!-- select2 -->
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

    <script>
        $(document).ready(function(){
            let btn = $('#plus');
            let section = $('#elm');
            let minus = $('#minus');
            minus.hide();

            var i;
            // var add = "<div class='row' id='elm'><div class='col-12-xl col-lg-6 col-12 form-group'><label>Teachings Name *</label><input type='text' value='{{old('name.*')}}' name='name' placeholder='' class='form-control'></div><div class='col-12 form-group mg-t-8'>@error('name.*')<span class='form-text text-muted mr-5' role='alert'><strong class='text-danger'>{{ $message }}</strong></span>@enderror";
            $(btn).click(function(e){
                i++;
                e.preventDefault();
                var result = section.children('.row')[0].outerHTML;
                section.append(result);
                minus.show();
            })

        

            $(minus).click(function(e){
                // i--;
                e.preventDefault();
                $result = $('#elm').children();
                $result.last().remove();
                if($result.length < 3){
                    minus.hide();
                    console.log($result.length);
                }
                // console.log($result.length);
                
            })
        })

    </script>
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
                            url:'{{url("subject")}}/' +id,
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
                    <h3>@lang('Periods')</h3>
                    <ul>
                        <li>
                            <a href="{{route('dashboard_manage.period.index')}}">@lang('Home')</a>
                        </li>
                        <li>@lang('Periods')</li>
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
                                        <h3>@lang('Add New Period')</h3>
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
                                <form class="new-added-form" method="POST" action="{{route('dashboard_manage.periode.demi_store')}}" enctype="multipart/form-data">
                                    @csrf
                                    {{-- @method('POST') --}}
                                    @include('admin_manager.flash-message')
                                    <section id="elm" class="mb-4" >
                                        <div class="row">
                                            <div class="col-xl-5 col-lg-9 col-12 form-group">
                                                <label>@lang('Days ') *</label>
                                                <select name="jour[]" class="select2" multiple required>
                                                    <option disabled value="multiselect">@lang('Please Select Day') *</option>
                                                @foreach($jours as $jour)
                                                    <option value="{{$jour->id}}">
                                                        {{$jour->jour}}
                                                    </option>
                                                @endforeach
                                                </select>
                                                @error('jour.*')
                                                    <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="col-6-xxxl col-lg-9 col-12 form-group">
                                                <label>@lang('The day starts at') *</label>
                                                <input value="{{old('starttime')}}" name="starttime" type="time" placeholder="" class="form-control">
                                                @error('starttime')
                                                <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="col-6-xxxl col-lg-3 col-12 form-group">
                                                <label>@lang('The day ends at') *</label>
                                                <input value="{{old('endtime')}}" name="endtime" type="time" placeholder="" class="form-control">
                                                @error('endtime')
                                                <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="col-6-xxxl col-lg-12 col-12 form-group">
                                                <label>@lang('Duration of a period of the day') *</label>
                                                <input value="{{old('duree_period')}}" name="duree_period" type="time" placeholder="" class="form-control">
                                                @error('duree_period')
                                                <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="col-6-xxxl col-lg-9 col-12 form-group">
                                                <label>@lang('Number of breaks') *</label>
                                                <input value="{{old('nbre_pause')}}" name="nbre_pause" type="number" placeholder="" class="form-control">
                                                @error('nbre_pause')
                                                <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </section>
                                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">@lang('Save')</button>
                                        <!-- <a href = "" title="Ajouter" id="plus" style="float: right;"><i style="color:white; background-color: #ffae01;border-color:#ffae01; border-radius:4px; border:none; font-weight:500px; padding:12px 15px;" class="fa fa-plus"></i></a>
                                        <a href = "" title="Retirer" id="minus" style="float: right; margin-right:5px;"><i style="color:white; background-color: #042954;border-color:#042954; border-radius:4px; border:none; font-weight:500px; padding:12px 15px;" class="fa fa-minus"></i></a> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- All Subjects Area End Here -->
                <footer class="footer-wrap-layout1">
                    <div class="copyright">© @lang('Copyrights') <a href="#">akkhor</a> 2019.@lang(' All rights reserved'). @lang('Designed by') <a
                            href="#">PsdBosS</a></div>
                </footer>
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
@endsection
