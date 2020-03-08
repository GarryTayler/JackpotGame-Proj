
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
    $('#LoginForm').on('keyup' , function(event) {
        event.preventDefault();
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
          if($('#accept_button').prop('checked')) {
              $('#btn_login').trigger('click');
          }
          else {
            showToast('error' , 'You should accept terms of service.');
          }
        }
    });

    $('#btn_login').on('click' , function(e) {
        e.preventDefault();
        // check validation of login form
        if( $('#username').val() == '' ) {
            $('#username').removeClass('outline-normal');
            $('#username').addClass('outline-red');
            showToast('error' , 'The Email shouldn\'t be empty. This is required field.');
            return;
        }

        if( $('#password').val() == '' ) {
            $('#password').removeClass('outline-normal');
            $('#password').addClass('outline-red');
            showToast('error' , 'The Password shouldn\'t be empty. This is required field.');
            return;
        }

        blockUI();
        $.ajax({
          url: base_url+'User/signIn',
          type: 'POST',
          dataType: 'json',
          data: {
            username : $('#username').val() ,
            password : $('#password').val() 
          },
          success: function(data) {
              $.unblockUI();  
              if(data.error_code == 0) {
                location.href = data.login_link;
              }
              else {
                showToast('error' , data.res_msg);
              }
          }
        });        

    });
});