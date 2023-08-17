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
                                                    <div class="dr-chat-box-1 mb-3 user-list" data-id="{{ $value->friend_id }}" data-query="0">
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

                                                                    <p id="{{ $value->friend_id }}-userStatus"><span class="offline-user"></span>Offline</p>
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
                                        <div class="col-xl-7 col-12 chat-first-page">
                                            <div class="dr-chat-request-box">
                                                <div class="dr-cam-img">
                                                    
                                                </div>
                                                <div class="profile-text">
                                                    <div class="dr-chat-request-img">
                                                        {{-- <img src="{{ asset('frontend_assets/images/profile.png') }}" </div> --}}
                                                        <h2>Adam Smith</h2>
                                                    </div>
                                                    <div class="chat-sec-box chat-srl_1" id="chat-srl">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="col-xl-7 col-12 chat-module">
                                            @include('frontend.doctor.chat.chat-body')
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
