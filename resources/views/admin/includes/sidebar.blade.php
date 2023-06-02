<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sidebar-vertical">
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="{{ Request::is('admin/dashboard*') ? 'active' : ' ' }}">
                    <a href="{{ route('admin.dashboard') }}" ><i class="la la-dashboard"></i> <span>Dashboard</span></a>                 
                </li>

                <li class="submenu">
                    <a href="#" class="{{ Request::is('admin/profile*') || Request::is('admin/password*') || Request::is('admin/detail*') ? 'active' : ' ' }}"><i class="la la-user-cog"></i> <span>Manage Account </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ Request::is('admin/profile*') ? 'active' : ' ' }}">
                            <a href="{{ route('admin.profile') }}">My Profile</a>
                        </li>
                        <li class="{{ Request::is('admin/password*') ? 'active' : ' ' }}">
                            <a href="{{ route('admin.password') }}">Change Password</a>
                        </li>                
                    </ul>
                </li>
                <li class="menu-title">
                    <span>User Management</span>
                </li>
                <li class="{{ Request::is('admin/patients*') ? 'active' : ' ' }}">
                    <a href="{{ route('patients.index') }}" ><i class="fa fa-wheelchair"></i> <span>Manage Patients</span></a>                 
                </li>

                <li class="{{ Request::is('admin/doctors*') ? 'active' : ' ' }}">
                    <a href="{{ route('doctors.index') }}" ><i class="fas fa-user-md"></i> <span>Manage Doctors</span></a>                 
                </li>
                <li class="menu-title">
                    <span>Others</span>
                </li>
                <li class="submenu">
                    <a href="#" class="{{ Request::is('admin/blogs*') ? 'active' : ' ' }}"><i class="la la-blog"></i> <span>Blogs</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ Request::is('admin/blogs/categories*') ? 'active' : ' ' }}">
                            <a href="{{ route('blogs.categories.index') }}">Category</a>
                        </li>
                        <li class="{{ Request::is('admin/blogs') | Request::is('admin/blogs/create') ? 'active' : ' ' }}">
                            <a href="{{ route('blogs.index') }}">Details</a>
                        </li>                
                    </ul>
                </li>
                <li class="{{ Request::is('admin/contact-us*') ? 'active' : ' ' }}">
                    <a href="{{ route('contact-us.index') }}" ><i class="la la-phone"></i> <span>Contact Us</span></a>                 
                </li>
                <li class="{{ Request::is('admin/newsletters*') ? 'active' : ' ' }}">
                    <a href="{{ route('newsletters.index') }}" ><i class="la la-paper-plane"></i> <span>Newsletter</span></a>                 
                </li>
                <li class="submenu">
                    <a href="#" class="{{ Request::is('admin/cms*') ? 'active' : ' ' }}"><i class="la la-cog"></i> <span>Settings</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ Request::is('admin/cms/qna*') ? 'active' : ' ' }}">
                            <a href="{{ route('cms.qna.index') }}">QNA Page</a>
                        </li>         
                        <li class="{{ Request::is('admin/cms/contact-us*') ? 'active' : ' ' }}">
                            <a href="{{ route('cms.contact-us.index') }}">Contact Us Page</a>
                        </li>     
                    </ul>
                </li>
            </ul> 
        </div>
    </div>
</div>


