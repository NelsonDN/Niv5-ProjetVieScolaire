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
                url:'{{url("class")}}/' +id,
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

function classe(e){

let matieres = e.getAttribute('data-matiere');
let nom_classe = e.getAttribute('data-name');

const swalWithBootstrapButtons = Swal.mixin({
    // customClass: {
        
    // },
});

swalWithBootstrapButtons.fire({
    title: 'The subjects of the class ' + nom_classe +' are',
    text: matieres,
    icon: 'info',
    showCancelButton: false,
    showconfirmButton: false,
})
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
                    <h3>Classes</h3>
                    <ul>
                        <li>
                            <a href="{{ route('dashboard_manage.textbookTeacher.index') }}">@lang('Home')</a>
                        </li>
                        <li>@lang('All Classes') --> Teacher : {{ auth()->user()->name }}</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Class Table Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>@lang('All Classes') --> Teacher : {{ auth()->user()->name }}</h3>
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
                                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                @include('admin_manager.flash-message')
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table display data-table text-nowrap">
                                <thead>
                                    <tr>
                                        <th> 
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input checkAll">
                                                <label class="form-check-label">ID</label>
                                            </div>
                                        </th>
                                        <th>@lang('Class')</th>
                                        <th>@lang('Subjects')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($classes as $classe)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input">
                                                <label class="form-check-label">#0021</label>
                                            </div>
                                        </td>
                                        <td>{{$classe->nom}}</td>
                                        
                                        <td>  <button style="border: none; background-color: #0056b3; border-radius: 4px; font-size: 14px; font-weight: 600; color: #ffffff; letter-spacing: 1px; padding: 10px; cursor: pointer; z-index: 9;" class="btn btn-sm btn-clean btn-icon  delete"
                                                    title="Voir le cahier de texte {{$classe->nom}}"><a href="{{route('dashboard_manage.textbookTeacher.show', $classe->id)}}" > @lang('Textbook ') </a></button>
                                        </td>
                                    </tr>
                                     @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Class Table Area End Here -->
                <footer class="footer-wrap-layout1">
                    <div class="copyright">© @lang('Copyrights') <a href="#">akkhor</a> 2019.@lang(' All rights reserved'). @lang('Designed by') <a href="#">PsdBosS</a></div>
                </footer>
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
@endsection


<!-- LOL -->
