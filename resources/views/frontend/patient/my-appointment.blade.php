@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    Patient Profile
@endsection
@push('styles')
@endpush

@section('content')
    <section class="sidebar-sec" id="body-pd">
        <div class="container-fluid">
            <div class="sidebar-wrap d-flex justify-content-between">
                @include('frontend.patient.partials.sidebar')
            </div>
            <!-- Content -->
            <div class="sidebar-right height-100">
                <div class="content">
                    <div class="my-app-div-wrap">
                        <div class="content-head">
                            <h2>My Appointment</h2>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="clinical-consultation-wrap">
                                    <div class="clinicl-head">
                                        <h3>Clinical Consultation</h3>
                                    </div>
                                    <div class="clinical-box-wrap">
                                        <div class="row">
                                            <div class="col-xl-4 col-12">
                                                <div class="clinical-box-1 me-3">
                                                    <div class="up-app">
                                                        <h4>upcoming Appointments</h4>
                                                    </div>
                                                    <div class="clinical-box cl-min-h">
                                                        <div class="row">
                                                            <div class="col-xl-8">
                                                                <div class="my-app-head">
                                                                    <h4>00.15 min left</h4>
                                                                </div>
                                                                <div
                                                                    class="profile-div profile-div-2 d-flex justify-content-center align-items-center">
                                                                    <div class="profile-img">
                                                                        <img src="{{ asset('frontend_assets/images/profile.png') }}"
                                                                            alt="">
                                                                    </div>
                                                                    <div class="profile-text">
                                                                        <h2>Dr. Sandip Rungta</h2>
                                                                        <p> Ear-Nose-Throat (ENT)
                                                                            Special</p>
                                                                        <p>14-17 years experience</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="app-time-wrap d-flex justify-content-between align-items-center">
                                                            <div class="app-time app-time-1 me-3">
                                                                <h3><i class="fa-solid fa-house-chimney-medical"></i>
                                                                    Clinic Details</h3>
                                                                <p>ABCD Medical Hall
                                                                    <span>JC 16 & JK 02 block
                                                                        7777</span>
                                                                </p>
                                                            </div>

                                                            <div class="app-time app-time-2">
                                                                <h3><i class="fa-regular fa-clock"></i>
                                                                    Appointment time</h3>
                                                                <p>Mon, 24 Apr 05.00 PM <span>in 1 hour
                                                                        and
                                                                        15min</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-8">
                                                <div class="clinical-box-1 clinical-box-2 clinical-box-3">
                                                    <div class="up-app">
                                                        <h4>past Appointments</h4>
                                                    </div>
                                                    <div class="clinical-box-wrap-2 srl" id="srl_1">
                                                        <div class="clinical-box">
                                                            <div class="row align-items-center">
                                                                <div class="col-xl-4 col-md-6 col-12">
                                                                    <div class="patient-name d-flex">
                                                                        <div
                                                                            class="profile-div profile-div-2 d-flex justify-content-center align-items-center">
                                                                            <div class="profile-img">
                                                                                <img src="{{ asset('frontend_assets/images/profile.png') }}"
                                                                                    alt="">
                                                                            </div>
                                                                            <div class="profile-text">
                                                                                <h2>Dr. Sandip Rungta</h2>
                                                                                <h3>Ear-Nose-Throat (ENT)
                                                                                    Special</h3>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12">
                                                                    <div class="app-time app-time-1 me-3">
                                                                        <h3>Clinic Details</h3>
                                                                        <p>ABCD Medical Hall<span>JC 16
                                                                                &amp; JK 02
                                                                                block 7777</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12">
                                                                    <div class="app-time app-time-2">
                                                                        <h3>Appointment time</h3>
                                                                        <p>Mon, 24 Apr 05.00 PM <span>in 1
                                                                                hour and
                                                                                15min</span></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-2 col-md-6 col-12">
                                                                    <div class="status">
                                                                        <div class="app-time app-time-2">
                                                                            <h3>Status</h3>
                                                                            <h2>DONE</h2>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clinical-box">
                                                            <div class="row">
                                                                <div class="col-xl-4 col-md-6 col-12">
                                                                    <div class="patient-name d-flex">
                                                                        <div
                                                                            class="profile-div profile-div-2 d-flex justify-content-center align-items-center">
                                                                            <div class="profile-img">
                                                                                <img src="{{ asset('frontend_assets/images/profile.png') }}"
                                                                                    alt="">
                                                                            </div>
                                                                            <div class="profile-text">
                                                                                <h2>Dr. Sandip Rungta</h2>
                                                                                <h3>Ear-Nose-Throat (ENT)
                                                                                    Special</h3>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12">
                                                                    <div class="app-time app-time-1 me-3">
                                                                        <h3>Clinic Details</h3>
                                                                        <p>ABCD Medical Hall<span>JC 16
                                                                                &amp; JK 02
                                                                                block 7777</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12">
                                                                    <div class="app-time app-time-2">
                                                                        <h3>Appointment time</h3>
                                                                        <p>Mon, 24 Apr 05.00 PM <span>in 1
                                                                                hour and
                                                                                15min</span></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-2 col-md-6 col-12">
                                                                    <div class="status status-2">
                                                                        <div class="app-time app-time-2">
                                                                            <h3>Status</h3>
                                                                            <h2>Pending</h2>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clinical-box">
                                                            <div class="row">
                                                                <div class="col-xl-4 col-md-6 col-12">
                                                                    <div class="patient-name d-flex">
                                                                        <div
                                                                            class="profile-div profile-div-2 d-flex justify-content-center align-items-center">
                                                                            <div class="profile-img">
                                                                                <img src="{{ asset('frontend_assets/images/profile.png') }}"
                                                                                    alt="">
                                                                            </div>
                                                                            <div class="profile-text">
                                                                                <h2>Dr. Sandip Rungta</h2>
                                                                                <h3>Ear-Nose-Throat (ENT)
                                                                                    Special</h3>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12">
                                                                    <div class="app-time app-time-1 me-3">
                                                                        <h3>Clinic Details</h3>
                                                                        <p>ABCD Medical Hall<span>JC 16
                                                                                &amp; JK 02
                                                                                block 7777</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12">
                                                                    <div class="app-time app-time-2">
                                                                        <h3>Appointment time</h3>
                                                                        <p>Mon, 24 Apr 05.00 PM <span>in 1
                                                                                hour and
                                                                                15min</span></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-2 col-md-6 col-12">
                                                                    <div class="status">
                                                                        <div class="app-time app-time-2">
                                                                            <h3>Status</h3>
                                                                            <h2>DONE</h2>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clinical-box">
                                                            <div class="row">
                                                                <div class="col-xl-4 col-md-6 col-12">
                                                                    <div class="patient-name">
                                                                        <div
                                                                            class="profile-div profile-div-2 d-flex justify-content-center align-items-center">
                                                                            <div class="profile-img">
                                                                                <img src="{{ asset('frontend_assets/images/profile.png') }}"
                                                                                    alt="">
                                                                            </div>
                                                                            <div class="profile-text">
                                                                                <h2>Dr. Sandip Rungta</h2>
                                                                                <h3>Ear-Nose-Throat (ENT)
                                                                                    Special</h3>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12">
                                                                    <div class="app-time app-time-1 me-3">
                                                                        <h3>Clinic Details</h3>
                                                                        <p>ABCD Medical Hall<span>JC 16
                                                                                &amp; JK 02
                                                                                block 7777</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-6 col-12">
                                                                    <div class="app-time app-time-2">
                                                                        <h3>Appointment time</h3>
                                                                        <p>Mon, 24 Apr 05.00 PM <span>in 1
                                                                                hour and
                                                                                15min</span></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-2 col-md-6 col-12">
                                                                    <div class="status status-3">
                                                                        <div class="app-time app-time-2">
                                                                            <h3>Status</h3>
                                                                            <h2>CANCELLED</h2>
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
                                <div class="clinical-consultation-wrap">
                                    <div class="clinicl-head">
                                        <h3>Chat / Video Consultation</h3>
                                    </div>
                                    <div class="chat-box-1-wrap">
                                        <div class="row">
                                            <div class="col-xl-4 col-6 col-12">
                                                <div class="chat-box-1 d-flex align-items-center justify-content-between">
                                                    <div class="profile-div profile-div-2 d-flex align-items-center">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                                        </div>
                                                        <div class="profile-text">
                                                            <h2>Dr. Sandip Rungta</h2>
                                                            <h3>Mon, 24 Apr 05.00 PM</h3>
                                                        </div>
                                                    </div>
                                                    <div class="cam-img">
                                                        <span><i class="fa-solid fa-video"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-6 col-12">
                                                <div class="chat-box-1 d-flex align-items-center justify-content-between">
                                                    <div class="profile-div profile-div-2 d-flex align-items-center">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                                        </div>
                                                        <div class="profile-text">
                                                            <h2>Dr. Sandip Rungta</h2>
                                                            <h3>Mon, 24 Apr 05.00 PM</h3>
                                                        </div>
                                                    </div>
                                                    <div class="cam-img">
                                                        <span><i class="fa-solid fa-video"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-6 col-12">
                                                <div class="chat-box-1 d-flex align-items-center justify-content-between">
                                                    <div class="profile-div profile-div-2 d-flex align-items-center">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                                        </div>
                                                        <div class="profile-text">
                                                            <h2>Dr. Sandip Rungta</h2>
                                                            <h3>Mon, 24 Apr 05.00 PM</h3>
                                                        </div>
                                                    </div>
                                                    <div class="cam-img">
                                                        <span><i class="fa-solid fa-video"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-6 col-12">
                                                <div class="chat-box-1 d-flex align-items-center justify-content-between">
                                                    <div class="profile-div profile-div-2 d-flex align-items-center">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                                        </div>
                                                        <div class="profile-text">
                                                            <h2>Dr. Sandip Rungta</h2>
                                                            <h3>Mon, 24 Apr 05.00 PM</h3>
                                                        </div>
                                                    </div>
                                                    <div class="cam-img">
                                                        <span><i class="fa-solid fa-video"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-6 col-12">
                                                <div class="chat-box-1 d-flex align-items-center justify-content-between">
                                                    <div class="profile-div profile-div-2 d-flex align-items-center">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                                        </div>
                                                        <div class="profile-text">
                                                            <h2>Dr. Sandip Rungta</h2>
                                                            <h3>Mon, 24 Apr 05.00 PM</h3>
                                                        </div>
                                                    </div>
                                                    <div class="cam-img">
                                                        <span><i class="fa-solid fa-video"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-6 col-12">
                                                <div class="chat-box-1 d-flex align-items-center justify-content-between">
                                                    <div class="profile-div profile-div-2 d-flex align-items-center">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                                        </div>
                                                        <div class="profile-text">
                                                            <h2>Dr. Sandip Rungta</h2>
                                                            <h3>Mon, 24 Apr 05.00 PM</h3>
                                                        </div>
                                                    </div>
                                                    <div class="cam-img">
                                                        <span><i class="fa-solid fa-video"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-6 col-12">
                                                <div class="chat-box-1 d-flex align-items-center justify-content-between">
                                                    <div class="profile-div profile-div-2 d-flex align-items-center">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                                        </div>
                                                        <div class="profile-text">
                                                            <h2>Dr. Sandip Rungta</h2>
                                                            <h3>Mon, 24 Apr 05.00 PM</h3>
                                                        </div>
                                                    </div>
                                                    <div class="cam-img">
                                                        <span><i class="fa-solid fa-video"></i></span>
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
