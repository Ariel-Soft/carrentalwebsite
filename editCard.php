<?php 
include("init.php");
$urlReturn = "";

if(isset($_GET['loc'])){
    if(filter_input(INPUT_GET,'loc') == "1"){
        $urlReturn = "/upgrade";
    }
}
    
$result = ChargeBee_HostedPage::updatePaymentMethod(array(
    "redirect_url" => $configData["BACKAND_BILLING_URL"] . $servicePortal->getAppName() . "/billing" . $urlReturn, //getReturnURL(),
    "cancel_url" => $configData["BACKAND_BILLING_URL"] . $servicePortal->getAppName() . "/billing" . $urlReturn, //getReturnURL(),
    //"iframe_messaging" => true,
    array("customer" => array("id" => $servicePortal->getCustomer()->id))
));

header('Location: ' . $result->hostedPage()->url);
?>
