<div class="sidebar-left">
    <header class="header" id="header">
      <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
      <nav class="nav l-navbar-1 show">
          <div>
              <div class="nav_list">
                  <a href="{{ route('doctor.dashboard') }}" class="nav_link {{ Request::is('doctor/dashboard') ? 'active' : '' }}"> <i
                          class='bx bx-grid-alt nav_icon'></i> <span
                          class="nav_name">Dashboard</span> </a>
                  {{-- <a href="#" class="nav_link {{ Request::is('patient/my-appointment') ? 'active' : '' }}">
                      <i class='bx bx-calendar nav_icon'></i><span class="nav_name">My
                          Appointment</span> </a>
                  <a href="#" class="nav_link {{ Request::is('patient/payment-history') ? 'active' : '' }}"> <i
                          class='bx bx-notepad nav_icon'></i> <span class="nav_name">Payment
                          History</span> </a> --}}
                  <a href="{{ route('doctor.profile') }}" class="nav_link {{ Request::is('doctor/profile') ? 'active' : '' }}"> <i class='bx bx-user nav_icon'></i>
                      <span class="nav_name">My
                          Profile</span></a>
                  <a href="{{ route('doctor.notifications') }}" class="nav_link {{ Request::is('doctor/notifications') ? 'active' : '' }}"> <i
                          class='bx bx-clipboard nav_icon'></i> <span
                          class="nav_name">Notification</span> </a>
                  <a href="{{ route('doctor.settings') }}" class="nav_link {{ Request::is('doctor/setting') ? 'active' : '' }}">
                      <i class='bx bx-cog nav_icon'></i><span class="nav_name">Settings</span>
                  </a>
                  <a href="{{ route('doctor.logout') }}" class="nav_link">
                      <i class='bx bx-log-out nav_icon'></i><span class="nav_name">Logout</span>
                  </a>
              </div>
          </div>
      </nav>
  </div>