<?php
//echo"<pre>";print_r($_POST);die();
$processed = FALSE;
$ERROR_MESSAGE = '';
$vehtypeid= $_POST['vehid'];
$timer1= $_POST['timer1'];
$timer2= $_POST['timer2'];
$checkvtype = $_POST['vehtype'];
$vehpiclocname= $_POST['vehploc'];
$vehpdate = $_POST['vehpdate'];
//$vehtpdte = explode(" ",$vehpdate);
$vehtypdroploc = $_POST['vehdloc'];
$vehtypdpdate = $_POST['vehddate'];
//$vehdrpdte =explode (" ",$vehtypdpdate);

	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/GetVehicleTypes");
	

	$curl_post_vehicledata  = "{\"ClientId\":\"6189\",\"UserEmail\":\"ahmed.fattoh2@rentcentric.com\",\"Password\":\"Rent45\",\"PickupDate\":\"$vehpdate\",\"PickupLocation\":\"$vehpiclocname\",\"PickupTime\":\"$timer1 \",\"DropOffDate\":\"$vehtypdpdate\",\"DropOffLocation\":\"$vehtypdroploc\",\"DropOffTime\":\"$timer2\"}";
	
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","content-type: application/json; charset=utf-8"));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_vehicledata);
	$record1s = curl_exec($ch);
	$err = curl_error($ch);
	if ($err) {
	    echo "cURL Error #:" . $err;
	} else {
		$arrnew = json_decode($record1s);

		$specific= array();
		foreach ($arrnew->VehicleTypes as $item) {
			if($item->VehicleTypeid == $vehtypeid){
				$specific['VehicleTypeID'] = $item->VehicleTypeid;
				$specific['Description']=$item->VehicleTypeName;
				$specific['vehtypeimg']= $item->VehicleTypeImage;
				$specific['noofpassengers']= $item->NumberOfSeats;
				$specific['NumberOfDoors']= $item->NumberOfSeats;
				$specific['Luggages']= ($item->NumberOfBagsSmall + $item->NumberOfBagsLarge);
			}
		}
		$jsonresult = json_encode($specific);
		print_r($jsonresult);
	}