<?php
$processed = FALSE;
$ERROR_MESSAGE = '';
$vehnam = $_POST['vehname'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/GetVehicleTypes");
$curl_post_data2  = "{\"ClientId\":\"6189\",\"UserEmail\":\"ahmed.fattoh2@rentcentric.com\",\"Password\":\"Rent45\",\"PickupDate\":\"7/27/2017\",\"PickupLocation\":\"$vehnam\",\"PickupTime\":\"12:00 PM\",\"DropOffDate\":\"7/27/2017\",\"DropOffLocation\":\"Bloor Street\",\"DropOffTime\":\"12:00 PM\"}";
curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","content-type: application/json; charset=utf-8"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data2);
$result2 = curl_exec($ch);
$err = curl_error($ch);
$arr = json_decode($result2);
if(!empty($arr->VehicleTypes)){
?>
<ul>
	<li id="sel0" >  <a onclick="passvehicletype(this.getAttribute('data-q_id'));" href="javascript:void(0)" title="" data-q_id="0"> <span class="vehicle_name"> All Vehicles </span> <span> <img src="http://carrentalwebsite.biz/wp-content/uploads/2017/08/2016-toyota-sienna-se-8-passenger-minivan-side-view.png" alt="Car Image"></span> </a> </li>
<?php 
	foreach ($arr->VehicleTypes as $item) {
?>
		<li id="sel<?php  echo $item->VehicleTypeid; ?>"> <a onclick="passvehicletype(this.getAttribute('data-q_id'));" href="javascript:void(0)" title="" data-q_id="<?php echo $item->VehicleTypeid; ?>"  >  <span class="vehicle_name"><?php echo $item->VehicleTypeName; ?> </span> <span> <img src="<?php echo "//".$item->VehicleTypeImage; ?>" alt="Car Image"></span> </a> </li>
<?php
	}
} else { echo "No vehicle type available here"; }
?>