<div class="row">
    <div class="col-lg-12">
        <!--begin::Portlet-->
        <div class="m-portlet">
            <!--begin::Form-->
            <div class="m-portlet__body">
                <div class="form-group m-form__group" id="search-form">
                    <button type="button" class="btn btn-info btn-sm float-right" onclick="onCreateFaq();" style="margin-bottom: 20px;">
                        <i class="fa fa-plus-circle"></i>
                        Add
                    </button>
                </div>
                <table class="table table-bordered table-responsive-md" id="grTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th style="width:10%;">Time</th>
                            <th style="width:20%;">Question</th>
                            <th>Answer</th>
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

<div class="modal fade" id="faqDlg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="faqTitle">
                    Add
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <label class="col-lg-3"><span style="color: red">*</span>Question</label>
                    <textarea class="col-lg-9 form-control" id="question">
                    </textarea>
                </div>
                <div class="row form-group">
                    <label class="col-lg-3"><span style="color: red">*</span>Answer</label>
                    <textarea class="col-lg-9 form-control" id="answer" rows="10">
                    </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cancel
                </button>
                <input type="hidden" id="faqid">
                <button type="button" class="btn btn-info" onclick="saveFaq()" id="faq_action">
                    Add Question
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    var curPage = 1;
    $(document).ready(function (e) {
        getTblData();
    });
    function getTblData() {
        $.ajax({
            url: '<?= base_url("faq/ajax_get_faqs") ?>',
            type: 'post',
            dataType: 'json',
            data: {page: curPage},
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
                render_table(res.faqList);
            },
            error: function (err) {
                console.log(err);
                alert('Server Error');
            }
        });
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
                            <td>${tblData[i].id}</td>
                            <td>${tblData[i].create_time}</td>
                            <td>${tblData[i].question}</td>
                            <td>${tblData[i].answer}</td>
                            <td>
                                <button class="btn btn-warning"
                                    onclick="onEditFaq('${tblData[i].id}')"
                                    data-toggle="m-tooltip" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button class="btn btn-danger"
                                    onclick="onDeleteItem('${tblData[i].id}')"
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
        deleteConfirmMsg(function(){
            $.ajax({
                url: baseURL + 'faq/ajax_del_faq',
                type: 'post',
                dataType: 'json',
                data: {faqid: rId},
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
                    alert('Delete Error')
                }
            })
        })
    }

    function onEditFaq(id) {
        $("#faqid").val(id);
        $.post(baseURL + "Faq/edit", {faqid:id}, function(res) {
            if(res.error == '0') {
                $("#faqTitle").html('Update');
                $("#question").val(res.question);
                $("#answer").val(res.answer);
                $("#faqDlg").modal();
            }else {
                alert(res.msg);
            }
        }, 'json');
    }
    function onCreateFaq() {
        $("#faqid").val('');
        $("#faqTitle").html('Add');
        $("#question").val('');
        $("#answer").val('');
        $("#faqDlg").modal();
    }

    function saveFaq() {
        var faqid = $("#faqid").val();
        var data = new Object();
        if(faqid != '') {
            data.faqid = faqid;
        }
        data.question  = $("#question").val();
        data.answer = $("#answer").val();
        $.ajax({
            url: baseURL + 'Faq/ajax_save_faq',
            type: 'post',
            data: data,
            dataType: 'json',
            success: function(resp) {
                if (resp.errorCode == '0') {
                    $("#faqDlg").modal('hide');
                    getTblData();
                } else {
                    alert(resp.res_msg);
                }
            }
        });
    }
</script>