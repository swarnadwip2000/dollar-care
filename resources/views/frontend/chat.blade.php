@if (isset($chat_call))
    <div class="container">
        <div class="chat-sec-wrap">
               @if($chats->count() > 0)
            <div class="chat-sec-box" id="chat-container">
                @foreach ($chats as $key => $chat)
                    @if ($chat->sender_id == Auth::user()->id)
                        <div class="chat-sec-left chat-sec-right pb-3">
                            <div class="chat-sec-left-wrap d-flex justify-content-end">
                                <div class="chat-sec-left-text-box">
                                    <div class="chat-sec-left-text">
                                        <h4>
                                            {{ $chat->sender->name }}
                                        </h4>
                                        <p>
                                            {{ $chat->message }}
                                        </p>
                                    </div>
                                    <div class="tm-div d-block pt-2 text-end">
                                        <h4>
                                            {{ date('h:i A', strtotime($chat->created_at)) }}
                                        </h4>
                                    </div>
                                </div>
                                <div class="chat-sec-left-img ps-3">
                                    <div class="find-doc-slide-img cht-img">
                                        @if ($chat->sender->profile_picture)
                                            <img src="{{ Storage::url($chat->sender->profile_picture) }}"
                                                alt="" />
                                        @else
                                            <img src="{{ asset('frontend_assets/images/profile.png') }}" alt="" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="chat-sec-left pb-3">
                            <div class="chat-sec-left-wrap d-flex">
                                <div class="chat-sec-left-img">
                                    <div class="find-doc-slide-img cht-img">
                                        @if ($chat->reciver->profile_picture)
                                            <img src="{{ Storage::url($chat->sender->profile_picture) }}"
                                                alt="" />
                                        @else
                                            <img src="{{ asset('frontend_assets/images/profile.png') }}"
                                                alt="" />
                                        @endif
                                    </div>
                                </div>
                                <div class="chat-sec-left-text-box">
                                    <div class="chat-sec-left-text">
                                        <h4>
                                            {{ $chat->sender->name }}
                                        </h4>
                                        <p>
                                            {{ $chat->message }}
                                        </p>
                                    </div>
                                    <div class="tm-div d-block pt-2">
                                        <h4>
                                            {{ date('h:i A', strtotime($chat->created_at)) }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            @else
            <div class="chat-sec-box" id="chat-container">
                {{-- show no chat found --}}
                 <div class="chat-not-available">
                    <h4 class="text-center">No Chat Yet ... </h4>
                    <p class="text-center">
                        Start messaging with Dr. {{ $doctor['name'] }} to get your queries answered.
                    </p>
                 </div>
                    
            </div>
            @endif
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
