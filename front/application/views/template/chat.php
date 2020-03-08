<style type="text/css">
    .copen {
        display: none;
    }
</style>
<div class="copen">
    <a href="javascript:;" class="open_chat">
        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
    </a>
</div>
<div class="chat-panel">
    <div class="row row_heading_v1" style="margin: 0">
        <div class="row" style="width: 100%;margin:0;height: 65px">
            <div class="chat-title-wrapper">
                <label class="chat-title">Live Chat</label>
            </div>
            <div class="chat-close-wrapper">
                <a class="bar-close"><i class="fa fa-chevron-left" aria-hidden="true" style="font-size: 14px;margin-top:24px;"></i></a>
            </div>
        </div>
    </div>
    <ul class="list-unstyled mCustomScrollbar" id="chatlog1" style="border-bottom: 2px solid rgb(52, 63, 97);overflow-y: hidden;">
    </ul>
    <div class="msg-input left-input" style="align-items: center;padding: 12px 0;">
        <?php
        if( isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ) {
            ?>
            <textarea placeholder="your message" id="chat_message_input"></textarea>
            <div id="chat-send-btn-wrapper">
                <a class="chatsend" id="chat-send-btn">
                    <img src="<?php echo base_url(); ?>assets/user/images/chat_send.png" alt="Chat" id="chat_message_input_img">
                </a>
            </div>
            <?php
        } else {
            ?>
            <textarea placeholder="your message" id="chat_message_input" disabled></textarea>
            <div id="chat-send-btn-wrapper">
                <a class="chatsend disable_button" id="chat-send-btn">
                    <img src="<?php echo base_url(); ?>assets/user/images/chat_send.png" alt="Chat" id="chat_message_input_img">
                </a>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<!-- socket part -->
<script src="<?php echo base_url();?>assets/modules/socket.io-client/dist/socket.io.js"></script>
<script>
    run_waitMe($('.chat-panel'), 2, 'bounce');
    var chat_socket = io.connect( '<?php echo CHAT_SERVER_URL; ?>' );
    var game_type = '<?= $data['game_type']; ?>';
    function setScroll() {
        var height = $('#mCSB_1').height();
        var main_height = $('#mCSB_1_container').height();
        main_height = height - main_height;
        if(main_height < 0) {
            $('#mCSB_1_container').css('top' , main_height + 'px');
            height = height - $('#mCSB_1_dragger_vertical').height();
            $('#mCSB_1_dragger_vertical').css('top' , height + 'px');
        }
    }
    $('#chat_message_input').on('keyup' , function(e) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if( keycode == '13' ) {
            send_msg($('#chat_message_input').val());
        }
    });
    $('#chat_message_input_img').on('click' , function(e) {
        send_msg($('#chat_message_input').val());
    });
    function send_msg (msg) {
        run_waitMe($('.chat-panel'), 2, 'bounce');
        $.post("<?php echo site_url(); ?>User/emit",
        {
            msg: msg,
            type : game_type
        },
        function(data, status){
            $('.chat-panel').waitMe('hide');
            var result = jQuery.parseJSON(data);
            if(result.error_code != 0) {
                showToast('error' , result.res_msg , 'bottom-left');
            }

        });
        $('#chat_message_input').val("");
    }
    function getTimeString (timestamp) {
        timestamp *= 1000;
        var d = new Date(timestamp);
        hour = d.getHours(); minute = d.getMinutes(); afterfix = 'AM';
        if( hour >= 12 ) {
            afterfix = 'PM';
            if( hour > 12 )
                hour -= 12;
        }
        else {
            if( hour < 10 )
                hour = '0' + hour;
        }
        if( minute < 10 )
            minute = '0' + minute;

        return hour + ':' + minute +' ' + afterfix;

    }
    chat_socket.on('chat_message' , function(msg) {
        var data = jQuery.parseJSON(msg);
        if( data.type == game_type ) {
            var no_avatar = "this.src='" + base_url + "assets/user/images/no_avatar.jpg'";
            data.avatar = base_url + "uploads/profile/" + data.avatar;
            var html_code = '<li class="notification"><span class = "time" style="display:block;text-align: center">' + getTimeString(data.curtime)+ '</span>' +
            '<div class="overflow-h">' +
                '<img width = "20%" class ="msg_user" src = "' + data.avatar + '" ' + ' onerror = "' + no_avatar + '">' +
                '<div class="chat_content">' +
                    '<div class="chat_title">' +
                        '<div class="chat_id">' +
                            '<a class="dropdown-toggle1" data-toggle="dropdown">' +
                            data.username +
                            '</a>' +
                        '</div>'+
                    '</div>' +
                    '<div class = "msg">' +
                            data.msg +
                    '</div></div></div></li>';
                $('.dropdown-menu2').attr('class' , 'dropdown-menu1');
            $('#mCSB_1_container').append(html_code);
            setTimeout(function(){
                setScroll();
            }, 100);

        }

    });
    var timerId = setInterval(function() {
        if($('#mCSB_1_container').length > 0) {
            drawChat();
            clearInterval(timerId);
        }
    } , 100);
    function drawChat() {
        run_waitMe($('.chat-panel'), 2, 'bounce');
        $.post("<?php echo site_url(); ?>User/getChatList",
        {
            type : game_type
        },
        function(data, status){
            var result = jQuery.parseJSON(data);
            var no_avatar = "this.src='" + base_url + "assets/user/images/no_avatar.jpg'";
            if(result.error_code == 0) {
                for( i = 0; i < result.result.length; i ++ ) {
                    var avatar = base_url + "uploads/profile/" + result.result[i].AVATAR;
					var html_code = '<li class="notification">' +
					'           <span class = "time" style="display:block;text-align: center">' +
                                        getTimeString(parseInt(result.result[i].CREATE_TIME)) +
                        '</span>' +
                        '<div class="overflow-h">' +
                            '<img width = "20%" class ="msg_user" src = "' + avatar + '" onerror = "' + no_avatar + '">' +
                            '<div class="chat_content">' +
                                '<div class="chat_title">' +
                                    '<div class="chat_id">' +
                                        '<a class="dropdown-toggle1" data-toggle="dropdown">' +
                                        result.result[i].USERNAME +
                                        '</a>' +
                                    '</div>' +
                                '</div>' +
                                '<div class = "msg">' +
                                    result.result[i].MSG +
                                '</div></div></div>' +
                        '</li>';
                    $('.dropdown-menu2').attr('class' , 'dropdown-menu1');
                    $('#mCSB_1_container').append(html_code);
                }

                setTimeout(function(){
                    setScroll();
                }, 100);
            }
            $('.chat-panel').waitMe('hide');
        });
    }
</script>
