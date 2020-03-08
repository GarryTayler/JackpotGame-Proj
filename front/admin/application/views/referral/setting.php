<div class="row">
    <div class="col-lg-6">
        <!--begin::Portlet-->
        <div class="m-portlet">
            <!--begin::Form-->
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <label class="col-lg-4 col-form-label">
                        Referral Bonus(%)
                    </label>
                    <div class="col-lg-5">
                        <input type="text"
                               id="referral_bonus"
                               value="<?= $referralPercInfo ?>"
                               oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                               class="form-control m-input" placeholder="Referral Bonus(%)">
                    </div>
                    <div class="col-lg-3">
                        <button class="btn btn-info form-control gr-change-btn" onclick="onChangeBonus()">Change</button>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-lg-4 col-form-label">
                        Withdrawal Fee(%)
                    </label>
                    <div class="col-lg-5">
                        <input type="text"
                               id="withdrawal_fee"
                               value="<?= $withdrawalFeeInfo ?>"
                               oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                               class="form-control m-input" placeholder="Withdrawal Fee(%)">
                    </div>
                    <div class="col-lg-3">
                        <button class="btn btn-info form-control gr-change-btn" onclick="onChangeFee()">Change</button>
                    </div>
                </div>
            </div>
            <!--end::Form-->
        </div>
        <!--end::Portlet-->
    </div>
</div>
<script>
    function onChangeBonus() {
        var referral_bonus = $('#referral_bonus').val();
        $.ajax({
            url: baseURL + 'referral/ajax_save_setting',
            type:'post',
            dataType: 'json',
            data: {key: 'REFERAL_PERCENTAGE', value: referral_bonus},
            success: function(res) {
                if (res.errorCode == 0) {
                    swal(
                        'Success!',
                        'Referral Bonus has been changed successfully!',
                        'success'
                    )
                } else {
                   alert(res.msg);
                }
            },
            error: function(err) {
                alert('Server error');
            }
        })
    }
    function onChangeFee() {
        var withdrawal_fee = $('#withdrawal_fee').val();
        $.ajax({
            url: baseURL + 'referral/ajax_save_setting',
            type:'post',
            dataType: 'json',
            data: {key: 'WITHDRAWAL_FEE', value: withdrawal_fee},
            success: function(res) {
                if (res.errorCode == 0) {
                    swal(
                        'Success!',
                        'Withdrawal Fee has been changed successfully!',
                        'success'
                    )
                } else {
                    alert(res.msg);
                }
            },
            error: function(err) {
                alert('Server error');
            }
        })
    }
</script>

