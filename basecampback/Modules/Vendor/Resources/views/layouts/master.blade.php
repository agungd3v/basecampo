<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Vendor</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  @stack('css')
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">        
  <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
  <div id="app">
    <div id="sidebar" class="active">
      <div class="sidebar-wrapper active">
        {{-- <div class="sidebar-header">
          <div class="d-flex justify-content-between">
            <div class="logo">
              <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
            </div>
            <div class="toggler">
              <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
          </div>
        </div> --}}
        <div class="sidebar-menu">
          <ul class="menu">
            <li class="sidebar-title">Menu</li>
            <li class="sidebar-item @yield('dashboard')">
              <a href="{{ route('vendor.dashboard') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item @yield('company') has-sub">
              <a href="#" class='sidebar-link'>
                <i class="bi bi-building"></i>
                <span>Company</span>
              </a>
              <ul class="submenu @yield('company')">
                <li class="submenu-item @yield('company-data')">
                  <a href="{{ route('vendor.company') }}">Company Data</a>
                </li>
                <li class="submenu-item @yield('company-create')">
                  <a href="{{ route('vendor.company.create') }}">Add Company</a>
                </li>
              </ul>
            </li>
            <li class="sidebar-item @yield('employee')">
              <a href="{{ route('vendor.employee') }}" class="sidebar-link">
                <i class="bi bi-people-fill"></i>
                <span>Employee</span>
              </a>
            </li>
            <li class="sidebar-item @yield('tasks')">
              <a href="{{ route('vendor.task') }}" class="sidebar-link">
                <i class="bi bi-kanban-fill"></i>
                <span>Tasks</span>
              </a>
            </li>
            <li class="sidebar-title">Raise Support</li>
            <li class="sidebar-item">
              <a href="{{ route('vendor.logout') }}" class='sidebar-link' onclick="event.preventDefault();document.getElementById('logout-form').submit()">
                <i class="bi bi-circle-square"></i>
                <span>Sign Out</span>
              </a>
              <form id="logout-form" action="{{ route('vendor.logout') }}" method="POST" style="display: none">@csrf</form>
            </li>
          </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
      </div>
    </div>
    <div id="main">
      <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
          <i class="bi bi-justify fs-3"></i>
        </a>
      </header>
      @yield('content')
    </div>
  </div>
  @stack('js')
  <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/mazer.js') }}"></script>
</body>
</html>
