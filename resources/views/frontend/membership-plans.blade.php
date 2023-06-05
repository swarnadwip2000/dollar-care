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
                    @foreach($plans as $key=>$plan)
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="mem-box-wrap">
                            <div class="mem-box @if($key == 1) mem-box-2 @endif @if($key == 2) mem-box-3 @endif" >
                                <h3>{{ $plan['plan_name'] }}</h3>
                            </div>
                            <div class="price-box">
                                <h2><span>USD</span>${{ $plan['plan_price'] }}<span>({{ $plan['plan_type'] }})</span></h2>
                            </div>
                            <div class="mem-list">
                                <ul>
                                    @foreach($plan->specifications as $specification)
                                    <li>{{ $specification['specification_name'] }}</li>
                                   @endforeach
                                </ul>
                                <div class="main-btn pt-4">
                                    <a href="#" tabindex="0"><span>buy now</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
