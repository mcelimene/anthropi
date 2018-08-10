<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>AnthroPi @yield('title')</title>
  <link rel="icon" href="{{ asset('images/logo.png')}}" type="images/png">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="{{ URL::asset("css/material-dashboard.min.css")}}" rel="stylesheet" />
  <link href="{{ URL::asset("css/style.css")}}" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-background-color="white" data-image="{{ URL::asset("images/image1.jpg") }}">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-normal">
          AnthroPi
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          @if(\Auth::user()->role == 'admin')
            <li class="nav-item {{ Request::is('home', 'home/*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ url('/home') }}">
                <i class="material-icons">dashboard</i>
                <p>Tableau de bord</p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('calendar') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('calendar.index')}}">
                <i class="material-icons">calendar_today</i>
                <p>Calendrier</p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('training-follow-up', 'training-follow-up/*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('training-follow-up.index') }}">
                <i class="material-icons">bookmarks</i>
                <p>Suivi des candidatures</p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('formations', 'formations/*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('formations.index') }}">
                <i class="material-icons">assignment</i>
                <p>Formations</p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('trainers', 'trainers/*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('trainers.index') }}">
                <i class="material-icons">people</i>
                <p>Formateurs</p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('datadock', 'datadock/*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('datadock.index') }}">
                <i class="material-icons">attach_file</i>
                <p>Datadock</p>
              </a>
            </li>
          @elseif(\Auth::user()->role == 'user')
            <li class="nav-item {{ Request::is('home-trainer', 'home-trainer/*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ url('/home-trainer') }}">
                <i class="material-icons">dashboard</i>
                <p>Tableau de bord</p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('registration-formations', 'registration-formations/*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('registration-formations.index') }}">
                <i class="material-icons">assignment</i>
                <p>Inscriptions</p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('password-change', 'password-change/*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('password-change.edit') }}">
                <i class="material-icons">vpn_key</i>
                <p>Modifier mot de passe</p>
              </a>
            </li>
          @else
            <li class="nav-item {{ Request::is('home-datadock', 'home-datadock/*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ url('/home-datadock') }}">
                <i class="material-icons">dashboard</i>
                <p>Tableau de bord</p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('settings', 'settings/*') ? 'active' : '' }}">
              <a class="nav-link" href="{{ url('/settings') }}">
                <i class="material-icons">dashboard</i>
                <p>Paramètres</p>
              </a>
            </li>
          @endif
          <!-- your sidebar here -->
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="#pablo">@yield('pageName')</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout')}}">
                  <i class="material-icons">power_settings_new</i> Déconnexion
                </a>
              </li>
              <!-- your navbar here -->
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              @include('flash-messages')
              @yield('content')
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script> - Fait par Mélodie Célimène
            <a href="https://www.melodiecelimene.fr" target="_blank"><img src="{{ asset('images/logo-mc.png')}}" alt="Logo Mélodie Célimène" id='logo-mc'></a>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ URL::asset("js/core/jquery.min.js")}}" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="{{ URL::asset("js/core/popper.min.js")}}" type="text/javascript"></script>
  <script src="{{ URL::asset("js/core/bootstrap-material-design.min.js")}}" type="text/javascript"></script>
  <!--<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>-->

  <!-- Chartist JS -->
  <!--<script src="assets/js/plugins/chartist.min.js"></script>-->
  <!--  Notifications Plugin    -->
  <!--<script src="assets/js/plugins/bootstrap-notify.js"></script>-->
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ URL::asset("js/material-dashboard.min.js")}}" type="text/javascript"></script>
  @yield('script')
</body>

</html>
