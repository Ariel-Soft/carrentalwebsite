<?php
/**
 * Template Name: Car List Right Sidebar(R4)
 * The main template file for display car page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
if(!is_null($post)){
	$page_obj = get_page($post->ID);
}
$current_page_id = '';
/**
*	Get current page id
**/
if(!is_null($post) && isset($page_obj->ID)){
    $current_page_id = $page_obj->ID;
}
$grandcarrental_homepage_style = grandcarrental_get_homepage_style();
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);
if(empty($page_sidebar)){
	$page_sidebar = 'Page Sidebar';
}
get_header();
?>
<link href="http://carrentalwebsite.biz/wp-content/themes/grandcarrental/css/bootstrap.css" rel="stylesheet" /><link href="http://carrentalwebsite.biz/wp-content/themes/grandcarrental/css/datepicker.css" rel="stylesheet" /><?php
$grandcarrental_page_content_class = grandcarrental_get_page_content_class();
get_template_part("/templates/template-header");
$wp_query = grandcarrental_get_wp_query();
$current_photo_count = $wp_query->post_count;
$all_photo_count = $wp_query->found_posts;
$processed = FALSE;
$ERROR_MESSAGE = '';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/GetLocations");
$curl_post_data1  = "{\"ClientId\":\"5830\",\"UserEmail\":\"selfservice@rentcentric.com\",\"Password\":\"Mahmoud777\"}";
curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","content-type: application/json; charset=utf-8"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data1);
$result = curl_exec($ch);
$err = curl_error($ch);
if ($err) {
  echo "cURL Error #:" . $err;
} else {
   $json = json_decode($result);
}	
if(isset($_GET)){
	$picklocation = $_GET['PickUpLocation'];
	$droplocation= $_GET['DropOffLocation'];			
	$date1 = date_create($_GET['vehpdate'].$_GET['timer1']);
	$pickupdate = date_format($date1, 'l, jS F Y \a\t g:ia');				 
	$date1pass = $_GET['vehpdate'];
	$date2 = date_create($_GET['vehddate'].$_GET['timer2']);	
	$date2pass = $_GET['vehddate'];				
	$dropdate =  date_format($date2, 'l, jS F Y \a\t g:ia');				
	$vehicletype = $_GET['VehicleType'];
	if($vehicletype == ""){ 
		$vehicletype = 101;
	}				
	$var = 0;
}
if( isset($_GET['typeloca']) && $picklocation == "" ){
	$picklocation = $_GET['typeloca'];
}
if( isset($_GET['typedrploc']) && $droplocation == "" ){
	$droplocation = $_GET['typedrploc'];
	$pickupdate = 	$_GET['typedate1'];			
	$dropdate = $_GET['typedate2'] ;				
	$vehicletype= $_GET['typevhetype'];				
}
if($picklocation != ""){
	foreach ($json->LocationData as $item) {
		if($item->LocationID == $picklocation ){
			$picklocationname =  $item->LocationName;
		}
		if($item->LocationID == $droplocation ){
			$drplocationname =  $item->LocationName;
		}				   
	}
}	
?>
    
<div class="inner">
	<div class="tab_div">

	<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation"><a href="http://carrentalwebsite.biz/test/" aria-controls="home" role="tab" data-toggle="tab">1 Pick up</a></li>
			<li role="presentation" ><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">2 Select Vehicle</a></li>
			<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">3 Rental Option</a></li>
			<li role="presentation" class="active"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">4 Your Information</a></li>
		</ul> 
  
		<div class="modal fade" id="pickup_Modify_popup" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Modify Pick Up Date</h4>
					</div>
					<div class="modal-body">
						<div class='input-group date' id='pickup_Mdatepicker'>
							<input type='text' class="form-control" name="modify_date_timepicker_value" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span> 
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default updateDate">Update</button>
					</div>
				</div>
				  
			</div>
		</div>
			
		<div class="modal fade" id="dropoff_Modify_popup" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Modify Drop off Date</h4>
					</div>
					<div class="modal-body">
						<div class='input-group' id='dropOff_Mdatepicker'>
							<input type='text' class="form-control" name="modify_timepicker_value" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span> 
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default UpdateModifyDate">Update</button>
					</div>
				</div>  
			</div>
		</div>
 
		
		<div role="tabpanel" class="tab-pane" id="settings">	
			<div class="">
				<div class="row">
					<div class="col-sm-3">
						<div class="tab_text ">
							<h5> Pick-Up </h5>
							<p> 
								<span id="lblPickupLocation" style="font-weight:bold;"><?php 
								if($picklocation == ""){
								?>
									34534
						<?php   } else { echo $picklocationname; } ?></span>
							</p>
							<span id="LblPickupDateTime">	<?php if($pickupdate =="") { ?> Tuesday, 18 July 2017 at 12:00 PM <?php } else { echo $pickupdate; } ?></span>
						</div>
						<div class="pickup_modify">
							<a href="#" data-toggle="modal" data-target="#pickup_Modify_popup">Modify</a>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="tab_text">
							<h5> Return </h5>
							<p> 
								<span id="lblReturnLocation" style="font-weight:bold;"><?php if($droplocation == ""){
							?>
								Dundas Square
					<?php 	} else { echo $drplocationname; } ?></span>
							</p>
							<span id="lblReturnDateTime"><?php if($dropdate =="" ){ ?>Wednesday, 19 July 2017 at 12:00 PM <?php } else { echo $dropdate; } ?></span>
						</div>
						  
						
						<div class="dropof_modify">
							<a href="#" data-toggle="modal" data-target="#dropoff_Modify_popup">Modify</a>
						</div> 
					</div>
				</div>
			</div>
			<div class="rental_div">
				<div class="row">
					<div class="col-sm-6 col-xs-6">					
						<img class="chgnowimg" src="" alt="">
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="lexus_div">
				<input type="hidden" name="vehicl_id" class="getvehidnow" /> 
				<h2>Lexus LS 460</h2>
				<div class="border_top passengers">
					<div class="row">
						<div class="col-md-9 col-sm-12 col-xs-12">
							<div class="row">
								<div class="col-sm-3 col-xs-6 v_passengers">
									<div class="lexus_icon ">
										<img src="<?php echo get_template_directory_uri(); ?>/images/user_icon.jpg" alt="">
										<span>5 Passengers</span>
									</div>
								</div>
								<div class="col-sm-3 col-xs-6 v_lugss">
									<div class="lexus_icon">
										<img src="<?php echo get_template_directory_uri(); ?>/images/bag_icon.jpg" alt="">
										<span>4 Luggages</span>
									</div>
								</div>
								<div class="col-sm-3 col-xs-6 v_doors">
									<div class="lexus_icon lexus_icon2 ">
										<img src="<?php echo get_template_directory_uri(); ?>/images/car_cion.png" alt="">
										<span>4 Doors</span>
									</div>
								</div>
							</div>
						</div>				
					</div>
				</div>
			</div>
			<div id="infoid">
				<div class="table_div border_top">
					<table class="table">
							<tbody>
								<tr>
									<td><h4>Base Rate</h4></td>
									<td><h4><input type="hidden" name="baserate1" value="0.00" /><span id="baserate1">$ 15.00</span></h4></td>
								</tr>
								<tr>
									<td><h4>Rental Options</h4></td>
									
									<td><h4><input type="hidden" name="rentalopt" value="0.00" /> <span>$ </span><span id="rentaloption1">0.00</span></h4></td>
								</tr>
								<!--tr><td><h4>Total</h4></td><td><h4><span>$ </span><span id="totbaserent1">15.00</span></h4></td>
								</tr-->
								<tr>
									<td><h4><b>Taxes</b></h4></td>
									
								</tr>
								<tr>
									<tr>
									<td><h4>IVA @ 16%</h4></td>
									
									<td><h4><span>$ </span><span id="taxsc1"></span></h4></td>
								</tr>
									
								<tr>
									<td><h4>Total</h4></td>
									<td><h4><span>$ </span><span id="total_ca1">23.35</span></h4></td>
								</tr>
							</tbody>
						</table>					
				</div>
				<div class="your_info">
					<h2>Your Information</h2>
					<div class="info_form">
						<form id="youcardauth" action=""  method="post">
						<input type="hidden" id="pickuplocation_inpt" name="pickuplocationinput" value="<?php echo $picklocationname; ?>" />
						<input type="hidden" id="array_of_rateInfo" name="array_of_rateInfo" value="" />
						<input type="hidden" id="droplocation_input" name="droplocationinput" value="<?php echo $droplocation ; ?>" />
						<input type="hidden" id="pickdate_input" name="pickdateinput" value="<?php echo $date1pass; ?>" />
						<input type="hidden" id="dropoff_date" name="dropoffdate"  value="<?php echo $date2pass ; ?>" />
						<input type="hidden" id="locationid_input" name="locationidinput" value="<?php echo $picklocation; ?>" />
						<input type="hidden" id="vehicletypeid_input" name="vehicletypeidinput" value="" />							
						<input type="hidden" id="dailyrate_charge" name="dailyratecharge" />
						<input type="hidden" id="rentalrate_charge" name="rentalratecharge" />
						<div class="form-group">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-3">
									<label for="exampleInputEmail1">First Name</label>
								</div>
								<div class="col-md-10 col-sm-9 col-xs-9">
									<input type="text" class="form-control req alfa" id="" name="infor_fname" placeholder="">
								</div>
							</div>						
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-3">
									<label for="exampleInputEmail1">Last Name</label>
								</div>
								<div class="col-md-10 col-sm-9 col-xs-9">
									<input type="text" class="form-control req alfa" name="infor_lname"  id="" placeholder="">
								</div>
							</div>						
						</div>	
						<div class="form-group">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-3">
									<label for="exampleInputEmail1">Email</label>
								</div>
								<div class="col-md-10 col-sm-9 col-xs-9">
									<input type="text" class="form-control req email" name="infor_email" id="" placeholder="">
								</div>
							</div>						
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-3">
									<label for="exampleInputEmail1">Phone</label>
								</div>
								<div class="col-md-10 col-sm-9 col-xs-9">
									<input type="text" class="form-control req phone" id="" name="infor_phone" placeholder="">
								</div>
							</div>						
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-3">
									<label for="exampleInputEmail1">Date of Birth</label>
								</div>
								<div class="col-md-10 col-sm-9 col-xs-9">
									<div class='input-group date' id='infrdatetimepicker2'>
										<input type='text' class="form-control req" name="infor_dateofbirth" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>						
						</div>
								
						<div class="form-group">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-3">
									<label for="exampleInputEmail1">Driver License Number</label>
								</div>
								<div class="col-md-10 col-sm-9 col-xs-9">
									<input type="text" class="form-control req" id="" name="infr_drlicensenumber" placeholder="">
								</div>
							</div>						
						</div>
								
						<div class="form-group">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-3">
									<label for="exampleInputEmail1">Driver's License Exp.</label>
								</div>
								<div class="col-md-10 col-sm-9 col-xs-9">
									<div class='input-group date' id='infodatetimepicker2'>
										<input type='text' class="form-control req" name="infor_liceexp" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>						
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-3">
									<label for="exampleInputEmail1">Driver's License State</label>
								</div>
								<div class="col-md-10 col-sm-9 col-xs-9">
									<select class="form-control" name="drivelicestate">
										<option value="-1">Ontario</option>
										<option value="AL">Alabama</option>
										<option value="AK">Alaska</option>
										<option value="AS">American Samoa</option>
										<option value="AZ">Arizona</option>
										<option value="AR">Arkansas</option>
										<option value="AF">Armed Forces Africa</option>
										<option value="AC">Armed Forces Canada</option>
										<option value="AE">Armed Forces Europe</option>
										<option value="Bogotá DC">Bogotá</option>
										<option value="BC">British Columbia</option>
										<option value="CA">California</option>
										<option value="CO">Colorado</option>
										<option value="CT">Connecticut</option>
									</select>
								</div>
							</div>						
						</div>						
					</div>
				</div>
			<!-- Form section 1 end here ===================================================== -->
					
			<!-- Form section 2 start here ===================================================== -->

			<div class="your_info credit_info">
				<h2 class="credit_hd">Credit Card & Billing Information</h2>
				<div class="info_form">
					
						<div class="form-group">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-3">
									<label for="exampleInputEmail1">Card Holder</label>
								</div>
								<div class="col-md-10 col-sm-9 col-xs-9">
									<input type="text" class="form-control req alfa" name="cardholder" id="" placeholder="">
								</div>
							</div>						
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-3">
									<label for="exampleInputEmail1">Exp. Date</label>
								</div>
								<div class="col-md-5 col-sm-5 col-xs-9">
									<select class="form-control req" name="expmonth">
										<option value=""></option>
										<option value="01">January</option>
										<option value="02">February</option>
										<option value="03">March</option>
										<option value="04">April</option>
										<option value="05">May</option>
										<option value="06">June</option>
										<option value="07">July</option>
										<option value="08">August</option>
										<option value="09">September</option>
										<option value="10">October</option>
										<option value="11">November</option>
										<option value="12">December</option>
									</select>
								</div>
								<div class="col-md-5 col-sm-4 col-sm-offset-0 col-xs-9 col-xs-offset-3">
									<select class="form-control req" name="expyear" >
										<option value=""></option>
										<option value="2012">2012</option>
										<option value="2013">2013</option>
										<option value="2014">2014</option>
										<option value="2015">2015</option>
										<option value="2016">2016</option>
										<option value="2016">2017</option>
										<option value="2016">2018</option>
										<option value="2016">2019</option>
										<option value="2016">2020</option>
									</select>
								</div>
							</div>						
						</div>	
						<div class="form-group">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-3">
									<label for="exampleInputEmail1">Credit Card Type</label>
								</div>
								<div class="col-md-10 col-sm-9 col-xs-9">
									<select class="form-control req" name="credittype" >
										<option value=""></option>
										<option value="">Visa</option>
										<option value="">Amex</option>
										<option value="">Master Card</option>
										
									</select>
								</div>
							</div>						
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-3">
									<label for="exampleInputEmail1">Credit Card Number</label>
								</div>
								<div class="col-md-10 col-sm-9 col-xs-9">
									<input type="text" class="form-control intval req" id="" name="creditcarnumber" placeholder="">
								</div>
							</div>						
						</div>
						
						<div class="form-group">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-3">
									<label for="exampleInputEmail1">Special Request/Local Information</label>
								</div>
								<div class="col-md-10 col-sm-9 col-xs-9">
									<textarea class="form-control" name="specialreq_local" rows="3"></textarea>
								</div>
							</div>						
						</div>
						
						<div class="form-group">
							<div class="row">
								<div class="col-md-2 col-sm-3 col-xs-3">
									<label for="exampleInputEmail1">Special <br />Request</label>
								</div>
								<div class="col-md-10 col-sm-9 col-xs-9">
									<textarea class="form-control" name="specialreq" rows="3"></textarea>
								</div>
							</div>						
						</div>
						
						<div class="final_div">
							<p>A major Credit Card is required to make an online reservation and secure the rental. Debit cards are not accepted, except for final Payment. For more details please read our rental policy.</p>
							 <div class="checkbox">
								<label>
									<input type="checkbox" required class="req" > I have read and accept the rental policy 
								</label>
							</div>
						</div>
					
				</div>
			</div>

			<!-- Form section 2 end here ===================================================== -->

			<!-- Form section 3 start here ===================================================== -->
					<div class="your_info form_sec3">
						<h2 class="credit_hd">Additional Driver 1 (Optional)</h2>
						<div class="info_form">
							
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 col-sm-3 col-xs-3">
											<label for="exampleInputEmail1">First Name</label>
										</div>
										<div class="col-md-5 col-sm-5 col-xs-5">
											<input type="text" class="form-control" name="additionaldrivefname" id="" placeholder="">
										</div>
									</div>						
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 col-sm-3 col-xs-3">
											<label for="exampleInputEmail1">Last Name</label>
										</div>
										<div class="col-md-5 col-sm-5 col-xs-5">
											<input type="text" class="form-control"  name="additionaldrivelname" id="" placeholder="">
										</div>
									</div>						
								</div>	
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 col-sm-3 col-xs-3">
											<label for="exampleInputEmail1">Email</label>
										</div>
										<div class="col-md-5 col-sm-5 col-xs-5">
											<input type="text" class="form-control" name="additionaldriveemail" id="" placeholder="">
										</div>
									</div>						
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 col-sm-3 col-xs-3">
											<label for="exampleInputEmail1">Phone</label>
										</div>
										<div class="col-md-5 col-sm-5 col-xs-5">
											<input type="text" class="form-control" id="" name="additionaldrivephne" placeholder="">
										</div>
									</div>						
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 col-sm-3 col-xs-3">
											<label for="exampleInputEmail1">Date of Birth</label>
										</div>
										<div class="col-md-5 col-sm-5 col-xs-5">
											<div class='input-group date' id='infrdatetimepicker2'>
												<input type='text' class="form-control" name="adddrivedateofbirth" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>						
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 col-sm-3 col-xs-3">
											<label for="exampleInputEmail1">Driver License Number</label>
										</div>
										<div class="col-md-10 col-sm-9 col-xs-9">
											<input type="text" class="form-control"  name="adddrivelicenumber" id="" placeholder="">
										</div>
									</div>						
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 col-sm-3 col-xs-3">
											<label for="exampleInputEmail1">Driver's License Exp.</label>
										</div>
										<div class="col-md-10 col-sm-9 col-xs-9">
											<div class='input-group date' id='inlicedatetimepicker2' >
												<input type='text' class="form-control" name="adddrivelicenumberexp" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>						
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 col-sm-3 col-xs-3">
											<label for="exampleInputEmail1">Driver's License State</label>
										</div>
										<div class="col-md-10 col-sm-9 col-xs-9">
											<select class="form-control" name="adddrivelicestate" >
												<option value="-1">Ontario</option>
												<option value="AL">Alabama</option>
												<option value="AK">Alaska</option>
												<option value="AS">American Samoa</option>
												<option value="AZ">Arizona</option>
												<option value="AR">Arkansas</option>
												<option value="AF">Armed Forces Africa</option>
												<option value="AC">Armed Forces Canada</option>
												<option value="AE">Armed Forces Europe</option>
												<option value="Bogotá DC">Bogotá</option>
												<option value="BC">British Columbia</option>
												<option value="CA">California</option>
												<option value="CO">Colorado</option>
												<option value="CT">Connecticut</option>
											</select>
										</div>
									</div>						
								</div>
								
							
						</div>
					</div>
			<!-- Form section 3 end here ===================================================== -->	
				
			<!-- Form section 4 start here ===================================================== -->
					<div class="your_info">
						<h2 class="credit_hd">Additional Driver 2 (Optional)</h2>
						<div class="info_form">
						
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 col-sm-3 col-xs-3">
											<label for="exampleInputEmail1">First Name</label>
										</div>
										<div class="col-md-10 col-sm-9 col-xs-9">
											<input type="text" class="form-control" name="adddrive2name" id="" placeholder="">
										</div>
									</div>						
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 col-sm-3 col-xs-3">
											<label for="exampleInputEmail1">Last Name</label>
										</div>
										<div class="col-md-10 col-sm-9 col-xs-9">
											<input type="text" class="form-control"  name="adddrive2lname" id="" placeholder="">
										</div>
									</div>						
								</div>	
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 col-sm-3 col-xs-3">
											<label for="exampleInputEmail1">Email</label>
										</div>
										<div class="col-md-10 col-sm-9 col-xs-9">
											<input type="text" class="form-control" name="adddrive2email" id="" placeholder="">
										</div>
									</div>						
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 col-sm-3 col-xs-3">
											<label for="exampleInputEmail1">Phone</label>
										</div>
										<div class="col-md-10 col-sm-9 col-xs-9">
											<input type="text" class="form-control" name="adddrive2phone" id="" placeholder="">
										</div>
									</div>						
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 col-sm-3 col-xs-3">
											<label for="exampleInputEmail1">Date of Birth</label>
										</div>
										<div class="col-md-10 col-sm-9 col-xs-9">
											<div class='input-group date' id='infrdatetimepicker2'  >
												<input type='text' class="form-control" name="adddrive2datebirth"  />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>						
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 col-sm-3 col-xs-3">
											<label for="exampleInputEmail1">Driver License Number</label>
										</div>
										<div class="col-md-10 col-sm-9 col-xs-9">
											<input type="text" class="form-control" id=""  name="adddrive2licenumber" placeholder="">
										</div>
									</div>						
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 col-sm-3 col-xs-3">
											<label for="exampleInputEmail1">Driver's License Exp.</label>
										</div>
										<div class="col-md-10 col-sm-9 col-xs-9">
											<div class='input-group date' id='datetimepicker3'>
												<input type='text' class="form-control" name="adddrive2liceexp"  />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>						
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 col-sm-3 col-xs-3">
											<label for="exampleInputEmail1">Driver's License State</label>
										</div>
										<div class="col-md-10 col-sm-9 col-xs-9">
											<select class="form-control" name="adddrive2licestate"  >
												<option value="-1">Ontario</option>
												<option value="AL">Alabama</option>
												<option value="AK">Alaska</option>
												<option value="AS">American Samoa</option>
												<option value="AZ">Arizona</option>
												<option value="AR">Arkansas</option>
												<option value="AF">Armed Forces Africa</option>
												<option value="AC">Armed Forces Canada</option>
												<option value="AE">Armed Forces Europe</option>
												<option value="Bogotá DC">Bogotá</option>
												<option value="BC">British Columbia</option>
												<option value="CA">California</option>
												<option value="CO">Colorado</option>
												<option value="CT">Connecticut</option>
											</select>
										</div>
									</div>						
								</div>
								<div class="final_div terms_div">
									<p>Terms & Conditions</p>
									 <div class="checkbox">
										<label>
											<input type="checkbox" required> I have read and accept the rental policy 
										</label>
									</div>
								</div>
								<div class="form_btn reserve_btn">
									<!-- <label class="continue_btn">
									<a href="#" title="">Reserve</a>
									</label> --> <label class="continue_btn">
									<input type="submit" name="Reserve" value="Reserve" />
									</label>
									<div class="clearfix"></div>
								</div>
							</form>
							
							
							
							
							
							
						</div>
					</div>
			<!-- Form section 4 end here ===================================================== -->
			</div>
			<div id="confirmationInfo" style="display:none;">
				<div class="your_info seccuss_div border_top">
				<h2 class="credit_hd">Your Information</h2>
				<p><b>Success !</b> Reservation Complete</p>
					<div class="table-responsive">
						<div class="table_div border_top">
							<table class="table">
								<tbody>
									<tr>
										<td colspan="2"><h4>Your Reservation Number : <span id="reservat_id">875</span></h4></td>
										<td rowspan="3"><span id="ImgData"><img src="" alt=""></span></td>
									</tr>
									<tr>
										<td>First Name : <span id="confrmcusname">Alaa</span></td>							
									</tr>
									<tr>
										<td>Last Name : <span id="confrmcuslname">Mohammed</span></td>							
									</tr>
									<tr class="base_rate_table">
										<td>Phone : <span id="confrmcusphone">1272841592</span></td>
										<td><h4>Base Rate</h4></td>
										<td style="text-align:right;" id="confrmdailyrate" >$ 35.00</td>
									</tr>
									<tr class="rental_option_table">
										<td>Email : <span id="confrmcuseml">alaa87_ma@hotmail.com</span></td>
										<td><h4>Rental Options</h4></td>
										<td style="text-align:right;" id="confrmrentailoption" >$ 0.00</td>
									</tr>
								</tbody>
							</table>				
						</div>
				
						<div class="table_div table_div2 border_top">
							<table class="table">
								<tbody>
									<tr>
										<td><h4>Pick-up</h4></td>
										<td colspan="2"><h4>Taxes</h4></td>
									</tr>
									<tr>
										<td id="confrmpickupdate" >Wednesday, 19 July 2017 12:00 PM</td>							
										<td>IVA @ 16%</td>							
										<td style="text-align:right !important;" id="confrmtaxcharges" >$ 5.60</td>							
									</tr>
									<tr>
										<td id="confrmpcklocation" >Dundas Square</td>	
										<td><h4>Total</h4></td>
										<td style="text-align:right !important;" ><h4 id="confrmtotalchrgess" >$ 40.60</h4></td>
									</tr>
									<tr>
										<td>One Dundas West, #2500, Toronto, ON, M5G1Z3</td>
									</tr>
									<tr>
										<td>Phone : 416-873-7331</td>
									</tr>
									<tr>
										<td>Toll-Free :</td>
									</tr>
								</tbody>
							</table>				
						</div>
				
						<div class="table_div border_top">
							<table class="table">
								<tbody>
									<tr>
										<td><h4>Drop-off</h4></td>
									</tr>
									<tr>
										<td id="confrmdrpoffdate"  >Thursday, 20 July 2017 12:00 PM</td>						
									</tr>
									<tr>
										<td id="confrmdrplocation">Dundas Square</td>								
									</tr>
									<tr>
										<td colspan="3">One Dundas West, #2500, Toronto, ON, M5G1Z3</td>
									</tr>
									<tr>
										<td colspan="3">Phone : 416-873-7331</td>
									</tr>
									<tr>
										<td colspan="3">Toll-Free :</td>
									</tr>
								</tbody>
							</table>				
						</div>
					</div>
					<!-- Modal -->
					<div class="modal fade" id="myModals" role="dialog">
						<div class="modal-dialog">
				
				  <!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Reason for cancellation</h4>
								</div>
								<div class="modal-body">
									<textarea rows=5 cols=71 name="textArea" id="message"></textarea>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default reasonApi">Submit</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
				  
						</div>
					</div>
			

					<div class="print_div border_top text-center">
						<a href="#" title="" data-toggle="modal" data-target="#myModals">Cancel</a>
						<a href="#" title="">Add to Outlook Calender</a>
						<a href="#" onclick="myFunction()" title="">Print</a>
						<a href="#" onclick="mailfunctionnow();" title="">Email</a>
						<a href="javascript:void(0)" title="" id="modify" >Modify</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<script src='http://carrentalwebsite.biz/wp-content/themes/grandcarrental/js/bootstrap.min.js'></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bezier.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
<?php

$rentaloptions= $_GET['rentalopt'];
//$totalCharges= $_GET['totbaserent1'];
//$taxcharges= $_GET['taxcharges'];
$iva= $_GET['taxsc1'];
$vehtypeid= $_GET['vehid'];
$timer1= $_GET['timer1'];
$timer2= $_GET['timer2'];
$total_ca1= $_GET['total_ca1'];
$checkvtype = $_GET['vehtype'];
$PickUpLocation = $_GET['PickUpLocation'];
$DropOffLocation = $_GET['DropOffLocation'];
$vehpiclocname= $_GET['vehploc'];
$vehpdate = $_GET['vehpdate'];
//$vehtpdte = explode(" ",$vehpdate);
$vehtypdroploc = $_GET['vehdloc'];
$getvprice = $_GET['baserate'];
$vehtypdpdate = $_GET['vehddate'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/GetVehiclesAndRates");
$curl_post_datarate2  = "{\"ClientId\":\"5830\",\"UserEmail\":\"selfservice@rentcentric.com\",\"Password\":\"Mahmoud777\",\"PickupDate\":\"$vehpdate\",\"LocationID\":\"116\",\"PickupLocation\":\"$PickUpLocation\",\"PickupTime\":\"$timer1\",\"DropOffDate\":\"$vehtypdpdate\",\"DropOffLocation\":\"$DropOffLocation\",\"DropOffTime\":\"$timer2\"}";
curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","content-type: application/json; charset=utf-8"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_datarate2);
$records = curl_exec($ch);
$err = curl_error($ch);
if ($err) {
	echo "cURL Error #:" . $err;
} else {
	$array = json_decode($records );
	if($array){
		$data = $array->VehiclesAndRatesInfos;
		$tdt = array();
		foreach($data as $item){
			if($item->VehiclesAndRatesVTypeInfo->VehicleTypeID == $vehtypeid){
				$tdt[] = $item->VehiclesAndRatesRateInfos[0]->RateInfo;
			}
		}
	}
}
?> 

<script type="text/javascript">
function myFunction(){
				window.print();
			}
			function mailfunctionnow()
			{
				var mailresnumber= document.getElementById('reservat_id').innerHTML;
				var mailfirstname= document.getElementById('confrmcusname').innerHTML;
				var maillastname= document.getElementById('confrmcuslname').innerHTML;
				var mailphone = document.getElementById('confrmcusphone').innerHTML;
				var maileml = document.getElementById('confrmcuseml').innerHTML;
		
			
			  var postdata= "resnumid="+mailresnumber+",resfrtname="+mailfirstname+",reslname="+maillastname+",reslphone="+mailphone+",resleml="+maileml;
			  var xhttp = new XMLHttpRequest();
			  xhttp.open("POST", "http://carrentalwebsite.biz/wp-content/themes/grandcarrental/mailfunctioncus.php", true);
			  //Send the proper header information along with the request
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			   	xhttp.onreadystatechange = function() {//Call a function when the state changes.
					if(xhttp.readyState == 4 && xhttp.status == 200) {
					   //document.getElementById("hideMe").innerHTML =	 this.responseText;
				 alert(xhttp.responseText);
					}
				}
				xhttp.send(postdata);
			  
				
				
				
			}
jQuery(document).ready(function(){
	jQuery("#array_of_rateInfo").attr("value",'<?php echo json_encode($tdt)?>');
	
})
jQuery(document).ready(function(){
	jQuery("#modify").on("click",function(){
		//jQuery("html, body").animate({ scrollTop: 0 }, "slow");
		jQuery.ajax({
			url: "http://carrentalwebsite.biz/wp-content/themes/grandcarrental/ModifyReservation.php",
			type: "POST",
			data: { 
				reservationId : jQuery("#reservat_id").val(),
				vehicl_id : jQuery("#vehicletypeid_input").val(),
				locationId : jQuery("#locationid_input").val(),
				PickupLocation : jQuery("#locationid_input").val(),
				droplocationId : jQuery("#droplocation_input").val(),
				pickup   : jQuery("#pickdate_input").val(),
				dropoff  : jQuery("#dropoff_date").val()
			},
			success: function (jsonresult) {
				if(jsonresult =='success'){
					alert("Modified Successfully!");
					
				}
			}
		}); 
	});
});

function openyourinformation(){
	document.getElementById('infoid').style.display = 'block';
	document.getElementById('confirmationInfo').style.display='none';

}

jQuery(document).ready(function(){
	jQuery(".reasonApi").on("click",function(){
		
		var reason = jQuery("textarea#message").val();
		
		var reservationId = jQuery("#reservat_id").html();
		if(reason){
			jQuery.ajax({
				url: "http://carrentalwebsite.biz/wp-content/themes/grandcarrental/CancelReservation.php",
				type: "POST",
				data: { 
					reason   : reason,
					reservationId  : reservationId
				},
				success: function (jsonresult) {
				
					if(jsonresult =="Success" && jQuery('#myModals').modal('hide')){
						alert("Cancelled!");				 					
					} 
				}
			}); 
			 
		}
		
	}); 
	
			
	
	jQuery('.req').keydown(function(){
						jQuery(this).parent().removeClass('has-error');
						jQuery(this).parent().addClass('has-success');
						jQuery(this).tooltip('destroy');
					});
					jQuery('.req').on("blur",function(){
						if (jQuery.trim(jQuery(this).val())==''){
							jQuery(this).parent().addClass('has-error');
							jQuery(this).parent().removeClass('has-success');
						}
					});
					function showErr(field){
						field.parent().addClass('has-error');
						field.tooltip('show');
						jQuery('html, body').animate({scrollTop: field.offset().top-170}, 1000);
					}
					jQuery('#youcardauth').on('submit',function(e){
							
							var cherror = 0; 
							
						jQuery('input.req').each(function(){
							
							errField = jQuery(this);
							var val = jQuery.trim(errField.val());
							if(val == ''){
								cherror =1;
								e.preventDefault();
								errField.tooltip({title:"This is a required filed",trigger:'manual', selector:errField, html:true,placement: 'auto'});
								showErr(errField);
								return false;
								
							}
							if (errField.hasClass('alfa')){
								filter = /^[a-zA-Z ]*$/;
								if (!filter.test(val)) {
									cherror =1;
									e.preventDefault();
									errField.tooltip({title:"Only <b>ALFA</b> characters allowed",trigger:'manual',selector:errField, html:true,placement: 'auto'});
									showErr(errField);
									return false;
									
								}
								
							}
							
							
							if (errField.hasClass('intval')){
								if (isNaN(val)) {
									cherror =1;
									e.preventDefault();
									errField.tooltip({title:"Only <b>Numeric</b> value allowed",trigger:'manual',selector:errField, html:true,placement: 'auto'});
									showErr(errField);
									return false;
									
								}
								
							}
							if (errField.hasClass('email')){
								filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,6})+$/;
								if (!filter.test(val)) {
									cherror =1;
									e.preventDefault();
									errField.tooltip({title:"This is <b>invalid email</b> address",trigger:'manual',selector:errField, html:true,placement: 'auto'});
									showErr(errField);
									return false;
								
								}
							}
										if (errField.hasClass('phone')){
								if (val.length < 10){
									cherror =1;
									e.preventDefault();
									errField.tooltip({title:"Phone number is short",trigger:'manual',selector:errField});
									showErr(errField);
									return false;
									
								}
								
								var strvalidchars = "-+()0123456789 ";
								for (i =0; i < val.length; i++){
									var curchar = val[i];
									if (strvalidchars.indexOf(curchar) == -1) {
										cherror =1;
										e.preventDefault();
										errField.tooltip({title:"Phone number has invalid characters <i>(-+()0123456789) allowed</i>",trigger:'manual',selector:errField,html:true});
										showErr(errField);
										return false;
										
									}
								}
							}
						
						});	
						
						if(cherror==0)
						{
							
						e.preventDefault();
							
						var post_data = jQuery('#youcardauth').serializeArray();
						var form=jQuery("#youcardauth");
						//console.log(form.serialize());
						jQuery.ajax({
									url: "http://carrentalwebsite.biz/wp-content/themes/grandcarrental/createcustomerinform.php",
									type: "POST",
									data: form.serialize(),
									success: function (jsonresult11) {
										//alert(jsonresult11);
									var newda = JSON.parse(jsonresult11);
									//console.log(newda);
									//alert(jsonresult11);
									if(newda['error']==1)
									{
										alert(newda['msg']);
									}
									if(newda['error']==0)
									{
										var rescusid = newda['resid'];
										var rescusname= newda['custmname'];
										var rescuslstname= newda['custmltnme'];
										var rescusphne= newda['custmphone'];
										var rescuseml= newda['customemail'];
										var rescuspicloc= newda['confrmpickloc'];
										var rescuspicdate= newda['confrmpkupd'];
										var rescsdrploc= newda['confirmdrploc'];
										var rescsdrpdate= newda['confrmdrpd'];
										
										var resconfrmdailychrge = newda['confrmdalychrge'];
										var resconfrmrentalchrge = newda['confrmrentalchrge'];
										var rescnfrmtaxchrge = newda['confrmtaxchge'];
										var resconfrmtotalamt = newda['confrmtotalchrge'];
										var srccc = jQuery("div#settings > div.rental_div").find("img.chgnowimg").attr("src");
										
										jQuery("#reservat_id").html(rescusid);
										jQuery("span#ImgData >img").attr("src",srccc);
										jQuery("#confrmcusname").html(rescusname);
										jQuery("#confrmcuslname").html(rescuslstname);
										jQuery("#confrmcusphone").html(rescusphne);
										jQuery("#confrmcuseml").html(rescuseml);
										jQuery("#confrmpickupdate").html(rescuspicdate);
										jQuery("#confrmpcklocation").html(rescuspicloc);
										jQuery("#confrmdrpoffdate").html(rescsdrpdate);
										jQuery("#confrmdrplocation").html(rescsdrploc);
										
										
										jQuery("#confrmdailyrate").html("$ ".resconfrmdailychrge);
										jQuery("#confrmrentailoption").html("$ ".resconfrmrentalchrge);
										jQuery("#confrmtaxcharges").html("$ ".rescnfrmtaxchrge);
										jQuery("#confrmtotalchrgess").html("$ ".resconfrmtotalamt);
										
										jQuery("#confirmationInfo").css("display","block");
										jQuery("#infoid").css("display","none");
										
									}
									
									
									  }
									});
						}
					
						
						
						
					});
});

jQuery(function () {
	jQuery('#datetimepicker2').datetimepicker({
		locale: 'ru'
	});
});
jQuery(document).ready(function(){
	jQuery.ajax({
		url: "http://carrentalwebsite.biz/wp-content/themes/grandcarrental/getrentaloptiondata.php",
		type: "POST",
		data: {
			vehid    : '<?php echo $vehtypeid;?>',
			vehtype  : '<?php echo $checkvtype;?>',
			timer1  : '<?php echo $timer1;?>',
			timer2  : '<?php echo $timer2;?>',
			vehploc  : '<?php echo $vehpiclocname;?>',
			vehpdate : '<?php echo $vehpdate;?>',
			vehdloc  : '<?php echo $drplocationname;?>',
			vehddate : '<?php echo $vehtypdpdate;?>',
		},
		success: function (jsonresult) {
			//jQuery("#array_of_rateInfo").attr("value",$jsonresult);
			var j= JSON.parse(jsonresult);
			console.log(j);
			var desc = j['Description'];
		
			var totalPrice = '<?php echo $getvprice; ?>';
			var vidnw = j['VehicleTypeID'];
			var dor = j['NumberOfDoors'];
			var lugs= j['Luggages'];
			var gears= j['NumberOfGears'];
			var passgers= j['noofpassengers']; 
			var vehtypimg= j['vehtypeimg'];
		
			jQuery("#baserate1").html("$ "+totalPrice+" .00");
			jQuery("#rentaloption1").html(<?php echo $_GET['rentalopt'];?>);
			jQuery("input[name=rentalopt]").val(<?php echo $_GET['rentalopt'];?>);
			//jQuery("#baserate").html("$ "+totalPrice+" .00");
			jQuery("#dailyrate_charge").val(totalPrice);
			
			jQuery("input[name='baserate1']").val(totalPrice);
			jQuery("#taxXCharges").html(<?php echo $taxcharges;?>);
			jQuery("#taxsc1").html(<?php echo $iva;?>);
			jQuery("#totbaserent1").html(<?php echo $totalCharges;?>);
			jQuery("#total_ca1").html(<?php echo $total_ca1;?>);
			jQuery(".lexus_div h2").html(desc);
			jQuery(".lexus_div .getvehidnow").val(vidnw);
			jQuery(".lexus_div .v_passengers .lexus_icon").find("span").html (passgers +" Passengers");
			jQuery(".lexus_div .v_doors .lexus_icon ").find("span").html(dor + " doors");
			jQuery(".lexus_div .v_lugss .lexus_icon").find("span").html(lugs+" Luggages");
			jQuery(".lexus_div .v_gears .lexus_icon").find("span").html(gears);
			var src = '//'+vehtypimg;
			jQuery(".rental_div  img.chgnowimg").attr('src', src);
			jQuery("#vehicletypeid_input").val(vidnw);
		}
	});		
});

jQuery(document).ready(function(){
	jQuery(".updateDate").on("click",function(){
		var data = jQuery("input[name=modify_date_timepicker_value]").val();	
		var d = data.split(" ");
		var tt = new Date(data);
		var datee = d[0];
		jQuery("form#youcardauth > #pickdate_input").val(datee)
		jQuery("div#settings").find("span#LblPickupDateTime").html(tt);
	});
});

jQuery(document).ready(function(){
	jQuery(".UpdateModifyDate").on("click",function(){
		var data = jQuery("input[name=modify_timepicker_value]").val();	
		var d = data.split(" ");
		var tt = new Date(data);
		var datee = d[0];
		jQuery("form#youcardauth > #dropoff_date").val(datee)
		jQuery("div#settings").find("span#lblReturnDateTime").html(tt);
		
	});
});
jQuery(document).ready(function (){
	jQuery('#infrdatetimepicker2, #datetimepicker3').datetimepicker({	
		locale: 'en',
		format: 'D/MM/YY'
	});
});
jQuery(document).ready(function () {
	jQuery('#datetimepicker2, #datetimepicker2, #datetimepicker1').datetimepicker({
        locale: 'en'
    });
})
jQuery(document).ready(function(){
	jQuery('#pickup_Mdatepicker').datetimepicker({
		locale: 'en'
	});
});
jQuery(document).ready(function(){
	jQuery("#dropOff_Mdatepicker").datetimepicker({
		locale:'en'
	});
});
   
jQuery(document).ready(function(){
	jQuery('#infodatetimepicker2').datetimepicker({
		locale: 'en',
		format: 'D/MM/YY'
	});
});
				
jQuery(document).find(".tab-content").find("div#settings").addClass("active");	
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

var veh = getParameterByName('VehicleType');
var foo = getParameterByName('PickUpLocation');
var drop = getParameterByName('DropOffLocation');
var dat1 = getParameterByName('date1');
var dat2 = getParameterByName('date2');

 if(foo != null)
 {
	if(foo=="139")
	{
		foo= '34534';
	}
	if(foo=="122")
	{
		foo= 'Bloor Street';
	}
	if(foo=="117")
	{
		foo= 'Dundas Square';
	}
	if(foo=="121")
	{
		foo= 'King West';
	}
	if(foo=="120")
	{
		foo= 'Queen West';
	}
	if(foo=="147")
	{
		foo= 'RC-Location';
	}
	if(foo=="149")
	{
		foo= ' Test Location ';
	}
	if(foo=="140")
	{
		foo= 'Test1107';
	}if(foo=="116")
	{
		foo= 'Toronto';
	}
	
	
	 document.getElementById('lblPickupLocation').innerHTML = foo;
}
if(drop != null)
 {
	if(drop=="139")
	{
		drop= '34534';
	}
	if(drop=="122")
	{
		drop= 'Bloor Street';
	}
	if(drop=="117")
	{
		drop= 'Dundas Square';
	}
	if(drop=="121")
	{
		drop= 'King West';
	}
	if(drop=="120")
	{
		drop= 'Queen West';
	}
	if(drop=="147")
	{
		drop= 'RC-Location';
	}
	if(drop=="149")
	{
		drop= ' Test Location ';
	}
	if(drop=="140")
	{
		drop= 'Test1107';
	}if(drop=="116")
	{
		drop= 'Toronto';
	}
	document.getElementById('lblReturnLocation').innerHTML = drop;
}
</script>	
<?php get_footer(); ?>
<!-- End content -->
<!-- End content -->