$(document).ready(function () { 
    $(document).on('submit', '#chat-form', function(e) {
        e.preventDefault();
        var message = $('#user-chat').val();
        var doctor_id = $('.doctor_id').val();
        var url =  '/user-chat'
        $.ajax({
            type: "POST",
            url: url,
            data: {
                '_token': $('input[name=_token]').val(),
                'message': message,
                'reciver_id': doctor_id,
                'sender_id' : sender_id
            },
            success: function (res) {
                console.log(data);
                if (res.success) {
                    let chat = res.data.message;
                    
                } else {    
                    console.log('error');
                }
            },
        });
       
    });
 });

Echo.join('status-update')
    .here((users) => {
        for (let x = 0; x < users.length; x++) {
            if (users[x].id != sender_id) {
            //   console.log(users[x].id + '--here');
            $('#' + users[x].id + '-status').addClass('active-green set-active-green');
          }
        }
    })

    .joining((user) => {
        console.log(user + '--join');
        $('#' + user.id + '-status').addClass('active-green set-active-green');
    })

    .leaving((user) => {
        console.log(user+ '--leave');
        $('#' + user.id + '-status').removeClass('active-green set-active-green');
    })

    .listen('UserStatusEvent', (e) => {
        // console.log(e);
    });