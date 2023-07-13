<div class="sidebar-left">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav l-navbar-1 show">
            <div>
                <div class="nav_list">
                    <ul>
                        <li><a href="{{ route('doctor.dashboard') }}" class="nav_link {{ Request::is('doctor/dashboard') ? 'active' : '' }}"> <i
                                    class='bx bx-grid-alt nav_icon'></i>
                                <span class="nav_name">Dashboard</span> </a>
                        </li>
                        <li><a href="#" class="nav_link sub-link {{ Request::is('doctor/profile') || Request::is('doctor/change-password') ? 'active' : '' }}">
                                <i class='bx bxs-user nav_icon'></i><span class="nav_name">Manage
                                    Account</span></a>
                            <ul class="sub-nav">
                                <li><a href="{{ route('doctor.profile') }}" class="nav_link {{ Request::is('doctor/profile') ? 'sub-li-active' : '' }}">
                                        <i class='bx bxs-user'></i><span class="nav_name">My
                                            Profile</span> </a></li>
                                <li><a href="{{ route('doctor.change.password') }}" class="nav_link {{ Request::is('doctor/change-password') ? 'sub-li-active' : '' }}">
                                        <i class='bx bxs-key'></i><span class="nav_name">Change
                                            Password</span> </a></li>
                            </ul>
                        </li>
                        <div class="sub-head">
                            <h4>ONLINE CONSULTATION</h4>
                        </div>
                        <li> <a href="#" class="nav_link sub-link">
                                <i class='bx bx-conversation nav_icon'></i>
                                <span class="nav_name">Chat</span> </a>
                            <ul class="sub-nav">
                                <li><a href="chat-request.html" class="nav_link">
                                        <i class='bx bx-comment-dots'></i><span
                                            class="nav_name">Chat Request</span> </a></li>
                                <li><a href="chat-history.html" class="nav_link">
                                        <i class='bx bx-stopwatch'></i><span class="nav_name">Chat
                                            History</span> </a></li>
                            </ul>
                        </li>
                        <div class="sub-head">
                            <h4>CLINIC VISIT</h4>
                        </div>
                        <li> <a href="booking-history.html" class="nav_link"><i
                                    class='bx bxs-calendar nav_icon'></i> <span
                                    class="nav_name">Booking History</span> </a></li>
                        <li><a href="{{ route('doctor.notifications') }}" class="nav_link {{ Request::is('doctor/notifications') ? 'active' : '' }}"> <i
                                    class='bx bx-clipboard nav_icon'></i> <span
                                    class="nav_name">Notification</span> </a></li>
                        <li><a href="{{ route('doctor.manage-clinic.index') }}" class="nav_link {{ Request::is('doctor/manage-clinic*') ? 'active' : '' }}"> <i
                                    class='bx bxs-map nav_icon'></i> <span class="nav_name">Manage
                                    Clinic Address</span> </a></li>
                        <li><a href="{{ route('doctor.settings') }}" class="nav_link {{ Request::is('doctor/settings') ? 'active' : '' }}">
                                <i class='bx bx-cog nav_icon'></i><span
                                    class="nav_name">Settings</span>
                            </a></li>
                        <li><a href="{{ route('doctor.logout') }}" class="nav_link">
                                <i class='bx bx-log-out nav_icon'></i><span
                                    class="nav_name">Logout</span>
                            </a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>