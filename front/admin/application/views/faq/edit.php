<div class="row">
    <div class="col-lg-12">
        <!--begin::Portlet-->
        <div class="m-portlet">
            <!--begin::Form-->
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <input type="text" id="question" class="form-control form-control-lg" placeholder="Input Question"
                           value="<?php if(isset($faq['question'])) { echo $faq['question'];}?>">
                </div>
                <div class="form-group m-form__group row">
                    <textarea name="answer"  id="answer" class="form-control">
                        <?php
                        if(isset($faq['answer'])) {
                            echo $faq['answer'];
                        }
                        ?>
                    </textarea>
                </div>
                <div class="form-group m-form__group row">
                    <button type="button" onclick="saveFaq();" class="form-control btn btn-info btn-sm float-right" style="width:100px;">
                        <i class="fa fa-save"></i>
                        Change
                    </button>
                </div>
            </div>
            <!--end::Form-->
        </div>
        <!--end::Portlet-->
    </div>
</div>
<script src="<?=base_url('assets/plugin/ckeditor/ckeditor.js')?>"></script>
<script>
    $(document).ready(function(){
        CKEDITOR.replace('answer', {'width':'100%', 'height':'500px'});
    });


    function saveFaq() {
        var question = $("#question").val();
        var answer = CKEDITOR.instances.answer.getData();
        $.ajax({
            url: baseURL + 'Faq/ajax_save_faq',
            type: 'post',
            data: {'question':question, 'answer':answer},
            dataType: 'json',
            success: function(resp) {
                if (resp.errorCode == '0') {
                    window.location.reload();
                } else {
                    alert(resp.res_msg);
                }
            }
        });
    }
</script>