<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                Add
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        ×
                    </span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <label class="col-lg-3"><span class="text-red">*</span>Question</label>
                <textarea class="col-lg-9" id="question">
                    <?php if(isset($faq['question'])) { echo $faq['question'];}?>"
                </textarea>
            </div>
            <div class="row">
                <label class="col-lg-3"><span class="text-red">*</span>Answer</label>
                <textarea class="col-lg-9" id="answer">
                    <?php
                    if(isset($faq['answer'])) {
                        echo $faq['answer'];
                    }
                    ?>
                </textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-info" onclick="saveFaq()">
                Add Question
            </button>
        </div>
    </div>
</div>

<script>
    function saveFaq() {
        var question = $("#question").text();
        var answer = $("#answer").text();
        $.ajax({
            url: baseURL + 'Faq/ajax_save_faq',
            type: 'post',
            data: {'question':question, 'answer':answer},
            dataType: 'json',
            success: function(resp) {
                if (resp.errorCode == '0') {
                    $("#faqDlg").dismiss();
                    window.location.reload();
                } else {
                    alert(resp.res_msg);
                }
            }
        });
    }
</script>