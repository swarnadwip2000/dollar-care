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
                scrollChatToBottom();
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
            scrollChatToBottom()
        } else {
            $("#chat-container").html(html);
        }
    }
});


function scrollChatToBottom() {
    var messages = document.getElementById('chat-container');
    messages.scrollTop = messages.scrollHeight;
}



  

 
