<div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
       <div class="location-div">
        <div class="search_box">
          <div class="search_field">
            <input type="text" class="input" placeholder="Search your location">
            <button type="submit"><i class="fas fa-search"></i></button>
          </div>
        </div>
        <div class="get-location">
           <a href="">
             <div class="get-location-box d-flex justify-content-between">
              <div class="get-location-icon">
                <span><i class="fa-solid fa-location-crosshairs"></i></span>   
              </div>
              <div class="get-location-text">
                <h2>Get your location</h2>   
                <h3>Using GPS</h3>
              </div>
             </div>
           </a>     
        </div>
       </div>
    </div>

<div class="main_manu">
    <div class="container-fluid">
        <div class="row justify-content-between align-items-center">
            <div class="col-xl-2 col-lg-2 col-md-2 col-2">
                <div class="logo {{ Request::is('patient/*') || Request::is('doctor/*') ? 'logo-d' : '' }}">
                    <a href="{{ route('home') }}"><img src="{{ asset('frontend_assets/images/logo.png') }}"
                            alt="" /></a>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-7">
            <div id="main">
              <a href="javascript:void(0)" onclick="openNav()">
                <div class="location d-flex">
                  <div class="location_icon">
                    <i class="fa-solid fa-location-dot"></i>
                  </div>
                  <div class="address_loa">
                    <span>Deliver to</span>
                    17581 Sultana St, Hesperia, CA
                    92345, USA
                  </div>
                </div>
            </div>
            </a>
          </div>
          <div class="col-xxl-7 col-xl-7 col-lg-6 col-md-6 col-3">
                <div id="cssmenu">
                    <ul>
                        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
                        <li class="{{ Request::is('telehealth') ? 'active' : '' }}"><a
                                href="{{ route('telehealth') }}">Telehealth</a></li>
                        <!-- <ul>
                            <li><a href="#">Product 1</a>
                            <ul>
                                <li><a href="#">Sub Product</a></li>
                                <li><a href="#">Sub Product</a></li>
                            </ul>
                            </li>
                            <li><a href="#">Product 2</a>
                            <ul>
                                <li><a href="#">Sub Product</a></li>
                                <li><a href="#">Sub Product</a></li>
                            </ul>
                            </li>
                        </ul> -->
                        </li>
                        <li class="{{ Request::is('membership-plans') ? 'active' : '' }}"><a
                                href="{{ route('membership-plans') }}">Membership Plans</a></li>
                        {{-- <li class="{{ Request::is('mobile-health-coverage') ? 'active' : '' }}"><a href="{{ route('mobile-health-coverage') }}">Mobile Health Coverage</a></li> --}}
                        {{-- <li class="{{ Request::is('qna') ? 'active' : '' }}"><a href="{{ route('qna') }}">Q&A</a></li> --}}
                        <li
                            class="{{ Request::is('qna-blogs/*') || Request::is('blog-details/*') || Request::is('qna-blogs') ? 'active' : '' }}">
                            <a href="{{ route('blogs') }}">Q&A / 
                                Blogs</a>
                        </li>
                        <li class="{{ Request::is('contact-us') ? 'active' : '' }}"><a
                                href="{{ route('contact-us') }}">Contact Us</a></li>

                        <!-- <li><a href="about.html">About us</a></li>
            <li><a href="services.html">Services</a></li>
            <li><a href="blog.html">Blog</a></li>
            <li><a href="contact.html">Contact Us</a></li> -->
                        @if (Auth::check() && Auth::user()->hasRole('PATIENT'))
                            <li>
                                <a href="{{ route('patient.dashboard') }}"><span class="u-i"><i
                                            class="fa-regular fa-user"></i></span>Profile</a>
                            </li>
                        @elseif(Auth::check() && Auth::user()->hasRole('DOCTOR'))
                        <li>
                            <a href="{{ route('doctor.dashboard') }}"><span class="u-i"><i
                                        class="fa-regular fa-user"></i></span>Profile</a>
                        </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}"><span class="u-i"><i
                                            class="fa-regular fa-user"></i></span>LOGIN</a>
                            </li>
                        @endif
                        <li>
                            <div class="mn-btn">
                                <a href="contact.html"><span>donate</span></a>
                            </div>
                        </li>
                        {{-- <li class="nav-item">
                            <button class="btn t-btn" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasHeader" aria-controls="offcanvasHeader">
                                <i class="fa-solid fa-bars"></i>
                            </button>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasHeader" aria-labelledby="offcanvasHeaderLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasHeaderLabel">
            <div class="h-logo">
                <a href="{{ route('home') }}">
                    <img class="" src="{{ asset('frontend_assets/images/logo.png') }}">
                </a>
            </div>
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body t-body">
        <div class="d-lg-block d-none">
            At Dollar Care, we provide qualified immigrant investors a secured platform to invest in a variety of
            high-yielding and long-term projects that primarily include healthcare-related investments. We also invest
            in projects that include new construction, rehabilitation, or adaptive reuse in a variety of industries
            including retail, food service, accommodation service, multifamily, assisted living, skilled nursing,
            medical offices, hospitals, construction, and professional offices.
        </div>
        <p class="d-flex align-items-center mt-3">
            <i class="text-yellow fs-5 fa-solid fa-location-dot"></i>
            <a target="_blank" class=" ms-2 text-decoration-none text-secondary" href="#">17581 Sultana St,
                Hesperia, CA 92345, USA</a>
        </p>
        <p class="d-flex align-items-center">
            <i class="text-yellow fs-5 fa-solid fa-envelope"></i>
            <a class=" ms-2 text-decoration-none text-secondary" href="mailto:info@dollarcare.org">
                info@dollarcare.org
            </a>
        </p>
        <p class="d-flex align-items-center">
            <i class="text-yellow fs-5 fa-solid fa-phone"></i>
            <span>
                <a class=" ms-2 text-decoration-none text-secondary" href="tel:7608811141">
                    760-881-1141
                </a><br>
            </span>
        </p>
        <p class="d-flex align-items-center">
            <i class="text-yellow fs-5 fa-solid fa-fax"></i>
            <a target="_blank" class=" ms-2 text-decoration-none text-secondary" href="fax:7604862571">
                760-486-2571
            </a>
        </p>
        <h4 class="mt-3">Follow Us On</h4>
        <div class="d-flex align-items-center">
            <a class="text-secondary mx-2 fs-5" href="#" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
            <a class="text-secondary mx-2 fs-5" href="#" target="_blank"><i
                    class="fa-brands fa-facebook-f"></i></a>
            <a class="text-secondary mx-2 fs-5" href="#" target="_blank"><i class="fa-brands fa-twitter"></i></a>
            <a class="text-secondary mx-2 fs-5" href="#" target="_blank"><i
                    class="fa-brands fa-instagram"></i></a>
            <a class="text-secondary mx-2 fs-5" href="#" target="_blank"><i
                    class="fa-brands fa-youtube"></i></a>
        </div>
    </div>
</div>
