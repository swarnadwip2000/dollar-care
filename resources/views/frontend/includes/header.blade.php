<div class="main_manu">
    <div class="container-fluid">
        <div class="row justify-content-between align-items-center">
            <div class="col-xl-2 col-lg-2 col-md-2 col-5">
                <div class="logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('frontend_assets/images/logo.png') }}"
                            alt="" /></a>
                </div>
            </div>
            <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-6">
                <div id="cssmenu">
                    <ul>
                        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
                        @if (Auth::check() && (Auth::user()->hasRole('DOCTOR') || Auth::user()->hasRole('PATIENT')))
                            <li class="{{ Request::is('telehealth') ? 'active' : '' }}"><a
                                    href="{{ route('telehealth') }}">Telehealth</a></li>
                        @else
                            <li><a href="{{ route('login') }}">Telehealth</a></li>
                        @endif
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
                        <li class="{{ Request::is('qna-blogs') ? 'active' : '' }}"><a href="{{ route('blogs') }}">Q&A /
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
                            <a href="{{ route('logout') }}"><span class="u-i"><i
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
                        <li class="nav-item">
                            <button class="btn t-btn" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasHeader" aria-controls="offcanvasHeader">
                                <i class="fa-solid fa-bars"></i>
                            </button>
                        </li>
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
            <a class="text-secondary mx-2 fs-5" href="#" target="_blank"><i class="fa-brands fa-youtube"></i></a>
        </div>
    </div>
</div>
