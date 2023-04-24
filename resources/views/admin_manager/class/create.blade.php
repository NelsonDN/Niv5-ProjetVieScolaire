@extends('layouts.app_manager')


@section('style')
<!-- Favicon -->
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
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/datepicker.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('asset/style.css')}}">
    <!-- Modernize js -->
    <script src="{{asset('asset/js/modernizr-3.6.0.min.js')}}"></script>
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
 <script src="{{asset('asset/js/datepicker.min.js')}}"></script>
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
    var nbre = 1 ;
    
    $(btn).click(function(e){
        i++;
        var add = "<div class='row new'><div class='col-xl-4 col-lg-6 form-group'><label>Select Matiere *</label><select name='matiere[]' value='{{old('matiere.*')}}' style='background-color: #f0f1f3;height: 50px; width:100%; border:none;border-radius: 4px;'><option selected>select</option>@foreach($matieres as $matiere)<option  value='{{$matiere->id}}'>{{$matiere->nom}}</option>@endforeach]</select>@error('matiere.*')<span class='form-text text-muted mr-5' role='alert'><strong class='text-danger'>{{ $message }}</strong></span>@enderror</div><div class='col-xl-4 col-lg-6 form-group'><label>Entrez le coefficient de la matière</label><input value='{{old('coef.*')}}' type='number' min='1' name='coef[]' placeholder='Entrez le coefficient de la matière' class='form-control'>@error('coef.*')<span class='form-text text-muted mr-5' role='alert'><strong class='text-danger'>{{ $message }}</strong></span>@enderror</div><div class='col-xl-4 col-lg-6 col-12 form-group'><label>@lang('Select Period') *</label><select name='periode[]' class='select2' multiple required><option disabled value='multiselect'>@lang('Please Select period') *</option>@foreach($jour_periodes as $value)<option value='"+nbre+",{{$value->id}}'>{{App\Models\Jour::findOrFail($value->jour_id)->jour}} ( {{App\Models\Periode::findOrFail($value->periode_id)->heure_debut}} // {{App\Models\Periode::findOrFail($value->periode_id)->heure_fin}} )</option>@endforeach</select>@error('periode.*')  <span class='form-text text-muted' role='alert'><strong class='text-danger'>{{ $message }}</strong></span>@enderror</div></div>";
        e.preventDefault();
        var result = section.children('.new')[0].outerHTML;
        section.append(add);
        nbre = nbre + 1;
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

$(document).ready(function() {
$('.mdb-select').materialSelect();
});
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
                            <a href="{{ route('dashboard_manage.class.index') }}">@lang('Home')</a>
                        </li>
                        <li>@lang('Add New Class')</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Add Class Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>@lang('Add New Class')</h3>
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
                        <form class="new-added-form" method="POST" action="{{ route('dashboard_manage.class.store')}}" enctype="multipart/form-data">
                        @csrf
                        @include('admin_manager.flash-message')
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-12 form-group">
                                    <label>@lang('class Name') *</label>
                                    <input value="{{old('nom')}}" name="nom" type="text" placeholder="" class="form-control">
                                    @error('nom')
                                        <span class="form-text text-muted mr-5" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-xl-4 col-lg-4 col-12 form-group">
                                    <label>@lang('Nombres limite élèves')</label>
                                    <input value="{{old('limite')}}" type="number" min="1" name="limite" placeholder="Entrez le nombres limite d'élèves" class="form-control">
                                    @error('limite')
                                        <span class="form-text text-muted mr-5" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div value="{{old('cycle')}}" class="col-xl-4 col-lg-4 col-12 form-group">
                                    <label>@lang('Select Cycle') *</label>
                                    <select name="cycle" style="background-color: #f0f1f3;height: 50px; width:100%; border:none;border-radius: 4px;">
                                        
                                        @foreach($cycles as $cycle)
                                            <option value="{{$cycle->id}}">{{$cycle->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('cycle')
                                        <span class="form-text text-muted mr-5" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                </div>  
                            </div>      
                            <section id="elm">
                                <div class="new row">
                                            <div  class="col-xl-4 col-lg-6 form-group">
                                                <label>@lang('Select Matiere ')*</label>
                                                <select name="matiere[]"  style="background-color: #f0f1f3;height: 50px; width:100%; border:none;border-radius: 4px;">
                                                <option selected value="{{old('matiere.*')}}">@lang('select')</option>
                                                    @foreach($matieres as $matiere)
                                                        <option  value="{{$matiere->id}}">{{$matiere->nom}}</option>
                                                    @endforeach
                                                </select>
                                                @error('matiere.*')
                                                <span class="form-text text-muted mr-5" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                    <div class="col-xl-4 col-lg-6 form-group">
                                        <label>@lang('Enter the Coefficient of Subject')</label>
                                        <input value="{{old('coef.*')}}" type="number" min="1" name="coef[]" placeholder="Entrez le coefficient de la matière" class="form-control">
                                        @error('coef.*')
                                        <span class="form-text text-muted mr-5" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                        <label>@lang('Select Period') *</label>
                                        <select name="periode[]" class="select2" multiple required>
                                            <option disabled value="multiselect">@lang('Please Select period') *</option>
                                            @foreach($jour_periodes as $value)
                                                <option value="0,{{$value->id}}">
                                                {{App\Models\Jour::findOrFail($value->jour_id)->jour}} ( {{App\Models\Periode::findOrFail($value->periode_id)->heure_debut}} // {{App\Models\Periode::findOrFail($value->periode_id)->heure_fin}} )
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('periode.*')
                                            <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                </div>
                            </section>                                
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">@lang('Save')</button>
                                    <a href = "" title="Ajouter" id="plus" style="float: right;"><i style="color:white; background-color: #ffae01;border-color:#ffae01; border-radius:4px; border:none; font-weight:500px; padding:12px 15px;" class="fa fa-plus"></i></a>
                                    <a href = "" title="Retirer" id="minus" style="float: right; margin-right:5px;"><i style="color:white; background-color: #042954;border-color:#042954; border-radius:4px; border:none; font-weight:500px; padding:12px 15px;" class="fa fa-minus"></i></a>
                            
                        </form>
                    </div>
                </div>
                <!-- Add Class Area End Here -->
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
