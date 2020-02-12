<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
  <i class="fa fa-bars"></i>
</button>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

  <!-- Nav Item - Search Dropdown (Visible Only XS) -->
  <li class="nav-item dropdown no-arrow d-sm-none">
    <!-- Dropdown - Messages -->
    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
      <form class="form-inline mr-auto w-100 navbar-search">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </li>

  <!-- Nav Item - Alerts -->

  <div class="topbar-divider d-none d-sm-block"></div>

  <!-- Nav Item - User Information -->
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="mr-2 d-none d-lg-inline text-gray-600 small">
        @if (Auth::user()->level == 1)
            <span>Super Admin</span>
        @endif

        @if (Auth::user()->level == 2)
            <span>Admin</span>
        @endif

        @if (Auth::user()->level == 3)
            <span>Dokter Hewan</span>
        @endif

        @if (Auth::user()->level == 4)
            <span>Helper</span>
        @endif
        {{-- <span id="date">auth name</span> --}}
      </span>
      <img class="img-profile rounded-circle" src="/assets/img/profil_aywa.png" >
    </a>
    <!-- Dropdown - User Information -->
  </li>

</ul>
</nav>

<script>
</script>