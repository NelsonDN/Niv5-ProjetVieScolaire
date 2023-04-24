<div class="navbar navbar-expand-md header-menu-one bg-light">
            <div class="nav-bar-header-one">
                <div class="header-logo">
                    <a href="index.html">
                        <img src="" alt="logo">
                    </a>
                </div>
                 <div class="toggle-button sidebar-toggle">
                    <button type="button" class="item-link">
                        <span class="btn-icon-wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="d-md-none mobile-nav-bar">
               <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false">
                    <i class="far fa-arrow-alt-circle-down"></i>
                </button>
                <button type="button" class="navbar-toggler sidebar-toggle-mobile">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
                <ul class="navbar-nav">
                    <li class="navbar-item header-search-bar">
                        <div class="input-group stylish-input-group">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="flaticon-search" aria-hidden="true"></span>
                                </button>
                            </span>
                            <input type="text" class="form-control" placeholder="@lang('Find Something . . .')">
                        </div>
                    </li>
                </ul>
                <!-- ajout bouton nouvelle annee scholaire -->
                <!-- <div class="container">
                    <div class="row">
                        <div class="col text-center"> 
                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">New Year</button>
                        </div>
                    </div>
                </div> -->
                <div class="mr-5 dropdown form-group">
                    <button style="font-size: 1.5 rem;" type="button" class="btn btn-fill-lg bg-blue-dark btn-hover-yellow dropdown-toggle" data-toggle="dropdown">
                        @lang('For Year')
                    </button>
                    <div class="form-group dropdown-menu ">
                        <li style="padding: 10px 15px;" href="#">
                            <button style="font-size: 1.5 rem;" type="button" class="btn btn-fill-lg bg-blue-dark btn-hover-yellow dropdown-toggle" data-toggle="modal" data-target="#form">
                            @lang('New Year')
                            </button>  
                        </li>
                        <li style="padding: 10px 15px;" href="">
                            <button style="font-size: 1.5 rem;" type="button" class="btn btn-fill-lg bg-blue-dark btn-hover-yellow dropdown-toggle" data-toggle="" data-target="#form">
                            @lang('Year List')
                            </button>  
                        </li>
                    </div>
                </div>

                <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg"  role="document">
                    <div class="modal-content">
                    <div style="background-color: #042954;" class="modal-header border-bottom-0 btn-secondary">
                        <h5 style="color:white;" class="modal-title" id="exampleModalLabel">@lang('Add an academic Year')</h5>
                        <button style="background-color: #042954;color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="YearForm" action="#"  method="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nomSession">@lang('session name')</label>
                                <input  type="text" name="session" class="form-control" id="session"  placeholder="@lang('Enter the Session')">
                                @error('session')
                                    <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="dateDebut">@lang('Start Date')</label>
                                <input type="date" name="startDate" class="form-control" id="dateDebut" placeholder="@lang('Password')">
                                @error('startDate')
                                    <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="dateFin">@lang('End Date')</label>
                                <input type="date" name="endDate" class="form-control form-control-plaintext" id="dateFin" placeholder="@lang('Confirm Password')">
                                @error('endDate')
                                    <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="dropdown form-group">
                                <select class="btn btn-fill-lg bg-blue-dark btn-hover-yellow dropdown-toggle">
                                    <option value="" disabled selected name="status" type="button">
                                    @lang('Status')
                                    </option>
                                    @error('status')
                                        <span class="form-text text-muted" role="alert"><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                    <div class="form-group dropdown-menu ">
                                        <li style="padding: 10px 15px;" href="#">
                                            <option value="1" style="font-size: 1.5 rem;" type="button" class="btn btn-fill-lg bg-blue-dark btn-hover-yellow dropdown-toggle" data-toggle="" data-target="#form">
                                            @lang('In progress')
                                            </option>  
                                        </li>
                                        <li style="padding: 10px 15px;" href="#">
                                            <option value="2" style="font-size: 1.5 rem;" type="button" class="btn btn-fill-lg bg-blue-dark btn-hover-yellow dropdown-toggle" data-toggle="" data-target="#form">
                                            @lang('Next ')
                                            </option>  
                                        </li>
                                    </div>
                                </select>        
                            </div>
                        </div>
                        <div class="modal-footer border-top-0 d-flex justify-content-center">
                            <button type="" style="font-size: 2rem;background-color: #ffae01; border:none;" class="btn btn-secondary mr-4" data-toggle="tooltip" data-placement="top" title="@lang('Don\'t forget to submit your data before closing the modal.')">
                            @lang('Close')
                            </button>
                            <button style="font-size: 2rem;background-color: #042954;border:none;" type="submit" class="btn btn-success">@lang('Submit ')</button>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
                <ul class="navbar-nav">   
                    <li class="navbar-item dropdown header-admin">
                        <a class="navbar-nav-link dropdown-toggle p-0" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <div class="admin-title">
                                <h5 class="item-title">{{Auth()->user()->name}}</h5>
                            </div>
                            <div class="admin-img list-group-item">
                                <img src="{{auth()->user()->avatar}}" style="heignt:50px; width:50px;" alt="Admin">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">{{Auth()->user()->name}}</h6>
                            </div>
                            <div class="item-content">
                                <ul class="settings-list">
                                    <li><a href="#"><i class="flaticon-user"></i>@lang('My Profile')</a></li>
                                    <li><a href="#"><i class="flaticon-list"></i>@lang('Task')</a></li>
                                    <li><a href="#"><i class="flaticon-chat-comment-oval-speech-bubble-with-text-lines"></i>@lang('Message')</a></li>
                                    <li><a href="#"><i class="flaticon-gear-loading"></i>@lang('Account Settings')</a></li>
                                    <li><a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="flaticon-turn-off"></i>@lang('Log Out')</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="navbar-item dropdown header-message">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="far fa-envelope"></i>
                            <div class="item-title d-md-none text-16 mg-l-10">@lang('Message')</div>
                            <span>5</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">05 Message</h6>
                            </div>
                            <div class="item-content">
                                <div class="media">
                                    <div class="item-img bg-skyblue author-online">
                                        <img src="{{asset('asset/img/figure/student11.png'.auth()->user()->avatars)}}" alt="img">
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="item-title">
                                            <a href="#">
                                                <span class="item-name">Maria Zaman</span> 
                                                <span class="item-time">18:30</span> 
                                            </a>  
                                        </div>
                                        <p>What is the reason of buy this item. 
                                        Is it usefull for me.....</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="item-img bg-yellow author-online">
                                        <img src="{{asset('asset/img/figure/student12.png')}}" alt="img">
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="item-title">
                                            <a href="#">
                                                <span class="item-name">Benny Roy</span> 
                                                <span class="item-time">10:35</span> 
                                            </a>  
                                        </div>
                                        <p>What is the reason of buy this item. 
                                        Is it usefull for me.....</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="item-img bg-pink">
                                        <img src="{{asset('asset/img/figure/student13.png')}}" alt="img">
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="item-title">
                                            <a href="#">
                                                <span class="item-name">Steven</span> 
                                                <span class="item-time">02:35</span> 
                                            </a>  
                                        </div>
                                        <p>What is the reason of buy this item. 
                                        Is it usefull for me.....</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="item-img bg-violet-blue">
                                        <img src="{{asset('asset/img/figure/student11.png')}}" alt="img">
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="item-title">
                                            <a href="#">
                                                <span class="item-name">Joshep Joe</span> 
                                                <span class="item-time">12:35</span> 
                                            </a>  
                                        </div>
                                        <p>What is the reason of buy this item. 
                                        Is it usefull for me.....</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="navbar-item dropdown header-notification">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="far fa-bell"></i>
                            <div class="item-title d-md-none text-16 mg-l-10">@lang('Notification')</div>
                            <span>8</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">03 Notifications</h6>
                            </div>
                            <div class="item-content">
                                <div class="media">
                                    <div class="item-icon bg-skyblue">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="post-title">Complete Today Task</div>
                                        <span>1 Mins ago</span>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="item-icon bg-orange">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="post-title">Director Metting</div>
                                        <span>20 Mins ago</span>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="item-icon bg-violet-blue">
                                        <i class="fas fa-cogs"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="post-title">Update Password</div>
                                        <span>45 Mins ago</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                     <li class="navbar-item dropdown header-language">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" 
                        data-toggle="dropdown" aria-expanded="false">
                            @if (app()->getLocale() == 'fr')
                                <i class="fas fa-globe-europe"></i>FR
                            @elseif(app()->getLocale() == 'en')
                                <i class="fas fa-globe-americas"></i>EN   
                            @else
                                <i class="fas fa-globe-americas"></i>EN  
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('langue',['locale' => 'en'])}}">@lang('English')</a>
                            <a class="dropdown-item" href="{{route('langue', ['locale' => 'fr'])}}">@lang('French')</a>
                        </div>
                    </li>
                </ul>
            </div>
</div>

<script>
    //ecriture auto de la Session academique(l'annee academique )  
   document.getElementById('session').addEventListener('click',function(event) {
       if (new Date(document.getElementById('dateDebut').value).getFullYear() < new Date(document.getElementById('dateFin').value).getFullYear()) {
            new Date (document.getElementById('session').value).getFullYear() = new Date(document.getElementById('dateDebut').value).getFullYear() + "/" + new Date(document.getElementById('dateFin').value).getFullYear();
       } else {
           alert("Entrez Des Dates Valides");
       }
       
   });

      
</script>