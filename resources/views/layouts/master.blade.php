<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIP - Aywa Petcare</title>

  <!-- Custom fonts for this template-->
  <link href="{{ url('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="{{ url('assets/css/sb-admin-2.css') }}" rel="stylesheet">
  <link href="{{ url('assets/css/select2.min.css') }}" rel="stylesheet">
  <link href="{{ url('assets/css/chosen.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
        <div class="sidebar-brand-text mx-3">Aywa Petcare</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="fas fa-columns"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Main Menu
      </div>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('view.pelanggan') }}">
          <i class="fas fa-users"></i>
          <span>Pemilik Hewan</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('medis') }}">
          <i class="fas fa-book-open"></i>
          <span>Medical Checkup</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('pethotel') }}">
          <i class="fas fa-cat"></i>
          <span>Pet Hotel</span></a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-users"></i>
          <span>Data Pasien</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu</h6>
            <a class="collapse-item" href="{{ route('data_medis') }}">Data Transaksi Medis</a>
            <a class="collapse-item" href="{{ route('data_penitipan') }}">Data Transaksi Penitipan</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-users"></i>
          <span>Master Data</span>
        </a>
        <div id="collapseMaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Master Data</h6>
            <a class="collapse-item" href="{{ route('pegawai') }}">Data Pegawai</a>
            <a class="collapse-item" href="{{ route('view.jenis') }}">Data Jenis Hewan</a>
            <a class="collapse-item" href="{{ route('view.penyakit') }}">Data Penyakit Hewan</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->

      <div class="sidebar-heading">

      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="far fa-user-circle"></i>
          {{-- <span>auth::user()->username</span> --}}
          <span>{{ Auth::user()->username }}</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu</h6>
            <a class="collapse-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Logout
            </a>
            <form id="logout-form" action="{{ route('get.logout') }}" method="get" style="display: none;">
              @csrf
            </form>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->


      <!-- Nav Item - Tables -->


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      @include('sweetalert::alert')
      @include('layouts.header')
      
      @yield('dashboard')
      @yield('pemilik-hewan')
      @yield('medis')
      @yield('penitipan')
      @yield('data_medis')
      @yield('data_hotel')
      @yield('data_user_aywa')

      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ route('login') }}">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ url('assets/vendor/jquery/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ url('assets/vendor/jquery/jquery-ui.min.js') }}"></script>
  <script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ url('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ url('assets/js/sb-admin-2.min.js') }}"></script>
  <script src="{{ url('assets/js/chosen.jquery.min.js') }}"></script>
  <!-- Page level plugins -->
  <script src="{{ url('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ url('assets/js/demo/datatables-demo.js') }}"></script>
  {{-- new plugin --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="{{ url('assets/js/select2.js') }}"></script>
</body>
</html>
