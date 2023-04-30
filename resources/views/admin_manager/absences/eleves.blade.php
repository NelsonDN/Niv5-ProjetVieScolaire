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
                    <h3>Note de {{ $matiere_->nom}} dans la classe de {{ $classe_->nom }}</h3>
                    <ul>
                        <li>
                            <a href="{{ route('dashboard') }}">@lang('Home')</a>
                        </li>
                        <li>{{ $classe_->nom }}</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Class Table Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Evaluation de {{ $evaluation_->name }} </h3>
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
                        <form class="mg-b-20" action="{{ route('dashboard_manage.notes.indexEleves') }}" method="POST">
                            @csrf
                            <div class="row gutters-8">
                                <div class="col-3-xxxl col-xl-2 col-lg-3 col-3 form-group">
                                    <select name="evaluation" style="background-color: #f0f1f3;height: 50px; width:100%; border:none;border-radius: 4px;"  class="form-control">
                                        <option selected>@lang('Select evaluation')</option>
                                        @foreach($evaluations as $evaluation)
                                            <option value="{{$evaluation->id}}">{{$evaluation->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('evaluation')
                                    <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-3-xxxl col-xl-2 col-lg-3 col-3 form-group">
                                    <select name="classe" style="background-color: #f0f1f3;height: 50px; width:100%; border:none;border-radius: 4px;"  class="form-control">
                                        <option selected>@lang('Select classe')</option>
                                        @foreach($classes as $classe)
                                            <option value="{{$classe->id}}">{{$classe->nom}}</option>
                                        @endforeach
                                    </select>
                                    @error('classe')
                                    <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-3-xxxl col-xl-2 col-lg-3 col-3 form-group">
                                    <select name="matiere" style="background-color: #f0f1f3;height: 50px; width:100%; border:none;border-radius: 4px;"  class="form-control">
                                        <option selected>@lang('Select matiere')</option>
                                        @foreach($matieres as $matiere)
                                            <option value="{{$matiere->id}}">{{$matiere->nom}}</option>
                                        @endforeach
                                    </select>
                                    @error('matiere')
                                    <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-1-xxxl col-xl-2 col-lg-3 col-3 form-group">
                                    <button type="submit" class="btn btn-fill-lg bg-blue-dark btn-hover-yellow">@lang('SEARCH')</button>
                                </div>
                                @include('admin_manager.flash-message')
                            </div>
                        </form>

                        <form class="mg-b-20" action="{{ route('dashboard_manage.notes.update', $evaluation->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="table-responsive">
                                <table class="table display data-table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>@lang('Name')</th>
                                            <th>@lang('Pename')</th>
                                            {{-- <th>@lang('Matières')</th> --}}
                                            <th>@lang('Evaluation')</th>
                                            <th>@lang('Note ')</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($notes as $note)   
                                    
                                        <tr>
                                            <input type="hidden" value="{{ $matiere_->id }}" name="matiere_"/>
                                            <input type="hidden" value="{{ $evaluation_->id }}" name="evaluation_"/>
                                            <input type="hidden" value="{{ $classe_->id }}" name="classe_"/>
                                            <input type="hidden" value="{{ $note->id }}" name="note_id[]"/>
                                            <input type="hidden" value="{{ $note->eleve->id }}" name="eleve_id[]"/>
                                            <td>{{$note->eleve->name }}</td>
                                            <td>{{$note->eleve->prename }}</td>
                                            {{-- <td>{{$matiere->nom }}</td> --}}
                                            <td>{{ $note->evaluation->name  }}</td>
                                            <td><input type="text" name="note[]" value="{{ $note->note }}" /></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn-fill-lg mt-4 btn-gradient-yellow btn-hover-bluedark">@lang('Modifier')</button>
                        </form>
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
