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
                            <th>ID</th>
                            <th>Avatar</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Bonus</th>
                            <th>Profit</th>
                            <th>Log Date</th>
                            <th>Referral<br>Code</th>
                            <th>Referral<br>Username</th>
                            <th>Referral<br>Email</th>
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
        $('#search-form button').click(function () {
            curPage = 1;
            getTblData();
        });

        $('#search-form input').keyup(function (e) {
            if (e.keyCode == 13) {
                $('#search-form button').click();
            }
        })
    });

    function getTblData() {
        var searchValue = $('#search').val(); //todo ; later
        $.ajax({
            url: '<?= base_url("referral/ajax_get_referral") ?>',
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
                render_table(res.referralList);
            },
            error: function (err) {
                console.log(err);
                alert('Server Error');
            }
        })
    }

    //fixme  later using real data...
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

            if (tblData[i].STATE == 1) {
                blockState = '<span class="m-badge m-badge--primary m-badge--wide">active</span>';
                blockBtnClass = 'btn-focus';
                blockBtnToolTip = 'Block';
            } else {
                blockState = '<span class="m-badge m-badge--danger m-badge--wide">inactive</span>';
                blockBtnClass = 'btn-info';
                blockBtnToolTip = 'UnBlock';
            }

            var trRecord = `<tr>
                            <td>${tblData[i].ID}</td>
                            <td><img src="${tblData[i].AVATAR}" onerror="this.src='${no_avatar}'"></td>
                            <td>${tblData[i].USERNAME}</td>
                            <td>${tblData[i].EMAIL}</td>
                            <td></td>
                            <td></td>
                            <td>${getFullTimeFormat(tblData[i].UPDATE_TIME)}</td>
                            <td>${tblData[i].REFERAL_CODE}</td>
                            <td>${tblData[i].USERNAME}</td>
                            <td>${tblData[i].EMAIL}</td>
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

</script>


