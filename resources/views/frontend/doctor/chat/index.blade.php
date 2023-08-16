@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    Doctor Chats
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
                                    <h2>Chat History</h2>
                                    <h3>Chat / Chat History</h3>
                                </div>
                            </div>
                            @if ($friends->count() > 0)
                                <div class="dr-chat-box-wrap">
                                    <div class="row">
                                        <div class="col-xl-5 col-12">
                                            <div class="dr-chat-box-1 srl-2" id="srl-2">
                                                @foreach ($friends as $key => $value)
                                                    <div class="dr-chat-box-1 mb-3">
                                                        <div
                                                            class="profile-div-box dr-chat mb-3 d-flex justify-content-between align-items-center">
                                                            <div
                                                                class="profile-div profile-div-2 profile-div-3 d-flex align-items-center">
                                                                <div class="profile-img">
                                                                    @if ($value->friend->profile_picture)
                                                                        <img src="{{ Storage::url($value->friend->profile_picture) }}"
                                                                            alt="">
                                                                    @else
                                                                        <img src="{{ asset('frontend_assets/images/profile-3.png') }}"
                                                                            alt="">
                                                                    @endif
                                                                </div>
                                                                <div class="profile-text">
                                                                    <h2>
                                                                        {{ $value->friend->name }}
                                                                    </h2>

                                                                    <p><span class="online-user"></span>Online</p>
                                                                </div>
                                                            </div>
                                                            <div class="patient-age">
                                                                <h3><span>
                                                                        {{ date('d M Y', strtotime($value->created_at)) }}
                                                                    </span></h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-xl-7 col-12">
                                            <div class="dr-chat-request-box">
                                                <div class="dr-cam-img">
                                                    <a href="">
                                                        <div class="cam-img">
                                                            <span><i class="fa-solid fa-video"></i></span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="profile-text">
                                                    <div class="dr-chat-request-img active-green">
                                                        <img src="{{ asset('frontend_assets/images/profile.png') }}" </div>
                                                        <h2>Adam Smith</h2>
                                                    </div>
                                                    <div class="chat-sec-box chat-srl_1" id="chat-srl">
                                                        <div class="chat-sec-left pb-3">
                                                            <div class="chat-sec-left-wrap d-flex">
                                                                <div class="chat-sec-left-img">
                                                                    <div class="find-doc-slide-img cht-img">
                                                                        <img src="{{ asset('frontend_assets/images/profile.png') }}"
                                                                            alt="" />
                                                                    </div>
                                                                </div>
                                                                <div class="chat-sec-left-text-box">
                                                                    <div class="chat-sec-left-text">
                                                                        <h4>Dr. Sam Rungta</h4>
                                                                        <p>Lorem ipsum dolor sit amet consectetur.
                                                                            Pellentesque viverra
                                                                            imperdiet ipsum augue id aliquam orci integer.
                                                                        </p>
                                                                    </div>
                                                                    <div class="tm-div d-block pt-2">
                                                                        <h4>09:34 PM</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="chat-sec-left chat-sec-right pb-3">
                                                            <div class="chat-sec-left-wrap d-flex justify-content-end">
                                                                <div class="chat-sec-left-text-box">
                                                                    <div class="chat-sec-left-text">
                                                                        <h4>Adam Smith</h4>
                                                                        <p>Lorem ipsum dolor sit amet consectetur</p>
                                                                    </div>
                                                                    <div class="tm-div d-block pt-2 text-end">
                                                                        <h4>09:34 PM</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="chat-sec-left-img ps-3">
                                                                    <div class="find-doc-slide-img cht-img">
                                                                        <img src="{{ asset('frontend_assets/images/profile.png') }}"
                                                                            alt="" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="chat_form-div">
                                                            <form action="javascript:void(0);" id="chat-form">
                                                                <input type="hidden" class="user_id" value="">
                                                                <div
                                                                    class="type-sec d-flex justify-content-center align-items-center">
                                                                    <div class="type-div">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control"
                                                                                id="user-chat" value=""
                                                                                placeholder="Type here..." required="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="send-div">
                                                                        <button type="submit" value="Submit"><img
                                                                                src="{{ asset('frontend_assets/images/send.png') }}"
                                                                                alt=""></button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <h4>No Chat Found</h4>
                                    </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
