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
                url:'{{url("textbook")}}/' +id,
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
                    <h3> Textbook -->  {{auth()->user()->name}} </h3>
                    <ul>
                        <li>
                            <a href="{{ route('dashboard_manage.textbookTeacher.index') }}">@lang('Home')</a>
                        </li>
                        <li> {{auth()->user()->name}} @lang('teacher class textbook')  </li>
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
                                        <th>@lang('Type of lesson')</th>
                                        <th>@lang('Title')</th>
                                        <th>@lang('Content')</th>
                                        <th>@lang('Attachments')</th>
                                        <th>@lang('Homework')</th>
                                        <th>@lang('Delete')</th>
                                        <th>@lang('Actions')</th>
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
         <a href="{{route('dashboard_manage.downloadattachment', ['attachment_name' =>$pj[1] ]) }}" > Download </a>
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

                                                        <li>{{$exercice->contenu}}</li>

                                                        @endforeach
                                                    </ul>                                                    
                                                </td>
                                                <td>
                                                        <a href="#" class="btn btn-danger" onclick="if (confirm('Voulez-vous vraiment supprimer le cahier de  {{ $cahier_de_texte->titre }}__ ?')){document.getElementById('form-{{$cahier_de_texte->id}}').submit()}" >@lang('Delete')</a>
                                                            <form id="form-{{$cahier_de_texte->id}}" method="post" action ="{{ route('dashboard_manage.textbookTeacher.destroy', ['textbookTeacher'=> $cahier_de_texte->id])}}">
                                                            @csrf
                                                            @method('DELETE')
                                                                <input type="hidden" name="_method" value="delete">
                                                            </form> 
                                                    </td>
                                                <td>
                                                <a href="{{ route('dashboard_manage.textbookTeacher.edit', $cahier_de_texte->id)}}"
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
                                                    </svg>
                                                </span>
                                            </a>
                                            <a href="{{ route('dashboard_manage.textbookTeacher.destroy', $cahier_de_texte->id)}}"
                                                                title="Delete"> 
                                                                @method('DELETE')
                                                                @method('DELETE')
                                                                <span class="svg-icon svg-icon-danger svg-icon-md"> <svg
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
                                                            </a> 

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
