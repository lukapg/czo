
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>IS Centar za obuku</title>

  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="{{ asset('css/sb-admin.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/stilovi.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10.13.0/dist/sweetalert2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
  <style>
	input[type="radio"] {
	-webkit-appearance: radio !important;
	opacity: 1;
	}
	input[type=radio] + label {
	padding-left: 5px;
	}

	.select2-container {
	 width: 100% !important;
	}
  </style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand bg-primary topbar mb-4 static-top shadow">
          <div class="sidebar-brand-text mx-3">
            <a href="{{ route('zaposleni.index') }}">
              <img class="img-fluid" src="{{url('images/logo.png')}}" alt="CEDIS logo" style="max-width: 100px">
            </a>
          </div>
	  <ul class="navbar-nav ml-auto">
	    <li class="nav-item">
	      <a class="nav-link text-white" href="{{ route('evidencija.index') }}">Evidencija</a>
	    </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('zaposleni.index') }}">Zaposleni</a>
            </li>            
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('grupa.index') }}">Grupe</a>
	    </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('vrsta_obuke.index') }}">Vrste obuke</a>
	    </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('komisija.index') }}">Komisija</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('predavac.index') }}">Predavači</a>
	    </li>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-white">
                  {{ auth()->user() ? auth()->user()->naziv : '' }}
                  @if (auth()->user())
                  <i class="fa fa-caret-down ml-2"></i>
                  @endif
                </span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-grey-400"></i>
                  Odjava
                </a>
              </div>
            </li>

          </ul> 

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; 2020 CEDIS</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->


  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
  <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('js/vendor/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/vendor/sb-admin-2.min.js') }}"></script>
  <script src="{{ asset('js/vendor/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/vendor/dataTables.bootstrap4.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  @yield('scripts')

</body>

</html>
