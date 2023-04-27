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
<!-- Data Table CSS -->
<link rel="stylesheet" href="{{asset('asset/css/jquery.dataTables.min.css')}}">
<!-- Custom CSS -->
<link rel="stylesheet" href="{{asset('asset/style.css')}}">
<!-- Modernize js -->
<script src="{{asset('asset/js/modernizr-3.6.0.min.js')}}"></script>
<script src = "https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection
@section('script')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script> --}}
    <script src="{{asset('asset/js/jquery-3.3.1.min.js')}}"></script>
    <!-- Plugins js -->
    <script src="{{asset('asset/js/plugins.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('asset/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('asset/js/bootstrap.min.js')}}"></script>
    <!-- Scroll Up Js -->
    <script src="{{asset('asset/js/jquery.scrollUp.min.js')}}"></script>
    <!-- Data Table Js -->
    <script src="{{asset('asset/js/jquery.dataTables.min.js')}}"></script>
    <!-- Custom Js -->
    <script src="{{asset('asset/js/main.js')}}"></script>

    {{-- <script>

        $(document).ready(function(){

            $('#formSubmit').click(function(e){

                e.preventDefault();

                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                    }

                });

                $.ajax({

                    url: "{{ url('/fathers') }}",

                    method: 'post',

                    data: {

                        name: $('#name').val(),

                        email: $('#email').val(),

                        password: $('#password').val(),

                    },

                    success: function(result){

                        if(result.errors)

                        {

                            $('.alert-danger').html('');


                            $.each(result.errors, function(key, value){

                                $('.alert-danger').show();

                                $('.alert-danger').append('<li>'+value+'</li>');

                            });

                        }

                        else

                        {

                            $('.alert-danger').hide();

                            $('#exampleModal').modal('hide');

                        }

                    }

                });

            });

        });

    </script> --}}

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
                            url:'{{url("eleves")}}/'+id,
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
                        'Your imaginary file is safe :)',
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
                    <h3>@lang('All Students') {{ $class->nom }}</h3>
                    <ul>
                        <li>
                            <a href="{{ route('dashboard_manage.eleves.index') }}">@lang('Home')</a>
                        </li>
                        <li>@lang('All Students')</li>
                        @include('admin_manager.flash-message')
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Teacher Table Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>@lang('All Students') of {{ $class->nom }}</h3>
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
                        <form class="mg-b-20">
                            <div class="row gutters-8">
                                <div class="col-6-xxxl col-xl-4 col-lg-6 col-12 form-group">
                                    
                                    <button type="submit" class="fw-btn-fill btn-gradient-yellow">
                                        <a class="fw-bold text-white" href="{{route('dashboard_manage.eleves.create')}}">    
                                        @lang('Add Student')
                                        </a>
                                    </button>
                                </div>
            
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table display data-table text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Pic</th>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Matricule')</th>
                                        <th>Birthday Date</th>
                                        <th>Phone</th>
                                        <th>Localisation</th>
                                        <th>Parents</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($eleves as $eleve)
                                        <tr>
                                            <td class="text-center"><img src=" {{ $eleve->avatar ? Storage::url($eleve->avatar) : asset('asset/img/figure/teacher.jpg') }}" width="10%" alt="student"></td>
                                            <td>{{$eleve->name}} {{$eleve->prename}}</td>
                                            <td>{{$eleve->matricule}}</td>
                                            <td>{{$eleve->date_naissance}}</td>
                                            <td>{{$eleve->telephone}}</td>
                                            <td>{{$eleve->localisation}}</td>
                                            <td>
                                                <button style="font-size: 1.5 rem;" type="button" class="btn btn-fill-lg bg-blue-dark btn-hover-yellow" data-toggle="modal" data-target="#formparent-{{ $eleve->id }}">
                                                    Add Parent
                                                </button> 
                                            </td>
                                            <td>
                                                <a href="{{ route('dashboard_manage.eleves.edit', $eleve->id)}}"
                                                    class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
                                                    <span class="svg-icon svg-icon-success svg-icon-md"> <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path
                                                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                                </path>
                                                                <rect fill="#000000" opacity="0.3" x="5" y="20"
                                                                    width="15" height="2" rx="1"></rect>
                                                            </g>
                                                        </svg> </span>
                                                </a>
                                                <button onclick="deleteItem(this)" data-id="{{ $eleve->id }}"  class="btn btn-sm btn-clean btn-icon  delete"
                                                    title="Delete"> 
                                                    <span class="svg-icon svg-icon-danger svg-icon-md"> 
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path
                                                            d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                            fill="#000000" fill-rule="nonzero"></path>
                                                            <path
                                                            d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                            fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg> 
                                                    </span>
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="formparent-{{ $eleve->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg"  role="document">
                                                <div class="modal-content">
                                                <div style="background-color: #042954;" class="modal-header border-bottom-0 btn-secondary">
                                                    <h5 style="color:white;" class="modal-title" id="exampleModalLabel">@lang('Add a Parent') of {{ $eleve->name }} {{ $eleve->prename }}</h5>
                                                    <button style="background-color: #042954;color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form name="YearForm" action="{{ route('dashboard_manage.fathers.store') }}" enctype="multipart/form-data"  method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="avatar">@lang('Avatar')</label>
                                                            <input  type="file" name="avatar" class="form-control" id="avatar" >
                                                            @error('avatar')
                                                                <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">@lang('Name')</label>
                                                            <input  type="text" name="name" class="form-control" id="name"  placeholder="@lang('Enter the name')">
                                                            @error('name')
                                                                <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">@lang('Email')</label>
                                                            <input type="hidden" name="eleve_id" value="{{ $eleve->id }}" class="form-control form-control-plaintext">
                                                            <input  type="email" name="email" class="form-control" id="email"  placeholder="@lang('Enter the email')">
                                                            @error('email')
                                                                <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="form-group col-6">
                                                                <label for="password">@lang('Password')</label>
                                                                <input type="password" name="password" class="form-control" id="password" placeholder="">
                                                                @error('password')
                                                                    <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label for="password_c">@lang('Confirm password')</label>
                                                                <input type="password" name="password_confirmation" class="form-control" id="paswword_c" placeholder="">
                                                            </div>
                                                        </div>
                                                        {{-- <div class="form-group row">
                                                            <div class="form-group col-6">
                                                                <label for="telephone">@lang('Telephone')</label>
                                                                <input type="text" name="telephone" class="form-control form-control-plaintext" id="telephone" placeholder="+237">
                                                                @error('telephone')
                                                                    <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label for="localisation">@lang('Localisation')</label>
                                                                <input type="text" name="localisation" class="form-control form-control-plaintext" id="localisation" placeholder="">
                                                                <input type="hidden" name="eleve_id" value="{{ $eleve->id }}" class="form-control form-control-plaintext">
                                                                @error('localisation')
                                                                    <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div> --}}
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
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Teacher Table Area End Here -->
                <footer class="footer-wrap-layout1">
                    <div class="copyright">© @lang('Copyrights') <a href="#">akkhor</a> 2019. @lang('All rights reserved'). @lang('Designed by') <a href="#">PsdBosS</a></div>
                </footer>
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
@endsection
  