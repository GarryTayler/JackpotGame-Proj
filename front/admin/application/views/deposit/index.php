<div class="row">
    <div class="col-lg-12">
        <!--begin::Portlet-->
        <div class="m-portlet">
            <!--begin::Form-->
            <div class="m-portlet__body">
                <div class="form-group m-form__group row" id="search-form">
                    <div class="col-lg-3">
                        <div class="input-group date">
                            <input type="text"
                                   class="form-control m-input"
                                   readonly="" placeholder="Start Date"
                                   id="start_date">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="input-group date">
                            <input type="text"
                                   id="end_date"
                                   class="form-control m-input"
                                   readonly="" placeholder="End Date">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="offset-lg-4 col-lg-2">
                        <button type="button" class="form-control btn btn-info btn-md">
                            Search
                        </button>
                    </div>
                </div>
                <table class="table table-bordered table-responsive-md" id="grTable">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Detail</th>
                            <th>Destination</th>
                            <th>Deposit Amount<br>(BTC)</th>
                            <th>Deposit Amount<br>(Coins)</th>
                            <th>Fee(BTC)</th>
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
        // input group layout
        $('#start_date, #end_date').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });
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
        var fromDate = $('#start_date').val();
        var toDate = $('#end_date').val();

        var ajaxData = {};
        if (fromDate != '') {
            fromDate = moment(new Date(fromDate).getTime()).format('YYYY-MM-DD');
            ajaxData.from = fromDate;
        }

        if (toDate != '') {
            toDate = moment(new Date(toDate).getTime()).format('YYYY-MM-DD');
            ajaxData.to = toDate;
        }

        ajaxData.page = curPage;

        $.ajax({
            url: '<?= base_url("Wallet/Deposit/ajax_get_logs") ?>',
            type: 'post',
            dataType: 'json',
            data: ajaxData,
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
                render_table(res.logsList);
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
            var trRecord = `<tr>
                            <td>${getFullTimeFormat(tblData[i].CREATE_TIME)}</td>
                            <td>${tblData[i].EMAIL}</td>
                            <td>${tblData[i].USERNAME}</td>
                            <td>${tblData[i].DETAIL}</td>
                            <td>${tblData[i].TXHASH}</td>
                            <td>${tblData[i].AMOUNT_BTC}</td>
                            <td>${tblData[i].AMOUNT_COINS}</td>
                            <td>${tblData[i].FEE}</td>
                        </tr>`;
            $('#grTable tbody').append(trRecord);
        }
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


