 <!--==========================
  Header
  ============================-->
  <header id="header">

    <div id="topbar">
      <div class="container">
        <div class="social-links">
          <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
          <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
          <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
          <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
        </div>
      </div>
    </div>

    <div class="container">

      <div class="logo float-left">
        <!-- Uncomment below if you prefer to use an image logo -->
        <h1 class="text-light"><a href="#intro" class="scrollto"><span>SchooLife</span></a></h1>
        <!-- <a href="#header" class="scrollto"><img src="img./logo1.pnfg" alt="" class="img-fluid"></a> -->
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li class="active"><a href="{{ route('accueil') }}">Accueil</a></li>
          <li><a href="#about">A propos</a></li>
          <li><a href="#services">Services</a></li>
          <li class="drop-down"><a href="">Portail</a>
            <ul>
              <li><a href="{{ route('portails-direction') }}">Direction & Administration</a></li>
              {{-- <li class="drop-down"><a href="#">Drop Down 2</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li> --}}
              <li><a href="{{ route('portails-enseignants') }}">Portails Enseignants</a></li>
              <li><a href="{{ route('portails-parents') }}">Portails Parents/Elèves</a></li>
            </ul>
          </li>
          <li class="text-align"><a href="{{ route('login') }}">Login<img src="{{ asset('assetshome/img/login.png') }}" alt="" class="img-fluid"></a></li>
        </ul>
      </nav><!-- .main-nav -->

    </div>
  </header><!-- #header -->
