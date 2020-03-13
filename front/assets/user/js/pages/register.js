//Center the element
$.fn.center_layout = function () {
    this.css("position", "absolute");
    this.css("top", ($(window).height() - this.height()) / 2 + $(window).scrollTop() + "px");
    this.css("left", ($(window).width() - this.width()) / 2 + $(window).scrollLeft() + "px");
    return this;
}

//blockUI
function blockUI() {
    $.blockUI({
        css: {
            backgroundColor: 'transparent',
            border: 'none'
        },
        message: '<div class="spinner"></div>',
        baseZ: 1500,
        overlayCSS: {
            backgroundColor: '#FFFFFF',
            opacity: 0.7,
            cursor: 'wait'
        }
    });
    $('.blockUI.blockMsg').center_layout();
}//end Blockui


$( document ).ready(function() {
    $('#RegisterForm').on('keyup' , function(event) {
        event.preventDefault();
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            $('#btn_register').trigger('click');
        }
    });

    $('#btn_register').on('click' , function(e) {
        e.preventDefault();
        // check validation of register form
        if( $('#username').val() == '' ) {
            $('#username').removeClass('outline-normal');
            $('#username').addClass('outline-red');
            showToast('error' , 'The Username shouldn\'t be empty. This is required field.');
            return;
        }

        if( $('#email').val() == '' ) {
            $('#email').removeClass('outline-normal');
            $('#email').addClass('outline-red');
            showToast('error' , 'The Email shouldn\'t be empty. This is required field.');
            return;
        }

        if( $('#password').val() == '' ) {
            $('#password').removeClass('outline-normal');
            $('#password').addClass('outline-red');
            showToast('error' , 'The Password shouldn\'t be empty. This is required field.');
            return;
        }

        if( $('#confirm_password').val() == '' ) {
            $('#confirm_password').removeClass('outline-normal');
            $('#confirm_password').addClass('outline-red');
            showToast('error' , 'The Confirm Password shouldn\'t be empty. This is required field.');
            return;
        }

        if( $('#password').val() != $('#confirm_password').val()) {
            $('#confirm_password').removeClass('outline-normal');
            $('#confirm_password').addClass('outline-red');
            showToast('error' , 'The Confirm Password is not correct.');
            return;
        }

        if($("#check-privacy").prop('checked') != true) {
            showToast('error' , 'You should accept privacy and policy.');
            return;
        }


        blockUI();
        $.ajax({
            url: base_url+'User/signUp',
            type: 'POST',
            dataType: 'json',
            data: {
                username : $('#username').val() ,
                email: $("#email").val(),
                password : $('#password').val()
            },
            success: function(data) {
                $.unblockUI();
                if(data.error_code == 0) {
                    location.href = data.link;
                }
                else {
                    showToast('error' , data.res_msg);
                }
            }
        });
    });
});