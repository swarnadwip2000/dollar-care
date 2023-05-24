<div class="main_manu">
    <div class="container-fluid">
      <div class="row justify-content-between align-items-center">
        <div class="col-xl-2 col-lg-2 col-md-3 col-5">
          <div class="logo">
            <a href="index.html"
              ><img src="{{ asset('frontend_assets/images/logo.png') }}" alt=""
            /></a>
          </div>
        </div>
        <div class="col-xxl-7 col-xl-7 col-lg-9 col-md-7 col-6">
          <div id="cssmenu">
            <ul>
              <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
              <li class="{{ Request::is('about-us') ? 'active' : '' }}">
                <a href="{{ route('about-us') }}">About us</a>
                
              </li>
              <li class="{{ Request::is('services') ? 'active' : '' }}"><a href="{{ route('services') }}">Services</a></li>
              <li class="{{ Request::is('blogs') ? 'active' : '' }}"><a href="{{ route('blogs') }}">Blog</a></li>
              <li class="{{ Request::is('contact-us') ? 'active' : '' }}"><a href="{{ route('contact-us') }}">Contact Us</a></li>
              <li>
                <a href="login.html"
                  ><span class="u-i"
                    ><i class="fa-regular fa-user"></i></span
                  >LOGIN</a
                >
              </li>
              <li>
                <div class="mn-btn">
                  <a href="contact.html"><span>donate</span></a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>