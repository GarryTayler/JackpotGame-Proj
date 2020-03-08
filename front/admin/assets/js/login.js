$(document).ready(function() {
    login_form();
    reset_form();
});

function login_form() {
    var form = $('#loginform');
    form.submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: site_url + 'auth/ajax_login',
            type: 'post',
            data: form.serializeArray(),
            dataType: 'json',
            success: function(resp) {
                if (resp.status) {
                    window.location.href = site_url;
                } else {
                    alert(resp.msg);
                }
            }
        });
    });
}

function reset_form() {

}