<div class="row">
    <div class="col-lg-12">
        <!--begin::Portlet-->
        <div class="m-portlet">
            <!--begin::Form-->
            <div class="m-portlet__body">
                <div class="form-group m-form__group" id="search-form">
                    <button type="button" class="btn btn-info btn-sm float-right" onclick="onCreateFaq();" style="margin-bottom: 20px;">
                        <i class="fa fa-plus-circle"></i>
                        Create
                    </button>
                </div>
                <table class="table table-bordered table-responsive-md" id="grTable">
                    <thead>
                    <tr>
                        <th>Time</th>
                        <th>Question</th>
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
    function render_table(tblData) {
        if (tblData.length == 0) {
            $('#grTable tbody').html('<tr><td colspan="8" class="no-data">No Data</td></td>');
            return;
        }
        $('#grTable tbody').html('');
        for (var i = 0; i < tblData.length; i++) {
            var trRecord = `<tr>
                            <td>${tblData[i].update_time}</td>
                            <td>${tblData[i].question}</td>
                            <td>
                                <button class="btn btn-danger"
                                    onclick="onDeleteItem('${tblData[i].id}')"
                                    data-toggle="m-tooltip" title="DELETE">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-warning"
                                    onclick="onEditFaq('${tblData[i].ID}')"
                                    data-toggle="m-tooltip" title="Edit">
                                    <i class="fa fa-pencil"></i>
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
                    alert('Delete Error')
                }
            })
        })
    }

    function onEditFaq(id) {
        window.location.href = baseURL + 'Faq/edit?' + id;
    }
    function onCreateFaq() {
        window.location.href = baseURL + 'Faq/create';
    }
</script>