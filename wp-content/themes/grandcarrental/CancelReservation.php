<?php 
if(!empty($_POST)){
	$reason = $_POST['reason'];
	$reservationId = $_POST['reservationId'];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI//CancelReservation");
	$curl_post_vehicledata  = "{\"ClientId\":\"5830\",\"UserEmail\":\"selfservice@rentcentric.com\",\"Password\":\"Mahmoud777\",\"ReservationId\":\"$reservationId\",\"IsCancelled\":\"No\",\"CancelReason\":\"$reason\"}";
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
		echo"Success";
	}
}

?>