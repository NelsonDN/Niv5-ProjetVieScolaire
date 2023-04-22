<!--==========================
    Footer
  ============================-->
  <footer id="footer" class="section-bg">
    <div class="footer-top">
      <div class="container">

        <div class="row">

          <div class="col-lg-6">

            <div class="row">

                <div class="col-sm-6">

                  <div class="footer-info">
                    <h3>SCHOOLIFE</h3>
                  </div>

                  <div class="footer-newsletter">
                    <h4>Our Newsletter</h4>
                    <p>Souscrivez à notre newsletter, pour être tenu infomer de toutes les publications, offres et mises à jour disponibles.</p>
                    <form action="" method="post">
                      <input type="email" name="email"><input type="submit"  value="Souscrivez">
                    </form>
                  </div>

                </div>

                <div class="col-sm-6">
                  <div class="footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                      <li><a href="{{ route('accueil') }}">Accueil</a></li>
                      <li><a href="#">About us</a></li>
                      <li><a href="#">Services</a></li>
                      <li><a href="#">Terms of service</a></li>
                      <li><a href="#">Privacy policy</a></li>
                    </ul>
                  </div>

                  <div class="footer-links">
                    <h4>Contactez-nous</h4>
                    <p>
                      ENSET CAMPUS 2 <br>
                      Douala, 5e Arrondissement<br>
                      Cameroun <br>
                      <strong>Phone:</strong> +237 6 94 32 47 23<br>
                      <strong>Email:</strong> soutenance@enset.com<br>
                    </p>
                  </div>

                  <div class="social-links">
                    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                  </div>

                </div>

            </div>

          </div>

          <div class="col-lg-6">

            <div class="form">

              <h4>Envoyez-nous un messsage</h4>
              <p>Pour toutes vos questions.</p>
              <form action="" method="post" role="form" class="contactForm">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nom" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Objet" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                  <div class="validation"></div>
                </div>

                <div id="sendmessage">Votre message a bien été envoyé, Merci!</div>
                <div id="errormessage"></div>

                <div class="text-center"><button type="submit" title="Send Message">Envoyer</button></div>
              </form>
            </div>

          </div>



        </div>

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>SchooLife</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Rapid
        -->
        Designed by <a href="https://bootstrapmade.com/">Paulette</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <!-- JavaScript libraries -->
  <script src="{{ asset('assetshome/lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assetshome/lib/jquery/jquery-migrate.min.js') }}"></script>
  <script src="{{ asset('assetshome/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assetshome/lib/easing/easing.min.js') }}"></script>
  <script src="{{ asset('assetshome/lib/mobile-nav/mobile-nav.js') }}"></script>
  <script src="{{ asset('assetshome/lib/wow/wow.min.js') }}"></script>
  <script src="{{ asset('assetshome/lib/waypoints/waypoints.min.js') }}"></script>
  <script src="{{ asset('assetshome/lib/counterup/counterup.min.js') }}"></script>
  <script src="{{ asset('assetshome/lib/owlcarousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assetshome/lib/isotope/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assetshome/lib/lightbox/js/lightbox.min.js') }}"></script>
  <!-- Contact Form JavaScript File -->
  <script src="{{ asset('assetshome/contactform/contactform.js') }}"></script>

  <!-- Template Main Javascript File -->
  <script src="{{ asset('assetshome/js/main.js') }}"></script>
