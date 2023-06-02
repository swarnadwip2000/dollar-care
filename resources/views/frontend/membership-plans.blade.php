@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    Membership Plans
@endsection
@push('styles')
@endpush

@section('content')
    <section class="inr-bnr">
        <div class="inr-bnr-img">
            <img src="{{ ('frontend_assets/images/blog-bg.jpg') }}" alt="" />
            <div class="inr-bnr-text">
                <h1>Membership</h1>
            </div>
        </div>
    </section>
    <section class="mem-sec">
        <div class="container">
            <div class="mem-sec-wrap">
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="mem-box-wrap">
                            <div class="mem-box">
                                <h3>basic plan</h3>
                            </div>
                            <div class="price-box">
                                <h2><span>USD</span>$150<span>(Basic)</span></h2>
                            </div>
                            <div class="mem-list">
                                <ul>
                                    <li>Domain Name</li>
                                    <li>Upto 8 Pages</li>
                                    <li>Direct Call Integration</li>
                                    <li>SEO Friendly Design</li>
                                    <li>Whatsapp Integration</li>
                                    <li>Responsive Design</li>
                                </ul>
                                <div class="main-btn pt-4">
                                    <a href="#" tabindex="0"><span>buy now</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="mem-box-wrap">
                            <div class="mem-box mem-box-2">
                                <h3>standard plan</h3>
                            </div>
                            <div class="price-box">
                                <h2><span>USD</span>$250<span>(Gold)</span></h2>
                            </div>
                            <div class="mem-list">
                                <ul>
                                    <li>Domain Name</li>
                                    <li>Upto 8 Pages</li>
                                    <li>Direct Call Integration</li>
                                    <li>SEO Friendly Design</li>
                                    <li>Whatsapp Integration</li>
                                    <li>Responsive Design</li>
                                </ul>
                                <div class="main-btn pt-4">
                                    <a href="#" tabindex="0"><span>buy now</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="mem-box-wrap">
                            <div class="mem-box mem-box-3">
                                <h3>quality plan</h3>
                            </div>
                            <div class="price-box">
                                <h2><span>USD</span>$350<span>(platinum)</span></h2>
                            </div>
                            <div class="mem-list">
                                <ul>
                                    <li>Domain Name</li>
                                    <li>Upto 8 Pages</li>
                                    <li>Direct Call Integration</li>
                                    <li>SEO Friendly Design</li>
                                    <li>Whatsapp Integration</li>
                                    <li>Responsive Design</li>
                                </ul>
                                <div class="main-btn pt-4">
                                    <a href="#" tabindex="0"><span>buy now</span></a>
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
