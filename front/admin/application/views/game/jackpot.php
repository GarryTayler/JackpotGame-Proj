<style>
    .game-round {
        cursor: pointer;
    }
    .game-round:hover {
        color:#36a3f7 !important;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <!--begin::Portlet-->
        <div class="m-portlet">
            <!--begin::Form-->
            <div class="m-portlet__body">
                <div class="form-group m-form__group row" id="search-form">
                    <div class="col-lg-2" style="margin-top:10px;">
                        <input id="from" class="form-control m-input" placeholder="From">
                    </div>
                    <div class="col-lg-offset-1 col-lg-2" style="margin-top:10px;">
                        <input id="to" class="form-control m-input" placeholder="To">
                    </div>
                    <div class="col-lg-2 float-right" style="margin-top:10px;">
                        <button type="button" class="form-control btn btn-info btn-md">
                            Search
                        </button>
                    </div>
                </div>
                <table class="table table-bordered table-responsive-md" id="grTable">
                    <thead>
                    <tr>
                        <th>Round</th>
                        <th>Time</th>
                        <th>HASH</th>
                        <th>Total Players</th>
                        <th>Total Betting Amount</th>
                        <th>Total Profit</th>
                        <th>Winner</th>
                        <th>Action</th>
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

<div class="modal fade" id="gameDlg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gameDlgTitle">
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-responsive-md" id="detailTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Time</th>
                        <th>BET AMOUNT</th>
                        <th>USER NAME</th>
                        <th>PROFIT</th>
                        <th>RESULT</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    var curPage = 1;
    $(document).ready(function(e){
        $("#from, #to").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });
        getTblData();
    });

    $('#search-form button').click(function() {
        curPage = 1;
        getTblData();
    });

    $('#search-form input').keyup(function(e){
        if (e.keyCode == 13) {
            $('#search-form button').click();
        }
    });
    function getTblData() {
        var from = $('#from').val();
        var to = $('#to').val();
        $.ajax({
            url: '<?= base_url("Game/Jackpot/ajax_get_histories") ?>',
            type: 'post',
            dataType: 'json',
            data: {page: curPage, from: from, to: to},
            success: function (res) {
                if (res.totalCount >= 0) {
                    $('.pagination').pagination('updateItems', res.totalCount);
                    if (res.totalCount < 10) {
                        $('ul.pagination').css('display', 'none');
                    } else {
                        $('ul.pagination').css('display', 'inline-block');
                    }
                }
                render_table(res.historyList);
            },
            error: function (err) {
                console.log(err);
                alert('Server Error');
            }
        })
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

    function render_table(tblData) {
        if (tblData.length == 0) {
            $('#grTable tbody').html('<tr><td colspan="8" class="no-data">No Data</td></td>');
            return;
        }
        $('#grTable tbody').html('');
        for (var i = 0; i < tblData.length; i++) {
            var trRecord = `<tr>
                            <td onclick="onShowGameDetail('${tblData[i].ID}')" class="game-round">${tblData[i].ID}</td>
                            <td>${tblData[i].CREATE_TIME}</td>
                            <td>${tblData[i].HASH}</td>
                            <td>${tblData[i].TOTAL_PLAYERS}</td>
                            <td>${tblData[i].TOTAL_BETTING_AMOUNT}</td>
                            <td>${tblData[i].TOTAL_PROFIT}</td>
                            <td>${tblData[i].WINNER_USERNAME}(${tblData[i].WINNER_EMAIL})</td>
                            <td>
                                <button class="btn btn-danger"
                                    onclick="onDeleteItem('${tblData[i].ID}')"
                                    data-toggle="m-tooltip" title="DELETE">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>`;
            $('#grTable tbody').append(trRecord);
        }
        mApp.initTooltips();
    }

    function onDeleteItem(rId) {
        // Add confirm dialog
        deleteConfirmMsg(function(){
            $.ajax({
                url: baseURL + 'Game/Jackpot/ajax_del_history',
                type: 'post',
                dataType: 'json',
                data: {gameid: rId},
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

    function onShowGameDetail(id) {
        $.ajax({
            url: '<?= base_url("Game/Jackpot/ajax_get_logs") ?>',
            type: 'post',
            dataType: 'json',
            data: {gameid: id},
            success: function (res) {
                $("#gameDlgTitle").html("Round " + id);
                renderGameDetail(res.logList);
                $("#gameDlg").modal();
            },
            error: function (err) {
                console.log(err);
                alert('Server Error');
            }
        });
    }


    function renderGameDetail(tblData) {
        if (tblData.length == 0) {
            $('#detailTable tbody').html('<tr><td colspan="6" class="no-data">No Data</td></td>');
            return;
        }
        $('#detailTable tbody').html('');
        for (var i = 0; i < tblData.length; i++) {
            var trRecord = `<tr>
                            <td>${i + 1}</td>
                            <td>${tblData[i].CREATE_TIME}</td>
                            <td>${tblData[i].BET_AMOUNT}</td>
                            <td>${tblData[i].USERNAME}</td>
                            <td>${tblData[i].PROFIT}</td>
                            <td>${tblData[i].RESULT}</td>
                        </tr>`;
            $('#detailTable tbody').append(trRecord);
        }
    }
</script>