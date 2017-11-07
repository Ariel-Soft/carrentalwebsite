<?php
/**
 * Template Name: Car List Right Sidebar(R)
 * The main template file for display car page.
 *
 * @package WordPress
*/
if(!is_null($post)){
	$page_obj = get_page($post->ID);
}
$current_page_id = '';
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
<link href="http://carrentalwebsite.biz/wp-content/themes/grandcarrental/css/bootstrap.css" rel="stylesheet" />
<link href="http://carrentalwebsite.biz/wp-content/themes/grandcarrental/css/datepicker.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700|Roboto:100,300,400,500,700,700i,900" rel="stylesheet">
<?php
$grandcarrental_page_content_class = grandcarrental_get_page_content_class();
get_template_part("/templates/template-header");
$wp_query = grandcarrental_get_wp_query();
$current_photo_count = $wp_query->post_count;
$all_photo_count = $wp_query->found_posts;
$processed = FALSE;
$ERROR_MESSAGE = '';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/GetLocations");
$curl_post_data1  = "{\"ClientId\":\"6189\",\"UserEmail\":\"ahmed.fattoh2@rentcentric.com\",\"Password\":\"Rent45\"}";
curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","content-type: application/json; charset=utf-8"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data1);
$result = curl_exec($ch);
$err = curl_error($ch);
if ($err) {	echo "cURL Error #:" . $err;} else {  $json = json_decode($result);}	
if(isset($_GET)){
	$picklocation = $_GET['PickUpLocation'];
	$droplocation= $_GET['DropOffLocation'];					
	$date1 = date_create($_GET['date1'].$_GET['timer1']);
	$pickupdate = date_format($date1, 'l, jS F Y \a\t g:ia');				 
	$date1pass = $_GET['date1'];
	$date2 = date_create($_GET['date2'].$_GET['timer2']);	
	$date2pass = $_GET['date2'];				
	$dropdate =  date_format($date2, 'l, jS F Y \a\t g:ia');				
	$vehicletype = $_GET['VehicleType'];
	$timer1 = $_GET['timer1'];
	$timer2 = $_GET['timer2'];			
	$var = 0;
}
if( isset($_GET['typeloca']) && $picklocation == "" ){
	$picklocation = $_GET['PickUpLocation'];						
}
if( isset($_GET['typedrploc']) && $droplocation == "" ){
	$droplocation = $_GET['DropOffLocation'];			
	$vehicletype= $_GET['typevhetype'];				
}
if($picklocation != ""){
	if($json){
		foreach ($json->LocationData as $item){
			if($item->LocationID == $picklocation ){
				$picklocationname =  $item->LocationName;
			}
			if($item->LocationID == $droplocation ){
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
			<li onclick="redirecttofirst('http://carrentalwebsite.biz/')"  role="presentation" ><a  href="" aria-controls="home" role="tab" data-toggle="tab">1 Pick up</a></li>
			<li onclick="redirecttosecond()"  role="presentation" <?php if($_GET['VehicleType']==0) { ?> class="active" <?php } ?> ><a href="" aria-controls="profile" role="tab" data-toggle="tab">2 Select Vehicle</a></li>
			<li role="presentation" <?php if($_GET['VehicleType']!= 0) { ?> class="active" <?php } ?> ><a href="" aria-controls="messages" role="tab" data-toggle="tab">3 Rental Option</a></li>
			<li role="presentation" ><a href="" aria-controls="settings" role="tab" data-toggle="tab">4 Your Information</a></li>
	  </ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane <?php if($_GET['VehicleType']== 0) { ?> active <?php } ?>" id="profile">
			<div class="">
				<div class="row">
					<div class="col-sm-3">
						<div class="tab_text ">
							<h5> Pick-Up </h5>
							<p><span id="lblPickupLocation" style="font-weight:bold;">
								<?php if($picklocationname != ""){ echo $picklocationname; } ?>
								</span>
							</p>
							<span id="LblPickupDateTime">
								<?php if($pickupdate !="") { echo $pickupdate; } ?>
							</span>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="tab_text">
							<h5> Return </h5>
							<p>
								<span id="lblReturnLocation" style="font-weight:bold;">
									<?php if($drplocationname != ""){ echo $drplocationname; } ?>
								</span>
							</p>
							<span id="lblReturnDateTime">
								<?php if($dropdate !="" ){ echo $dropdate; } ?>
							</span>
						</div>
					</div>
				</div>						
			</div>
			<div class="inner_wrapper nopadding form_margin_top">						
			<?php
			if(!empty($post->post_content) && empty($term)){
			?>
				<div class="standard_wrapper">
					<?php echo grandcarrental_apply_content($post->post_content); ?>
				</div>
				<br class="clear"/><br/>
	  <?php } ?>
				<div id="page_main_content" class="sidebar_content fixed_column">						
				<?php
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/GetVehicleTypes");
					$curl_post_dataveh2  = "{\"ClientId\":\"6189\",\"UserEmail\":\"ahmed.fattoh2@rentcentric.com\",\"Password\":\"Rent45\",\"PickupDate\":\"$date1pass\",\"PickupLocation\":\"$picklocationname\",\"PickupTime\":\"$timer1\",\"DropOffDate\":\"$date2pass\",\"DropOffLocation\":\"$drplocationname\",\"DropOffTime\":\"$timer2\"}";
					curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","content-type: application/json; charset=utf-8"));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_dataveh2);
					$record1s = curl_exec($ch);
					$errc = curl_error($ch);
					if ($errc) { echo "cURL Error #:" . $errc;} else{$vehic = json_decode($record1s );} 				
					curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/GetVehiclesAndRates");
					$curl_post_datarate2  = "{\"ClientId\":\"6189\",\"UserEmail\":\"ahmed.fattoh2@rentcentric.com\",\"Password\":\"Rent45\",\"PickupDate\":\"$date1pass\",\"LocationID\":\"116\",\"PickupLocation\":\"$picklocation\",\"PickupTime\":\"$timer1\",\"DropOffDate\":\"$date2pass\",\"DropOffLocation\":\"$droplocation\",\"DropOffTime\":\"$timer2\"}";
					curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","content-type: application/json; charset=utf-8"));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_datarate2);
					$recrate = curl_exec($ch);
					$errrc = curl_error($ch);
					if ($errrc) {echo "cURL Error #:" . $errrc;	}else { $vehicrates = json_decode($recrate );} 
				?>
				<form id="car_search_form" name="car_search_form" method="get" action="<?php echo get_the_permalink($id); ?>">
					<input type="hidden" name="PickUpLocation" value="<?php  echo $_GET['PickUpLocation']; ?>" />
					<input type="hidden" name="DropOffLocation" value="<?php  echo $_GET['DropOffLocation']; ?>" />
					<input type="hidden" name="typeloca" value="<?php  echo $picklocationname; ?>" />
					<input type="hidden" name="typedrploc" value="<?php echo $drplocationname;?>" />
					<input type="hidden" name="typevhetype" value="<?php  echo $vehicletype; ?>" />
					<input type="hidden" name="date1" value="<?php echo $_GET['date1'];?>" />
					<input type="hidden" name="date2" value="<?php  echo $_GET['date2']; ?>" />
					<input type="hidden" name="timer1" value="<?php  echo $_GET['timer1']; ?>" />
					<input type="hidden" name="timer2" value="<?php  echo $_GET['timer2']; ?>" />
					<div class="car_search_wrapper">
						<div class="one_third themeborder">	    	
							<select id="type" name="type">
								<option value=""><?php esc_html_e('Any Type', 'grandcarrental' ); ?></option>
								<?php
								if($vehic){
									foreach($vehic->VehicleTypes as $itemc){						
								?>
									<option value="<?php echo $itemc->VehicleTypeName; ?>" <?php if(isset($_GET['type']) && $_GET['type']==$itemc->VehicleTypeName) { ?> selected <?php } ?>><?php echo $itemc->VehicleTypeName; ?></option>
								<?php	
									}
								}
								?>							
							</select>
							
						</div>
						<div class="one_third themeborder">   		
							<select id="sort_by" name="sort_by">
								<option value="">Select</option>							
								<option value="price_low" <?php if(isset($_GET['sort_by']) && $_GET['sort_by']== price_low  ) { ?> selected <?php } ?>>Price Low to High</option>
								<option value="price_high"<?php if(isset($_GET['sort_by']) && $_GET['sort_by']== price_high ) { ?>selected<?php } ?>>Price High to Low</option>																		
							</select>
							
						</div>
						<div class="one_third last themeborder">
							<input id="car_search_btn" type="submit" class="button" value="<?php echo _e( 'Search', 'grandcarrental' ); ?>"/>
						</div>
					</div>
				</form>
				<div class="clearfix"></div>
				<?php
				//echo"<pre>";print_r($vehicrates);die();
				$users = $vehicrates->VehiclesAndRatesInfos;
				if(@$_GET['sort_by']== 'price_low' ){
					if (function_exists('my_sort')){
						echo "Function Exists"; 
					}else{				
						function my_sort($a, $b){
							if ($a->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge < $b->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge) {
								return -1;
							} else if ($a->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge > $b->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge) {
								return 1;
							} else { 
								return 0; 
							}
						}
					}
					usort($users, 'my_sort');
					//echo"<pre>";print_r($users);die();
					$j=0;
					foreach($users as $datat){?>
						<div class="car_div" id="<?php echo $datat->VehiclesAndRatesVTypeInfo->VehicleTypeID;  ?>"> 
							<div class="row" id="msgchnow-<?php echo $j; ?>" data-getloop="<?php echo $j; ?>"  >
								<div class="col-md-4 col-sm-4 col-xs-4">
									<div class="red_car"><img src="<?php echo "//".$datat->VehiclesAndRatesVTypeInfo->VehicleTypeImageURL; ?>" alt=""></div>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<div class="red_car">
										<h3><?php echo $datat->VehiclesAndRatesVTypeInfo->VehicleTypeName; ?></h3>
										<h5><?php echo $datat->VehiclesAndRatesVTypeInfo->memo; ?></h5>
										<h5 class="view_hd"><a data-pickuploctn="<?php echo $picklocationname; ?>" data-v_id="<?php echo $datat->VehiclesAndRatesVTypeInfo->VehicleTypeID;  ?>" onclick="getvehtypeinfrm(<?php echo $datat->VehiclesAndRatesVTypeInfo->VehicleTypeID;  ?>, this.getAttribute('data-pickuploctn'),'<?php echo $_GET['date1'];?>','<?php echo $_GET['date2'];?>','<?php echo $_GET['timer1']?>','<?php echo $_GET['timer2'];?>','<?php echo $drplocationname; ?>');" href="" title=""  data-toggle="modal" data-target="#myModal">View Vehicle Information</a></h5>
									</div>
								</div>
								<!--<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="red_car mrg_top">										
										<h3>Payment Options</h3>
										<div>
											<a class="amex_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/amex.jpg" alt=""></a>
											<a class="moster_img" href="#" title=""><img src="<?php echo 	get_template_directory_uri(); ?>/images/moster.jpg" alt=""></a>
											<a class="visa_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/visa.jpg" alt=""></a>
										</div>
									</div>
								</div>-->
								<div class="col-md-4 col-sm-4 col-xs-4">				
									<div class="btn_div">											
									<?php 
										$checkrate="";
										$rental_charges="";
										$tax_charges="";
										$total="";
										$checkrate = $datat->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge;?>
										<h2>$<?php echo $datat->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge; ?> <span class="vehicleDays">/day</span></h2>
										<?php
										$rental_charges = $datat->VehiclesAndRatesRateInfos[0]->RentalRateCharges;
										$total = $datat->VehiclesAndRatesRateInfos[0]->TotalCharges;
										$tax_charges = $datat->VehiclesAndRatesRateInfos[0]->TotalTaxCharges;												
										if($checkrate==""){
											$checkrate=45;
											?>
											<h2>$<?php echo $checkrate; ?> <span class="vehicleDays">/day</span></h2><?php
										}?>
										<div class="clearfix"></div>
										<a data-picklocaid="<?php echo $picklocationname; ?>" data-datepic="<?php echo $date1pass; ?>" data-droploc="<?php echo $drplocationname; ?>" data-dropdte="<?php echo $date2pass; ?>"  data-vehicletypepas="<?php echo $vehicletype; ?>" data-rental_id="<?php echo $rental_charges;?>" data-taxcharges="<?php echo $tax_charges;?>" data-total_charges="<?php echo $total;?>" data-prc="<?php echo $checkrate; ?>" data-v_id="<?php echo $itemc->VehicleTypeid;  ?>" class="marg_right tabbingchane" href="#" title="" aria-controls="messages" role="tab" data-toggle="tab" >Pay Now</a>
										<a data-picklocaid="<?php echo $picklocationname; ?>" data-datepic="<?php echo $date1pass; ?>" data-taxcharges="<?php echo $tax_charges;?>" data-droploc="<?php echo $drplocationname; ?>" data-total_charges="<?php echo $total;?>"  data-rental_id="<?php echo $rental_charges;?>" data-dropdte="<?php echo $date2pass; ?>" data-vehicletypepas="<?php echo $vehicletype; ?>" data-prc="<?php echo $checkrate; ?>" data-v_id="<?php echo $itemc->VehicleTypeid;  ?>" class="tabbingchane" href="#" title="" aria-controls="messages" role="tab" data-toggle="tab">Pay Later</a>
									</div>					
								</div>
							</div>
						</div>	
							
						<?php  $j++;
					}	
				}
				
				if(@$_GET['sort_by']== 'price_high' ){
					if (function_exists('my_sort')){
						echo "Function Exists"; 
					}else{				
						function my_sort($a, $b){
							if ($a->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge > $b->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge) {
								return -1;
							} else if ($a->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge < $b->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge) {
								return 1;
							} else {
								return 0; 
							}
						}
					}
					usort($users, 'my_sort');
					$j=0;
					foreach($users as $datat){?>
						<div class="car_div" id="<?php echo $datat->VehiclesAndRatesVTypeInfo->VehicleTypeID;  ?>"> 
							<div class="row" id="msgchnow-<?php echo $j; ?>" data-getloop="<?php echo $j; ?>"  >
								<div class="col-md-4 col-sm-4 col-xs-4">
									<div class="red_car"><img src="<?php echo "//".$datat->VehiclesAndRatesVTypeInfo->VehicleTypeImageURL; ?>" alt=""></div>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<div class="red_car">
										<h3><?php echo $datat->VehiclesAndRatesVTypeInfo->VehicleTypeName; ?></h3>
										<h5><?php echo $datat->VehiclesAndRatesVTypeInfo->memo; ?></h5>
										<h5 class="view_hd"><a data-pickuploctn="<?php echo $picklocationname; ?>" data-v_id="<?php echo $datat->VehiclesAndRatesVTypeInfo->VehicleTypeID;  ?>" onclick="getvehtypeinfrm(<?php echo $datat->VehiclesAndRatesVTypeInfo->VehicleTypeID;  ?>, this.getAttribute('data-pickuploctn'),'<?php echo $_GET['date1'];?>','<?php echo $_GET['date2'];?>','<?php echo $_GET['timer1']?>','<?php echo $_GET['timer2'];?>','<?php echo $drplocationname; ?>');" href="" title=""  data-toggle="modal" data-target="#myModal">View Vehicle Information</a></h5>
									</div>
								</div>
								<!--<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="red_car mrg_top">										
										<h3>Payment Options</h3>
										<div>
											<a class="amex_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/amex.jpg" alt=""></a>
											<a class="moster_img" href="#" title=""><img src="<?php echo 	get_template_directory_uri(); ?>/images/moster.jpg" alt=""></a>
											<a class="visa_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/visa.jpg" alt=""></a>
										</div>
									</div>
								</div>-->
								<div class="col-md-4 col-sm-4 col-xs-4">				
									<div class="btn_div">											
									<?php 
										$checkrate="";
										$rental_charges="";
										$tax_charges="";
										$total="";
										$checkrate = $datat->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge;?>
										<h2>$<?php echo $datat->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge; ?> <span class="vehicleDays">/day</span></h2>
										<?php
										$rental_charges = $datat->VehiclesAndRatesRateInfos[0]->RentalRateCharges;
										$total = $datat->VehiclesAndRatesRateInfos[0]->TotalCharges;
										$tax_charges = $datat->VehiclesAndRatesRateInfos[0]->TotalTaxCharges;												
										if($checkrate==""){
											$checkrate=45;
											?>
											<h2>$<?php echo $checkrate; ?> <span class="vehicleDays">/day</span></h2><?php
										}?>
										<div class="clearfix"></div>
										<a data-picklocaid="<?php echo $picklocationname; ?>" data-datepic="<?php echo $date1pass; ?>" data-droploc="<?php echo $drplocationname; ?>" data-dropdte="<?php echo $date2pass; ?>"  data-vehicletypepas="<?php echo $vehicletype; ?>" data-rental_id="<?php echo $rental_charges;?>" data-taxcharges="<?php echo $tax_charges;?>" data-total_charges="<?php echo $total;?>" data-prc="<?php echo $checkrate; ?>" data-v_id="<?php echo $itemc->VehicleTypeid;  ?>" class="marg_right tabbingchane" href="#" title="" aria-controls="messages" role="tab" data-toggle="tab" >Pay Now</a>
										<a data-picklocaid="<?php echo $picklocationname; ?>" data-datepic="<?php echo $date1pass; ?>" data-taxcharges="<?php echo $tax_charges;?>" data-droploc="<?php echo $drplocationname; ?>" data-total_charges="<?php echo $total;?>"  data-rental_id="<?php echo $rental_charges;?>" data-dropdte="<?php echo $date2pass; ?>" data-vehicletypepas="<?php echo $vehicletype; ?>" data-prc="<?php echo $checkrate; ?>" data-v_id="<?php echo $itemc->VehicleTypeid;  ?>" class="tabbingchane" href="#" title="" aria-controls="messages" role="tab" data-toggle="tab">Pay Later</a>
									</div>					
								</div>
							</div>
						</div>	
							
						<?php  $j++;
					}	
					
				}
				
				//echo"<pre>";print_r($vehic->VehicleTypes);
				if(!empty($vehic->VehicleTypes) && empty($_GET['sort_by'])){
					//	echo"if";die();
					$img= 0;	
					foreach ($vehic->VehicleTypes as $itemc) {
						if( isset($_GET['typeloca']) && $_GET['type']!=""  ){	
							if($_GET['type'] == $itemc->VehicleTypeName ){
						?>
								<div class="car_div" id="<?php echo $itemc->VehicleTypeid;  ?>"> 
									<div class="row" id="msgchnow-<?php echo $img; ?>" data-getloop="<?php echo $img; ?>"  >
										<div class="col-md-4 col-sm-4 col-xs-4">
											<div class="red_car"><img src="<?php echo "//".$itemc->VehicleTypeImage; ?>" alt=""></div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4">
											<div class="red_car">
												<h3><?php echo $itemc->VehicleTypeName; ?></h3>
												<h5><?php echo $itemc->memo; ?></h5>
												<h5 class="view_hd"><a data-pickuploctn="<?php echo $picklocationname; ?>" data-v_id="<?php echo $itemc->VehicleTypeid;  ?>" onclick="getvehtypeinfrm(<?php echo $itemc->VehicleTypeid;  ?>, this.getAttribute('data-pickuploctn'),'<?php echo $_GET['date1'];?>','<?php echo $_GET['date2'];?>','<?php echo $_GET['timer1']?>','<?php echo $_GET['timer2'];?>','<?php echo $drplocationname; ?>');" href="" title=""  data-toggle="modal" data-target="#myModal">View Vehicle Information</a></h5>
											</div>
										</div>
																					
										<div class="col-md-4 col-sm-4 col-xs-4">				
											<div class="btn_div">												
											<?php 
												$checkrate="";
												if($vehicrates){
													foreach($vehicrates->VehiclesAndRatesInfos as $chrate){	
														if($chrate->VehiclesAndRatesVTypeInfo->VehicleTypeName == $itemc->VehicleTypeName ){
															$checkrate = $chrate->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge;
															?>
															<h2>$
															<?php echo $chrate->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge; ?> <span class="vehicleDays">/day</span></h2><?php
														}
													}
												}
												if($checkrate==""){
													$checkrate=45;
												?>
													<h2>$<?php echo $checkrate; ?> <span class="vehicleDays">/day</span></h2><?php
												}
												?>
												<div class="clearfix"></div>
												<a data-picklocaid="<?php echo $picklocationname; ?>" data-datepic="<?php echo $date1pass; ?>" data-droploc="<?php echo $drplocationname; ?>" data-dropdte="<?php echo $date2pass; ?>"  data-vehicletypepas="<?php echo $vehicletype; ?>" data-prc="<?php echo $checkrate; ?>" data-v_id="<?php echo $itemc->VehicleTypeid;  ?>" class="marg_right tabbingchane" href="" title="" aria-controls="messages" role="tab" data-toggle="tab" >Pay Now</a>
												<a data-picklocaid="<?php echo $picklocationname; ?>" data-datepic="<?php echo $date1pass; ?>" data-droploc="<?php echo $drplocationname; ?>" data-dropdte="<?php echo $date2pass; ?>" data-vehicletypepas="<?php echo $vehicletype; ?>" data-prc="<?php echo $checkrate; ?>" data-v_id="<?php echo $itemc->VehicleTypeid;  ?>" class="tabbingchane" href="" title="" aria-controls="messages" role="tab" data-toggle="tab">Pay Later</a>
											</div>					
										</div>
									</div>
								</div>
								<?php 
									$img ++;		
							}	
						}
						
						else{ 
						?>
							
							<div class="car_div" id="<?php echo $itemc->VehicleTypeid;  ?>"> 
								<div class="row" id="msgchnow-<?php echo $img; ?>" data-getloop="<?php echo $img; ?>"  >
									<div class="col-md-4 col-sm-4 col-xs-6">
										<div class="red_car"><img src="<?php echo "//".$itemc->VehicleTypeImage; ?>" alt=""></div>
									</div>
									<div class="col-md-4 col-sm-4 col-xs-6">
										<div class="red_car">
											<h3><?php echo $itemc->VehicleTypeName; ?></h3>
											<h5><?php echo $itemc->memo; ?></h5>
											<h5 class="view_hd"><a data-pickuploctn="<?php echo $picklocationname; ?>" data-v_id="<?php echo $itemc->VehicleTypeid;  ?>" onclick="getvehtypeinfrm(<?php echo $itemc->VehicleTypeid;  ?>, this.getAttribute('data-pickuploctn'),'<?php echo $_GET['date1'];?>','<?php echo $_GET['date2'];?>','<?php echo $_GET['timer1']?>','<?php echo $_GET['timer2'];?>','<?php echo $drplocationname; ?>');" href="" title=""  data-toggle="modal" data-target="#myModal">View Vehicle Information</a></h5>
										</div>
									</div>
									
									<div class="col-md-4 col-sm-4 col-xs-12">				
										<div class="btn_div">												
										<?php 
											$checkrate="";
											$rental_charges="";
											$tax_charges="";
											$total="";
											if($vehicrates){
												foreach($vehicrates->VehiclesAndRatesInfos as $chrate){		
													if($chrate->VehiclesAndRatesVTypeInfo->VehicleTypeName == $itemc->VehicleTypeName ){
														$checkrate = $chrate->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge;
													?>
														<h2>$<?php echo $chrate->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge; ?> <span class="vehicleDays">/day</span></h2>
													<?php
														$rental_charges = $chrate->VehiclesAndRatesRateInfos[0]->RentalRateCharges;
														$total = $chrate->VehiclesAndRatesRateInfos[0]->TotalCharges;
														$tax_charges = $chrate->VehiclesAndRatesRateInfos[0]->TotalTaxCharges;
													}
												}
											} 
											if($checkrate==""){
												$checkrate=45;
											?>
												<h2>$<?php echo $checkrate; ?> <span class="vehicleDays">/day</span></h2><?php
											}?>
											<div class="clearfix"></div>
											<a data-picklocaid="<?php echo $picklocationname; ?>" data-datepic="<?php echo $date1pass; ?>" data-droploc="<?php echo $drplocationname; ?>" data-dropdte="<?php echo $date2pass; ?>"  data-vehicletypepas="<?php echo $vehicletype; ?>" data-rental_id="<?php echo $rental_charges;?>" data-taxcharges="<?php echo $tax_charges;?>" data-total_charges="<?php echo $total;?>" data-prc="<?php echo $checkrate; ?>" data-v_id="<?php echo $itemc->VehicleTypeid;  ?>" class="marg_right tabbingchane" href="#" title="" aria-controls="messages" role="tab" data-toggle="tab" >Pay Now</a>
											<a data-picklocaid="<?php echo $picklocationname; ?>" data-datepic="<?php echo $date1pass; ?>" data-taxcharges="<?php echo $tax_charges;?>" data-droploc="<?php echo $drplocationname; ?>" data-total_charges="<?php echo $total;?>"  data-rental_id="<?php echo $rental_charges;?>" data-dropdte="<?php echo $date2pass; ?>" data-vehicletypepas="<?php echo $vehicletype; ?>" data-prc="<?php echo $checkrate; ?>" data-v_id="<?php echo $itemc->VehicleTypeid;  ?>" class="tabbingchane" href="#" title="" aria-controls="messages" role="tab" data-toggle="tab">Pay Later</a>
										</div>					
									</div>
								</div>
							</div>
							<?php 
							$img ++;
						}
					}
				}else{
					//echo"No Vehicles Found for this route!";
				}
				?>
				</div>
				<div class="sidebar_wrapper">
					<div class="sidebar">
						<div class="content">
						<?php 
							$page_sidebar = sanitize_title($page_sidebar);
								if (is_active_sidebar($page_sidebar)) { ?>
									<ul class="sidebar_widget">
										<?php dynamic_sidebar($page_sidebar); ?>
									</ul>
					<?php 		} ?>						  
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<div role="tabpanel" class="tab-pane <?php if($_GET['VehicleType']!= 0) { ?> active <?php } ?>" id="messages">	
			<div class="">
				<div class="row">
					<div class="col-sm-3">
						<div class="tab_text ">
							<h5> Pick-Up </h5>
							<p> 
								<span id="lblPickupLocation" style="font-weight:bold;"><?php 
								if($picklocation != "")
								{ echo $picklocationname; } ?></span>
							</p>
							<span id="LblPickupDateTime"><?php if($pickupdate !="") { echo $pickupdate; } ?></span>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="tab_text">
							<h5> Return </h5>
							<p> 
								<span id="lblReturnLocation" style="font-weight:bold;"><?php if($droplocation != ""){
								echo $drplocationname; } ?></span>
							</p>
							<span id="lblReturnDateTime"><?php if($dropdate !="" ){ echo $dropdate; } ?></span>
						</div>
					</div>
				</div>
			</div>
			<?php  
			if($_GET['VehicleType']!= 0) {
				curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/GetVehicleTypes");
				$curl_post_dataveh2  = "{\"ClientId\":\"6189\",\"UserEmail\":\"ahmed.fattoh2@rentcentric.com\",\"Password\":\"Rent45\",\"PickupDate\":\"$date1pass\",\"PickupLocation\":\"$picklocationname\",\"PickupTime\":\"$timer1\",\"DropOffDate\":\"$date2pass\",\"DropOffLocation\":\"$drplocationname\",\"DropOffTime\":\"$timer2\"}";
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","content-type: application/json; charset=utf-8"));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_dataveh2);
				$record1s = curl_exec($ch);
				$errc = curl_error($ch);
				if ($errc) { echo "cURL Error #:" . $errc;} else{ $vehic = json_decode($record1s );}
				curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/GetVehiclesAndRates");
				$curl_post_datarate2  = "{\"ClientId\":\"6189\",\"UserEmail\":\"ahmed.fattoh2@rentcentric.com\",\"Password\":\"Rent45\",\"PickupDate\":\"$date1pass\",\"LocationID\":\"116\",\"PickupLocation\":\"$picklocation\",\"PickupTime\":\"$timer1\",\"DropOffDate\":\"$date2pass\",\"DropOffLocation\":\"$droplocation\",\"DropOffTime\":\"$timer2\"}";
				curl_setopt($ch,CURLOPT_HTTPHEADER, array("cache-control: no-cache","content-type: application/json; charset=utf-8"));
				curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch,CURLOPT_POST, true);
				curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch,CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
				curl_setopt($ch,CURLOPT_POSTFIELDS, $curl_post_datarate2);
				$recrate = curl_exec($ch);
				$errrc = curl_error($ch);
				if ($errrc) {echo "cURL Error #:" . $errrc;	}else {  $vehicrates = json_decode($recrate );}					
				if($vehic){
					foreach ($vehic->VehicleTypes as $item){
						if($item->VehicleTypeid == $_GET['VehicleType']){
					?>	
						<input type="hidden" name="vehicleidrental" value="" />
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
							$TotalCharges="";
							$iva="";
							if($vehicrates){								
								foreach($vehicrates->VehiclesAndRatesInfos as $chrate){								
									if($chrate->VehiclesAndRatesVTypeInfo->VehicleTypeName == $item->VehicleTypeName){									
										$checkrate = $chrate->VehiclesAndRatesRateInfos[0]->RateInfo->DailyRateCharge;
										$iva = $chrate->VehiclesAndRatesRateInfos[0]->TotalTaxCharges;
										$TotalCharges = $chrate->VehiclesAndRatesRateInfos[0]->TotalCharges;	
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
											<div class="col-sm-3 col-xs-6 v_doors">
												<div class="lexus_icon lexus_icon2">
													<img src="<?php echo get_template_directory_uri(); 	?>/images/car_cion.png" alt="">
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
									<?php 
										$start = strtotime($date1pass);
										$end = strtotime($date2pass);
										$days_between = ceil(abs($end - $start) / 86400);
									?>
										<td><h4>Base Rate</h4></td>
										<td><h4><input type="hidden" name="baserate1" value="<?php echo $checkrate*$days_between; ?>" /><span id="baserate1">$ <?php echo $checkrate*$days_between; ?>.00</span></h4></td>
									</tr>
									<tr>
										<td><h4>Rental Options</h4></td>
										<td><h4><input type="hidden" name="rentalopt" value="0.00" /> <span>$ </span><span id="rentaloption1">0.00</span></h4></td>
									</tr>
									<tr>
										<td><h4>Total</h4></td>
										<td><h4><span>$ </span><span id="totbaserent1"><?php echo $checkrate*$days_between; ?>.00</span></h4></td>
									</tr>
									<tr>
										<td><h4>Taxes</h4></td>
										<td></td>
									</tr>
									<tr>
										<td><h4>IVA @ 16%</h4></td>	
										<td><h4><span>$ </span><span id="taxsc1"><?php if($iva){echo $iva;}else{echo"0.0";} ?></span></h4></td>
									</tr>
									<tr>
										<td><h4>Total</h4></td>
										<td><h4><span>$ </span><span id="total_ca1"><?php if($TotalCharges){echo $TotalCharges;}else{echo"0.0";}?></span></h4></td>
									</tr>
								</tbody>
							</table>				
						</div>
						<div class="service_div border_top service_div2">
							<h5>Equipment & Services</h5>						
							<h4>SIRIUS XM Satellite Radio</h4>
							<span>Make your drive come alive with SiriusXM<b>&reg;</b> Satellite Radio.</span>
							<form class="form_btn">
								<label><input type="checkbox" name="sateliteradio" value="<?php echo 6.99*$days_between;?>"> $6.99/Day</label>
								<div class="clearfix"></div>
							</form>
						</div>
						<div class="service_div border_top safety_div">
							<h4>Extended Roadside Assistance</h4>
							<span>Pease of Mind for unexpected emergencies. Get fast, reliable 24/7 service when you need it most.</span>
							<form class="form_btn">
								<label><input type="checkbox" name="exroadside" value="<?php echo 16.99*$days_between;?>"> $16.99/Day</label>
								<div class="clearfix"></div>
							</form>
						</div>
						<div class="service_div border_top safety_div">
							<h4>Child Safety Seats</h4>
							<span>Keep kids safe when travelling with our child safety seats.</span>
							<form class="form_btn">
								<label><input type="checkbox" name="childsafety" value="<?php echo 6.99*$days_between;?>"> $6.99/Day</label>
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
			}else {
				?>
				<input type="hidden" name="vehicleidrental" value="" />			
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
							<?php 
								$start = strtotime('2010-01-25');
								$end = strtotime('2010-02-20');
								echo $days_between = ceil(abs($end - $start) / 86400);
							?>
								<td><h4>Base Rate</h4></td>
								<td><h4><input type="hidden" name="baserate1" value="0.00" /><span id="baserate1">$ 15.00</span></h4></td>
							</tr>
							<tr>
								<td><h4>Rental Options</h4></td>
								<td><h4><input type="hidden" name="rentalopt" value="0.00" /> <span>$ </span><span id="rentaloption1">0.00</span></h4></td>
							</tr>
							<tr>
								<td><h4>Total</h4></td><td><h4><span>$ </span><span id="totbaserent1">15.00</span></h4></td>
							</tr>
							<tr>
								<td><h4>Taxes</h4></td>
								<td></td>
							</tr>
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
						<label class="continue_btn"><a href="#" title="" id="continue_btnBtn" >Continue</a></label>
						<div class="clearfix"></div>
					</form>
				</div>
	<?php   } ?>
		</div>
	</div>
	</div>
</div>
</div>
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
<script src='<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js'></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/js/bootstrap-datetimepicker.min.js"></script>
<script>
jQuery(document).ready(function(){
	jQuery("#continue_btnBtn").on("click",function(){
		//alert("cntinueee");
		var url = "http://carrentalwebsite.biz/reserve3/";
		var baserate = jQuery("input[name=baserate1]").attr("value");
		var timer1 = '<?php echo $_GET['timer1'];?>';
	//	var taxcharges = '<?php echo $_GET['taxcharges'];?>';
		var timer2 =  '<?php echo $_GET['timer2'];?>';
		var rentalopt = jQuery("input[name=rentalopt]").attr("value");
		//var totbaserent1 = jQuery("span#totbaserent1").html();
		var total_ca1 = jQuery("span#total_ca1").html();
		var taxsc1 = jQuery("span#taxsc1").html();
		
		var form = jQuery('<form action="' + url + '" method="get"><input type="text" name="VehicleType" value="<?php echo $_GET['VehicleType'];?>" /><input type="text" name="PickUpLocation" value="<?php echo $PickUpLocation;?>" /><input type="text" name="DropOffLocation" value="<?php echo $DropOffLocation;?>" /><input type="text" name="baserate" value="'+baserate+'" /><input type="text" name="timer1" value="'+timer1+'" /><input type="text" name="timer2" value="'+timer2+'" /><input type="text" name="rentalopt" value="'+rentalopt+'" /><input type="text" name="total_ca1" value="'+total_ca1+'" /><input type="text" name="taxsc1" value="'+taxsc1+'" /><input type="text" name="vehid" value="<?php echo $_GET['VehicleType'];?>" /><input type="text" name="vehtype" value="<?php echo $_GET['VehicleType'];?>" /><input type="text" name="vehploc" value="<?php echo $picklocationname;?>" /><input type="text" name="vehpdate" value="<?php echo $date1pass;?>" /><input type="text" name="vehdloc" value="<?php echo $drplocationname;?>" /><input type="text" name="vehddate" value="<?php echo $date2pass;?>" /></form>');
		jQuery('body').append(form);
		form.submit();
		
	});
});

function redirecttofirst(url1)	{
		window.history.go(-1);
	}
	function redirecttosecond(){
		window.history.go(-1);
		jQuery("div#page_main_content > form#car_search_form").css("display","none");
	}
	
	
jQuery(document).ready(function(){
	jQuery(".btn_div > a").on("click",function(){
		var getvhid= this.getAttribute('data-v_id');
		var getvprice = this.getAttribute('data-prc');	
		var getvvtype = this.getAttribute('data-vehicletypepas');
		var getvehploc = this.getAttribute('data-picklocaid');
		var getvehpdat = this.getAttribute('data-datepic');
		var rental_id = this.getAttribute('data-rental_id');
		var total_charges = this.getAttribute('data-total_charges');
		var taxcharges = this.getAttribute('data-taxcharges');
		var getvehdloc = this.getAttribute('data-droploc');
		var getvehddat = this.getAttribute('data-dropdte');
		var firstDate = '<?php echo $_GET['date1'];?>';
		var secondDate = '<?php echo $_GET['date2'];?>';
		var startDay = new Date(firstDate);
		var endDay = new Date(secondDate);
		var millisecondsPerDay = 1000 * 60 * 60 * 24;
		var millisBetween = endDay - startDay;
		var day = millisBetween / millisecondsPerDay;	
		var days = Math.round(day);	
		
		var url = "http://carrentalwebsite.biz/reserve2/";
		var form = jQuery('<form action="' + url + '" method="get"><input type="text" name="vehid" value="'+getvhid+'" /><input type="text" name="vehtype" value="'+getvvtype+'" /><input type="text" name="days" value="'+days+'" /><input type="text" name="getvprice" value="'+getvprice+'" /><input type="text" name="vehdloc" value="'+getvehdloc+'" /><input type="text" name="vehploc" value="'+getvehploc+'" /><input type="text" name="getvehddat" value="'+getvehddat+'" />" /><input type="text" name="getvehpdat" value="'+getvehpdat+'"><input type="text" name="PickUpLocation" value="<?php echo $_GET['PickUpLocation'];?>" /><input type="text" name="DropOffLocation" value="<?php echo $_GET['DropOffLocation'];?>" /><input type="text" name="timer1" value="<?PHP echo $_GET['timer1'];?>" /><input type="text" name="timer2" value="<?PHP echo $_GET['timer2'];?>"><input type="text" name="rentaloptions" value="'+rental_id+'"><input type="text" name="totalCharges" value="'+total_charges+'"><input type="text" name="taxcharges" value="'+taxcharges+'"></form>');
		jQuery('body').append(form);
		form.submit();
	});
});

function getvehtypeinfrm(vehid, veloc,pickupdate,dropoffdate,pickuptime,dropofftime,droploc){ 
	var params = 'eid=' +vehid+'&timer1='+pickuptime+'&timer2='+dropofftime+'&pickupdate='+pickupdate+'&dropoffdate='+dropoffdate+'&droploc='+droploc+'&pwd='+veloc;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "http://carrentalwebsite.biz/wp-content/themes/grandcarrental/getvehicletpyeinfo.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.onreadystatechange = function() {//Call a function when the state changes.
		if(xhttp.readyState == 4 && xhttp.status == 200) {
			var opendataa = JSON.parse(xhttp.responseText);
			var openvehgetid = opendataa['VehicleTypeid'];
			var VehicleImage = '//'+opendataa['VehicleImage'];
			var openvehgetname = opendataa['VehicleTypeName'];
			var openvehgetpass = opendataa['NumberOfSeats'];
			var openvehgetlugg = opendataa['lugg'];
			var openvehgetdor = opendataa['NumberOfDoors'];
			document.getElementById("openvehicleid").value = openvehgetid;
			jQuery("#openvehiclenme").find("img").attr("src",VehicleImage);
			document.getElementsByClassName("nameevEHICLE")[0].innerHTML = openvehgetname;
			document.getElementById("openvehiclepassger").innerHTML = openvehgetpass+ " Passengers";
			document.getElementById("openvehiclelugg").innerHTML = openvehgetlugg+ " Luggages";
			document.getElementById("openvehicledor").innerHTML = openvehgetdor+" doors";
		}
	}
	xhttp.send(params);
}
jQuery(document).ready(function (){
	jQuery('#infrdatetimepicker2, #datetimepicker3').datetimepicker({								locale: 'en',
		format: 'D/MM/YY'
	});
});

jQuery(function () {
	jQuery('#infor_liceexp').datetimepicker({
		locale: 'en',
		format: 'D/MM/YY'
	});
	jQuery('#infrdatetimepicker2').datetimepicker({
		locale: 'en',
		format: 'D/MM/YY'
	});			
});
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bezier.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
<script>
	jQuery(document).ready(function(){
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
				var bindvalue = parseFloat(chkId) + parseFloat(rental_opt);		
				jQuery("input[name='rentalopt']").val(bindvalue.toFixed(2));		
			} else{
				chkId = jQuery(this).val();
				var bindvalue = parseFloat(rental_opt) - parseFloat(chkId) ;
				parseFloat(bindvalue);
				jQuery("input[name='rentalopt']").val(bindvalue.toFixed(2));
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
			else{
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
			else{
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
	});
	
	jQuery('.nav-tabs').on('hide.bs.tab', 'a', function(event) {
		event.preventDefault();
	});
	jQuery(document).keyup(function(event){
        if (event.which == 8) {
           
        }	
    });
</script>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" tabindex='-1'>
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content popupContent">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body popUpmediaBody">
        <div class="lexus_div">
					<input id="openvehicleid" type="hidden" name="vehicl_id" class="getvehidnow" value="100"> 
						<h2 id="openvehiclenme"><img src="" style="width:150px;padding-right:10px;"><span class="nameevEHICLE"></span></h2>
						<div class="border_top passengers">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="row">
										<div class="col-sm-3 col-xs-6 v_passengers">
											<div class="lexus_icon popUplexusIcon">
												<img src="http://carrentalwebsite.biz/wp-content/themes/grandcarrental/images/user_icon.jpg" alt="">
												<span id="openvehiclepassger" ></span>
											</div>
										</div>
										<div class="col-sm-3 col-xs-6 v_lugss">
											<div class="lexus_icon popUplexusIcon">
												<img src="http://carrentalwebsite.biz/wp-content/themes/grandcarrental/images/bag_icon.jpg" alt="">
												<span id="openvehiclelugg" ></span>
											</div>
										</div>
										<!-- <div class="col-sm-3 col-xs-6 v_gears">
											<div class="lexus_icon lexus_icon2 popUplexusIcon">
												<img src="http://carrentalwebsite.biz/wp-content/themes/grandcarrental/images/setting_icon.jpg" alt="">
												<span>Auto</span>
											</div>
										</div> -->
										<div class="col-sm-3 col-xs-6 v_doors">
											<div class="lexus_icon lexus_icon2 popUplexusIcon">
												<img class="popUpcar_cont" src="http://carrentalwebsite.biz/wp-content/themes/grandcarrental/images/car_cion.png" alt="">
												<span id="openvehicledor" ></span>
											</div>
										</div>
									</div>
								</div>				
							</div>
						</div>
					</div>
      </div>
    
    </div> 

  </div>
</div>
<?php get_footer(); ?>
<!-- End content -->