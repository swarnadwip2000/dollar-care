@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    Mange Clinic Address
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
                        <div class="my-app-div-wrap">
                            <div class="content-head-wrap d-flex justify-content-between align-items-center">
                                <div class="content-head mb-4">
                                    <h2>Manage Clinic Address</h2>
                                    <h3><a href="{{ route('doctor.dashboard') }}">Dashboard</a> / Manage Clinic Address</h3>
                                </div>
                                <div class="add-address">
                                    <a href="{{ route('doctor.manage-clinic.create') }}"><span>+ Add Address</span></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="clinical-consultation-wrap">
                                        <!-- <div class="clinicl-head">
                                            <h3>Clinical Consultation</h3>
                                        </div> -->
                                        <div class="clinical-box-wrap">
                                            <div class="row">
                                                <div class="col-xl-10 col-lg-9 col-12">
                                                    <div class="manage-clinic-div">
                                                        <div class="row">
                                                            <div class="col-xl-3 col-md-6 col-12">
                                                                <div class="cl-name">
                                                                    <h3>Clinic Name</h3>
                                                                    <h2>ABCD Medical Hall</h2>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12">
                                                                <div class="cl-name">
                                                                    <h3>Phone Number</h3>
                                                                    <h2>XXX XXX XXXX</h2>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12">
                                                                <div class="cl-name">
                                                                    <h3>Clinic Address</h3>
                                                                    <h2>ABCD Medical Hall
                                                                        JC 16 & JK 02 block 7777</h2>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12">
                                                                <div class="cl-name">
                                                                    <h3>Slot Day</h3>
                                                                    <h2>Mon - Wed - Fri</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-12">
                                                    <div class="cl-edit">
                                                        <div class="edit-btn d-flex align-items-center">
                                                            <div class="edit-btn-1">
                                                                <a href="add-clinic-address.html"><span><i
                                                                            class="fa-solid fa-pen-to-square"></i></span></a>
                                                            </div>
                                                            <div class="edit-btn-1 edit-btn-2">
                                                                <a href="#"><span><i
                                                                            class="fa-solid fa-trash-can"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-10 col-lg-9 col-12">
                                                    <div class="manage-clinic-div">
                                                        <div class="row">
                                                            <div class="col-xl-3 col-md-6 col-12">
                                                                <div class="cl-name">
                                                                    <h3>Clinic Name</h3>
                                                                    <h2>ABCD Medical Hall</h2>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12">
                                                                <div class="cl-name">
                                                                    <h3>Phone Number</h3>
                                                                    <h2>XXX XXX XXXX</h2>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12">
                                                                <div class="cl-name">
                                                                    <h3>Clinic Address</h3>
                                                                    <h2>ABCD Medical Hall
                                                                        JC 16 & JK 02 block 7777</h2>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12">
                                                                <div class="cl-name">
                                                                    <h3>Slot Day</h3>
                                                                    <h2>Mon - Wed - Fri</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-12">
                                                    <div class="cl-edit">
                                                        <div class="edit-btn d-flex align-items-center">
                                                            <div class="edit-btn-1">
                                                                <a href="add-clinic-address.html"><span><i
                                                                            class="fa-solid fa-pen-to-square"></i></span></a>
                                                            </div>
                                                            <div class="edit-btn-1 edit-btn-2">
                                                                <a href="#"><span><i
                                                                            class="fa-solid fa-trash-can"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-10 col-lg-9 col-12">
                                                    <div class="manage-clinic-div">
                                                        <div class="row">
                                                            <div class="col-xl-3 col-md-6 col-12">
                                                                <div class="cl-name">
                                                                    <h3>Clinic Name</h3>
                                                                    <h2>ABCD Medical Hall</h2>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12">
                                                                <div class="cl-name">
                                                                    <h3>Phone Number</h3>
                                                                    <h2>XXX XXX XXXX</h2>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12">
                                                                <div class="cl-name">
                                                                    <h3>Clinic Address</h3>
                                                                    <h2>ABCD Medical Hall
                                                                        JC 16 & JK 02 block 7777</h2>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12">
                                                                <div class="cl-name">
                                                                    <h3>Slot Day</h3>
                                                                    <h2>Mon - Wed - Fri</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-lg-3 col-12">
                                                    <div class="cl-edit">
                                                        <div class="edit-btn d-flex align-items-center">
                                                            <div class="edit-btn-1">
                                                                <a href="add-clinic-address.html"><span><i
                                                                            class="fa-solid fa-pen-to-square"></i></span></a>
                                                            </div>
                                                            <div class="edit-btn-1 edit-btn-2">
                                                                <a href="#"><span><i
                                                                            class="fa-solid fa-trash-can"></i></span></a>
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
