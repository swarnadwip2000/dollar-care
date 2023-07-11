@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    Doctor Dashboard
@endsection
@push('styles')
@endpush

@section('content')
    <section class="sidebar-sec" id="body-pd">
        <div class="container-fluid">
            <div class="sidebar-wrap d-flex justify-content-between">

                @include('frontend.doctor.partials.sidebar')


                <!-- Content -->
                <div class="sidebar-right height-100">
                    <div class="content">
                        <div class="row">
                            <div class="col-xl-6 col-12">
                                <div class="profile-div d-flex align-items-center">
                                    <div class="profile-img active-green">
                                      @if(Auth::user()->profile_picture)
                                      <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="">
                                      @else
                                      <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                      @endif
                                    </div>
                                    <div class="profile-text">
                                        <h2><span>Hello!</span>Dr. {{Auth::user()->name}}</h2>
                                        <a href="mailto:{{Auth::user()->email}}">{{Auth::user()->email}}</a>
                                        <h3>Online</h3>
                                    </div>
                                </div>
                                <div class="my-app-div dr-panel-div mb-3">
                                    <div class="my-app-head-wrap d-flex justify-content-between align-items-center">
                                        <div class="my-app-head">
                                            <h3>Chat Request</h3>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-xl-12 col-12">
                                            <div class="profile-div-box d-flex align-items-center justify-content-between">
                                                <div
                                                    class="profile-div profile-div-2 profile-div-3 d-flex align-items-center">
                                                    <div class="profile-img">
                                                        <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                                    </div>
                                                    <div class="profile-text">
                                                        <h2>Adam Smith</h2>
                                                    </div>
                                                </div>
                                                <div class="patient-age">
                                                    <h3>Age: <span>28</span></h3>
                                                </div>
                                                <div class="patient-age">
                                                    <h3>Gender: <span>Male</span></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-app-div dr-panel-div">
                                    <div class="my-app-head-wrap d-flex justify-content-between align-items-center">
                                        <div class="my-app-head">
                                            <h3>Chat History</h3>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-xl-12 col-12">
                                            <div class="profile-div-box-wrap srl" id="srl_1">
                                                <div
                                                    class="profile-div-box mb-3 d-flex justify-content-between align-items-center">
                                                    <div
                                                        class="profile-div profile-div-2 profile-div-3 d-flex align-items-center">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                                        </div>
                                                        <div class="profile-text">
                                                            <h2>Adam Smith</h2>
                                                            <p>Lorem ipsum dolor sit amet consectetur. Pellentesque
                                                                viverra imperdiet ipsum augue id aliquam orci integer.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="patient-age">
                                                        <h3><span>09:34 PM</span></h3>
                                                    </div>
                                                </div>
                                                <div
                                                    class="profile-div-box mb-3 d-flex justify-content-between align-items-center">
                                                    <div
                                                        class="profile-div profile-div-2 profile-div-3 d-flex align-items-center">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                                        </div>
                                                        <div class="profile-text">
                                                            <h2>Adam Smith</h2>
                                                            <p>Lorem ipsum dolor sit amet consectetur. Pellentesque
                                                                viverra imperdiet ipsum augue id aliquam orci integer.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="patient-age">
                                                        <h3><span>09:34 PM</span></h3>
                                                    </div>
                                                </div>
                                                <div
                                                    class="profile-div-box mb-3 d-flex justify-content-between align-items-center">
                                                    <div
                                                        class="profile-div profile-div-2 profile-div-3 d-flex align-items-center">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                                        </div>
                                                        <div class="profile-text">
                                                            <h2>Adam Smith</h2>
                                                            <p>Lorem ipsum dolor sit amet consectetur. Pellentesque
                                                                viverra imperdiet ipsum augue id aliquam orci integer.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="patient-age">
                                                        <h3><span>09:34 PM</span></h3>
                                                    </div>
                                                </div>
                                                <div
                                                    class="profile-div-box mb-3 d-flex justify-content-between align-items-center">
                                                    <div
                                                        class="profile-div profile-div-2 profile-div-3 d-flex align-items-center">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                                        </div>
                                                        <div class="profile-text">
                                                            <h2>Adam Smith</h2>
                                                            <p>Lorem ipsum dolor sit amet consectetur. Pellentesque
                                                                viverra imperdiet ipsum augue id aliquam orci integer.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="patient-age">
                                                        <h3><span>09:34 PM</span></h3>
                                                    </div>
                                                </div>
                                                <div
                                                    class="profile-div-box mb-3 d-flex justify-content-between align-items-center">
                                                    <div
                                                        class="profile-div profile-div-2 profile-div-3 d-flex align-items-center">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                                        </div>
                                                        <div class="profile-text">
                                                            <h2>Adam Smith</h2>
                                                            <p>Lorem ipsum dolor sit amet consectetur. Pellentesque
                                                                viverra imperdiet ipsum augue id aliquam orci integer.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="patient-age">
                                                        <h3><span>09:34 PM</span></h3>
                                                    </div>
                                                </div>
                                                <div
                                                    class="profile-div-box mb-3 d-flex justify-content-between align-items-center">
                                                    <div
                                                        class="profile-div profile-div-2 profile-div-3 d-flex align-items-center">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                                        </div>
                                                        <div class="profile-text">
                                                            <h2>Adam Smith</h2>
                                                            <p>Lorem ipsum dolor sit amet consectetur. Pellentesque
                                                                viverra imperdiet ipsum augue id aliquam orci integer.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="patient-age">
                                                        <h3><span>09:34 PM</span></h3>
                                                    </div>
                                                </div>
                                                <div
                                                    class="profile-div-box mb-3 d-flex justify-content-between align-items-center">
                                                    <div
                                                        class="profile-div profile-div-2 profile-div-3 d-flex align-items-center">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                                        </div>
                                                        <div class="profile-text">
                                                            <h2>Adam Smith</h2>
                                                            <p>Lorem ipsum dolor sit amet consectetur. Pellentesque
                                                                viverra imperdiet ipsum augue id aliquam orci integer.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="patient-age">
                                                        <h3><span>09:34 PM</span></h3>
                                                    </div>
                                                </div>
                                                <div
                                                    class="profile-div-box d-flex justify-content-between align-items-center">
                                                    <div
                                                        class="profile-div profile-div-2 profile-div-3 d-flex align-items-center">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                                        </div>
                                                        <div class="profile-text">
                                                            <h2>Adam Smith</h2>
                                                            <p>Lorem ipsum dolor sit amet consectetur. Pellentesque
                                                                viverra imperdiet ipsum augue id aliquam orci integer.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="patient-age">
                                                        <h3><span>09:34 PM</span></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12">
                                <div class="my-app-div dr-panel-div justify-content-between align-items-center mb-3">
                                    <div class="my-app-head-wrap d-flex justify-content-between align-items-center">
                                        <div class="my-app-head">
                                            <h3>Revenue</h3>
                                        </div>
                                        <div class="my-app-head">
                                            <h5>Last 7 days VS prior week</h5>
                                        </div>
                                    </div>
                                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                                </div>

                                <div class="my-app-div dr-panel-div justify-content-between align-items-center">
                                    <div class="my-app-head-wrap d-flex justify-content-between align-items-center">
                                        <div class="my-app-head">
                                            <h3>Booking History</h3>
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
    </section>
@endsection

@push('scripts')
@endpush
