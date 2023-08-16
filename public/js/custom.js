$(document).ready(function () {
    $(document).on("submit", "#chat-form", function (e) {
        e.preventDefault();
        var message = $("#user-chat").val();
        var doctor_id = $(".doctor_id").val();
        var url = "/user-chat";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                _token: $("input[name=_token]").val(),
                message: message,
                reciver_id: doctor_id,
                sender_id: sender_id,
            },
            success: function (res) {
                if (res.success) {
                    $("#user-chat").val("");
                    let chat = res.chat.message;
                    let created_at = res.chat.created_at;
                    let time_format_12 = moment(created_at, 'YYYY-MM-DD HH:mm:ss').format('hh:mm A');
                    let profile_picture = res.sender_profile_picture;

                    let html =
                        `<div class="chat-sec-left chat-sec-right pb-3"><div class="chat-sec-left-wrap d-flex justify-content-end"><div class="chat-sec-left-text-box"><div class="chat-sec-left-text"><h4>`+res.chat.sender.name+`</h4><p>` +
                        chat +
                        `</p></div><div class="tm-div d-block pt-2 text-end"><h4>` + time_format_12 + `</h4></div></div><div class="chat-sec-left-img ps-3"><div class="find-doc-slide-img cht-img"><img src="` +
                        profile_picture 
                        + `" alt="" /></div></div></div></div>`;
                    if (res.chat_count > 0) {
                        $("#chat-container").append(html);
                    } else { 
                        $("#chat-container").html(html);
                    }
                    
                } else {
                    console.log("error");
                }
            },
        });
    });
});

Echo.join("status-update")
    .here((users) => {
        for (let x = 0; x < users.length; x++) {
            if (users[x].id != sender_id) {
                //   console.log(users[x].id + '--here');
                $("#" + users[x].id + "-status").addClass(
                    "active-green set-active-green"
                );
            }
        }
    })

    .joining((user) => {
        // console.log(user + "--join");
        $("#" + user.id + "-status").addClass("active-green set-active-green");
    })

    .leaving((user) => {
        // console.log(user + "--leave");
        $("#" + user.id + "-status").removeClass(
            "active-green set-active-green"
        );
    })

    .listen("UserStatusEvent", (e) => {
        // console.log(e);
    });

Echo.private("broadcast-message").listen(".getChatMessage", (data) => {
    console.log(data);
    let chat = data.chat.message;
    let created_at = data.chat.created_at;
    let time_format_12 = moment(created_at, 'YYYY-MM-DD HH:mm:ss').format('hh:mm A');
    let profile_picture = data.reciver_profile_picture;
    if (
        data.chat.reciver_id == sender_id &&
        reciver_id == data.chat.sender_id
    ) {
        let html =
            `<div class="chat-sec-left pb-3"><div class="chat-sec-left-wrap d-flex"><div class="chat-sec-left-img"><div class="find-doc-slide-img cht-img"><img src="`+profile_picture+`" alt="" /></div></div><div class="chat-sec-left-text-box"><div class="chat-sec-left-text"><h4>Dr. Sam Rungta</h4><p>` +
            chat +
            `</p></div><div class="tm-div d-block pt-2"><h4>` + time_format_12 + `</h4></div></div></div></div>`;
            if (data.chat_count > 0) {
                $("#chat-container").append(html);
            } else { 
                $("#chat-container").html(html);
            }
    }
});
