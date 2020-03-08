<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5">
                        <div>Chart1</div>
                        <div>Chart2</div>
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label>Amount From</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label>Amount To</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label>Date</label>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                            </div>
                            <div class="mb-3 col-12 row">
                                <button type="submit" style="margin: auto;" class="btn waves-effect waves-light btn-secondary">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#pending" role="tab" aria-selected="true"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Pending</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#completed" role="tab" aria-selected="false"><span class="hidden-sm-up"><span class="hidden-xs-down">Completed</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cancelled" role="tab" aria-selected="false"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Cancelled</span></a> </li>
                </ul>
                <div class="tab-content tabcontent-border">
                    <div class="tab-pane active" id="pending" role="tabpanel">1</div>
                    <div class="tab-pane p-20" id="completed" role="tabpanel">2</div>
                    <div class="tab-pane p-20" id="cancelled" role="tabpanel">3</div>
                </div>
            </div>
        </div>
    </div>
</div>