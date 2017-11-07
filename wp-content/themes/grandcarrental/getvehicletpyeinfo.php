<?php 
$processed = FALSE;
$ERROR_MESSAGE = '';
$droploc = $_POST['droploc'];
$dropoffdate = $_POST['dropoffdate'];
$timer1 = $_POST['timer1'];
$timer2 = $_POST['timer2'];
$pickupdate = $_POST['pickupdate'];
$aa = $_POST['eid'];
$myl = $_POST['pwd'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/GetVehicleTypes");
$curl_post_data2  = "{\"ClientId\":\"6189\",\"UserEmail\":\"ahmed.fattoh2@rentcentric.com\",\"Password\":\"Rent45\",\"PickupDate\":\"$pickupdate\",\"PickupLocation\":\"$myl\",\"PickupTime\":\"$timer1\",\"DropOffDate\":\"$dropoffdate\",\"DropOffLocation\":\"$droploc\",\"DropOffTime\":\"$timer1\"}";
curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","content-type: application/json; charset=utf-8"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data2);
$result2 = curl_exec($ch);
$err = curl_error($ch);
$arr = json_decode($result2);
if(!empty($arr->VehicleTypes) ){
	$openarry = array();
	foreach ($arr->VehicleTypes as $item) {
		if($item->VehicleTypeid == $aa){
			$openarry['VehicleTypeid']= $item->VehicleTypeid; 
			$openarry['VehicleImage']= $item->VehicleTypeImage; 
			$openarry['VehicleTypeName']= $item->VehicleTypeName;
			$openarry['NumberOfSeats']= $item->NumberOfSeats;
			$openarry['NumberOfDoors']= $item->NumberOfDoors;
			$openarry['lugg']= $item->NumberOfBagsSmall+$item->NumberOfBagsLarge ;
		}
	}
 	$jsonresult = json_encode($openarry);
	print_r($jsonresult);
}	
?>