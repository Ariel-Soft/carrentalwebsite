<?php
if(!empty($_POST)){
	$pickup = $_POST['pickup'];
	$locationId = $_POST['locationId'];
	$vehicl_id = $_POST['vehicl_id'];
	$dropoff = $_POST['dropoff'];
	$reservationId = $_POST['reservationId'];
	$droplocationId = $_POST['droplocationId'];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI//ModifyReservation");
	$curl_post_vehicledata  = "{\"ClientId\":\"6189\",\"UserEmail\":\"ahmed.fattoh2@rentcentric.com\",\"Password\":\"Rent45\",\"ReservationId\":\"$reservationId\",\"LocationID\":\"$locationId\",\"PickupLocation\":\"$locationId\",\"DropoffLocation\":\"$droplocationId\",\"PickupDate\":\"$pickup\",\"DropoffDate\":\"$dropoff\",\"VehicleTypeID\":\"$vehicl_id\",\"RateCodeID\":\"Sencillo\",\"InsuranceIDs\":[\"100\",\"101\"],\"TaxIDs":["38","40\"],\"MiscChargeIDs\":[\"1","2\"],\"Comment\":\"Test OnlineReservation Modify\",\"RateInfo\":{\"RateCodeID\":\"0\",\"HourlyRateQuantity\":\"0\",\"HourlyRateCharge\":\"0\",\"DailyRateQuantity\":\"0\",\"DailyRateCharge\":\"0\",\"ExtraDailyRateQuantity\":\"0\",\"ExtraDailyRateCharge\":\"0\",\"WeeklyRateQuantity\":\"0\",\"WeeklyRateCharge\":\"0\",\"MonthlyRateQuantity\":\"0\",\"MonthlyRateCharge\":\"0\",\"IncludedMileage\":\"0\",\"AdditionalMileageCharge\":\"0\",\"OneWayFee\":\"0\"}}";
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