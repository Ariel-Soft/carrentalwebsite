<?php
include("header.php");
$curAddons = $servicePortal->getAddon();
$curPlan = $servicePortal->getSubscription()->planId;
$allPlans = $servicePortal->retrieveAllPlans(); 
$allAddons = $servicePortal->retrieveAllAddons(); 
$planQuantity = $servicePortal->getSubscription()->planQuantity;
$planId = $servicePortal->getSubscription()->planId;
$currentTermEnd = $servicePortal->getSubscription()->currentTermEnd;
$currentTermStart = min($servicePortal->getSubscription()->currentTermStart, $servicePortal->getSubscription()->metaData['start_date']);
$havePaymentMethod = isset($servicePortal->getCustomer()->paymentMethod);

$allPlansIndexed = array();
$excludePlans = array("free-for-environments", "unlimited-for-offline-payment", "backand-internal-use");
foreach ($allPlans as $plan) {
    if ($plan->plan()->id == $servicePortal->getSubscription()->planId) {
        $planResult = $plan->plan();
    }
        if($plan->plan()->status == "archived" && $plan->plan()-> id != $servicePortal->getSubscription()->planId || in_array($plan->plan()->id, $excludePlans)){
            continue;
	}
    $allPlansIndexed[$plan->plan()->id] = $plan->plan();
    if ($settingconfigData["changesubscription"]["groupplan"] == 'false') {
        $nonGroupPlans[$plan->plan()->id] = $plan->plan()->period;
    } elseif ($plan->plan()->periodUnit == "week") {
        $weeklyPlans[$plan->plan()->id] = $plan->plan()->period;
        asort($weeklyPlans);
    } elseif ($plan->plan()->periodUnit == "month") {
        if ($plan->plan()->period == 6) {
            $halfYearlyPlans[$plan->plan()->id] = $plan->plan()->period;
        } elseif ($plan->plan()->period == 3) {
            $quarterYearlyPlans[$plan->plan()->id] = $plan->plan()->period;
        } else {
            $monthlyPlans[$plan->plan()->id] = $plan->plan()->period;
            asort($monthlyPlans);
        }
    } elseif ($plan->plan()->periodUnit == "year") {
        $yearlyPlans[$plan->plan()->id] = $plan->plan()->period;
        asort($yearlyPlans);
    }
}
$total = ($planResult->price * $servicePortal->getSubscription()->planQuantity);
if ( !$servicePortal->planAccessible($allPlans, $settingconfigData) ) { ?>
    <input id="onePlan" name="onePlan" type="hidden" class="form-control" value="1" > 
<?php } ?>

<div class="container" >
    <div id="cb-wrapper-ssp">
		<?php include("processing.php") ?>
        <div id="cb-user-content">
            <form id="form" method="post">
                <div class="cb-well">
                    <div class="cb-product">
                        <div class="cb-product-header">
                            <div class="cb-product-steps" data-cb="cb-product-steps">
                                <div class="cb-product-step current" data-cb-step-for="plan" 
                                    accesskey="" data-cb-current-step='current' id="step-plan">
                                    Change your plan
                                </div>
                                <?php if ( $servicePortal->addonAccessible($allAddons, $settingconfigData )) { ?>
                                    <div class="cb-product-step future" data-cb-step-for="addon" 
					data-cb-current-step='' id="step-addon">
                                        Add/Remove Addon(s)
                                    </div>
                                <?php } else { ?>                                    
                                    <input id="NoAddon" name="NoAddon" type="hidden" class="form-control" value="1" > 
                                <?php } ?>
                                <div class="cb-product-step future" data-cb-step-for="review" data-cb-current-step='' id="step-review">
                                    Review and Confirm
                                </div>
                            </div>
                        </div>
                        <div class="cb-product-body" data-cb="cb-product-body" data-cb-req-from="plan" id="changeYourPlan">
                            <div class="cb-product-box" id="subscriptionForm">
                                <div class="cb-product-title">
                                    Your Current Plan
                                </div>
                                <hr class="clearfix">
                                <div class="cb-product-list">
                                    <?php
                                    if (number_format($planResult->price / 100, 2, '.', '') == 0.00) {
                                        ?>
                                        <div class="row cb-product-item">
                                            <div class="col-xs-8"><?php echo esc(isset($planResult->invoiceName) ? $planResult->invoiceName : $planResult->name) ?></div>
                                            <div class="col-xs-4 text-right"></div>
                                        </div>
                                    <?php
                                    } else {
                                        ?>
                                        <div class="row cb-product-item">
                                            <div class="col-xs-8"><?php echo esc(isset($planResult->invoiceName) ? $planResult->invoiceName : $planResult->name) ?> </div>
                                            <div class="col-xs-4 text-right">
                                                <strong>
                                                    <?php echo $configData['currency_value'] . ' ' . number_format($total / 100, 2, '.', '') ?>
                                                </strong>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <?php if (isset($curAddons)) { ?>
                                <div class="cb-product-box">
                                    <div class="cb-product-title">
                                        Your Current Addon(s)
                                    </div>
                                    <hr class="clearfix">
                                    <?php
                                    foreach ($curAddons as $curaddon) {
                                        foreach ($allAddons as $addons) {
                                            if ($curaddon->id == $addons->addon()->id) {
                                                ?>
                                                <div class="cb-product-list">
                                                    <?php
                                                    if (($planResult->period != $addons->addon()->period) && ($planResult->periodUnit != $addons->addon()->periodUnit)) {
                                                        ?>
                                                        <input id="NoAddon" name="NoAddon" type="hidden" class="form-control" value="1" > 
                                                    <?php }
                                                    ?>
                                                    <div class="row cb-product-item">
                                                        <div class="col-xs-8"><?php echo esc($addons->addon()->invoiceName) ?>   ( <?php echo $configData['currency_value'] . number_format($addons->addon()->price / 100, 2, '.', '') ?> x <?php echo $curaddon->quantity ?> )</div>
                                                        <div class="col-xs-4 text-right">
															<strong><?php echo $configData['currency_value'] . number_format($addons->addon()->price / 100, 2, '.', '') ?>
															</strong>
														</div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            <?php } ?>

<!--                            <div class="page-header clearfix">
                                <span class="h3">Change your plan</span>
                            </div>
                            <p>You can choose from one of the available plans below.</p>                            -->
                            <?php
                            
                            if (isset($nonGroupPlans)) {   
                                $planList = $nonGroupPlans;
                                include("renderPlans.php");
                            }
                            if (isset($weeklyPlans)) {
                                $planList = $weeklyPlans;
                                include "renderPlans.php";
                            }
                            if (isset($monthlyPlans)) {
                                $planList = $monthlyPlans;
                                include "renderPlans.php";
                            }
                            if (isset($quarterYearlyPlans)) {
                                $planList = $quarterYearlyPlans;
                                include "renderPlans.php";
                            }
                            if (isset($halfYearlyPlans)) {
                                $planList = $halfYearlyPlans;
                                include "renderPlans.php";
                            }
                            if (isset($yearlyPlans)) {
                                $planList = $yearlyPlans;
                                include "renderPlans.php";
                            }
                            ?>
                            <span id="plan_id.err" class="text-danger">&nbsp;</span>
                            <span id="plan_quantity.err" class="text-danger">&nbsp;</span>
                            <hr class="clearfix">
                            <?php if($havePaymentMethod){ ?>
                                <p class="cb-step-nav clearfix">
                                    <a data-cb-next-link="cb-nav-next" class="cb-nav-next" id="next" onclick="savePlan()">Next</a>
                                </p>
                            <?php } ?>
                            <div class="clearfix">
                                <?php if($havePaymentMethod){ ?>
                                    <input type='button' data-cb="plan" class='btn btn-default' value="Save and Continue" id="continueSubscription" onclick="savePlan()">         
                                <?php 
                                } else { 
                                ?>
                                    <input type='button' data-cb="plan" class='btn btn-default' value="Add Payment Method" id="addpaymentmethod" onclick="goToPayment()">         
                                <?php } ?>    
                                <a class="btn btn-link" id="back" href=<?php echo getCancelURL($configData) ?>>Cancel</a>   
                            </div>
                        </div>

                        <div id="addons" >
                        </div>

                        <div class="cb-product-body" data-cb="cb-product-body" data-cb-req-from="review" id="review" style="display: none;" >
                            <div class="page-header clearfix">
                                <span class="h3">Review and Confirm</span>
                            </div>
                            <p>Review the details below and make sure you've selected the right plan. If you have any concerns or questions about the charges, please contact us at <a href="mailto:billing@backand.com">billing@backand.com</a> </p>
                            <div class="cb-product-box">
                                <div class="cb-product-title">
                                    Selected Plan
                                </div>
                                <div class="cb-product-list" id="selectedLineItems">
                                    <div class="row cb-product-item">
                                        <div class="col-xs-8" id="selectedPlanReview"></div>
                                        <div class="col-xs-4 text-right" id="selectedPlanAmount"><strong></strong></div>
                                    </div>
                                </div>
                                <div class="cb-product-title" id="ifAddonSelected" style="display: none;">
                                    Selected Addon(s)
                                </div>
                                <div class="cb-product-list" id="selectedAddon">
                                </div>
                                <div class="cb-product-total">
                                    <hr class="clearfix">
                                    <div class="cb-product-list">
                                        <div class="row cb-product-item cb-product-grand-total">
                                            <div class="col-xs-8 col-sm-9">Total
                                            </div>
                                            <div class="col-xs-4 col-sm-3 text-right" data-cb="grand-total" id="grand-total" ><strong></strong></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="text-center">
                                <div class="alert alert-info">
                                    <div class="media text-left">
                                        <span class="glyphicon glyphicon-info-sign pull-left"></span>
                                        <div class="media-body" id="subscriptionMessage"> 
                                            <?php
                                            if ($settingconfigData["subscription"]["immediately"] == 'false') {
//                                                $phrase = $infoconfigData['Messages_during_change_subscription']['Change_at_end_of_term'];
//                                                $default = array('$subscription.current_term_end', '$subscription.current_term_start');
//                                                $assign = array(gmdate('d-M-y',$currentTermEnd), gmdate('d-M-y', $currentTermStart));
//                                                $subscriptionMessage = str_replace($default, $assign, $phrase);
                                                ?>
                                                <input type="hidden" value="true" name="end_of_term" id="end_of_term" /> 

                                            <?php
                                            } else {
                                                $phrase = $infoconfigData['Messages_during_change_subscription']['Change_immediately'];
                                                $default = array('$subscription.current_term_end', '$subscription.current_term_start');
                                                $assign = array(gmdate('d-M-y', $currentTermEnd), gmdate('d-M-y', $currentTermStart));
                                                $subscriptionMessage = str_replace($default, $assign, $phrase);
                                                ?>
                                                <input type="hidden" value="false" name="end_of_term" id="end_of_term" />  
                                            <?php }
                                            ?>
                                        </div>
                                        <input type="hidden" value="<?php echo $subscriptionMessage ?>" name="submessge" id="submessge" /> 
                                    </div>
                                </div>
                            </div>
                            <hr class="clearfix">
                            <p class="cb-step-nav clearfix">
                                <a data-cb-prev-link="cb-nav-prev" class="cb-nav-prev" href="#" id="prev1" onclick="backAddon()">Prev</a>
                            </p>
                            <div class="clearfix">
                                <input type="button" data-cb="review" class="btn btn-primary" value="Change Subscription" id="changeSubscription">
                                <a class="btn btn-link" id="back2" href=<?php echo getCancelURL($configData) ?>>Cancel</a>
                            </div>
                        </div>



                        <div class="cb-product-body" data-cb="cb-product-body" data-cb-req-from="addon" style='display:none'></div>
                        <div class="cb-product-body" data-cb="cb-product-body" data-cb-req-from="review"></div>
                    </div>
                    <input type="hidden" id="data-cb-req-from" name="data-cb-req-from" value="" />
                    <input type="hidden" id="sub_id" name="sub_id" value="2102635" />
                    <input type="hidden" id="total_selected_addons" name="total_selected_addons" value="" />
                </div>
            </form>
        </div>
    </div>
</div>
    
<div>    
<?php 
    $usage = $servicePortal->retrieveUsage($configData);
                                    
    if (property_exists($usage, "appName")) {
        $nextBillingCycleDate = "";
        if (property_exists($usage->current, "nextBillingCycleDate")) {
            $nextBillingCycleDate = $usage->current->nextBillingCycleDate;
        }
?>
    
<div class="container" id="cd-usage">
    <div id="cb-wrapper-ssp">
        <div id="cb-user-usage">
            <div class="cb-well">
                <div class="cb-product">
                    <div class="cb-product-header">
                        <div class="cb-product-steps" data-cb="cb-product-steps">
                            <div class="cb-product-step current" data-cb-step-for="plan" 
                                accesskey="" data-cb-current-step='current' id="step-plan">
                                <b>Your Usage / Your Plan</b> <br>Next Billing Cycle:&nbsp;<?php echo date('d-M-Y', strtotime($nextBillingCycleDate)) ?>
                            </div>

                        </div>
                    </div>
                    <div class="cb-product-body" data-cb="cb-product-body" data-cb-req-from="plan" id="changeYourPlan">
                        <div class="row cb-product-item">
                            
                            <div class="col-usage col-border col-xs-auto">
                                <div class="col-title">
                                    Period
                                </div>
                                <?php
                                $currentStartDate = $usage->current->startDate;
                                $currentEndDate = (string)$usage->current->endDate;
        
                                ?>
                                <div class="col-body" style="box-shadow: 0 1px 0 black;">
                                    <?php echo date('d-M-Y', strtotime($currentStartDate)) ?>&nbsp;to&nbsp;<?php echo date('d-M-Y', strtotime($currentEndDate)) ?>
                                </div>
                                <?php
                                if (property_exists($usage, "prev")) {
                                    for($j = 0; $j < count($usage->prev); $j++) {
                                        $prevStartDate = $usage->prev[$j]->startDate;
                                        $prevEndDate = (string)$usage->prev[$j]->endDate;

                                       ?> 
                                    <div class="col-body">
                                        <?php echo date('d-M-Y', strtotime($prevStartDate)) ?>&nbsp;to&nbsp;<?php echo date('d-M-Y', strtotime($prevEndDate)) ?>

                                    </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            
                            <?php
                                for($i = 0; $i < count($usage->current->usage); $i++) {
                                    $currentAddon = $usage->current->usage[$i];
                                //foreach ($usage->current->usage as $addon) {
                                    $units = "";
                                    if ($currentAddon->units != null){
                                        $units = "(" . $currentAddon->units . ")";
                                    }
                                    ?>
                                    <div class="col-usage col-border col-xs-auto">
                                        <div class="col-title">
                                            <?php echo $currentAddon->addon ?>&nbsp;<?php echo $units ?>
                                        </div>
                                        <div class="col-body" style="box-shadow: 0 1px 0 black;">
                                            <span style="<?php echo ($currentAddon->usage > $currentAddon->threshold ? 'color:red' : '')?>"><?php echo (is_numeric($currentAddon->usage) ? number_format($currentAddon->usage,$currentAddon->round) : '--') ?></span>&nbsp;/&nbsp;
                                                <?php echo (is_numeric($currentAddon->threshold) ? number_format($currentAddon->threshold) : '--') ?>
                                        </div>
                                        <?php
                                        if (property_exists($usage, "prev")) {
                                            for($j = 0; $j < count($usage->prev); $j++) {
                                
                                                $prevAddon = $usage->prev[$j]->usage[$i];
                                               ?> 
                                            <div class="col-body">
                                                <span style="<?php echo ($prevAddon->usage > $prevAddon->threshold ? 'color:red' : '')?>"><?php echo (is_numeric($prevAddon->usage) ? number_format($prevAddon->usage,$prevAddon->round) : '--') ?></span>&nbsp;/&nbsp;
                                                    <?php echo (is_numeric($prevAddon->threshold) ? number_format($prevAddon->threshold) : '--') ?>
                                            </div>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </div>

                                <?php }
                            ?>
                       </div>
                    </div>
                    
                    <div class="cb-product-body" data-cb="cb-product-body" data-cb-req-from="addon" style='display:none'></div>
                    <div class="cb-product-body" data-cb="cb-product-body" data-cb-req-from="review"></div>
                </div>
                <input type="hidden" id="data-cb-req-from" name="data-cb-req-from" value="" />
                <input type="hidden" id="sub_id" name="sub_id" value="2102635" />
                <input type="hidden" id="total_selected_addons" name="total_selected_addons" value="" />
            </div>
            
        </div>
    </div>
</div>
    <?php } ?>
</div>      
<div class="container" >
    <div style="">    
        <img src="assets/images/pricing.png" style="width:100%">
    </div>
</div>    
<?php include("footer.php"); ?>
<script>
    var addonIdList = [];
    var addonQuantityList = [];
    var currencyValue = "<?php echo $configData['currency_value'] ?>";
    $(function () {
        var onePlan = $("#onePlan").val();
        if (onePlan === 1) {
            $('#step-plan').toggleClass('cb-product-step current cb-product-step past');
            $('#step-addon').toggleClass('cb-product-step future cb-product-step current');
            $('#changeYourPlan, #next').hide();
            $('#addons, #next1, #prev').show();
            saveAddon(false);
            return;
        }
        <?php if(!$havePaymentMethod){ ?>
        $("#cb-handle-progress .alert-danger").show();
        $("#cb-handle-progress .alert-danger .message").html("Payment method is missing: Before choosing a plan you must <a onclick='goToPayment(); return false;'>add a payment method</a>");
        <?php } ?>
        disableButtons();
        
        //init UI
        $("#selectedLineItems").html('');
        $("#grand-total").html('');
        $("#subscriptionMessage").html('');
        
    });
    function goToPayment() {
        window.location.href = "<?php echo getEditUrl("editCard.php", $configData) . "?loc=1" ?>";
    }
    function disableButtons(){
        var disabled = ($('input:radio[name=plan_id]:checked').val() === '<?php echo esc($planId) ?>');
        $('#continueSubscription').prop('disabled', disabled);
        $('#next').toggle(!disabled);
    }
    $('input:radio[name=plan_id]').click(function(){
        disableButtons(); 
    });
    
    function savePlan() {
        var planId = $('input:radio[name=plan_id]:checked').val();
        if (planId) {
            var price = $("span[data-plan-total-price='" + planId+"']").text();
            var planPrice = $("input[data-plan-price='" + planId +"']").val();
            var quantity = $("input[data-plan-quantity='" + planId+ "']").val();
            var replaceHtml = "";
            if ($("input[data-plan-quantity='" + planId+ "']").length > 0 ) {
                replaceHtml = toTitleCase(planId) + ' / ' + 'Month ' + '(' + currencyValue + ' ' + planPrice + ' x ' + quantity + ')';
            } else {
                replaceHtml = toTitleCase(planId);
            }
            var data = {plan_id: planId, plan_quantity: quantity };
            if ($("#NoAddon").val() === "1") {
                saveAddon(false);
                return;
            }
            $.ajax({
                type: 'POST',
                url: 'editAddon.php',
                data: data,
                contentType: "application/x-www-form-urlencoded;charset=utf-8",
                beforeSend: function(response){
                        $(".cb-alert-flash, .loader").show();
                },
                success: function (response) {
                    $('#addons').html(response);
                    $('#step-plan').toggleClass('cb-product-step current cb-product-step past');
                    $('#step-addon').toggleClass('cb-product-step future cb-product-step current');
                    $('#changeYourPlan, #next').hide();
                    $('#addons, #next1, #prev').show();
                    $('#cb-wrapper-ssp').css('min-height', '620px');
                    $('#selectedPlan').html(replaceHtml);
                    $('#selectedPrice').html(price);
                },
                error: function(response) {
                    $("span[id='plan.id.err']").text("Sorry, Something went wrong. Please try later. Err:" + response);
                },
                complete: function(response) {
                    $(".cb-alert-flash, .loader").hide();
                }
            });
        }
    }
    
    function saveAddon(withAddons) {
        addonIdList = [];
        addonQuantityList = [];
        if (!withAddons) {
            $('#step-plan').toggleClass('cb-product-step current cb-product-step past');
            $('#step-review').toggleClass('cb-product-step future cb-product-step current');
            $('#changeYourPlan, #next').hide();
        } else {
            $('#step-addon').toggleClass('cb-product-step current cb-product-step past');
            $('#step-review').toggleClass('cb-product-step future cb-product-step current');
        }
        $('#addons, #prev, #next1, #next, #cd-usage').hide();
        $('#prev1, #review').show();
        $('#cb-wrapper-ssp').css('min-height', '620px');
        
        var planRadioValue = $('input:radio[name=plan_id]:checked').val();
 
        var params = {action : "retrieveNewEstimate", planId: planRadioValue};
        AjaxCall('api.php', 'POST', 'json', $.param(params), saveEstimate);
    }
    
    function saveEstimate(result){
        
        var lineItems = '';
        result.data.lines.forEach(function(line){
            lineItems += '<div class="row cb-product-item">';
            lineItems += '<div class="col-xs-8" id="selectedPlanReview">' + line.description + '</div>';
            lineItems += '<div class="col-xs-4 text-right" id="selectedPlanAmount"><strong>$' + line.amount + '</strong></div>';
            lineItems += '</div>';
        })
        
        $("#selectedLineItems").html(lineItems);
        $("#grand-total").html("$" + result.data.total);
        
        var submessge = $("#submessge").val();
        var finalsubmessage = submessge.replace('$estimated_invoice.amount',currencyValue + result.data.lines[0].amount);
        $("#subscriptionMessage").html(finalsubmessage);

    }
    	
//    function saveAddon1(withAddons) {
//        addonIdList = [];
//        addonQuantityList = [];
//        if (!withAddons) {
//            $('#step-plan').toggleClass('cb-product-step current cb-product-step past');
//            $('#step-review').toggleClass('cb-product-step future cb-product-step current');
//            $('#changeYourPlan, #next').hide();
//        } else {
//            $('#step-addon').toggleClass('cb-product-step current cb-product-step past');
//            $('#step-review').toggleClass('cb-product-step future cb-product-step current');
//        }
//        $('#addons, #prev, #next1, #next').hide();
//        $('#prev1, #review').show();
//        $('#cb-wrapper-ssp').css('min-height', '620px');
//
//        var addonRadioValue = $('input[name=addons]:checked').val();
//        var planRadioValue = $('input:radio[name=plan_id]:checked').val();
//        var planPrice = $("span[data-plan-total-price='" + planRadioValue + "']").text();
//        var planActualPrice = $("input[data-plan-price='" + planRadioValue + "']").val();
//        var planQuantity = $("input[data-plan-quantity='" + planRadioValue + "']").val();
//
//        var addonActualPrice = $("span[data-addon-total-price='" +addonRadioValue+"']").val();
//        var addonQuantity = $("input[data-addon-quantity='" + addonRadioValue +"']").val();
//
//        var submessge = $("#submessge").val();
//
//        if (planActualPrice === '0.00') {
//            var planReplaceHtml = toTitleCase(planRadioValue);
//        } else {
//            if (typeof planQuantity === 'undefined') {
//                var planReplaceHtml = toTitleCase(planRadioValue) + ' / ' + 'Month ' + '(' + planActualPrice + ')';
//            } else {
//                var planReplaceHtml = toTitleCase(planRadioValue) + ' / ' + 'Month ' + '(' + currencyValue + ' ' + planActualPrice + ' x ' + planQuantity + ')';
//            }
//        }
//        var planReplaceHtml = "itay test";
//        var finalTotal = planPrice;
//        if (addonRadioValue) {
//            var addonName = '';
//            var addonReplaceHtml = '';
//            var emptytext = '';
//            var addonPricetot = 0;
//            var container = $("#selectedAddon");
//            $('#selectedAddon').html(emptytext);
//            $('#selectedAddonAmount').html(emptytext);
//            $("input[name=addons]:checked").each(function () {
//                var addonRadioValue = $(this).val();
//                var addonProductPrice = $("input[data-addon-price='" + addonRadioValue + "']").val();
//                var addonQty = $("input[data-addon-quantity='" + addonRadioValue +"']").val();
//                var addonName = $("input[data-addon-name='" + addonRadioValue +"']").val();
//                addonIdList.push(addonRadioValue);
//                addonQuantityList.push(addonQty);
//                if (typeof addonQty === 'undefined') {
//                    addonReplaceHtml = addonName + ' - ' + '(' + currencyValue + ' ' + addonProductPrice + '  )';
//                } else {
//                    addonReplaceHtml = addonName + ' - ' + '(' + currencyValue + ' ' + addonProductPrice + ' x ' + addonQty + '  )';
//                }
//				var addonPrice = (addonProductPrice * (addonQty == null ? 1 : addonQty));
//                container.append('<div class="row cb-product-item"> <div class="col-xs-8">'+addonReplaceHtml+'</div> <div class="col-xs-4 text-right">'+ currencyValue + ' ' + addonPrice.toFixed(2) + '</div></div>');
//				addonPricetot += addonPrice;
//            });
//            $('#ifAddonSelected').show();
//            $('#selectedPlanReview').html(planReplaceHtml);
//            $('#selectedPlanAmount').html(planPrice);
//            var planSplit = planPrice.split(" ");
//            var grandTotal = ((planActualPrice * (planQuantity == null ? 1 : planQuantity)) + addonPricetot).toFixed(2);
//            var finalTotal = currencyValue.concat(" ").concat(grandTotal);
//            finalsubmessage = submessge + finalTotal + '.';
//            $("#grand-total, #grandTotal-body").html(finalTotal);
//            $("#subscriptionMessage").html(finalsubmessage);
//        }
////        if (planRadioValue) {
////            $('#selectedPlanReview').html(planReplaceHtml);
////            $('#selectedPlanAmount').html(planPrice);
////            $("#grand-total, #grandTotal-body").html(finalTotal);
////            finalsubmessage = submessge + finalTotal + '.';
////            $("#subscriptionMessage").html(finalsubmessage);
////        }
//    }
    function backPlan(withAddons) {
        if (withAddons) {
            $('#step-plan').toggleClass('cb-product-step current cb-product-step future');
            $('#step-addon').toggleClass('cb-product-step past cb-product-step current');
            $('#step-review').toggleClass('cb-product-step current cb-product-step future');
            $('#review, #prev1').hide();
            $('#addons, #next1, #prev').show();
        } else {
            $('#step-plan').toggleClass('cb-product-step past cb-product-step current');
            $('#step-addon').toggleClass('cb-product-step current cb-product-step future');
            $('#step-review').toggleClass('cb-product-step current cb-product-step future');
            $('#addons, #review, #prev, #next1, #next').hide();
            $('#changeYourPlan, #next, #cd-usage').show();
        }
        addonIdList = [];
        addonQuantityList = [];
        
        $("#selectedLineItems").html('');
        $("#grand-total").html('');
        $("#subscriptionMessage").html('');
    }
	
    function backAddon() {
        if ($("#NoAddon").val() === "1") {
            backPlan(false);
            return;
        }
        $('#step-addon').toggleClass('cb-product-step past cb-product-step current');
        $('#step-review').toggleClass('cb-product-step current cb-product-step future');
        $('#review, #prev1').hide();
        $('#addons, #next1, #prev').show();
        $('#cb-wrapper-ssp').css('min-height', '620px');
    }
	
    /*
     * On selecting the plan enables the plan quantity for the user to change the quantity.
     */
    $("input[name=plan_id]:radio").on('change', function () {
        var selector = $("input[name=plan_id]:radio:checked");
        $(selector).attr("checked");
        var res = $(selector).val();
        $('input[name=plan_quantity]').attr('disabled', true);
        $("input[data-plan-quantity='"+ res +"']").removeAttr('disabled');
    });

     function onAddonClick(element){
        var addonId = $(element).attr("data-addon-id");
        if($(element).is(":checked")){
                $("input[data-addon-quantity='"+ addonId +"']").removeAttr('disabled');
        } else {
                $("input[data-addon-quantity='"+ addonId +"']").attr("disabled", "true");
        }
     }

    /**
	 * On change quantity in plan, plan price is updated.
	 */
    function planQuantityChange(planId) {
        var planPrice = $("input[data-plan-price='"+ planId +"']").val();
        var quantity = $("input[data-plan-quantity='" + planId + "']").val();
        var tot = planPrice * quantity;
        var total = tot.toFixed(2);
        $("span[data-plan-total-price='"+ planId +"']").text(total);
    }

    /**
	 * On change quantity in addon, addon price is updated.
	 */
    function addonQuantityChange(addonId) {
        var productPrice = $("input[data-addon-price='" + addonId + "']").val();
        var price = $("span[data-addon-total-price='" + addonId + "']").text();
        var dropQty = $("input[data-addon-quantity='" + addonId + "']").val();
        var tot = productPrice * dropQty;
        var tot = tot.toFixed(2);
        $("span[data-addon-total-price='" + addonId + "']").text(tot);
    }

    function toTitleCase(str) {
        return str.replace(/(?:^|\s)\w/g, function (match) {
            return match.toUpperCase();
        });
    }
	
	/**
	 * On click Change Subscription button, sends Ajax request to update the subscription.
	 */
    $('#changeSubscription').click(function () {
        var planId = $('input[name=plan_id]:checked').val();
		var planQuantity = 1;
		
        if ($("input[data-plan-quantity='" + planId + "']").length > 0) {
            var planQuantity = $("input[data-plan-quantity='" + planId + "']").val();
        } 

        var endOfTerm = $("#end_of_term").val();
        var addons = {};
        for (i = 0; i < addonIdList.length; i++) {
            var addonId = addonIdList[i];
            var addonQuantity = addonQuantityList[i];
            addons[i] = {id:addonId, quantity:addonQuantity};
        }
		
        var params = {action : "updateSubscription", planId: planId, planQuantity: planQuantity, addons: addons, endOfTerm: endOfTerm };
        AjaxCallMessage('api.php', 'POST', 'json', $.param(params), 'editsubscription');
    });
</script>


















