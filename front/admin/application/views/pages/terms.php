<div class="row">
    <div class="col-lg-12">
        <!--begin::Portlet-->
        <div class="m-portlet">
            <!--begin::Form-->
            <div class="m-portlet__body">
                <div class="form-group m-form__group">
                    <div class="col-lg-12">
                        <textarea name="content"  id="content" class="form-control" rows="40">
                            <?php
                            if(isset($info['VALUE'])) {
                                echo $info['VALUE'];
                            }
                            ?>
                        </textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <button type="button" onclick="saveContent();" class="form-control btn btn-info btn-sm float-right" style="width:100px;">
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
        CKEDITOR.replace('content', {'height':'500px'});
    });
    function saveContent(){
        var content = CKEDITOR.instances.content.getData();
        $.ajax({
            url: baseURL + 'Pages/ajax_save_terms',
            type: 'post',
            data: {'content':content},
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