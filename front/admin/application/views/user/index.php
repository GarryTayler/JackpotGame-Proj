<div class="row">
    <div class="col-lg-12">
        <!--begin::Portlet-->
        <div class="m-portlet">
            <!--begin::Form-->
            <div class="m-portlet__body">
                <div class="form-group m-form__group row" id="search-form">
                    <div class="col-lg-3">
                        <input id="search" class="form-control m-input" placeholder="Name or Email">
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="form-control btn btn-info btn-md">
                            Search
                        </button>
                    </div>
                </div>
                <table class="table table-bordered table-responsive-md" id="grTable">
                    <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Wallet</th>
                        <th>Referral Code</th>
                        <th>CreatedAt</th>
                        <th>IP</th>
                        <th>State</th>
                        <th style="min-width:150px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <?php $this->load->view('layout/pagination') ?>
            </div>
            <!--end::Form-->
        </div>
        <!--end::Portlet-->
    </div>
</div>
<script>
    var curPage = 1;
    $(document).ready(function (e) {
        getTblData();
        $('#search-form button').click(function() {
            curPage = 1;
            getTblData();
        });

        $('#search-form input').keyup(function(e){
            if (e.keyCode == 13) {
                $('#search-form button').click();
            }
        })
    });

    function getTblData() {
        var searchValue = $('#search').val(); //todo ; later
        $.ajax({
            url: '<?= base_url("user/ajax_get_users") ?>',
            type: 'post',
            dataType: 'json',
            data: {page: curPage, searchValue: searchValue},
            success: function (res) {
                if (res.totalCount > 0) {
                    $('.pagination').pagination('updateItems', res.totalCount);
                    if (res.totalCount < 10) {
                        $('ul.pagination').css('display', 'none');
                    } else {
                        $('ul.pagination').css('display', 'inline-block');
                    }
                } else {
                    $('ul.pagination').css('display', 'none');
                }
                render_table(res.userList);
            },
            error: function (err) {
                console.log(err);
                alert('Server Error');
            }
        })
    }

    function render_table(tblData) {
        if (tblData.length == 0) {
            $('#grTable tbody').html('<tr><td colspan="8" class="no-data">No Data</td></td>');
            return;
        }
        $('#grTable tbody').html('');
        for (var i = 0; i < tblData.length; i++) {
            var no_avatar = baseURL + 'assets/images/no_avatar.jpg';
            var blockState = '',
                blockBtnClass = '',
                blockBtnToolTip = '';

            if (tblData[i].STATE == 0) {
                blockState = '<span class="m-badge m-badge--primary m-badge--wide">active</span>';
                blockBtnClass = 'btn-focus';
                blockBtnToolTip = 'Block';
            } else {
                blockState = '<span class="m-badge m-badge--danger m-badge--wide">inactive</span>';
                blockBtnClass = 'btn-info';
                blockBtnToolTip = 'UnBlock';
            }

            var trRecord = `<tr>
                            <td><img src="/uploads/profile/${tblData[i].AVATAR}" onerror="this.src='${no_avatar}'"></td>
                            <td>${tblData[i].USERNAME}</td>
                            <td>${tblData[i].EMAIL}</td>
                            <td>${tblData[i].WALLET}</td>
                            <td>${tblData[i].REFERRAL_CODE}</td>
                            <td>${getFullTimeFormat(tblData[i].CREATE_TIME)}</td>
                            <td>${tblData[i].LAST_IPADDRESS}</td>
                            <td>${blockState}</td>
                            <td>
                                <button class="btn btn-danger"
                                    onclick="onDeleteItem('${tblData[i].ID}')"
                                    data-toggle="m-tooltip" title="DELETE">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn ${blockBtnClass}"
                                    onclick="onBlockItem(this, '${tblData[i].ID}')"
                                    data-toggle="m-tooltip" title="${blockBtnToolTip}">
                                    <i class="fa fa-window-close-o"></i>
                                </button>
                                <button class="btn btn-warning"
                                    onclick="onResetPassword('${tblData[i].ID}')"
                                    data-toggle="m-tooltip" title="Reset Password">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            </td>
                        </tr>`;
            $('#grTable tbody').append(trRecord);
        }
        mApp.initTooltips();
    }

    /**
     * Callback function for pagination
     * @param pageNumber
     * @param event
     */
    function onPageClick(pageNumber, event) {
        curPage = pageNumber;
        getTblData();
    }

    /**
     * Ajax function to delete user data
     * @param rId : record id
     */
    function onDeleteItem(rId) {
        // Add confirm dialog
        deleteConfirmMsg(function(){
            $.ajax({
                url: baseURL + 'user/ajax_delete_user',
                type: 'post',
                dataType: 'json',
                data: {userid: rId},
                success: function(res) {
                    //Refresh Table.....
                    if (res.errorCode == 1) {
                        alert(res.msg);
                    } else {
                        getTblData();
                    }
                },
                error: function (res) {
                    console.log(res);
                    alert('Server Error')
                }
            })
        })
    }

    /**
     * Ajax function to block user
     * @param rId
     */
    function onBlockItem(self, rId) {
        var stateTag = $(self).parent().parent().find('span.m-badge--wide');
        var title = '';
        if (stateTag.hasClass('m-badge--primary')) {
            title = "Are you sure to block this user?";
        }else {
            title = "Are you sure to unblock this user?";
        }
        swal({
            title: title,
            text: "You can revert this later!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes'
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseURL + 'user/ajax_block_user',
                    type: 'post',
                    dataType: 'json',
                    data: {userid: rId},
                    success: function(res) {
                        if (res.errorCode == 0) {
                            var stateTag = $(self).parent().parent().find('span.m-badge--wide');
                            if (stateTag.hasClass('m-badge--primary')) {
                                stateTag.removeClass('m-badge--primary');
                                stateTag.addClass('m-badge--danger');
                                stateTag.text('inactive');

                                $(self).removeClass('btn-focus');
                                $(self).addClass('btn-info');
                                $(self).attr('title', 'UnBlock');
                                $(self).attr('data-original-title', 'UnBlock');
                            } else {
                                stateTag.removeClass('m-badge--danger');
                                stateTag.addClass('m-badge--primary');
                                stateTag.text('active');

                                $(self).removeClass('btn-info');
                                $(self).addClass('btn-focus');
                                $(self).attr('title', 'Block');
                                $(self).attr('data-original-title', 'Block');
                            }
                        } else {
                            alert(res.msg);
                        }
                    },
                    error: function(res) {
                        alert('Server Error');
                    }
                })
            }
        });
    }

    /**
     * Ajax function to reset user password
     * @param rId
     */
    function onResetPassword(rId) {
        swal({
            title: 'Are you sure to reset user password?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Reset password!'
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: baseURL + 'user/ajax_reset_password',
                    type: 'post',
                    dataType: 'json',
                    data: {userid: rId},
                    success: function(res) {
                        if (res.errorCode == 0) {
                            swal(
                                'Success!',
                                'Password has been changed successfully!',
                                'success'
                            )
                        } else {
                            alert(res.msg);
                        }
                    },
                    error: function(res) {
                        alert('Server Error');
                    }
                })
            }
        });
    }
</script>


