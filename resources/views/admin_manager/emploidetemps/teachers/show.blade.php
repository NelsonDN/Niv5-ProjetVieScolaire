
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
<!-- Select 2 CSS -->
<link rel="stylesheet" href="{{asset('asset/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('asset/css/datepicker.min.css')}}">
<!-- Data Table CSS -->
<!-- <link rel="stylesheet" href="{{asset('asset/css/jquery.dataTables.min.css')}}"> -->
<!-- Custom CSS -->
<link rel="stylesheet" href="{{asset('asset/style.css')}}">
<!-- Modernize js -->
<script src="{{asset('asset/js/modernizr-3.6.0.min.js')}}"></script>
<script src = "https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<style>
        th 
        {
            text-align:center;
            color: white;
            font-size: 1.1em;
            font-family: Arial, "Arial Black", Times, "Times New Roman", serif;
            border:1.6px solid silver ;
        }
        td 
        {
           border: 1px solid gray;
           font-family: "Comic Sans MS", "Trebuchet MS", Times, "Times New Roman", serif;
           text-align: center; 
           padding: 5px; 
        }
        td.time
        {
            width:5%;
        }

</style>
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
                    <h3>@lang('Teacher Schedule')</h3>
                    <ul>
                        <li>
                            <a href=" {{ route('dashboard_manage.Sections.create') }} ">@lang('Home')</a>
                        </li>
                        <li>@lang('Schedule')</li>
                    </ul>
                </div>
                @php
                                use Carbon\Carbon;
                @endphp
                <!-- Breadcubs Area End Here -->
                <table  style =" border: 4px outset green; border-collapse: collapse;border:1px solid black;">
                        <thead>
                            <th style="font-weight:bold;color:black;" width="125">Time</th>
                            @foreach($jours as $jour)
                                <th style="font-weight:bold;color:black;">{{ $jour->jour }}</th>
                            @endforeach
                        </thead>
                        <tbody>
                            @foreach($periodes as $periode)
                        
                                <tr>
                                    <td  style="color:black;">
                                        {{Carbon::parse($periode->heure_debut)->format('H:i')}} - {{ Carbon::parse($periode->heure_fin)->format('H:i')}}
                                    </td>

                                @foreach($jours as $jour)    
                                    @php
                                        $classe_matiere_id_teacher = DB::table('classe_matiere')->select('id')->where('user_id', $teacher->id)->pluck('id')->toArray();
                                        $jour_periode_id_teacher = DB::table('classmat_jourperiode')->select('jour_periode_id')->whereIn('classe_matiere_id',$classe_matiere_id_teacher)->pluck('jour_periode_id')->toArray();
                                        $jp_id = DB::table('jour_periode')->select('id','isbreak')->where('periode_id',$periode->id)->where('jour_id',$jour->id)->first();
                                        $jp_idc = DB::table('jour_periode')->select('id')->where('periode_id',$periode->id)->where('jour_id',$jour->id)->count();
                                    @endphp
                                    
                                    @if($jp_idc > 0)
                                        @if(in_array($jp_id->id, $jour_periode_id_teacher))
                                            <td rowspan="" class="align-middle text-center" style="background-color:AliceBlue;" > 
                                                @php
                                                    $classe_matiere_id = DB::table('classmat_jourperiode')->select('classe_matiere_id')->where('jour_periode_id',$jp_id->id)->pluck('classe_matiere_id')->toArray();
                                                    $classe_matiere = DB::table('classe_matiere')->select('classe_id','matiere_id')->whereIn('id',$classe_matiere_id)->where('user_id',$teacher->id)->first();
                                
                                                @endphp
                                                <span style="color:black;" >{{App\Models\Classe::findOrFail($classe_matiere->classe_id)->nom}}<br/>{{App\Models\Matiere::findOrFail($classe_matiere->matiere_id)->nom}}</span>
                                            </td>
                                        @elseif($jp_id->isbreak == 1)
                                            <td>PAUSE</td>
                                        @else
                                            <td></td>
                                        @endif
                                    
                                    @else
                                        <td></td>
                                    @endif
                               
                                @endforeach

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

