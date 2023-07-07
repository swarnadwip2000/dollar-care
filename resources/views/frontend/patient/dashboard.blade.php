@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    Patient Dashboard
@endsection
@push('styles')
@endpush

@section('content')
<section class="sidebar-sec" id="body-pd">
    <div class="container-fluid">
      <div class="sidebar-wrap d-flex justify-content-between">

        @include('frontend.patient.partials.sidebar')

       
        <!-- Content -->
        <div class="sidebar-right height-100">
          <div class="content">
            <div class="row">
              <div class="col-xl-3">
                <div class="profile-div d-flex justify-content-center align-items-center">
                  <div class="profile-img">
                    @if(Auth::user()->profile_picture)
                    <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="">
                    @else
                    <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                    @endif
                  </div>
                  <div class="profile-text">
                    <h2><span>Hello!</span>{{Auth::user()->name}}</h2>
                    <a href="mailto:{{Auth::user()->email}}">{{Auth::user()->email}}</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="my-app-div-wrap">
              <div class="row">
                <div class="col-xl-6 col-12">
                  <div class="my-app-div">
                    <div class="my-app-head-wrap d-flex justify-content-between align-items-center">
                      <div class="my-app-head">
                        <h3>My Appointment</h3>
                      </div>
                      <div class="my-app-head">
                        <h4>00.15 min left</h4>
                      </div>
                    </div>
                    <hr/>
                    <div class="row">
                      <div class="col-xl-6 col-12">
                        <div class="profile-div profile-div-2 d-flex align-items-center">
                          <div class="profile-img">
                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                          </div>
                          <div class="profile-text">
                            <h2>Dr. Sandip Rungta</h2>
                            <p> Ear-Nose-Throat (ENT) Special</p>
                            <p>14-17 years experience</p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xl-6 col-12">
                          <div class="app-time-wrap d-flex  align-items-center">
                            <div class="app-time-img">
                              <span><i class="fa-regular fa-clock"></i></span>
                            </div>
                            <div class="app-time me-3">
                              <h3> Appointment time</h3>
                              <p>Mon, 24 Apr 05.00 PM | <span>in 1 hour and 15min</span></p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xl-6 col-12">
                          <div class="app-time-wrap d-flex align-items-center">
                            <div class="app-time-img">
                              <span><i class="fa-solid fa-house-chimney-medical"></i></span>
                            </div>
                            <div class="app-time app-time-1">
                              <h3>Clinic Details</h3>
                              <p>ABCD Medical Hall
                                <span>JC 16 JK 02 block 7777</span>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="col-xl-6 col-12">
                  <div class="my-app-div justify-content-between align-items-center">
                    <div class="my-app-head-wrap d-flex justify-content-between align-items-center">
                      <div class="my-app-head">
                        <h3>Doctors<span>Suggestion for you</span></h3>
                      </div>
                    </div>
                    <hr />
                    <div class="dr-suggestio-wrap srl" id="srl_1">
                      <div class="dr-suggestion">
                        <div class="row">
                          <div class="col-xl-4 col-md-6 col-12">
                            <div class="dr-name d-flex align-items-center">
                              <div class="dr-name-img">
                                <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                              </div>
                              <div class="dr-name-text">
                                <h2>Adam Smith</h2>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-6 col-12">
                            <div class="app-time app-time-2">
                              <h3><i class="fa-regular fa-clock"></i>
                                Appointment time</h3>
                              <p>Mon, 24 Apr 05.00 PM <span>in 1 hour and 15min</span>
                              </p>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-6 col-12">
                            <div class="app-time app-time-1 me-3">
                              <h3><i class="fa-solid fa-house-chimney-medical"></i>
                                  Clinic Details</h3>
                              <p>ABCD Medical Hall
                                  <span>JC 16 &amp; JK 02 block 7777</span>
                              </p>
                          </div>
                          </div>
                        </div>
                      </div>
                      <div class="dr-suggestion">
                        <div class="row">
                          <div class="col-xl-4 col-md-6 col-12">
                            <div class="dr-name d-flex align-items-center">
                              <div class="dr-name-img">
                                <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                              </div>
                              <div class="dr-name-text">
                                <h2>Adam Smith</h2>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-6 col-12">
                            <div class="app-time app-time-2">
                              <h3><i class="fa-regular fa-clock"></i>
                                Appointment time</h3>
                              <p>Mon, 24 Apr 05.00 PM <span>in 1 hour and 15min</span>
                              </p>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-6 col-12">
                            <div class="app-time app-time-1 me-3">
                              <h3><i class="fa-solid fa-house-chimney-medical"></i>
                                  Clinic Details</h3>
                              <p>ABCD Medical Hall
                                  <span>JC 16 &amp; JK 02 block 7777</span>
                              </p>
                          </div>
                          </div>
                        </div>
                      </div>
                      <div class="dr-suggestion">
                        <div class="row">
                          <div class="col-xl-4 col-md-6 col-12">
                            <div class="dr-name d-flex align-items-center">
                              <div class="dr-name-img">
                                <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                              </div>
                              <div class="dr-name-text">
                                <h2>Adam Smith</h2>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-6 col-12">
                            <div class="app-time app-time-2">
                              <h3><i class="fa-regular fa-clock"></i>
                                Appointment time</h3>
                              <p>Mon, 24 Apr 05.00 PM <span>in 1 hour and 15min</span>
                              </p>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-6 col-12">
                            <div class="app-time app-time-1 me-3">
                              <h3><i class="fa-solid fa-house-chimney-medical"></i>
                                  Clinic Details</h3>
                              <p>ABCD Medical Hall
                                  <span>JC 16 &amp; JK 02 block 7777</span>
                              </p>
                          </div>
                          </div>
                        </div>
                      </div>
                      <div class="dr-suggestion">
                        <div class="row">
                          <div class="col-xl-4 col-md-6 col-12">
                            <div class="dr-name d-flex align-items-center">
                              <div class="dr-name-img">
                                <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                              </div>
                              <div class="dr-name-text">
                                <h2>Adam Smith</h2>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-6 col-12">
                            <div class="app-time app-time-2">
                              <h3><i class="fa-regular fa-clock"></i>
                                Appointment time</h3>
                              <p>Mon, 24 Apr 05.00 PM <span>in 1 hour and 15min</span>
                              </p>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-6 col-12">
                            <div class="app-time app-time-1 me-3">
                              <h3><i class="fa-solid fa-house-chimney-medical"></i>
                                  Clinic Details</h3>
                              <p>ABCD Medical Hall
                                  <span>JC 16 &amp; JK 02 block 7777</span>
                              </p>
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
        </div>
      </div>
      </div>
  </section>
@endsection

@push('scripts')
@endpush
