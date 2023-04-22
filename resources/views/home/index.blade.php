@extends('home.layouts.app')

@section('title')
   School Life
@endsection

@section('content')
    <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix">
    <div class="container d-flex h-100">
      <div class="row justify-content-center align-self-center">
        <div class="col-md-5 intro-info order-md-first order-last">
          <!-- <h4 style="font-family: american, typewriter, serif;">School life</h4> -->
          <h2>Plateforme de<br>gestion <span>scolaire!</span></h2>
          <div class="">
              Application web tout en un pour piloter la gestion quotidienne de votre établissement scolaire. Meilleure solution pour école maternelle, primaire, collège, lycée, enseignement supérieur ou <span>centre de formation</span> privée ou publique.
          </div>
        </div>

        <div class="col-md-7 intro-img order-md-last order-first">
          <img src="{{ asset('assetshome/img/teachers.jpg') }}" class="img-fluid animated pulse infinite" style="animation-duration: 2.5s;" alt="">

        </div>
      </div>

    </div>
  </section><!-- #intro -->

  <main id="main">


    <!--==========================
      About Us Section
    ============================-->
    <section id="about" class="wow fadeIn">

      <div class="container">
        <div class="row">

          <div class="col-lg-5 col-md-6 wow bounceInLeft" data-wow-delay="0.3s" data-wow-duration="1.6s">
            <div class="about-img">
              <img src="{{ asset('assetshome/img/boy.jpg') }}" alt="">
            </div>
          </div>

          <div class="col-lg-7 col-md-6 wow bounceInRight" data-wow-duration="1.6s">
            <div class="about-content">
              <h2>A propos de nous</h2>
              <h3>SCHOOL&LIFE facilite la gestion de la vie scolaire</h3>
              <p>L'encadrement solaire pour ue meilleure réussite !</p>
              <p class="text-justify">Notre module de vie scolaire propose une interface intuitive capable de gérer l’ensemble des processus de la vie scolaire, quels que soient le nombre des élèves, des enseignants et la pluralité des niveaux et des disciplines. Notre module de vie scolaire est un véritable outil de travail performant qui offre les outils et les fonctionnalités nécessaires pour une bonne gestion totale de vos démarches quotidiennes.</p>
              <ul>
                <li class="wow bounceInUp clearfix" data-wow-delay="0.5s"><i class="ion-android-checkmark-circle"></i>Pour une évaluation positive, le cahier de réussites numérique maternelle vous permettra de consigner instantanément les réussites de chacun de vos élèves. Possibilité de joindre des photos et enregistrements pour les personnaliser..</li>
                <li class="wow bounceInUp clearfix" data-wow-delay="0.7s"><i class="ion-android-checkmark-circle"></i>Les absences, retards, motifs et justificatifs sont enregistrés pour suivre l’assiduité des élèves plus facilement. .</li>
                <li class="wow bounceInUp clearfix" data-wow-delay="0.9s"><i class="ion-android-checkmark-circle"></i>Centralisez l’ensemble des informations scolaires des élèves dans un dossier consultable uniquement par les personnes habilitées.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </section><!-- #about -->


    <!--==========================
      Why Us Section
    ============================-->
    <section id="why-us" class="wow fadeIn">
      <div class="container-fluid">

        <header class="section-header">
          <h3>Pourquoi nous choisir ?</h3>
          <p>SchooLife vous permet de gérer votre école en tenant compte de ses critères spécifiques. Ce système de gestion de vie scolaire réduit le travail administratif des écoles et des enseignants.</p>
        </header>

        <div class="row">

          <div class="col-lg-6">
            <div class="why-us-img">
              <img src="{{ asset('assetshome/img/solidarity.jpg') }}" alt="" class="img-fluid">
            </div>
          </div>

          <div class="col-lg-6">
            <div class="why-us-content">
              <p>Molestiae omnis numquam corrupti omnis itaque. Voluptatum quidem impedit. Odio dolorum exercitationem est error omnis repudiandae ad dolorum sit.</p>

              <div class="features wow bounceInUp clearfix">
                <i class="fa fa-institution" style="color: #f058dc;"></i>
                <h4>Direction & Administration</h4>
                <p>SchooLife permet la gestion de votre école en tenant compte de ses critères spécifiques. Ce système de gestion de vie scolaire réduit le travail administratif des écoles et des enseignants.</p>
              </div>

              <div class="features wow bounceInUp clearfix">
                <i class="fa fa-object-group" style="color: #ffb774;"></i>
                <h4>Espace dédié enseignants</h4>
                <p>SchooLife permet de gérer les enseignants, leurs emplois du temps, leurs absences ainsi que les note des élèves et leurs cahiers de texte.</p>
              </div>

              <div class="features wow bounceInUp clearfix">
                <i class="fa fa-address-book-o" style="color: #589af1;"></i>
                <h4>Portail Parents & Elèves</h4>
                <p>Conçu pour la participation intégrale des parents, SchooLife permet de gérer les inscriptions des élèves, suivre leur vie scolaire, tout en garantissant la confidentialité de leurs données personnelles.</p>
              </div>
              <!-- <div class="features wow bounceInUp clearfix">
                <div class="row">
                  <div class="col-6">
                    <img src="{{ asset('assetshome/img/enseignants.jpg') }}" height="100%" width="100%" alt="">
                  </div>
                  <div class="col-6">
                    <h4>Portail Parents & Elèves</h4>
                    <p>Conçu pour la participation intégrale des parents, SchooLife permet de gérer les inscriptions des élèves, suivre leur vie scolaire, tout en garantissant la confidentialité de leurs données personnelles.</p>
                  </div>
                </div>
              </div> -->
            </div>

          </div>

        </div>

      </div>

      <div class="container">
        <div class="row counters">

          <div class="col-lg-4 col-6 text-center">
            <span data-toggle="counter-up">12</span>
            <p>Modules inclus</p>
          </div>

          <div class="col-lg-4 col-6 text-center">
            <span data-toggle="counter-up">100</span><span>%</span>
            <p>En ligne et sécurisé</p>
          </div>

          <div class="col-lg-4 col-6 text-center">
            <span data-toggle="counter-up">18</span>
            <p>Clients</p>
          </div>

        </div>

      </div>
    </section>

    <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">

        <header class="section-header">
          <h3>Nos services</h3>
          <p>SchooLife propose un ensemble de fonctionnalités pour une gestion complète de la vie scolaire.</p>
        </header>

        <div class="row">

          <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon" style="background: #fceef3;"><i class="fa fa-file-text" style="color: #ff689b;"></i></div>
              <h4 class="title">Fiches élèves</h4>
              <p class="description">En un seul clic, l’enseignant visualise l’ensemble des informations de ses élèves : date de naissance, date d’entrée, trombinoscope, etc.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon" style="background: #fff0da;"><i class="ion-ios-bookmarks-outline" style="color: #e98e06;"></i></div>
              <h4 class="title"><a href="">Gestion des examens</a></h4>
              <p class="description">Programmer et diffuser l’ensemble des examens.  Grâce à des interfaces intuitives, et des notifications aux parents lors de l'approchedu delai.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon" style="background: #e6fdfc;"><i class="fa fa-calendar-check-o" style="color: #3fcdc7;"></i></div>
              <h4 class="title"><a href="">Gestion des événements</a></h4>
              <p class="description">Créer et partager les événements (réunions, portes ouvertes, tournois sportifs, etc.). Vous pouvez choisir les personnes concernés.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon" style="background: #eafde7;"><i class="fa fa-list" style="color:#41cf2e;"></i></div>
              <h4 class="title"><a href="">Gestion des classes</a></h4>
              <p class="description">Affectation des enseignants, choix du ou des professeurs principaux, matières, options, etc.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon" style="background: #e1eeff;"><i class="fa fa-book" style="color: #2282ff;"></i></div>
              <h4 class="title"><a href="">Gestion des matières</a></h4>
              <p class="description">Ajoutez ou personnalisez les matières selon les spécialités de votre établissement.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon" style="background: #ecebff;"><i class="fa fa-folder" style="color: #8660fe;"></i></div>
              <h4 class="title"><a href="">Cahier de texte numérique</a></h4>
              <p class="description">Le cahier de texte permet l’échange entre enseignants et élèves : synthèse des cours, fichiers en PDF, etc.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.3s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon" style="background: #e1eeff;"><i class="fa fa-desktop" style="color: #ec1aa6;"></i></div>
              <h4 class="title"><a href="">Tableau de bord</a></h4>
              <p class="description">Visualisez en temps réel et en un clin d’œil tout ce qui se passe dans l’établissement et suivez facilement les évènements : absences, cours, événement, tâche, etc.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.3s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon" style="background: #ecebff;"><i class="fa fa-folder-open" style="color: #ec1212;"></i></div>
              <h4 class="title"><a href="">Suivi des absences et des retards</a></h4>
              <p class="description">Les absences, retards et justificatifs sont enregistrés pour suivre l’assiduité des élèves. Une notification apparaît dans le tableau de bord de l’administrateur.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.4s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon" style="background: #ecebff;"><i class="fa fa-newspaper-o" style="color: #bdd109;"></i></div>
              <h4 class="title"><a href="">Dossier scolaire</a></h4>
              <p class="description">Centralisez l’ensemble des informations scolaires des élèves dans un dossier consultable uniquement par les personnes habilitées. Archivage sous forme numérique.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- #services -->

    {{-- <!--==========================
      Call To Action Section
    ============================-->
    <section id="call-to-action" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-left">
            <h3 class="cta-title">Call To Action</h3>
            <p class="cta-text"> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#">Call To Action</a>
          </div>
        </div>

      </div>
    </section><!-- #call-to-action --> --}}

    <!--==========================
      Features Section
    ============================-->
    <section id="features">
      <div class="container">

        <div class="row feature-item">
          <div class="col-lg-6 wow fadeInUp">
            <img src="{{ asset('assetshome/img/echanges.png')}}" class="animated bounce infinite img-fluid" alt="">
          </div>
          <div class="col-lg-6 wow fadeInUp pt-5 pt-lg-0">
            <h4 style="color:rgb(9, 93, 248);">SchooLife connecte et facilite les échanges entre utilisateurs</h4>
            <p class="text-justify">
              Nous savons à quel point il est important de faciliter les échanges entre les membres d'une équipe de gestion scolaire.
            </p>
            <p class="text-justify">Notre plateforme de communication est conçue pour être simple et intuitive, ce qui signifie que même les utilisateurs novices peuvent l'utiliser sans difficulté. Elle permet de communiquer par messages instantanés, d'envoyer des fichiers et de partager des documents en temps réel, ce qui facilite la collaboration entre les membres de l'équipe.</p>
            <p><strong><span style="color:rgb(221, 113, 40);">Schoo</span><span style="color:rgb(44, 44, 230);">Life</span></strong>, nous sommes convaincus que la communication est la clé de la réussite d'une administration.</p>

          </div>
        </div>

        <div class="row feature-item mt-5 pt-5">
          <div class="col-lg-7 wow fadeInUp order-1 order-lg-2">
            <img src="{{ asset('assetshome/img/multi.jpg')}}" class="animated bounce infinite img-fluid" alt="">
          </div>
          <div class="col-lg-5 wow fadeInUp pt-4 pt-lg-0 order-2 order-lg-1">
            <h2 class="text-center" style="color:rgb(9, 93, 248);">MULTIPLATEFORME</h2>
            -- Vous pouvez y accéder depuis n'importe quel appareil --
            <br><br><br><br>
            <p class="text-justify">
              <strong><span style="color:rgb(221, 113, 40);">Schoo</span><span style="color:rgb(44, 44, 230);">Life</span></strong> est une solution multiplateforme, elle est adaptée pour ordinateurs, tablettes ainsi que vos téléphones portable, une application SchooLife est disponible sur iOS et Android. Restez connectés avec SchooLife où que vous soyez et profitez de la gestion de votre établissement à portée de main. Vous pouvez effectuer l’appel en salle, saisir des notes, renseigner le contenu du cours, ajouter des devoirs directement depuis vos smartphones avec SchooLife.
            </p>
          </div>

        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      Clients Section
    ============================-->
    <section id="testimonials">
      <div class="container">

        <header class="section-header">
          <h3>Avis Clients</h3>
        </header>

        <div class="row justify-content-center">
          <div class="col-lg-8">

            <div class="owl-carousel testimonials-carousel wow fadeInUp">

              <div class="testimonial-item">
                <img src="{{ asset('assetshome/img/paulette.jpg') }}" class="testimonial-img" alt="">
                <h3>............</h3>
                <h4>Ceo &amp; Founder</h4>
                <p>
                  Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                </p>
              </div>

              <div class="testimonial-item">
                <img src="{{ asset('assetshome/img/nelson.jpg') }}" class="testimonial-img" alt="">
                <h3>DADA Nelson</h3>
                <h4>Proviseur du lycée Bilingue Douala </h4>
                <p>
                  Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                </p>
              </div>

              <div class="testimonial-item">
                <img src="{{ asset('assetshome/img/valdez.jpg') }}" class="testimonial-img" alt="">
                <h3>FOTSO Valdez</h3>
                <h4>Proviseur du lycée Douala</h4>
                <p>
                  Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                </p>
              </div>

              <div class="testimonial-item">
                <img src="{{ asset('assetshome/img/angelo.jpg') }}" class="testimonial-img" alt="">
                <h3>ESSAME Angelo</h3>
                <h4>Proviseur du lycée technique Douala </h4>
                <p>
                  Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                </p>
              </div>

            </div>

          </div>
        </div>


      </div>
    </section><!-- #testimonials -->

    {{-- <!--==========================
      Team Section
    ============================-->
    <section id="team" class="section-bg">
      <div class="container">
        <div class="section-header">
          <h3>Team</h3>
          <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6 wow fadeInUp">
            <div class="member">
              <img src="{{ asset('assetshome/img/team-1.jpg') }}" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Walter White</h4>
                  <span>Chief Executive Officer</span>
                  <div class="social">
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href=""><i class="fa fa-google-plus"></i></a>
                    <a href=""><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="member">
              <img src="{{ asset('assetshome/img/team-2.jpg') }}" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Sarah Jhonson</h4>
                  <span>Product Manager</span>
                  <div class="social">
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href=""><i class="fa fa-google-plus"></i></a>
                    <a href=""><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
            <div class="member">
              <img src="{{ asset('assetshome/img/team-3.jpg') }}" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>William Anderson</h4>
                  <span>CTO</span>
                  <div class="social">
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href=""><i class="fa fa-google-plus"></i></a>
                    <a href=""><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="member">
              <img src="{{ asset('assetshome/img/team-4.jpg') }}" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Amanda Jepson</h4>
                  <span>Accountant</span>
                  <div class="social">
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href=""><i class="fa fa-google-plus"></i></a>
                    <a href=""><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- #team --> --}}

    <!--==========================
      Clients Section
    ============================-->
    <section id="clients" class="wow fadeInUp">
      <div class="container">
        <div class="owl-carousel clients-carousel">
          <img src="{{ asset('assetshome/img/ud.jpg') }}" alt="">
          <img src="{{ asset('assetshome/img/enset.jpg') }}" alt="">
          <img src="{{ asset('assetshome/img/ginfo.png') }}" alt="">
        </div>

      </div>
    </section><!-- #clients -->


    {{-- <!--==========================
      Pricing Section
    ============================-->
    <section id="pricing" class="wow fadeInUp section-bg">

      <div class="container">

        <header class="section-header">
          <h3>Pricing</h3>
          <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </header>

        <div class="row flex-items-xs-middle flex-items-xs-center">

          <!-- Basic Plan  -->
          <div class="col-xs-12 col-lg-4">
            <div class="card">
              <div class="card-header">
                <h3><span class="currency">$</span>19<span class="period">/month</span></h3>
              </div>
              <div class="card-block">
                <h4 class="card-title">
                  Basic Plan
                </h4>
                <ul class="list-group">
                  <li class="list-group-item">Odio animi voluptates</li>
                  <li class="list-group-item">Inventore quisquam et</li>
                  <li class="list-group-item">Et perspiciatis suscipit</li>
                  <li class="list-group-item">24/7 Support System</li>
                </ul>
                <a href="#" class="btn">Choose Plan</a>
              </div>
            </div>
          </div>

          <!-- Regular Plan  -->
          <div class="col-xs-12 col-lg-4">
            <div class="card">
              <div class="card-header">
                <h3><span class="currency">$</span>29<span class="period">/month</span></h3>
              </div>
              <div class="card-block">
                <h4 class="card-title">
                  Regular Plan
                </h4>
                <ul class="list-group">
                  <li class="list-group-item">Odio animi voluptates</li>
                  <li class="list-group-item">Inventore quisquam et</li>
                  <li class="list-group-item">Et perspiciatis suscipit</li>
                  <li class="list-group-item">24/7 Support System</li>
                </ul>
                <a href="#" class="btn">Choose Plan</a>
              </div>
            </div>
          </div>

          <!-- Premium Plan  -->
          <div class="col-xs-12 col-lg-4">
            <div class="card">
              <div class="card-header">
                <h3><span class="currency">$</span>39<span class="period">/month</span></h3>
              </div>
              <div class="card-block">
                <h4 class="card-title">
                  Premium Plan
                </h4>
                <ul class="list-group">
                  <li class="list-group-item">Odio animi voluptates</li>
                  <li class="list-group-item">Inventore quisquam et</li>
                  <li class="list-group-item">Et perspiciatis suscipit</li>
                  <li class="list-group-item">24/7 Support System</li>
                </ul>
                <a href="#" class="btn">Choose Plan</a>
              </div>
            </div>
          </div>

        </div>
      </div>

    </section>

    <!-- #pricing --> --}}

    <!--==========================
      Frequently Asked Questions Section
    ============================-->
    <section id="faq">
      <div class="container">
        <header class="section-header">
          <h3>Foire Aux Questions</h3>
          <p>Les questions fréquenment posées par les internautes au sujet de SchooLife </p>
        </header>

        <ul id="faq-list" class="wow fadeInUp">
          <li>
            <a data-toggle="collapse" class="collapsed" href="#faq1">Faut-il installer sur notre pc ?<i class="ion-android-remove"></i></a>
            <div id="faq1" class="collapse" data-parent="#faq-list">
              <p>
                SchooLife est une solution cloud. Par conséquent, vous n'avez pas besoin de l'installer. SchooLife est installé sur notre serveur et nous nous occupons de sa maintenance et sauvegarde.
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq2" class="collapsed">SchooLife peut fonctionner partout dans le monde ?  <i class="ion-android-remove"></i></a>
            <div id="faq2" class="collapse" data-parent="#faq-list">
              <p>
                Avec une connexion internet et un navigateur moderne ( chrome, firefox, edge, safari ), SchooLife peut fonctionner partout dans le monde. Nous gérons les devises et fuseaux horaires.
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq3" class="collapsed">Est-ce disponible en Anglais ? <i class="ion-android-remove"></i></a>
            <div id="faq3" class="collapse" data-parent="#faq-list">
              <p>
                C'est une solution pour les francophones. Mais, nous avons traduit en anglais et sera bientôt disponible en d'autres langues.
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq4" class="collapsed">Proposez-vous des applications ? <i class="ion-android-remove"></i></a>
            <div id="faq4" class="collapse" data-parent="#faq-list">
              <p>
                Application SchooLife est gratuite et téléchargeable sur Playstore et Appstore.
              </p>
            </div>
          </li>

        </ul>

      </div>
    </section><!-- #faq -->

  </main>
@endsection
