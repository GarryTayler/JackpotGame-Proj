<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="mt-4" id="form-change-password">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Current Password</label>
                        <input name="cur_password" type="password" class="form-control" id="cur_password" placeholder="Enter Current Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">New Password</label>
                        <input name="new_password" type="password" class="form-control" id="new_password" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input name="confirm_password1" type="password" class="form-control" id="confirm_password" placeholder="Retype New Password">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="onChangePassword()">Change</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function onChangePassword() {
        var curPassword = $("#cur_password").val();
        var newPassword = $("#new_password").val();
        var confirmPassword = $("#confirm_password").val();

        if(newPassword != confirmPassword) {
            swal("Error!", "Confirm password is not correct!", "error");
            return;
        }

        swal({
            title: 'Are you sure change password?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes'
        }).then(function(result) {
            if(result.value) {
                $.ajax({
                    url: '<?= base_url("auth/ajax_set_password") ?>',
                    type: 'post',
                    dataType: 'json',
                    data: {curPassword: curPassword, password: newPassword},
                    success: function (res) {
                        swal(
                            'Success!',
                            'Your password was changed.',
                            'success'
                        );
                    },
                    error: function (err) {
                        swal(
                            'Error!',
                            err.msg,
                            'error'
                        );
                    }
                })
            }
        });
    }
</script>


