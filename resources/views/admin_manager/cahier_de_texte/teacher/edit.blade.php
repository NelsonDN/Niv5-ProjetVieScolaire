@extends('layouts.app_manager')


@section('style')


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
        function showStuff(id, text, btn) {
            if(document.getElementById(id).style.display == 'none'){
                document.getElementById(id).style.display = 'block';
            }else{
                document.getElementById(id).style.display = 'none';
            }
            // hide the lorem ipsum text
            document.getElementById(text).style.display = 'block';
            // hide the link
            btn.style.display = 'block';
        }
        


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
                    <h3>Textbook</h3>
                    <ul>
                        <li>
                            <a href="{{route('dashboard_manage.teacher_Schedule.index')}}">@lang('Home')</a>
                        </li>
                        <li>@lang('Add New Textbook')</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Add New Teacher Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>@lang('Add New Textbook')</h3>
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
                        <form action="{{ route('dashboard_manage.textbookTeacher.update', $cahier_de_texte->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @method('PUT')
                            <p style="background-color: thistle;">Vous etes ici :cahier de texte de --> </p> 
                            <div class="container">
                                <div class="row" style="background-color:whitesmoke ;">
                                    <div class="col-lg-4 col-md-sm-5 ">
                                    <button class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark"><a href="{{route('dashboard_manage.teacher_Schedule.index')}}" >Retour</a></button>
                                    </div>
                                    <div class="col-lg-4 col-md-sm-7">
                                        <p>Séance du {{ date('d-m-Y') }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-sm-12">
                                        <button  name="consulter_seances" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Consulter les Séances</button>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col">
                                        <label for="type">Type de cours:</label>
                                        <select  name="typedecour" id="type">
                                            <option value="{{old('typedecour')}}" disable >Select</option>
                                            @foreach($types as $type)
                                                <option @if($cahier_de_texte->typedecour_id == $type->id) selected @endif value="{{$type->id}}">{{$type->nom}}</option>
                                            @endforeach
                                        </select>
                                        @error('typedecour')
                                            <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="titre"> Titre</label>
                                        <input value="{{$cahier_de_texte->titre}}" name="titrecour" type="text">*
                                        @error('titrecour')
                                        <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div><br>
                                <div class="container" style="background-color: whitesmoke;">
                                    
                                    <div class="row" style="background-color:whitesmoke;">
                                        <div class="col">
                                            <label for="pieces">Piéces jointes  - ></label>
                                            <input type="file" value="{{$cahier_de_texte->piece_jointe}}" name ="piece_jointecour" placeholder="Ajouter une piece jointe">@if($cahier_de_texte->piece_jointe) '<span style="font-weight:bold; color:blue;">' fichier existant @else '</span>'  @endif
                                            <img id="img1" src="{{ Storage::url($cahier_de_texte->piece_jointe) }}" style="display:none;" />
                                            <embed id ="pdf1" src="{{ Storage::url($cahier_de_texte->piece_jointe) }}" type="application/pdf" width="100%" height="100%" style="display:none;">                                        
                                        </div>
                                        @php
                                            if($extension == "pdf"){
                                                $id ="pdf1";
                                            }else{
                                                $id = "img1";
                                            }
                                        @endphp
                                        @error('piece_jointecour')
                                            <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                        @enderror
                                    </div>                                         
                                </div><br/>
                                <a href = "" title="Ajouter un exercice" onclick="showStuff('{{$id}}', 'img', this); return false;" id="img" style="float: right;"><i style="color:white; background-color: #ffae01;border-color:#ffae01; border-radius:4px; border:none; font-weight:500px; padding:12px 15px;" >Voir</i></a>
                                <br/><br/>
                                <div class="row">
                                    <div class="col-lg-3 col-sm-12"> <label for="contenu" style="background-color: whitesmoke;" >Ajouter Un Contenu - ></label> 
                                        <textarea name="contenucour" value="" id="" cols="80" rows="4">{{$cahier_de_texte->contenu}}</textarea>
                                    </div>
                                    @error('contenucour')
                                        <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                </div><br>
                            <section id="elm">
                                <div class="row">
                                    <div class="row">
                                            <p style="text-decoration:underline ;"> Travail à Faire à l'issue de la science Prochaine</p>
                                            <hr width="100%" color="blue">
                                        </div>
                                    
                                    <div class="container" style="background-color: whitesmoke;">
                                        <div class="row">
                                            <div class="col">
                                                <label for="titre"> Titre de l'exercice </label>
                                                <input type="text" value="@if($exercice == null) {{old('titre_exercice')}}  @else {{$exercice->titre}} @endif" name="titre_exercice">
                                            </div>
                                            @error('titre_exercie')
                                                <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                            @enderror
                                        </div><br/>
                                        <div class="row">
                                            &emsp; A remettre avant ->  &emsp;&emsp;&emsp;&emsp;
                                            <input type="text" value="@if($exercice == null) {{old('date_de_correction')}}  @else {{$exercice->date_de_correction}} @endif" name="date_de_correction" placeholder="yyyy-mm-dd">
                                            @error('date_de_correction')
                                                <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                            @enderror
                                        </div><br>
                                        <div class="row" style="background-color:whitesmoke;">
                                            <div class="col">
                                                <label for="pieces">Piéces jointes  - ></label>
                                                <input type="file" value="@if($exercice == null) {{old('piece_jointeexercice')}}  @else {{$exercice->piece_jointe}} @endif" name ="piece_jointeexercice" placeholder="Ajouter une piece jointe">
                                                @error('piece_jointeexercice')
                                                    <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-lg-3 col-sm-12"> <label for="contenu" style="background-color: whitesmoke;" >Ajouter Un Contenu - ></label> 
                                                <textarea value="" name="contenu_exercice" id="" cols="60" rows="3">@if($exercice == null) {{old('contenu_exercice')}}  @else {{$exercice->contenu}} @endif</textarea>
                                                @error('contenu_exercice')
                                                    <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div><br>
                                    </div>
                                    
                                </div>
                            </section>
                            <br>
                            <button type="submit"  class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark" >Enregistrer</button>
                        </form>
                    </div>
                </div>
                
                <!-- Add New Teacher Area End Here -->
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
