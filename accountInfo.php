<div class="form-horizontal">
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <label class="col-xs-5 control-label">First Name
                    </label>
                    <div class="col-xs-7 form-control-static">
                        <b><?php echo (isset($customer->firstName) ? esc($customer->firstName) : "") ?></b>
                    </div>
                </div>
            </div>
             <div class="col-sm-6">
                    <div class="row">
                        <label class="col-xs-5 control-label">Last Name
                        </label>
                        <div class="col-xs-7 form-control-static">
                            <b><?php echo (isset($customer->lastName) ? esc($customer->lastName) : "") ?></b>
                        </div>
                    </div>
             </div>
        </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="row">
                <label class="col-xs-5 control-label">Email
                </label>
                <div class="col-xs-7 form-control-static">
                    <b><?php echo esc($customer->email) ?></b>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
                <div class="row">
                    <label class="col-xs-5 control-label">Company
                    </label>
                    <div class="col-xs-7 form-control-static">
                        <b><?php echo (isset($customer->company) ?  esc($customer->company) : "") ?></b>
                    </div>
                </div>
        </div>
    </div>
    <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <label class="col-xs-5 control-label">Phone
                    </label>
                    <div class="col-xs-7 form-control-static">
                        <b><?php echo (isset($customer->phone) ? esc($customer->phone) : "") ?></b>
                    </div>
                </div>
            </div>
     </div>
</div>