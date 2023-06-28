@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    Patient Settings
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
                            <h2>Settings</h2>
                        </div>
                    </div>
                    <div class="settings-div">
                        <div class="msn-tab">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-home" type="button" role="tab"
                                        aria-controls="nav-home" aria-selected="true">About Dollarcare</button>
                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-profile" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">Privacy
                                        Policy</button>
                                    <button class="nav-link" id="nav-help-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-help" type="button" role="tab"
                                        aria-controls="nav-help" aria-selected="false">Help & Support</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <p>Lorem ipsum dolor sit amet consectetur. Pharetra netus cursus nec
                                        facilisis. Quis ultrices morbi maecenas lobortis. Mattis sed nisi amet
                                        nisi elit nunc nibh in. Ac convallis fringilla tortor morbi vel massa et
                                        et. Elementum pellentesque quis nunc elit. Urna pellentesque venenatis
                                        egestas ac neque a. Consequat mi at quis sed tincidunt leo sed sit.
                                        Pretium mauris imperdiet ornare nunc ut enim. Erat viverra urna sed quis
                                        et varius lectus ipsum mollis. Ullamcorper pellentesque lectus sed
                                        tellus fames dolor turpis nibh pharetra. Aliquam tortor nascetur nec
                                        neque porttitor molestie quis non arcu. Pretium lectus eu vitae diam
                                        sapien pellentesque nisl. Euismod auctor arcu cras facilisi tortor
                                        facilisis consectetur.</p>
                                    <p>Amet ultrices augue lorem iaculis tortor massa velit. Phasellus sapien
                                        non ac tortor convallis fringilla. Sapien massa nunc aliquam platea
                                        pulvinar morbi dictum. Quis eget at magna sem mi dui elit. Nisl leo
                                        facilisis faucibus non posuere enim senectus. Lorem volutpat ante mollis
                                        pulvinar nibh tristique eu. Neque malesuada enim tellus tristique sem
                                        senectus ornare pharetra. Ipsum est a bibendum pretium viverra cras
                                        turpis massa.</p>
                                    <p>Neque id tristique auctor accumsan dolor lorem praesent volutpat cras. Id
                                        auctor in tempor egestas ornare faucibus. Viverra nisi quis lacinia
                                        lorem sed tellus mattis aliquet. Sed nam nulla sit eu feugiat nisi
                                        elementum urna laoreet. Nulla sit interdum amet nisl et. Fames senectus
                                        cursus ullamcorper varius feugiat.</p>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    <p>Lorem ipsum dolor sit amet consectetur. Pharetra netus cursus nec
                                        facilisis. Quis ultrices morbi maecenas lobortis. Mattis sed nisi amet
                                        nisi elit nunc nibh in. Ac convallis fringilla tortor morbi vel massa et
                                        et. Elementum pellentesque quis nunc elit. Urna pellentesque venenatis
                                        egestas ac neque a. Consequat mi at quis sed tincidunt leo sed sit.
                                        Pretium mauris imperdiet ornare nunc ut enim. Erat viverra urna sed quis
                                        et varius lectus ipsum mollis. Ullamcorper pellentesque lectus sed
                                        tellus fames dolor turpis nibh pharetra. Aliquam tortor nascetur nec
                                        neque porttitor molestie quis non arcu. Pretium lectus eu vitae diam
                                        sapien pellentesque nisl. Euismod auctor arcu cras facilisi tortor
                                        facilisis consectetur.</p>
                                    <p>Amet ultrices augue lorem iaculis tortor massa velit. Phasellus sapien
                                        non ac tortor convallis fringilla. Sapien massa nunc aliquam platea
                                        pulvinar morbi dictum. Quis eget at magna sem mi dui elit. Nisl leo
                                        facilisis faucibus non posuere enim senectus. Lorem volutpat ante mollis
                                        pulvinar nibh tristique eu. Neque malesuada enim tellus tristique sem
                                        senectus ornare pharetra. Ipsum est a bibendum pretium viverra cras
                                        turpis massa.</p>
                                    <p>Neque id tristique auctor accumsan dolor lorem praesent volutpat cras. Id
                                        auctor in tempor egestas ornare faucibus. Viverra nisi quis lacinia
                                        lorem sed tellus mattis aliquet. Sed nam nulla sit eu feugiat nisi
                                        elementum urna laoreet. Nulla sit interdum amet nisl et. Fames senectus
                                        cursus ullamcorper varius feugiat.</p>
                                </div>

                                <div class="tab-pane fade" id="nav-help" role="tabpanel"
                                    aria-labelledby="nav-help-tab">
                                    <div class="help-frm">
                                        <form action="">
                                            <div class="row">
                                                <div class="form-group col-lg-4 col-md-12">
                                                    <input type="text" class="form-control" id="" value=""
                                                        placeholder="Subject" required="">
                                                </div>
                                                <div class="form-group col-lg-12 col-md-12 mt-3">
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Description"  rows="6"></textarea>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="main-btn-p pt-4">
                                                        <input type="submit" value="send" class="sub-btn">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
