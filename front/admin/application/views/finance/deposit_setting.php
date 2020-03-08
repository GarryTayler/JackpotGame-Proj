<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex m-b-20 align-items-center no-block">
                    <h5 class="card-title">
                        Setup deposit setting to secure your profit and reduce risks.                        
                    </h5>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($inputs as $input) { ?>
                            <tr>
                                <td><?=$input['title']?></td>
                                <td>
                                <?=render_input($input,
                                    with_default($setting[$input['name']], 1),
                                    false) // don't render label
                                ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <button type="submit" style="margin: auto;" class="btn waves-effect waves-light btn-secondary">Save</button>
            </div>
        </div>
    </div>
</div>