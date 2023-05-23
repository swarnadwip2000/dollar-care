@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    Services
@endsection
@push('styles')
@endpush

@section('content')
<section class="inr-bnr">
    <div class="inr-bnr-img">
      <img src="{{asset('frontend_assets/images/serv-bg.jpg')}}" alt="" />
      <div class="inr-bnr-text">
        <h1>Our Services</h1>
      </div>
    </div>
  </section>
  <section class="serv-inr">
    <div class="container">
      <div class="serv-inr-wrap">
        <div class="row justify-content-between align-items-center">
          <div class="col-xl-5 col-md-12 col-12">
            <div class="serv-inr-img">
              <img src="{{asset('frontend_assets/images/sev-1.jpg')}}" alt="" />
            </div>
          </div>
          <div class="col-xl-6 col-md-12 col-12">
            <div class="serv-inr-text">
              <div class="head-1 h-b">
                <h2>Individual Online Enrollment (IOE) Link</h2>
              </div>
              <div class="para p-b">
                <p>
                  At Dollar Care, we provide stratified individual online
                  enrollments for your Health Savings Account and other
                  accounts related to real estate, rehabilitation, and other
                  such areas. Complete your application within 10 minutes
                  and get quick access to your enrollment with our
                  assistance. Get your insurance covered through High
                  Deductible Health Plans and an HSA savings account. In
                  addition, you can use the contributions to the accounts to
                  pay for your medical expenses, which the HDHP may not
                  cover.
                </p>
              </div>
              <div class="main-btn pt-4">
                <a href="about.html" tabindex="0"
                  ><span>Online Enrollment (IOE)</span
                  ><span class="btn-arw"
                    ><i class="fa-solid fa-arrow-right"></i></span
                ></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="serv-inr-wrap">
        <div class="row justify-content-between align-items-center">
          <div class="col-xl-6 col-md-12 col-12">
            <div class="serv-inr-text">
              <div class="head-1 h-b">
                <h2>Employer Sign-up Link</h2>
              </div>
              <div class="para p-b">
                <p>
                  This form is the first step of getting your Health Savings
                  Account program. Completing this form allows you to have
                  access to the HSA's bank employer site by which you can
                  manage your benefits programs. We make it convenient for
                  you to manage your employee's list, access education
                  materials, and so on. A summary of your enrollment with
                  the contribution option will be emailed to you within two
                  business days after submitting the form. We at Dollar Care
                  assist you at every step, and we are available 24x7 at
                  your service.
                </p>
              </div>
              <div class="main-btn pt-4">
                <a href="about.html" tabindex="0"
                  ><span>Employer Sign-up</span
                  ><span class="btn-arw"
                    ><i class="fa-solid fa-arrow-right"></i></span
                ></a>
              </div>
            </div>
          </div>
          <div class="col-xl-5 col-md-12 col-12">
            <div class="serv-inr-img">
              <img src="{{asset('frontend_assets/images/sev-2.jpg')}}" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> 
  <section class="d-mem d-mem-serv">
    <div class="container">
      <div class="abt-why">
        <div class="row justify-content-center">
          <div class="col-xl-12 text-center pb-5">
            <div class="head-1 h-b">
              <h2>Why Do We Stand Out?</h2>
            </div>
            <div class="para p-b">
              <p>
                Lorem ipsum dolor sit amet consectetur. Morbi quis eu
                volutpat sed tristique fusce amet.
              </p>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 col-12 p-0">
            <div class="abt-why-box">
              <div class="wht-slide">
                <div class="wht-slide-wrap">
                  <div class="wht-slide-box">
                    <div class="wht-slide-icon-div">
                      <div class="wht-slide-icon-1 wht-slide-icon">
                        <img src="{{asset('frontend_assets/images/sr-1.png')}}" alt="" />
                      </div>
                      <div class="wht-slide-icon wht-slide-icon-2">
                        <img src="{{asset('frontend_assets/images/sr-1.1.png')}}" alt="" />
                      </div>
                    </div>
                    <div class="wht-slide-text">
                      <div class="wht-slide-h h-b pb-3">
                        <h3>Planning and Advice</h3>
                      </div>
                      <div class="para p-b wht-slide-p">
                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 col-12 p-0">
            <div class="abt-why-box">
              <div class="wht-slide">
                <div class="wht-slide-wrap">
                  <div class="wht-slide-box">
                    <div class="wht-slide-icon-div">
                      <div class="wht-slide-icon-1 wht-slide-icon">
                        <img src="{{asset('frontend_assets/images/sr-2.png')}}" alt="" />
                      </div>
                      <div class="wht-slide-icon wht-slide-icon-2">
                        <img src="{{asset('frontend_assets/images/sr-2.1.png')}}" alt="" />
                      </div>
                    </div>
                    <div class="wht-slide-text">
                      <div class="wht-slide-h h-b pb-3">
                        <h3>High Yield Projects</h3>
                      </div>
                      <div class="para p-b wht-slide-p">
                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 col-12 p-0">
            <div class="abt-why-box">
              <div class="wht-slide">
                <div class="wht-slide-wrap">
                  <div class="wht-slide-box">
                    <div class="wht-slide-icon-div">
                      <div class="wht-slide-icon-1 wht-slide-icon">
                        <img src="{{asset('frontend_assets/images/sr-3.png')}}" alt="" />
                      </div>
                      <div class="wht-slide-icon wht-slide-icon-2">
                        <img src="{{asset('frontend_assets/images/sr-3.1.png')}}" alt="" />
                      </div>
                    </div>
                    <div class="wht-slide-text">
                      <div class="wht-slide-h h-b pb-3">
                        <h3>Robust Investment Tools</h3>
                      </div>
                      <div class="para p-b wht-slide-p">
                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="serv-inr">
    <div class="container">
      <div class="serv-inr-wrap">
        <div class="row justify-content-between align-items-center">
          <div class="col-xl-5 col-md-12 col-12">
            <div class="serv-inr-img">
              <img src="{{asset('frontend_assets/images/sev-3.jpg')}}" alt="" />
            </div>
          </div>
          <div class="col-xl-6 col-md-12 col-12">
            <div class="serv-inr-text">
              <div class="head-1 h-b">
                <h2>
                  Family-Self-Directed Brokerage Account with TD Ameritrade
                </h2>
              </div>
              <div class="para p-b">
                <p>
                  Nowadays, most investors are turning to a self-directed
                  brokerage account to take their investment decisions by
                  themselves. These accounts enable you to pick and choose
                  from every investment option possible, all from funds to
                  individual stocks. With Dollar Care, you can open up your
                  self-directed brokerage account without any trouble. Just
                  log in to your HSA account and click on manage
                  investments. Follow the further steps, and you will get a
                  welcome mail from our side and a letter containing your
                  password. You can change your password when you log in for
                  the first time to your account.
                </p>
              </div>
              <div class="main-btn pt-4">
                <a href="about.html" tabindex="0"
                  ><span
                    >Self-Directed Brokerage Account with TD
                    Ameritrade</span
                  ><span class="btn-arw"
                    ><i class="fa-solid fa-arrow-right"></i></span
                ></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="blog-sec">
    <div class="container">
      <div class="blog-sec-wrap">
        <div class="blog-sec-head text-center pb-5">
          <div class="head-1 h-b pb-3">
            <h2>Check Out Some Of Our Recent Blog Posts</h2>
          </div>
          <div class="para p-b">
            <p>
              We aim at changing the global perspective at health and
              wellness in the United States by providing people the
              necessary<br />
              knowledge and resources.
            </p>
          </div>
        </div>
      </div>
      <div class="blog-box-wrap">
        <div class="row justify-content-between">
          <div class="col-xl-6 col-md-6 col-12">
            <div class="blog-box-img">
              <img src="{{asset('frontend_assets/images/blog-img.jpg')}}" alt="" />
            </div>
            <div class="blog-rit d-flex">
              <div class="bl-text bl-text-1">
                <h3>Five Benefits Of Individual Health Insurance</h3>
                <p>
                  Individual health insurance is a health policy that an
                  individual purchases to shield themselves against
                  unpredictable health issues...
                </p>
                <div class="date-box d-flex align-items-center">
                  <div class="bl-date-img">
                    <img src="{{asset('frontend_assets/images/date.png')}}" alt="" />
                  </div>
                  <div class="bl-date">
                    <h4>17 May’ 2022</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-md-6 col-12">
            <div class="blog-rit d-flex">
              <div class="bl-lft">
                <img src="{{asset('frontend_assets/images/blog-1.jpg')}}" alt="" />
              </div>
              <div class="bl-text">
                <h3>What Are the Advantages of Group Health Insurance?</h3>
                <div class="date-box d-flex align-items-center pt-3">
                  <div class="bl-date-img">
                    <img src="{{asset('frontend_assets/images/date.png')}}" alt="" />
                  </div>
                  <div class="bl-date">
                    <h4>17 May’ 2022</h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="blog-rit d-flex">
              <div class="bl-lft">
                <img src="{{asset('frontend_assets/images/blog-2.jpg')}}" alt="" />
              </div>
              <div class="bl-text">
                <h3>
                  The Big Ideas: Foremost Organization Mission Health
                  Insurance
                </h3>
                <div class="date-box d-flex align-items-center pt-3">
                  <div class="bl-date-img">
                    <img src="{{asset('frontend_assets/images/date.png')}}" alt="" />
                  </div>
                  <div class="bl-date">
                    <h4>17 May’ 2022</h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="blog-rit d-flex">
              <div class="bl-lft">
                <img src="{{asset('frontend_assets/images/blog-3.jpg')}}" alt="" />
              </div>
              <div class="bl-text">
                <h3>
                  Individual Health Insurance, Health Policy, Health
                  Insurance, Insurance, Health
                </h3>
                <div class="date-box d-flex align-items-center pt-3">
                  <div class="bl-date-img">
                    <img src="{{asset('frontend_assets/images/date.png')}}" alt="" />
                  </div>
                  <div class="bl-date">
                    <h4>17 May’ 2022</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
@endpush