@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    Booking Appointment and Video Consultancy
@endsection
@push('styles')
@endpush

@section('content')
    @php
        use App\Models\User;
        use App\Helpers\Helper;
    @endphp
    <section class="inr-bnr">
        <div class="inr-bnr-img">
            <img src="{{ asset('frontend_assets/images/tele-bg.jpg') }}" alt="" />
            <div class="inr-bnr-text">
                <h1>Booking Appointment and Video Consultancy</h1>
            </div>
        </div>
    </section>
    <section class="clinic-sec">
        <div class="container">
            <div class="clinic-sec-wrap">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="cl-dc-bx">
                            <div class="row justify-content-between">
                                <div class="col-xl-3 col-md-3 col-12">
                                    <div class="find-doc-slide-img">
                                        @if ($doctor['profile_picture'])
                                            <img src="{{ Storage::url($doctor['profile_picture']) }}" alt="">
                                        @else
                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3 col-13">
                                    <div class="find-doc-slide-text">
                                        <h3>Dr. {{ $doctor['name'] }}</h3>
                                        <h4>{{ User::getDoctorSpecializations($doctor['id']) }}</h4>
                                        <h4>
                                            @if ($doctor['license_number'])
                                                License No. {{ $doctor['license_number'] }}
                                            @endif
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3 col-12">
                                    <div class="pec-div">
                                        <span class="pec d-block"><i class="fa-solid fa-thumbs-up"></i>99%</span>
                                        <span class="exp d-block"><i class="fa-regular fa-period"></i>
                                            {{ $doctor['year_of_experience'] }} Years
                                            Exp</span>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3 col-12">
                                    <div class="find-doc-slide-text">
                                        <h5>{{ $doctor['location'] }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="slot-sec">
        <div class="container">
            <div class="slot-sec-wrap">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="slot-div d-flex justify-content-center">
                            @if ($clinics->count() > 0)
                                <a href="javascript:void(0);">
                                    <div class="slot-1 slot-2 lft active-slot clinic-visit">
                                        <h3>Clinic Visit Slots</h3>
                                    </div>
                                </a>
                            @endif
                            <a href="javascript:void(0);">
                                <div class="slot-1 chat" id="show-chat">
                                    {{-- add chat class when implemetation start --}}
                                    <h3>Chat / Video Consultation</h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="chat-sec chat-slot" id="chat-view">
        @include('frontend.chat')
    </section>
    @if ($clinics->count() > 0)
        <section class="cl-tm-slot booking-slot">
            <form action="{{ route('appointment-store') }}" method="POST">
                @csrf
            <div class="container">
                <div class="cl-name-div">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="cl-slot-wrap">
                                <div class="cl-slot-icon d-flex align-items-center">
                                    <i class="fa-solid fa-house-chimney-medical"></i>
                                    <h3>Clinic Name</h3>
                                </div>
                                <div class="clinic-name-ck-div">
                                    <div class="clinic-name-ck">
                                       
                                            <div class="row align-items-center justify-content-between">
                                                @foreach ($clinics as $key => $clinic)
                                                    <div class="col-xl-5 col-12">
                                                        <div class="form-check d-flex">
                                                            <div class="form-check-box">
                                                                <input class="form-check-input clinic_add" type="radio" value="{{ $clinic['id'] }}"
                                                                    name="clinic_name" id="clinic_name_{{ $clinic['id'] }}">
                                                            </div>
                                                            <div class="form-text">
                                                                <h3>{{ $clinic['clinic_name'] }} </h3>
                                                                <p>{{ $clinic['clinic_address'] }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                     
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="cl-tm-slot-wrap">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-6 col-md-12" id="clinic_visit_slots">
                            @include('frontend.ajax-clinic-visit')
                        </div>
                        <div class="col-xl-6 col-md-12" id="clinic_visit_slots_time">
                            @include('frontend.ajax-clinic-visit-slot-time')
                           
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="main-btn-p pt-4">
                                <input type="submit" value="Book" class="sub-btn">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </section>
    @endif
    <!-- Modal Start-->
    <div class="modal on-modal fade" id="Modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="mdl-img">
                    <div class="find-doc-slide-img">
                        @if ($doctor['profile_picture'])
                            <img src="{{ asset('frontend_assets/images/fd-2.png') }}" alt="">
                        @else
                            <img src="{{ Storage::url($doctor['profile_picture']) }}" alt="">
                        @endif
                    </div>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Dr. {{ $doctor['name'] }}</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <div class="mdl-cam">
                        <i class="fa-sharp fa-solid fa-video"></i>
                    </div>
                    <div class="mdl-btn">
                        <a href="javascript:void(0)" id="payment_now"><span>Pay & continue</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Start-->


    <!-- Modal Start 2-->
    <div class="modal on-modal on-modal-2 fade" id="Modal2" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- <div class="mdl-img">
                                                                                                                                                                                                                                                                                                             <div class="find-doc-slide-img">
                                                                                                                                                                                                                                                                                                                 <img src="{{ asset('frontend_assets/images/fd-2.png') }}" alt="">
                                                                                                                                                                                                                                                                                                             </div>
                                                                                                                                                                                                                                                                                                         </div> -->
                <div class="mdl-cam">
                    <i class="fa-sharp fa-solid fa-video"></i>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">For Video Consultation Fee <span>$9.9</span></h5>
                    <div class="stripe">
                        <img src="{{ asset('frontend_assets/images/stripe.png') }}" alt="">
                    </div>
                    <div class="stripe-p">
                        <h5>Payment via stripe</h5>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="payment-form">
                        <form action="">
                            <div class="form-group pb-3">
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Full Name">
                            </div>
                            <div class="form-group pb-3">
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Debit/ Credit Card Number">
                            </div>
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="cvv-div d-flex justify-content-center align-items-center">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="CVV">
                                        </div>
                                        <div class="cvv-icon ms-2">
                                            <a href="#" data-toggle="tooltip" title="Example tooltip">
                                                <i class="fa-solid fa-info"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8 cvv-date">
                                    <div class="row">
                                        <div class="form-group d-flex pb-3">
                                            <div class="row justify-content-center align-items-center">
                                                <div class="col-xl-5">
                                                    <label for="exampleFormControlInput1" class="form-label">Expiry
                                                        Date:</label>
                                                </div>
                                                <div class="col-xl-7">
                                                    <div class="row justify-content-center align-items-center">
                                                        <div class="col-xl-6">
                                                            <input type="text" class="form-control me-2 "
                                                                id="exampleFormControlInput1" placeholder="MM">
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <input type="text" class="form-control me-2"
                                                                id="exampleFormControlInput1" placeholder="YY">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pb-3">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mdl-btn">
                        <a href="#"><span>Pay now</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Start-->


    <!-- Scroll top -->
    <a href="#top-btn" alt="Top" title="Back to top" id="scrl">
        <div class="scroll_btm">
            <div class="scroll_btm_btn">
                <div class="scroll_text">
                    <h3>SCROLL up</h3>
                </div>
            </div>
        </div>
    </a>
    <!-- Modal -->
@endsection

@push('scripts')
    {{-- <script>
    $(document).ready(function () {
        $("#Modal1").modal('show');
    });
</script> --}}


    <script>
        $(document).ready(function() {
            $("#payment_now").click(function() {

                $("#Modal1").modal('hide');
                $("#Modal2").modal('show');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.chat-slot').css('display', 'none');
            $('.clinic-visit').on('click', function() {
                $('.chat').removeClass('active-slot');
                $(this).addClass('active-slot');
                $('.booking-slot').css('display', 'block');
                $('.chat-slot').css('display', 'none');
            });
            $('#show-chat').on('click', function() {
                $.ajax({
                    url: "{{ route('doctor.chat') }}",
                    type: 'GET',
                    success: function(resp) {
                        if (resp.status == true) {
                            $('.booking-slot').css('display', 'none');
                            $('.clinic-visit').removeClass('active-slot');
                            $('#show-chat').addClass('active-slot');
                            $('.chat-slot').css('display', 'block');
                            $('.chat-slot').html(resp.view);
                        } else {
                            toastr.error(resp.message);
                        }
                    }
                });
            });
        });
    </script>
    <script>
        const messaging = firebase.messaging();
        messaging.usePublicVapidKey("{{ env('FIREBASE_PUBLIC_VAPID_KEY') }}");
        // Request Permission of Notifications
        function sendTokenToServer(fcm_token) {
            const user_id = "{{ Auth::user()->id }}";
            axios.post('/api/save-token', {
                fcm_token,
                user_id
            }).then(res => {
                console.log(res);
            })
        }

        messaging.getToken().then((currentToken) => {
            if (currentToken) {
                sendTokenToServer(currentToken);
            } else {
                console.warn('Cannot get token');
                requestPermission();
            }
        }).catch(err => {
            console.warn(err);
            // showToken('Error retrieving Instance ID token', err);
        });
    </script>

    <script>
        $('.clinic_add').on('change', function(){
            var clinic_id = $(this).val();

            $.ajax({
                    url: "{{ route('clinic.visit.slot-ajax') }}",
                    type: 'GET',
                    data :{
                        clinic_id :clinic_id
                    },
                    success: function(resp) {
                        // console.log(resp.clinic.slots);

                        $('#clinic_visit_slots').html(resp.view)
                    }
                });
        });
    </script>
    
<script>
    $('.appointment-date').on('change', function(){
        var slot_id = $(this).val();
        // alert(slot_id)
        $.ajax({
                url: "{{ route('clinic.ajax-clinic-visit-slot-time') }}",
                type: 'GET',
                data :{
                    slot_id :slot_id
                },
                success: function(resp) {
                    // console.log(resp.clinic.slots);

                    $('#clinic_visit_slots_time').html(resp.view)
                }
            });
    });
</script>
@endpush
