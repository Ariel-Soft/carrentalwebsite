<?php
/**
 * Template Name: Car List Right Sidebar(R2)
 * The main template file for display car page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
if(!is_null($post))
{
	$page_obj = get_page($post->ID);
}

$current_page_id = '';

/**
*	Get current page id
**/

if(!is_null($post) && isset($page_obj->ID))
{
    $current_page_id = $page_obj->ID;
}

$grandcarrental_homepage_style = grandcarrental_get_homepage_style();

//Get page sidebar
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);

if(empty($page_sidebar))
{
	$page_sidebar = 'Page Sidebar';
}

get_header();
?>
<link href="http://carrentalwebsite.biz/wp-content/themes/grandcarrental/css/bootstrap.css" rel="stylesheet" /><link href="http://carrentalwebsite.biz/wp-content/themes/grandcarrental/css/datepicker.css" rel="stylesheet" /><?php
$grandcarrental_page_content_class = grandcarrental_get_page_content_class();
get_template_part("/templates/template-header");
//Get all portfolio items for paging
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

if(!empty($_GET)){
	//echo"<pre>";print_r($_GET);die();
	$picklocation = $_GET['PickUpLocation'];
	$droplocation= $_GET['DropOffLocation'];			
	$date1 = date_create($_GET['getvehpdat'].$_GET['timer1']);
				 $pickupdate = date_format($date1, 'l, jS F Y \a\t g:ia');				 
				//$pickupdate = date('d F Y ',strtotime($_POST['date1']));
				$date1pass = $_GET['getvehpdat'];
				//echo $pickupdate;				
				$date2 = date_create($_GET['getvehddat'].$_GET['timer2']);	
				$date2pass = $_GET['getvehddat'];				
				$dropdate =  date_format($date2, 'l, jS F Y \a\t g:ia');				
				//$pickdatte = explode(" ",$pickupdate);
				//$drpdatte = explode(" ",$dropdate);				
				$vehicletype = $_GET['VehicleType'];
				
					if($vehicletype == "")
					{ 
						$vehicletype = 101;
					}				
					$var = 0;
						 		
}
			
				if( isset($_GET['typeloca']) && $picklocation == "" )
				{
						$picklocation = $_GET['typeloca'];
						
						
				}
				if( isset($_GET['typedrploc']) && $droplocation == "" )
				{
						$droplocation = $_GET['typedrploc'];
						
									
				
				 $pickupdate = 	$_GET['typedate1'];			
								
				$dropdate = $_GET['typedate2'] ;				
							
				$vehicletype= $_GET['typevhetype'];				
			
						
				}
				
				
				
				if($picklocation != "")
					{
						if($json){
							foreach ($json->LocationData as $item) 
							{
								if($item->LocationID == $picklocation )
									{
									$picklocationname =  $item->LocationName;
									}
								if($item->LocationID == $droplocation )
									{
									$drplocationname =  $item->LocationName;
									}				   
							}
						}
					}	
?>   
<div class="inner">
	<div class="tab_div">

	<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li onclick="redirecttofirst('http://carrentalwebsite.biz/')"role="presentation"><a href="http://carrentalwebsite.biz/test/" aria-controls="home" role="tab" data-toggle="tab">1 Pick up</a></li>
			<li onclick="redirecttosecond()"role="presentation" ><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">2 Select Vehicle</a></li>
			<li role="presentation" class="active" ><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">3 Rental Option</a></li>
			<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">4 Your Information</a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
		
			
			
		  
		  
		  

   
   <div role="tabpanel" class="tab-pane <?php if($_GET['vehtype']!= 0) { ?> active <?php } ?>" id="messages">	
				
				
				
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
										<?php } else { echo $picklocationname; } ?></span>
								</p>
								<span id="LblPickupDateTime"><?php if($pickupdate =="") { ?> Tuesday, 18 July 2017 at 12:00 PM <?php } else { echo $pickupdate; } ?></span>
							</div>
						  </div>
						  <div class="col-sm-3">
							<div class="tab_text">
							  <h5> Return </h5>
							 <p> 
										<span id="lblReturnLocation" style="font-weight:bold;"><?php if($droplocation == ""){
										?>
										Dundas Square
										<?php } else { echo $drplocationname; } ?></span>
								</p>
										<span id="lblReturnDateTime"><?php if($dropdate =="" ){ ?>Wednesday, 19 July 2017 at 12:00 PM <?php } else { echo $dropdate; } ?></span>
							</div>
						  </div>
						</div>
					</div>
					
					
								
								
								<?php  
								if($_GET['VehicleType']!= 0) {
								curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/GetVehicleTypes");
								$curl_post_dataveh2  = "{\"ClientId\":\"5830\",\"UserEmail\":\"selfservice@rentcentric.com\",\"Password\":\"Mahmoud777\",\"PickupDate\":\"7/27/2017\",\"PickupLocation\":\"$picklocationname\",\"PickupTime\":\"12:00 PM\",\"DropOffDate\":\"7/27/2017\",\"DropOffLocation\":\"Sherbrooke \",\"DropOffTime\":\"12:00 PM\"}";
								curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache",
										"content-type: application/json; charset=utf-8"));
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								curl_setopt($ch, CURLOPT_POST, true);
								curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
								curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
								curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_dataveh2);
								$record1s = curl_exec($ch);
								$errc = curl_error($ch);
								//print_r($result);
								if ($errc) { echo "cURL Error #:" . $errc;} else
									{
									// echo $result;
									// echo '<pre>' . print_r($records, true) . '</pre>';
									//$array = json_decode($result, true);
									$vehic = json_decode($record1s );
									//print_r($vehic);
									}
									
									curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/GetVehiclesAndRates");
									$curl_post_datarate2  = "{\"ClientId\":\"5830\",\"UserEmail\":\"selfservice@rentcentric.com\",\"Password\":\"Mahmoud777\",\"PickupDate\":\"7/17/2017\",\"LocationID\":\"116\",\"PickupLocation\":\"117\",\"PickupTime\":\"12:00 PM\",\"DropOffDate\":\"7/27/2017\",\"DropOffLocation\":\"122\",\"DropOffTime\":\"12:00 PM\"}";
									//	$curl_post_data1	={"ClientId":"5830","UserEmail":"selfservice@rentcentric.com","Password":"Mahmoud777"}
									curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache",
										"content-type: application/json; charset=utf-8"));
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
									curl_setopt($ch, CURLOPT_POST, true);
									curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
									curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
									curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_datarate2);
									$recrate = curl_exec($ch);
									$errrc = curl_error($ch);
									//print_r($result);
									if ($errrc) {echo "cURL Error #:" . $errrc;	}
									else {
									 // echo $result;
									 // echo '<pre>' . print_r($records, true) . '</pre>';									  
									  //$array = json_decode($result, true);									  
									   $vehicrates = json_decode($recrate );
									  
									}
									
									if($vehic){
										foreach ($vehic->VehicleTypes as $item)

										{
									if($item->VehicleTypeid == $_GET['VehicleType'])
									{
									?>
									
											<input type="hidden" name="vehicleidrental" value="" />
					<?php  
					
					
					$array
					?>

					<div class="rental_div">
						<div class="row">
							<div class="col-sm-6 col-xs-6">					
								<img  class="chgnowimg" src="<?php echo "//".$item->VehicleTypeImage; ?>" alt="">
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="lexus_div">
					<?php 
														$checkrate="";
														if($vehicrates){
														foreach($vehicrates->VehiclesAndRatesInfos as $chrate)
														{											
														
														if($chrate->VehiclesAndRatesVTypeInfo->VehicleTypeName == $item->VehicleTypeName )
														{
															$checkrate = $chrate->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge;
															
														}
														
														
														}
														}
														if($checkrate==""){
															$checkrate=45;
														}?>
					<input type="hidden" name="vehicl_id" class="getvehidnow" /> 
						<h2><?php echo $item->VehicleTypeName; ?></h2>
						<div class="border_top passengers">
							<div class="row">
								<div class="col-md-9 col-sm-12 col-xs-12">
									<div class="row">
										<div class="col-sm-3 col-xs-6 v_passengers">
											<div class="lexus_icon">
												<img src="<?php echo get_template_directory_uri(); ?>/images/user_icon.jpg" alt="">
												<span><?php echo $item->NumberOfSeats;?> Passengers</span>
											</div>
										</div>
										<div class="col-sm-3 col-xs-6 v_lugss">
											<div class="lexus_icon">
												<img src="<?php echo get_template_directory_uri(); ?>/images/bag_icon.jpg" alt="">
												<span><?php
													$sumuplug = ($item->NumberOfBagsSmall + $item->NumberOfBagsLarge);
												echo $sumuplug; ?> Luggages</span>
											</div>
										</div>
										
									<!--	<div class="col-sm-3 col-xs-6 v_gears">
											<div class="lexus_icon lexus_icon2">
												<img src="<?php //echo get_template_directory_uri(); ?>/images/setting_icon.jpg" alt="">
												<span>Auto</span>
											</div>
										</div> -->
										
										<div class="col-sm-3 col-xs-6 v_doors">
											<div class="lexus_icon lexus_icon2">
												<img src="<?php echo get_template_directory_uri(); ?>/images/car_cion.png" alt="">
												<span><?php echo $item->NumberOfDoors; ?> Doors</span>
											</div>
										</div>
									</div>
								</div>				
							</div>
						</div>
					</div>
					
		
						
							<div class="table_div border_top">
						<table class="table">
							<tbody>
								<tr>
									<td><h4>Base Rate</h4></td>
									<td><h4><input type="hidden" name="baserate1" value="<?php echo $checkrate; ?>" /><span id="baserate1">$ <?php echo $checkrate; ?>.00</span></h4></td>
								</tr>
								<tr>
									<td><h4>Rental Options</h4></td>
									<td><h4><input type="hidden" name="rentalopt" value="0.00" /> <span>$ </span><span id="rentaloption1">0.00</span></h4></td>
								</tr>
								<!--tr><td><h4>Total</h4></td><td><h4><span>$ </span><span id="totbaserent1"><?php echo $checkrate; ?>.00</span></h4></td>
								</tr-->
								<tr>
									<td><h4><b>Taxes</b></h4></td>
									<td></td>
								</tr>
								<tr>
									<td><h4>IVA @ 16%</h4></td>
									
									<td><h4><span>$ </span><span id="taxsc1"><?php echo $_GET['taxcharges']; ?></span></h4></td>
								</tr>
								<tr>
									<td><h4>Total</h4></td>
									
									<td><h4><span>$ </span><span id="total_ca1"></span></h4></td>
								</tr>
							</tbody>
						</table>				
					</div>
					
				
					
					<div class="service_div border_top service_div2">
						<h5>Equipment & Services</h5>
						
						<h4>SIRIUS XM Satellite Radio</h4>
						<span>Make your drive come alive with SiriusXM<b>&reg;</b> Satellite Radio.</span>
						<form class="form_btn">
							<label><input type="checkbox" name="sateliteradio" value="6.99"> $6.99/Day</label>
							<div class="clearfix"></div>
						</form>
					</div>
					<div class="service_div border_top safety_div">
						<h4>Extended Roadside Assistance</h4>
						<span>Pease of Mind for unexpected emergencies. Get fast, reliable 24/7 service when you need it most.</span>
						<form class="form_btn">
							<label><input type="checkbox" name="exroadside" value="16.99"> $16.99/Day</label>
							<div class="clearfix"></div>
						</form>
					</div>
					<div class="service_div border_top safety_div">
						<h4>Child Safety Seats</h4>
						<span>Keep kids safe when travelling with our child safety seats.</span>
						<form class="form_btn">
							<label><input type="checkbox" name="childsafety" value="6.99"> $6.99/Day</label>
							<div class="clearfix"></div>
						</form>
					</div>
					<div class="service_div border_top safety_div">

						
						<form class="form_btn">
							<label class="continue_btn"><a title="" href="#" title="" id="continue_btnBtn">Continue</a></label>
							<div class="clearfix"></div>
						</form>
					</div>
			
									
									
									
									
									
									
									
								<?php 
								}
								}
									}
								}		else {
									?>
					
					
					<input type="hidden" name="vehicleidrental" value="" />
					<?php  
					
					
					$array
					?>

					<div class="rental_div">
						<div class="row">
							<div class="col-sm-6 col-xs-6">					
								<img  class="chgnowimg" src="" alt="">
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
											<div class="lexus_icon">
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
										
									<!--	<div class="col-sm-3 col-xs-6 v_gears">
											<div class="lexus_icon lexus_icon2">
												<img src="<?php //echo get_template_directory_uri(); ?>/images/setting_icon.jpg" alt="">
												<span>Auto</span>
											</div>
										</div> -->
										
										<div class="col-sm-3 col-xs-6 v_doors">
											<div class="lexus_icon lexus_icon2">
												<img src="<?php echo get_template_directory_uri(); ?>/images/car_cion.png" alt="">
												<span>4 Doors</span>
											</div>
										</div>
									</div>
								</div>				
							</div>
						</div>
					</div>
					
		
					
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
								<!--tr><td><h4>Total</h4></td><td><h4><span>$ </span><span id="totbaserent1">15.00</span></h4></td-->
								</tr>
								<tr>
									<td><h4><b>Taxes</b></h4></td>
									<td class="floatright"><span id="taxXCharges"></span></td>
								</tr>
								<tr>
									<tr>
									<td><h4>IVA @ 16%</h4></td>
									
										
									<td><h4><span>$ </span><span id="taxsc1"><?php echo $_GET['taxcharges']; ?></span></h4></td>
								</tr>
									
								<tr>
									<td><h4>Total</h4></td>
									<td><h4><span>$ </span><span id="total_ca1">23.35</span></h4></td>
								</tr>
							</tbody>
						</table>				
					</div>
					
				
					
					<div class="service_div border_top service_div2">
						<h5>Equipment & Services</h5>
						
						<h4>SIRIUS XM Satellite Radio</h4>
						<span>Make your drive come alive with SiriusXM<b>&reg;</b> Satellite Radio.</span>
						<form class="form_btn">
							<label><input type="checkbox" name="sateliteradio" value="<?php if(isset($_GET['days'])){echo $_GET['days']*6.99;}else{?>6.99"<?php } ?>"> $6.99/Day</label>
							<div class="clearfix"></div>
						</form>
					</div>
					<div class="service_div border_top safety_div">
						<h4>Extended Roadside Assistance</h4>
						<span>Pease of Mind for unexpected emergencies. Get fast, reliable 24/7 service when you need it most.</span>
						<form class="form_btn">
							<label><input type="checkbox" name="exroadside" value="<?php if(isset($_GET['days'])){echo -$_GET['days']*16.99;}else{?>16.99"<?php } ?>"> $16.99/Day</label>
							<div class="clearfix"></div>
						</form>
					</div>
					<div class="service_div border_top safety_div">
						<h4>Child Safety Seats</h4>
						<span>Keep kids safe when travelling with our child safety seats.</span>
						<form class="form_btn">
							<label><input type="checkbox" name="childsafety" value="<?php if(isset($_GET['days'])){echo -$_GET['days']*6.99;}else{?>6.99"<?php } ?>"> $6.99/Day</label>
							<div class="clearfix"></div>
						</form>
					</div>
					<div class="service_div border_top safety_div">

						
						<form class="form_btn">
							<label class="continue_btn"><a href="#" title="" id="continue_btnBtn" >Continue</a></label>
							<div class="clearfix"></div>
						</form>
					</div>
			

								<?php } ?>
								
					</div>
   
    
</div>

</div>
</div>
</div>
<script src='http://carrentalwebsite.biz/wp-content/themes/grandcarrental/js/bootstrap.min.js'></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/js/bootstrap-datetimepicker.min.js"></script>

<?php
$vehtypeid= $_GET['vehid'];
$rentaloptions= $_GET['rentaloptions'];
$totalCharges= $_GET['totalCharges'];
$taxcharges= $_GET['taxcharges'];
$PickUpLocation= $_GET['PickUpLocation'];
$DropOffLocation= $_GET['DropOffLocation'];
$checkvtype = $_GET['vehtype'];
$vehpiclocname= $_GET['vehploc'];
$vehpdate = $_GET['getvehpdat'];
//$vehtpdte = explode(" ",$vehpdate);
$vehtypdroploc = $_GET['vehdloc'];
$timer1 = $_GET['timer1'];
$timer2 = $_GET['timer2'];
$getvprice = $_GET['getvprice'];
$vehtypdpdate = $_GET['getvehddat'];
?>
<script>
	function redirecttofirst(url1)
			{
				 window.history.go(-1);
				//alert(url1);
				 //window.location= url1;
				
			}
		function redirecttosecond()
			{
				 window.history.go(-1);
				//alert(url1);
				 //window.location= url1;
				
			}
						
				
function getQueryVariable(url, variable) {
  	var query = url.substring(1);
    var vars = query.split('&');
    for (var i=0; i<vars.length; i++) {
        var pair = vars[i].split('=');
        if (pair[0] == variable) {
			return pair[1];
        }
    }
    return false;
 }
  
jQuery(document).ready(function () {
	
			var ckbox = jQuery("input[name='sateliteradio']");
					var ckbox1 = jQuery("input[name='exroadside']");
					var ckbox2 =jQuery("input[name='childsafety']");
					
					
			  var chkId = '';
			  var chkId1="";
			   var chkId2="";
				  jQuery("input[name='sateliteradio']").on('click', function() {
					  
					  var baserate = jQuery("input[name='baserate1']").val();
					
					  
					  var rental_opt = jQuery("input[name='rentalopt']").val();
					   if (ckbox.is(':checked')) {
					chkId = jQuery(this).val();		
					var bindvalue = -parseFloat(chkId) + parseFloat(rental_opt);		
					jQuery("input[name='rentalopt']").val(bindvalue.toFixed(2));		
					
				} else
				{
					chkId = jQuery(this).val();
					var bindvalue = -parseFloat(rental_opt) - parseFloat(chkId) ;
					parseFloat(bindvalue);
					jQuery("input[name='rentalopt']").val(bindvalue.toFixed(2));
					
				}
					  
					  
				var rental_opt1 = jQuery("input[name='rentalopt']").val();
				jQuery("#rentaloption1").html(-rental_opt1);	
				jQuery("#rentaloption").html(-rental_opt1);	
				jQuery("#rentalrate_charge").val(-rental_opt1);
				
				 var retotal = parseFloat(baserate) + parseFloat(rental_opt1);
				 var vtax= (parseFloat(retotal)*16)/100;
				 
				 var vgtotal= parseFloat(retotal) + parseFloat(vtax);
				 jQuery('#taxsc1').html(vtax.toFixed(2));
				 jQuery('#total_ca1').html(vgtotal.toFixed(2));
				 jQuery("#totbaserent1").html(retotal.toFixed(2));
				 
				jQuery('#taxsc').html(vtax.toFixed(2));
				 jQuery('#total_ca').html(vgtotal.toFixed(2));
				 jQuery("#totbaserent").html(retotal.toFixed(2))
				
				  });
				  
			  jQuery("input[name='exroadside']").on('click', function() {
				  
					  var baserate = jQuery("input[name='baserate1']").val();
					  var rental_opt = jQuery("input[name='rentalopt']").val();
					  if (ckbox1.is(':checked')) {
					chkId1 = jQuery(this).val();		
					var bindvaluen = parseFloat(chkId1) + parseFloat(rental_opt);		
					jQuery("input[name='rentalopt']").val(bindvaluen.toFixed(2));		
				}
				else
				{
					chkId1 = jQuery(this).val();		
					var bindvaluen = parseFloat(rental_opt) - parseFloat(chkId1) ;
					parseFloat(bindvaluen);
					jQuery("input[name='rentalopt']").val(bindvaluen.toFixed(2));
				}
				
				var rental_opt1 = jQuery("input[name='rentalopt']").val();
				jQuery("#rentaloption1").html(rental_opt1);	
				jQuery("#rentaloption").html(rental_opt1);	
				jQuery("#rentalrate_charge").val(rental_opt1);
				 var retotal = parseFloat(baserate) + parseFloat(rental_opt1);
				 var vtax= (parseFloat(retotal)*16)/100;
				 
				 var vgtotal= parseFloat(retotal) + parseFloat(vtax);
				 jQuery('#taxsc1').html(vtax.toFixed(2));
				 jQuery('#taxsc').html(vtax.toFixed(2));
				 jQuery('#total_ca1').html(vgtotal.toFixed(2));
				 jQuery('#total_ca').html(vgtotal.toFixed(2));
				 jQuery("#totbaserent1").html(retotal.toFixed(2));
				 jQuery("#totbaserent").html(retotal.toFixed(2));
			  });
			  
			  
			   jQuery("input[name='childsafety']").on('click', function() {
					  
					  var baserate = jQuery("input[name='baserate1']").val();
					  var rental_opt = jQuery("input[name='rentalopt']").val();
					  if (ckbox2.is(':checked')) {
					chkId2 = jQuery(this).val();		
					var bindvaluen2 = parseFloat(chkId2) + parseFloat(rental_opt);		
					jQuery("input[name='rentalopt']").val(bindvaluen2.toFixed(2));		
				}
				else
				{
					chkId2 = jQuery(this).val();		
					var bindvaluen2 = parseFloat(rental_opt) - parseFloat(chkId2) ;
					parseFloat(bindvaluen2);
					jQuery("input[name='rentalopt']").val(bindvaluen2.toFixed(2));
				}
						var rental_opt1 = jQuery("input[name='rentalopt']").val();
				jQuery("#rentaloption1").html(rental_opt1);	
				jQuery("#rentaloption").html(rental_opt1);
				jQuery("#rentalrate_charge").val(rental_opt1);
				 var retotal = parseFloat(baserate) + parseFloat(rental_opt1);
				 var vtax= (parseFloat(retotal)*16)/100;
				 
				 var vgtotal= parseFloat(retotal) + parseFloat(vtax);
				 jQuery('#taxsc1').html(vtax.toFixed(2));
				 jQuery('#total_ca1').html(vgtotal.toFixed(2));
				 jQuery("#totbaserent1").html(retotal.toFixed(2));
				 jQuery('#taxsc').html(vtax.toFixed(2));
				 jQuery('#total_ca').html(vgtotal.toFixed(2));
				 jQuery("#totbaserent").html(retotal.toFixed(2));
			  });

	jQuery("#continue_btnBtn").on("click",function(){

		var url = "http://carrentalwebsite.biz/reserve3/";
		var baserate = jQuery("input[name=baserate1]").attr("value");
		var timer1 = '<?php echo $_GET['timer1'];?>';
		var taxcharges = '<?php echo $_GET['taxcharges'];?>';
		var timer2 =  '<?php echo $_GET['timer2'];?>';
		var rentalopt = jQuery("input[name=rentalopt]").attr("value");
		//var totbaserent1 = jQuery("span#totbaserent1").html();
		var total_ca1 = jQuery("span#total_ca1").html();
		var taxsc1 = jQuery("span#taxsc1").html();
		
		var form = jQuery('<form action="' + url + '" method="get"><input type="text" name="VehicleType" value="<?php echo $_GET['VehicleType'];?>" /><input type="text" name="taxcharges" value="<?php echo $_GET['taxcharges'];?>" /><input type="text" name="PickUpLocation" value="<?php echo $PickUpLocation;?>" /><input type="text" name="DropOffLocation" value="<?php echo $DropOffLocation;?>" /><input type="text" name="baserate" value="'+baserate+'" /><input type="text" name="timer1" value="'+timer1+'" /><input type="text" name="timer2" value="'+timer2+'" /><input type="text" name="rentalopt" value="'+rentalopt+'" /><input type="text" name="total_ca1" value="'+total_ca1+'" /><input type="text" name="taxsc1" value="'+taxsc1+'" /><input type="text" name="vehid" value="<?php echo $vehtypeid;?>" /><input type="text" name="vehtype" value="<?php echo $checkvtype;?>" /><input type="text" name="vehploc" value="<?php echo $vehpiclocname;?>" /><input type="text" name="vehpdate" value="<?php echo $vehpdate;?>" /><input type="text" name="vehdloc" value="<?php echo $vehtypdroploc;?>" /><input type="text" name="vehddate" value="<?php echo $vehtypdpdate;?>" /></form>');
		jQuery('body').append(form);
		form.submit();
		
	});

	jQuery(document).find(".tab-content").find("div#messages").addClass("active");	
	//var chgmgsrc = "https://www4.rentcentric.com/Client5830V4/images/";
	jQuery.ajax({
		url: "http://carrentalwebsite.biz/wp-content/themes/grandcarrental/getrentaloptiondata.php",
		type: "POST",
		data: {
			vehid    : '<?php echo $vehtypeid;?>',
			vehtype  : '<?php echo $checkvtype;?>',
			vehploc  : '<?php echo $vehpiclocname;?>',
			vehpdate : '<?php echo $vehpdate;?>',
			vehdloc  : '<?php echo $drplocationname;?>',
			vehddate : '<?php echo $vehtypdpdate;?>',
			timer1 : '<?php echo $timer1;?>',
			timer2 : '<?php echo $timer2;?>',
		},
		success: function (jsonresult) {
			var j= JSON.parse(jsonresult);
			console.log(j);
			var desc = j['Description'];
			var getvprice = '<?php echo $getvprice;?>';
			var days = '<?php echo $_GET['days'];?>';
			var totalPrice = -days*getvprice;
			var vidnw = j['VehicleTypeID'];
			var dor = j['NumberOfDoors'];
			var lugs= j['Luggages'];
			var gears= j['NumberOfGears'];
			var passgers= j['noofpassengers'];
			var vehtypimg= j['vehtypeimg'];

			var pprntal = (getvprice*16)/100;
			var nntaml = getvprice + pprntal; 
			jQuery("#baserate1").html("$ "+totalPrice);
			//jQuery("#rentaloption1").html(<?php echo $rentaloptions;?>);
			//jQuery("input[name=rentalopt]").val(<?php echo $rentaloptions;?>);
			//jQuery("#baserate").html("$ "+totalPrice+" .00");
			jQuery("#dailyrate_charge").val(totalPrice);
			
			jQuery("input[name='baserate1']").val(totalPrice);
			//jQuery("#taxXCharges").html(<?php echo $taxcharges;?>);
			//jQuery("#totbaserent1").html(<?php echo $totalCharges;?>);
			jQuery("#total_ca1").html(<?php echo $totalCharges;?>);
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
jQuery(document).ready(function () {
    jQuery('#datetimepicker2, #datetimepicker2, #datetimepicker1').datetimepicker({
        locale: 'en'
    });
  
});
        </script>
		
		<script type="text/javascript">


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