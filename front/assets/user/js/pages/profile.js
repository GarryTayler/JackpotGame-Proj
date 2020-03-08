
function onSaveUsername() {
    var username = $("#username").val();
    if(username == "") {
        $('#username').removeClass('outline-normal');
        $('#username').addClass('outline-red');
        showToast('error' , 'The Username shouldn\'t be empty. This is required field.');
        return;
    }
    $.ajax({
        url: site_url + 'Profile/saveUsername',
        type: 'post',
        data: {'username':username},
        dataType: 'json',
        success: function(resp) {
            if (resp.error_code == '0') {
                window.location.href = resp.link;
            } else {
                alert(resp.res_msg);
            }
        }
    });
}
function onSaveEmail() {
    var email = $("#email").val();
    if(email == "") {
        $('#email').removeClass('outline-normal');
        $('#email').addClass('outline-red');
        showToast('error' , 'The Username shouldn\'t be empty. This is required field.');
        return;
    }
    $.ajax({
        url: site_url + 'Profile/saveEmail',
        type: 'post',
        data: {'email':email},
        dataType: 'json',
        success: function(resp) {
            if (resp.error_code == '0') {
                window.location.href = resp.link;
            } else {
                alert(resp.res_msg);
            }
        }
    });
}
function onSaveSecurityInfo() {
    var old_password = $("#old_password").val();
    var new_password = $("#new_password").val();
    var confirm_password = $("#confirm_password").val();
    if(old_password == "") {
        $('#old_password').removeClass('outline-normal');
        $('#old_password').addClass('outline-red');
        showToast('error' , 'The Old Password shouldn\'t be empty. This is required field.');
        return;
    }
    if(new_password == "") {
        $('#new_password').removeClass('outline-normal');
        $('#new_password').addClass('outline-red');
        showToast('error' , 'The New Password shouldn\'t be empty. This is required field.');
        return;
    }
    if(confirm_password == "") {
        $('#confirm_password').removeClass('outline-normal');
        $('#confirm_password').addClass('outline-red');
        showToast('error' , 'The Confirm Password shouldn\'t be empty. This is required field.');
        return;
    }
    if(new_password != confirm_password) {
        $('#confirm_password').removeClass('outline-normal');
        $('#confirm_password').addClass('outline-red');
        showToast('error' , 'The Confirm Password is not correct.');
        return;
    }
    $.ajax({
        url: site_url + 'Profile/saveSecurity',
        type: 'post',
        data: {'old_password':old_password, 'new_password':new_password, 'confirm_password':confirm_password},
        dataType: 'json',
        success: function(resp) {
            if (resp.error_code == '0') {
                window.location.href = resp.link;
            } else {
                alert(resp.res_msg);
            }
        }
    });
}

function onSaveAvatar() {
    var formData = new FormData($("#ProfileForm").get(0));
    if($("#avatar_file")[0].files[0] != undefined)
        formData.append('avatar_file', $("#avatar_file")[0].files[0]);
    $.ajax({
        url: site_url + 'Profile/saveAvatar',
        type: 'post',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(resp) {
            if (resp.error_code == '0') {
                window.location.href = resp.link;
            } else {
                alert(resp.res_msg);
            }
        }
    });
}
function onChangeAvatar(){
    $("#avatar_file").trigger('click');
}

$("#avatar_file").on("change", function(event){
    var src = $(this)[0].files[0];
    var FR= new FileReader();
    FR.onload = function(e) {
        $("#user-avatar").attr("src", e.target.result);
    };
    if(src != undefined)
        FR.readAsDataURL(src);
});

