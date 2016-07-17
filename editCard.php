<?php 
include("init.php");
$redirect_url = $configData["BACKAND_BILLING_URL"] . $servicePortal->getAppName() . "/billing";
$cancel_url = $configData["BACKAND_BILLING_URL"] . $servicePortal->getAppName() . "/billing";
$embed = true;

if(isset($_GET['loc'])){
    if(filter_input(INPUT_GET,'loc') == "1"){
        $redirect_url = $redirect_url ."/upgrade";
        $cancel_url = $redirect_url . "/upgrade";
    } else if (filter_input(INPUT_GET,'loc') == "2") {
        $redirect_url = $configData["BACKAND_APPS_URL"];
        $cancel_url = $configData["BACKAND_APPS_URL"];
        $embed = true;
    }
}
    
$result = ChargeBee_HostedPage::updatePaymentMethod(array(
    "redirect_url" => $redirect_url, //getReturnURL(),
    "cancel_url" => $cancel_url, //getReturnURL(),
    "embed" => $embed,
    //"iframe_messaging" => true,
    array("customer" => array("id" => $servicePortal->getCustomer()->id))
));

header('Location: ' . $result->hostedPage()->url);
?>
