@extends('home.layouts.app')

@section('title')
   SchooLife-Portails administration
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
                    <h1>Diretion & Administration</h1>
                    <p><strong><span style="color:rgb(221, 113, 40);">Schoo</span><span style="color:rgb(44, 44, 230);">Life</span></strong> vous permet de gérer votre école en tenant compte de ses critères spécifiques. Ce système de gestion de vie scolaire réduit le travail administratif des écoles et des enseignants.</p>
                </div>
                <div class="col-lg-6 wow fadeInUp">
                    <img src="{{ asset('assetshome/img/meet.png')}}" class="animated bounceInUp img-fluid" alt="">
                </div>
            </div>
        </div>
    </section><!-- #about -->

    <section id="features">
        <div class="container">
            <h1 class="text-center font-weight-bold text-info">Chef d'établissement, Directeur(trice) </h1>

        <div class="row feature-item">
            <div class="col-lg-6 text-justify">
                <p>
                    Avec tant de responsabilité en tant que chef, vous devez faire en sorte que tout fonctionne en harmonie. SchooLife vous offre un système puissant et un soutien exceptionnel pour vous aider à rassembler tout votre personnel et l’organisation de votre école dans un système qui intègre la gestion de toutes les informations nécessaires.
                </p>
                <p>
                    Réduisez la charge de travail de votre personnel, permettez aux enseignants de noter les présences, de préparer les rapports de notes et de définir les devoirs facilement. Tenez les parents informés et donnez aux élèves l’accès à leurs devoirs et notes dès qu’ils sont disponibles. Soulagez votre service de comptabilité grâce une facturation simple et facile à créer et avec nos différents modules.
                </p>
                <p>
                    La budgétisation annuelle est simple. Pas de frais d’installation, pas de frais de support supplémentaires ou de coûts cachés de mise à niveau. Nous avons un prix simple par pack des étudiants ou par étudiant et c’est tout.
                </p>
            </div>
            <div class="col-lg-6 pt-5 pt-lg-0 text-justify">
            <p class="text-justify">
                Pas besoin de personnel, de matériel ou de nouveaux serveurs pour sauvegarder vos données. Tout est pris en charge : sauvegarde quotidienne, maintenance et mise à jour. Pas besoin non plus d’investir dans une multitude de logiciels. Tout est inclus dans SchooLife !
            </p>
            <p>
                Avec un seul système puissant, SchooLife élimine les coûts d’impression et réduit le nombre de réunions grâce à ses outils de communication ultra efficaces. Les notes, les présences, l’emploi du temps des élèves et de votre personnel, la gestion des finances, la gestion des ressources humaines et matériels sont tous disponibles en ligne, instantanément.
            </p>
            </div>
        </div>

        </div>
    </section><!-- #about -->

    <section id="features">
        <div class="container">
            <div class="row feature-item">
                <div class="col-lg-4 wow fadeInUp">
                    <img src="{{ asset('assetshome/img/enseignants.jpg')}}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-8 wow fadeInUp pt-0 pt-lg-0">
                    <h4 style="color:rgb(9, 93, 248);">Administration & Secrétariat des écoles</h4>
                    <p>
                        Il suffit de sélectionner une classe ou l'école entière et de cliquer sur 'envoyer' pour envoyer des e-mails et des SMS. Vous pouvez également créer des profils personnalisés de parents, de membres du personnel, d'enseignants et d'élèves en quelques clics seulement. Accès instantané aux données centralisées pour les informations des élèves, des parents et du personnel. Plus besoin de chercher dans les fichiers ou de passer des appels pour savoir où sont les élèves, s'ils sont présents ou absents, quel cours un professeur donne ou de chercher les coordonnées des parents. SchooLife est hyper intuitif et vous donne un contrôle total sur l'administration de votre école. . En cas de besoin, notre équipe reste à disposition pour répondre à vos questions concernant l'utilisation de SchooLife. Vous pouvez également consulter nos vidéos de démonstration.
                    </p>
                </div>
            </div>

            <div class="row feature-item mt-5">
                <div class="col-lg-8 wow fadeInUp pt-0 pt-lg-0">
                    <h4 style="color:rgb(9, 93, 248);">Service informatique</h4>
                    <p>
                        Comme toutes les solutions en ligne, un navigateur moderne et une connexion Internet sont tout ce dont vous avez besoin. Nous nous occupons de la formation et du support, vous laissant avec moins de tâches à gérer. La budgétisation est simple ! Pas de matériel, de logiciels ou de surprises de mise à jour à prendre en compte. Nous nous occupons de toutes les tâches informatiques pour vous, tels que la sauvegarde quotidienne, mise à jour, demande spécifique.
                    </p>
                </div>
                <div class="col-lg-4 wow fadeInUp">
                    <img src="{{ asset('assetshome/img/admin.jpg')}}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section><!-- #about -->

@endsection
