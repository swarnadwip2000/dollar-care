@if (isset($chat_call))
    <div class="container">
        <div class="chat-sec-wrap">
            <div class="chat-sec-box">
                <div class="chat-sec-left pb-3">
                    <div class="chat-sec-left-wrap d-flex">
                        <div class="chat-sec-left-img">
                            <div class="find-doc-slide-img cht-img">
                                <img src="{{ asset('frontend_assets/images/fd-2.png') }}" alt="">
                            </div>
                        </div>
                        <div class="chat-sec-left-text-box">
                            <div class="chat-sec-left-text">
                                <h4>Dr. Sam Rungta</h4>
                                <p>Lorem ipsum dolor sit amet consectetur. Pellentesque viverra
                                    imperdiet ipsum augue id aliquam orci integer.</p>
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
                                <img src="{{ asset('frontend_assets/images/fd-1.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="javascript:void(0);" id="chat-form">
                <input type="hidden" class="doctor_id" value="{{ $doctor['id'] }}">
                <div class="type-sec d-flex justify-content-center align-items-center">
                    <div class="type-div">
                        <div class="form-group">
                            <input type="text" class="form-control" id="user-chat" value=""
                                placeholder="Type here..." required="">
                        </div>
                    </div>
                    <div class="send-div">
                        <button type="submit" value="Submit"><img src="{{ asset('frontend_assets/images/send.png') }}"
                                alt=""></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif
