<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DONORNATION</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
{{--   <script src="{{ asset('public/js/app.js') }}" defer></script> --}}

  <!-- Favicons -->
  <link href="{{asset('public/img/logoyy.png')}}" rel="icon">
  <link href="{{asset('public/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('public/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('public/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('public/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">

  @yield('styles')

  <!-- =======================================================
  * Template Name: Medilab
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
<div>
  <!-- ======= Top Bar ======= COMMENTED TO TEST  -->
 <!--  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <a href="mailto:contact@example.com">contact@example.com</a>
        <i class="bi bi-phone"></i> +1 5589 55488 55
      </div>
      <div class="d-none d-lg-flex social-links align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </div> -->

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="{{route('home')}}" class="logo me-auto"><img src="{{ asset('public/img/logoyy.png')}}" alt="" class="img-fluid"></a>
      <h1 class="logo me-auto"><a href="{{ route('home') }}">DONORNATION</a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link {{ Request::route()->getName() === 'home' ? 'active' : '' }}" href="{{ route('home') }}">Accueil</a></li>
          <li><a class="nav-link {{ Request::route()->getName() === 'donner_sang' ? 'active' : '' }}" href="{{ route('donner_sang') }}">Donner & Map</a></li>
          @if (Auth::check())
            <li><a class="nav-link {{ Request::route()->getName() === 'home' ? 'active' : '' }}" href="{{ route('home') }}">Donner du sang</a></li>
          @else
          <li><a class="nav-link scrollto {{ Request::is('blood-donation-process') ? 'active' : '' }}" href="{{ url('/blood-donation-process') }}">Donner du sang</a></li>
          @endif
          <li><a class="nav-link {{ Request::is('donors*') ? 'active' : '' }}" href="{{ route('donorsPage') }}">Rechercher des donneurs</a></li>
          <li><a class="nav-link {{ Request::route()->getName() === 'blog' ? 'active' : '' }}" href="{{ route('blog') }}">Blog</a></li>
          <li><a class="nav-link {{ Request::route()->getName() === 'home' ? '' : 'inactive' }}" href="{{ route('home') }}#contact-us">Contacts</a></li>
          @guest
    <a href="{{ route('login') }}" class="appointment-btn scrollto">
        <span class="d-none d-md-inline">Nous</span> Rejoindre
    </a>
@else
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>

        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li>
                <a href="/admin" class="dropdown-item">
                    <i class="fas fa-user me-2"></i> Mon compte &emsp; &emsp; &emsp; &emsp; &emsp;
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }} &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </li>
@endguest


      </nav><!-- .navbar -->
  </header><!-- End Header -->


  @yield("content")


    <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">

        <div class="row">

              <div class="col-lg-4 col-md-6 footer-contact">
                <h3>DONORNATION</h3>
                <p>
                 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<br>
                 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<br>
                 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<br>
                 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<br><br>

                </p>
              </div>

               <div class="col-lg-4 col-md-6 footer-links">
                 <h4>Information</h4>
                 <ul>
                 <li><i class="bx bx-chevron-right"></i> <a href="{{route('home')}}">Accueil</a></li>
                 @if (Auth::check())
                 <li><i class="bx bx-chevron-right"></i><a class="nav-link {{ Request::route()->getName() === 'home' ? 'active' : '' }}" href="{{ route('home') }}">Donner du sang</a></li>
                 @else
                 <li><i class="bx bx-chevron-right"></i><a class="nav-link scrollto {{ Request::is('blood-donation-process') ? 'active' : '' }}" href="{{ url('/blood-donation-process') }}">Donner du sang</a></li>
                 @endif
                 <li><i class="bx bx-chevron-right"></i> <a href="{{ route('donorsPage') }}">Rechercher des donneurs</a></li>
                 <li><i class="bx bx-chevron-right"></i> <a href="{{ route('blog') }}">Blog</a></li>
                 <li><i class="bx bx-chevron-right"></i><a class="nav-link {{ Request::route()->getName() === 'home' ? 'active' : '' }}" href="{{ route('home') }}#contact-us">Contact</a></li>
                 </ul>
               </div>

              <div class="col-lg-4 col-md-6 footer-links">
                 <div>
                 <h4>Contact us</h4>
                 <p>Tanger tanger tanger tanger<br>
                   Maroc maroc maroc maroc </p>
                 <p>Phone: +2120000000<br>
                   Email: xxxxxxxxx@gmail.com</p>
              </div>
               <div>
                 <h4>Social media</h4>
                  <p>Visiter nos profiles social medias </p>
                  <div class="social-links text-left text-md-right pt-3 pt-md-0">
                   <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                   <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                   <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                   <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                   <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                 </div>
                </div>
              </div>
        </div>
      </div>
    </div>
    <div class="container d-md-flex py-4">
      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>DONORNATION</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          Designed by <a href="file:///C:/Users/juan/OneDrive/Bureau/PFA/FORMULAIRE-DONOR.html">OUR-TEAM</a>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->
{{--   <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sectionLink = document.querySelector('a[href="#contact-us"]');
        sectionLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le comportement de lien par défaut

            const targetSection = document.getElementById('contact-us');
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script> --}}
@yield('scripts')
</div>
