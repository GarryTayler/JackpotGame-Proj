<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="#">
                    <div class="form-body">
                        <h3 class="card-title">User Info</h3>
                        <hr>
                        <div class="row p-t-20">
                            <?php foreach ($inputs as $input) { ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php render_input($input) ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                        <button type="button" class="btn btn-inverse" onclick="window.location.href='<?=site_url('user')?>'">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>