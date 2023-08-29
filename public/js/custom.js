$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function () {
    $(document).on("click", ".user-list", function (e) {
        var getUserID = $(this).attr("data-id");
        var dataQuery = $(this).attr("data-query");
        receiver_id = getUserID;
        if (dataQuery == 0) {
            $(".chat-first-page").css("display", "none");
            loadChats();
        }
    });

    $(document).on("submit", "#chat-form", function (e) {
        e.preventDefault();

        var message = $("#user-chat").val();
        var receiver_id = $(".reciver_id").val();
        var url = "/user-chat";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                _token: $("input[name=_token]").val(),
                message: message,
                reciver_id: receiver_id,
                sender_id: sender_id,
            },
            success: function (res) {
                if (res.success) {
                    $("#user-chat").val("");
                    let chat = res.chat.message;
                    let created_at = res.chat.created_at;
                    let time_format_12 = moment(
                        created_at,
                        "YYYY-MM-DD HH:mm:ss"
                    ).format("hh:mm A");
                    let profile_picture = res.sender_profile_picture;

                    let html =
                        `<div class="chat-sec-left chat-sec-right pb-1"><div class="chat-sec-left-wrap d-flex justify-content-end"><div class="chat-sec-left-text-box"><div class="chat-sec-left-text"><p>` +
                        chat +
                        `</p></div><div class="tm-div d-block pt-2 text-end"><h4>` +
                        time_format_12 +
                        `</h4></div></div></div></div>`;
                    if (res.chat_count > 0) {
                        $("#chat-container").append(html);
                        scrollChatToBottom();
                    } else {
                        $("#chat-container").html(html);
                    }
                } else {
                    console.log(res.msg);
                }
            },
        });
    });

    // delete freind request
    $(document).on("click", ".delete-btn", function (e) {
        e.preventDefault();
        var friendId = $(this).data("id");
        var url = "/doctor/reject-chat-request";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                _token: $("input[name=_token]").val(),
                friendId: friendId,
            },
            success: function (res) {
                if (res.status == true) {
                    $("#friendProfile" + res.chatRequest.friend_id).remove();
                    const requestCount = $("#chat-count-" + res.chatRequest.user_id).text();
                    $("#chat-count-" + res.chatRequest.user_id).text(
                        parseInt(requestCount) - 1
                    );
                } else {
                    console.log(res.msg);
                }
            },
        });
    });

    $(document).on("click", ".confirm-btn", function() {
        friendId = $(this).data('id');
        $.ajax({
            url: "/doctor/accept-chat-request",
            type: "POST",
            data: {
                _token: $("input[name=_token]").val(),
                friendId: friendId
            },
            success: function(response) {
                if (response.status) {
                    $("#friendProfile" + response.acceptedUser.id).remove();
                    // return false;
                    const id = sender_id;
                    var chatCount = $("#chat-count-" + id).html();
                    chatCount = parseInt(chatCount) - 1;
                    $("#chat-count-" + id).html(chatCount);
                    var user = response.acceptedUser;
                    // console.log(user);
                    // append in top of the list
                     
                    $('#srl-2').prepend(`
                    <div class="dr-chat-box-1 mb-3 user-list" id="userList" data-id="` + user.id + `" data-query="0">
                        <div class="profile-div-box dr-chat mb-3 d-flex justify-content-between align-items-center">
                            <div class="profile-div profile-div-2 profile-div-3 d-flex align-items-center">
                            <div class="profile-img">
                                <img src="` + response.acceptedUser_profile_picture + `" alt="">
                            </div>
                                <div class="profile-text">
                                    <h2>
                                        ` + user.name + `
                                    </h2>

                                    <p id="` + user.id + `-userStatus"><span class="offline-user"></span>Offline</p>
                                </div>
                            </div>
                            <div class="patient-age">
                                <h3><span>
                                        ` + response.accepterUser_created_at + `
                                    </span></h3>
                            </div>
                        </div>
                    </div>
                `);

                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});

// load chats
function loadChats() {
    $.ajax({
        type: "POST",
        url: "/doctor/load-chats",
        data: {
            _token: $("input[name=_token]").val(),
            reciver_id: receiver_id,
            sender_id: sender_id,
        },
        success: function (resp) {
            if (resp.status == true) {
                $(".chat-module").html(resp.view);
                if (resp.chat_count > 0) {
                    scrollChatToBottom();
                }
                
            } else {
                console.log(resp.msg);
            }
        },
    });
}

Echo.join("status-update")
    .here((users) => {
        for (let x = 0; x < users.length; x++) {
            if (users[x].id != sender_id) {
                //   console.log(users[x].id + '--here');
                $("#" + users[x].id + "-status").addClass(
                    "active-green set-active-green"
                );

                $("#" + users[x].id + "-userStatus").html(
                    `<span class="online-user"></span>Online`
                );
            }
        }
    })

    .joining((user) => {
        // console.log(user + "--join");
        $("#" + user.id + "-status").addClass("active-green set-active-green");
        $("#" + user.id + "-userStatus").html(
            `<span class="online-user"></span>Online`
        );
    })

    .leaving((user) => {
        // console.log(user + "--leave");
        $("#" + user.id + "-status").removeClass(
            "active-green set-active-green"
        );
        $("#" + user.id + "-userStatus").html(
            `<span class="offline-user"></span>Offline`
        );
    })

    .listen("UserStatusEvent", (e) => {
        // console.log(e);
    });

// get chat message
Echo.private("broadcast-message").listen(".getChatMessage", (data) => {
    // console.log(receiver_id);
    let chat = data.chat.message;
    let created_at = data.chat.created_at;
    let time_format_12 = moment(created_at, "YYYY-MM-DD HH:mm:ss").format(
        "hh:mm A"
    );
    let profile_picture = data.sender_profile_picture;
    if (
        data.chat.reciver_id == sender_id &&
        receiver_id == data.chat.sender_id
    ) {
        let html =
            `<div class="chat-sec-left pb-1"><div class="chat-sec-left-wrap d-flex"><div class="chat-sec-left-text-box"><div class="chat-sec-left-text"><p>` +
            chat +
            `</p></div><div class="tm-div d-block pt-2"><h4>` +
            time_format_12 +
            `</h4></div></div></div></div>`;
        if (data.chat_count > 0) {
            $("#chat-container").append(html);
            scrollChatToBottom();
        } else {
            $("#chat-container").html(html);
        }
    }
});

// get chat request
Echo.private("user-request").listen(".getChatRequest", (data) => {
    console.log(data);
    const doctor_id = data.friendRequest.user_id;
    const patient_id = data.friendRequest.friend_id;
    console.log(sender_id, doctor_id, patient_id);
    const requestCount = $("#chat-count-" + doctor_id).text();
    if (sender_id == doctor_id) {
        $("#chat-count-" + doctor_id).text(parseInt(requestCount) + 1);
        $("#friendbox-" + doctor_id).prepend(
            ` <div id="deletebtn" ></div> <div class="profile-div profile-div-2 profile-div-3 friend-request-div d-flex align-items-center justify-content-center" id="friendProfile` +
                patient_id +
                `" > <div class="profile-img"> <img src="` +
                data.friendProfilePicture +
                `" alt="" /> </div> <div class="profile-text"> <h2>` +
                data.friendRequest.friend.name +
                `</h2> </div> <div id="userId" ></div> <div class="confirm-btn" data-id="` +
                data.friendRequest.id +
                `"> <a href="javascript:void(0);"> <h4> <span><i class="fa-solid fa-check" id="acceptRequest"></i></span >Confirm </h4> </a> </div> <div class="delete-btn" data-id="` +
                data.friendRequest.id +
                `"> <a href="javascript:void(0);"> <h4> <span><i class="fa-solid fa-trash-can"></i></span> </h4> </a> </div> </div>`
        );
    }
});

// accept chat request
Echo.private("chat-request-accepted").listen(
    ".getChatRequestAccepted",
    (data) => {
        const doctor_id = data.friend.user_id;
        const chat = data.chat;
        let created_at = data.chat.created_at;
        let time_format_12 = moment(created_at, "YYYY-MM-DD HH:mm:ss").format(
            "hh:mm A"
        );
        if (
            data.chat.reciver_id == sender_id &&
            receiver_id == data.chat.sender_id
        ) {
            let html =
                `<div class="container"> <div class="chat-sec-wrap"> <div class="chat-sec-box chat-srl_1 infinite-scroll" id="chat-container"> <div class="chat-sec-left pb-1"> <div class="chat-sec-left-wrap d-flex"> <div class="chat-sec-left-text-box"> <div class="chat-sec-left-text"> <p>` +
                chat.message +
                `</p> </div> <div class="tm-div d-block pt-2"> <h4>` +
                time_format_12 +
                `</h4> </div> </div> </div> </div> </div> <form action="javascript:void(0);" id="chat-form"> <input type="hidden" class="reciver_id" value="` +
                doctor_id +
                `" /> <div class="type-sec d-flex justify-content-center align-items-center"> <div class="type-div"> <div class="form-group"> <input type="text" class="form-control" id="user-chat" value="" placeholder="Type here..." required="" /> </div> </div> <div class="send-div"> <button type="submit" value="Submit"> <img src="/frontend_assets/images/send.png" alt="" /> </button> </div> </div> </form> </div> </div>`;
            $("#chat-view").html(html);

            console.log("accepted---" + data);
        }
    }
);

// reject chat request
Echo.private("reject-request").listen(".getRejectRequest", (data) => {
    if (
        data.chatRequest.friend_id == sender_id &&
        receiver_id == data.chatRequest.user_id
    ) {
        $("#doctor-busy").html(
            " <p>Doctor Busy right now. Please try again latar</p> "
        );
    //   add id to send request button
        $(".chat-request-button").attr("id", "send_request");
        $("#send_request").val("Send Chat request");
        console.log("reject---" + data);            
    }
    console.log(data);
});

function scrollChatToBottom() {
    var messages = document.getElementById("chat-container");
    messages.scrollTop = messages.scrollHeight;
}
