@extends('home.layouts.app')

@section('title')
   SchooLife-Portails parents
@endsection

@section('content')

    <section id="features" class="bg-danger text-white">
        <div class="container">
            <div class="text-danger">
                qsssssssssssssssssssssssssssssssqsssssssssssssssssssssssssssssssss
            </div>
            <div class="text-danger">
                qsssssssssssssssssssssssssssssssqsssssssssssssssssssssssssssssssss
            </div>

        <div class="row feature-item ">
            <div class="col-lg-6  pt-10 pt-lg-0">
                <div>
                    <p></p>
                    <p></p><br><br>
                </div>
                <h1>Portails Parents & Elèves</h1>
                <p><strong><span style="color:rgb(221, 113, 40);">Schoo</span><span style="color:rgb(44, 44, 230);">Life</span></strong> est une solution de gestion des inscription très plébiscitée par les parents. Nous assurons le suivi scolaire de leurs enfants tout en veillant au respect de la confidentialité de leurs données personnelles.</p>
            </div>
            <div class="col-lg-6 wow fadeInUp">
                <img src="{{ asset('assetshome/img/parents-eleves.png')}}" class="animated bounceInUp img-fluid" alt="">
            </div>
        </div>
        </div>
    </section><!-- #about -->

    <section id="features">
        <div class="container">
            <div class="row feature-item">
                <div class="col-lg-4 wow fadeInUp">
                    <img src="{{ asset('assetshome/img/homework.png')}}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-8 wow fadeInUp pt-5 pt-lg-0">
                    <h4 style="color:rgb(9, 93, 248);">Parents</h4>
                    <p>
                        Ne manquez jamais un événement scolaire ou une réunion d'enseignants ou de parents. Recevez le bulletin ou livret scolaire de vos enfants dès qu'il est disponible et consultez les devoirs qu'ils ont à faire. Restez en contact permanent avec l'école et voyez exactement dans quelle classe se trouve vos enfants ou qui sont leurs enseignants. Justifiez les absences en ligne. SchooLife réunit les parents, les élèves et le personnel comme jamais auparavant.
                    </p>
                </div>
            </div>

            <div class="row feature-item mt-5">
                <div class="col-lg-8 wow fadeInUp pt-5 pt-lg-0">
                    <h4 style="color:rgb(9, 93, 248);">Elèves</h4>
                    <p>
                        Tranquillité de l’esprit : tout est dans SchooLife ! L’emploi du temps, les informations de l'école, les notes des devoirs sont tous là. Les élèves pourront savoir quand les devoirs sont à rendre et peuvent télécharger le bulletin et livret scolaire. Vérifiez les présences et accédez instantanément à leurs notes des devoirs actuels et passés.
                    </p>
                </div>
                <div class="col-lg-4 wow fadeInUp">
                    <img src="{{ asset('assetshome/img/students.png')}}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section><!-- #about -->

@endsection
