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
                url:'{{url("Cycles")}}/' +id,
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
                    <h3> Textbook -->  {{$classe->nom}} </h3>
                    <ul>
                        <li>
                            <a href="{{ route('dashboard_manage.class.index') }}">@lang('Home')</a>
                        </li>
                        <li>@lang('Textbook class')  </li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Class Table Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>@lang('All details') </h3>
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
                            @include('admin_manager.flash-message')
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
                                        <th>@lang('Subject Name')</th>
                                        <th>@lang('Teacher Name')</th>
                                        <th>@lang('Type of lesson')</th>
                                        <th>@lang('Title')</th>
                                        <th>@lang('Content')</th>
                                        <th>@lang('Attachments')</th>
                                        <th>@lang('Homework')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($classe_matieres as $classe_matiere)
                                        @php
                                            $cahier_de_textes = App\Models\Cahierdetexte::where('classe_matiere_id', $classe_matiere->id)->get();
                                            foreach($cahier_de_textes as $cahier_de_texte){
                                        @endphp
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input">
                                                        <label class="form-check-label">{{$loop->index+1}}</label>
                                                    </div>
                                                </td>
                                                <td>
        {{ App\Models\Matiere::findOrFail($classe_matiere->matiere_id)->nom }}
                                                </td>
                                                <td>
        {{ App\Models\User::findOrFail($classe_matiere->user_id)->name }}
                                                </td>
                                                <td>
        {{App\Models\Typedecour::findOrFail($cahier_de_texte->typedecour_id)->nom }}
                                                </td>
                                                <td>
        {{ $cahier_de_texte->titre }}
                                                </td>
                                                <td>
        {{ $cahier_de_texte->contenu }}
                                                </td> 
                                                <td>
        @if($cahier_de_texte->piece_jointe)      
        @php $pj = explode('/', $cahier_de_texte->piece_jointe);  @endphp                                      
         <a href="{{route('dashboard_manage.downloadattachment', ['attachment_name' =>$pj[1] ]) }}" >   {{ $cahier_de_texte->piece_jointe }} </a>
        @else
        <p>No attachment</p>
        @endif
    </td>
                                                <td>
                                                    @php 
                                                        $exercices = App\Models\Exercice::where('cahierdetexte_id', $cahier_de_texte->id)->get();
                                                    @endphp
                                                    <ul>
                                                        @foreach( $exercices as $exercice )

                                                        <li>{{$exercice->titre}}</li>

                                                        @endforeach
                                                    </ul>                                                    
                                                </td>
                                            </tr>
                                        @php } @endphp
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
