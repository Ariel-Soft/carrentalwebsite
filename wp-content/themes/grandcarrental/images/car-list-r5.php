<?php
/**
 * Template Name: Car List Right Sidebar(R5)
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
?><link href="http://carrentalwebsite.biz/wp-content/themes/grandcarrental/css/bootstrap.css" rel="stylesheet" /><link href="http://carrentalwebsite.biz/wp-content/themes/grandcarrental/css/datepicker.css" rel="stylesheet" /><?php
$grandcarrental_page_content_class = grandcarrental_get_page_content_class();

//Include custom header feature
get_template_part("/templates/template-header");


?>

<!-- Begin content -->
<?php

	//Get all portfolio items for paging
	$wp_query = grandcarrental_get_wp_query();
	$current_photo_count = $wp_query->post_count;
	$all_photo_count = $wp_query->found_posts;
	
	
	//My Code for Web Service Api
	
	
	$processed = FALSE;
$ERROR_MESSAGE = '';

// ************* Call API:
 $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/GetLocations");


			
			$curl_post_data1  = "{\"ClientId\":\"5830\",\"UserEmail\":\"selfservice@rentcentric.com\",\"Password\":\"Mahmoud777\"}";
			
//	$curl_post_data1	={"ClientId":"5830","UserEmail":"selfservice@rentcentric.com","Password":"Mahmoud777"}


			curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache",
    "content-type: application/json; charset=utf-8"));
			 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_POST, true);
	   
	        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data1);

$result = curl_exec($ch);
$err = curl_error($ch);

//print_r($result);


if ($err) {
  echo "cURL Error #:" . $err;
} else {
 // echo $result;
  //echo '<pre>' . print_r($result, true) . '</pre>';
  
  //$array = json_decode($result, true);
  
   $json = json_decode($result);
   
   

  
  
}	
	
	if(isset($_POST['btnNext']))
	{
		
		$picklocation = $_POST['PickUpLocation'];
		$droplocation= $_POST['DropOffLocation'];
		
		
		//$pickupdate= $_POST['date1'];
		
		$date1 = date_create($_POST['date1']);
		 $pickupdate = date_format($date1, 'l, jS F Y \a\t g:ia');
		 
		//$pickupdate = date('d F Y ',strtotime($_POST['date1']));
		//echo $_POST['date1'];
		//echo $pickupdate;
		
		$date2 = date_create($_POST['date2']);
		
		$dropdate =  date_format($date2, 'l, jS F Y \a\t g:ia');
		
		//$pickdatte = explode(" ",$pickupdate);
		//$drpdatte = explode(" ",$dropdate);
		
		
		$vehicletype=$_POST['VehicleType'];
		
		
		
		
		
			$var = 0;
			if($picklocation != ""){
				
				    foreach ($json->LocationData as $item) {
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
    <li role="presentation"><a href="http://carrentalwebsite.biz/test/" aria-controls="home" role="tab" data-toggle="tab">1 Pick up</a></li>
    <li role="presentation" ><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">2 Select Vehicle</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">3 Rental Option</a></li>
    <li role="presentation" class="active"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">4 Your Information</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane" id="home">...</div>
    <div role="tabpanel" class="tab-pane " id="profile">
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
							<?php } else { echo $picklocationname; } ?>
							
							
							
							</span>
                    </p>
                    <span id="LblPickupDateTime">
					<?php if($pickupdate =="") { ?> Tuesday, 18 July 2017 at 12:00 PM <?php } else { echo $pickupdate; } ?>
					</span>
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
                            <span id="lblReturnDateTime"><?php if($dropdate =="" ){ ?>Wednesday, 19 July 2017 at 12:00 PM <?php } else { echo $dropdate; } ?> </span>
                </div>
              </div>
            </div>
			
			
			
			
          </div>
		  
		  
		  
		  
		  
			<div class="inner_wrapper nopadding form_margin_top">
			
			<?php
				if(!empty($post->post_content) && empty($term))
				{
			?>
				<div class="standard_wrapper">
				
				
				
				
				<?php echo grandcarrental_apply_content($post->post_content); ?></div><br class="clear"/><br/>
			<?php
				}
			?>
			
			<div id="page_main_content" class="sidebar_content fixed_column">
			
			
		 <?php //Include custom car search feature
		 get_template_part("/templates/template-car-Rsearch"); ?>
				
				<div class="clearfix"></div>
				
				
				
		<?php 	
		// Record Fetching Code

			
				curl_setopt($ch, CURLOPT_URL, "http://www5.rentcentric.com/OnlineResAPI/GetVehicleTypes");


					
					$curl_post_data2  = "{\"ClientId\":\"5830\",\"UserEmail\":\"selfservice@rentcentric.com\",\"Password\":\"Mahmoud777\",\"PickupDate\":\"7/27/2017\",\"PickupLocation\":\"123\"}";
		//	$curl_post_data1	={"ClientId":"5830","UserEmail":"selfservice@rentcentric.com","Password":"Mahmoud777"}


					curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache",
			"content-type: application/json; charset=utf-8"));
					 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			   curl_setopt($ch, CURLOPT_POST, true);
			   
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			   curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data2);

		$records = curl_exec($ch);
		$err = curl_error($ch);

		//print_r($result);


		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		 // echo $result;
		 // echo '<pre>' . print_r($records, true) . '</pre>';
		  
		  //$array = json_decode($result, true);
		  
		   $array = json_decode($records );
		   
		   

		  
		  
		}	




						foreach ($array->VehicleTypes as $item) {

			?>
				
				
				
				
				<div class="car_div" id="<?php echo $item->VehicleTypeID;  ?>"> 
					<div class="row">
					
						<div class="col-md-2 col-sm-2 col-xs-6">
							<div class="red_car"><img src="<?php echo get_template_directory_uri(); ?>/images/red.jpg" alt=""></div>
						</div>
						
						<div class="col-md-3 col-sm-4 col-xs-6">
							<div class="red_car">
								<h3><?php echo $item->Description; ?></h3>
								<h5>Tesla Model S or Similar</h5>
								<h5 class="view_hd"><a href="#" title="">View Vehicle Information</a></h5>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="red_car mrg_top">
							
								<h3>Payment Options</h3>
								<div>
									<a class="amex_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/amex.jpg" alt=""></a>
									<a class="moster_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/moster.jpg" alt=""></a>
									<a class="visa_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/visa.jpg" alt=""></a>
								</div>
							</div>
						</div>
						
						<div class="col-md-3 col-sm-12 col-xs-12">				
							<div class="btn_div">
								<h2>$59/day</h2>
								<div class="clearfix"></div>
								<a class="marg_right" href="#" title="">Pay Now</a>
								<a href="#" title="">Pay Later</a>
							</div>					
						</div>
					</div>
				</div>
			
			
			
				   
			  <?php 


			  }
				
				?>
				
				
				
				
				<!-- <div class="car_div">
					<div class="row">
						<div class="col-md-2 col-sm-2 col-xs-6">
							<div class="red_car"><img src="<?php echo get_template_directory_uri(); ?>/images/black-car.jpg" alt=""></div>
						</div>
						
						<div class="col-md-3 col-sm-4 col-xs-6">
							<div class="red_car">
								<h3>Economy</h3>
								<h5>Honda Civic or Similar</h5>
								<h5 class="view_hd"><a href="#" title="">View Vehicle Information</a></h5>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="red_car mrg_top">
							
								<h3>Payment Options</h3>
								<div>
									<a class="amex_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/amex.jpg" alt=""></a>
									<a class="moster_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/moster.jpg" alt=""></a>
									<a class="visa_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/visa.jpg" alt=""></a>
								</div>
							</div>
						</div>
						
						<div class="col-md-3 col-sm-12 col-xs-12">				
							<div class="btn_div">
								<h2>$29/day</h2>
								<div class="clearfix"></div>
								<a class="marg_right" href="#" title="">Pay Now</a>
								<a href="#" title="">Pay Later</a>
							</div>					
						</div>
					</div>
				</div>
				
				<div class="car_div">
					<div class="row">
						<div class="col-md-2 col-sm-2 col-xs-6">
							<div class="red_car"><img src="<?php echo get_template_directory_uri(); ?>/images/gray-car.jpg" alt=""></div>
						</div>
						
						<div class="col-md-3 col-sm-4 col-xs-6">
							<div class="red_car">
								<h3>Sport Utility Vehicle</h3>
								<h5>Hyundai Santa Fe or Similar</h5>
								<h5 class="view_hd"><a href="#" title="">View Vehicle Information</a></h5>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="red_car mrg_top">
							
								<h3>Payment Options</h3>
								<div>
									<a class="amex_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/amex.jpg" alt=""></a>
									<a class="moster_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/moster.jpg" alt=""></a>
									<a class="visa_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/visa.jpg" alt=""></a>
								</div>
							</div>
						</div>
						
						<div class="col-md-3 col-sm-12 col-xs-12">				
							<div class="btn_div">
								<h2>$59/day</h2>
								<div class="clearfix"></div>
								<a class="marg_right" href="#" title="">Pay Now</a>
								<a href="#" title="">Pay Later</a>
							</div>					
						</div>
					</div>
				</div>
				
				<div class="car_div">
					<div class="row">
						<div class="col-md-2 col-sm-2 col-xs-6">
							<div class="red_car"><img src="<?php echo get_template_directory_uri(); ?>/images/red.jpg" alt=""></div>
						</div>
						
						<div class="col-md-3 col-sm-4 col-xs-6">
							<div class="red_car">
								<h3>Luxury Sports Car</h3>
								<h5>Tesla Model S or Similar</h5>
								<h5 class="view_hd"><a href="#" title="">View Vehicle Information</a></h5>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="red_car mrg_top">
							
								<h3>Payment Options</h3>
								<div>
									<a class="amex_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/amex.jpg" alt=""></a>
									<a class="moster_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/moster.jpg" alt=""></a>
									<a class="visa_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/visa.jpg" alt=""></a>
								</div>
							</div>
						</div>
						
						<div class="col-md-3 col-sm-12 col-xs-12">				
							<div class="btn_div">
								<h2>$59/day</h2>
								<div class="clearfix"></div>
								<a class="marg_right" href="#" title="">Pay Now</a>
								<a href="#" title="">Pay Later</a>
							</div>					
						</div>
					</div>
				</div>
				
				<div class="car_div">
					<div class="row">
						<div class="col-md-2 col-sm-2 col-xs-6">
							<div class="red_car"><img src="<?php echo get_template_directory_uri(); ?>/images/black-car.jpg" alt=""></div>
						</div>
						
						<div class="col-md-3 col-sm-4 col-xs-6">
							<div class="red_car">
								<h3>Economy </h3>
								<h5>Honda Civic or Similar</h5>
								<h5 class="view_hd"><a href="#" title="">View Vehicle Information</a></h5>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="red_car mrg_top">
							
								<h3>Payment Options</h3>
								<div>
									<a class="amex_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/amex.jpg" alt=""></a>
									<a class="moster_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/moster.jpg" alt=""></a>
									<a class="visa_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/visa.jpg" alt=""></a>
								</div>
							</div>
						</div>
						
						<div class="col-md-3 col-sm-12 col-xs-12">				
							<div class="btn_div">
								<h2>$29/day</h2>
								<div class="clearfix"></div>
								<a class="marg_right" href="#" title="">Pay Now</a>
								<a href="#" title="">Pay Later</a>
							</div>					
						</div>
					</div>
				</div>
				
				<div class="car_div last_cardiv">
					<div class="row">
						<div class="col-md-2 col-sm-2 col-xs-6">
							<div class="red_car"><img src="<?php echo get_template_directory_uri(); ?>/images/gray-car.jpg" alt=""></div>
						</div>
						
						<div class="col-md-3 col-sm-4 col-xs-6">
							<div class="red_car">
								<h3>Sport Utility Vehicle</h3>
								<h5>Hyundai Santa Fe or Similar</h5>
								<h5 class="view_hd"><a href="#" title="">View Vehicle Information</a></h5>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="red_car mrg_top">
							
								<h3>Payment Options</h3>
								<div>
									<a class="amex_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/amex.jpg" alt=""></a>
									<a class="moster_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/moster.jpg" alt=""></a>
									<a class="visa_img" href="#" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/visa.jpg" alt=""></a>
								</div>
							</div>
						</div>
						
						<div class="col-md-3 col-sm-12 col-xs-12">				
							<div class="btn_div">
								<h2>$59/day</h2>
								<div class="clearfix"></div>
								<a class="marg_right" href="#" title="">Pay Now</a>
								<a href="#" title="">Pay Later</a>
							</div>					
						</div>
					</div>
				</div> -->
			
			<div class="standard_wrapper">
			
			<div id="portfolio_filter_wrapper" class="gallery classic two_cols portfolio-content section content clearfix" data-columns="3">
			

			
			<?php
				$key = 0;
				if (have_posts()) : while (have_posts()) : the_post();
					$key++;
					$image_url = '';
					$car_ID = get_the_ID();
							
					if(has_post_thumbnail($car_ID, 'grandcarrental-gallery-list-full'))
					{
						$image_id = get_post_thumbnail_id($car_ID);
						$small_image_url = wp_get_attachment_image_src($image_id, 'grandcarrental-gallery-list-full', true);
					}
					
					$permalink_url = get_permalink($car_ID);
			?>
					<?php 
						if(!empty($small_image_url[0]))
						{
					?>
					<div class="car_list_wrapper floatleft noborder">
						<div class="one">
							<a class="car_image" href="<?php echo esc_url($permalink_url); ?>">
								<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
							</a>
						</div>
						
						
						
						<div class="one">
								<div class="car_attribute_wrapper car_list">
									<a class="car_link" href="<?php echo esc_url($permalink_url); ?>"><h3><?php the_title(); ?></h3></a>
								   <?php
									$overall_rating_arr = grandcarrental_get_review($car_ID, 'overall_rating');
									$overall_rating = intval($overall_rating_arr['average']);
									$overall_rating_count = intval($overall_rating_arr['count']);
									
									if(!empty($overall_rating))
									{
							   ?>
									<div class="car_attribute_rating">
							   <?php
										if($overall_rating > 0)
										{
							   ?>
										<div class="br-theme-fontawesome-stars-o">
											<div class="br-widget">
							   <?php
											for( $i=1; $i <= $overall_rating; $i++ ) {
												echo '<a href="javascript:;" class="br-selected"></a>';
											}
											
											$empty_star = 5 - $overall_rating;
											
											if(!empty($empty_star))
											{
												for( $i=1; $i <= $empty_star; $i++ ) {
													echo '<a href="javascript:;"></a>';
												}
											}
								?>
											</div>
										</div>
								<?php
										}
										
										if($overall_rating_count > 0)
										{
								?>
										<div class="car_attribute_rating_count">
											<?php echo intval($overall_rating_count); ?>&nbsp;
											<?php
												if($overall_rating_count > 1)
												{
													echo esc_html__('reviews', 'grandcarrental' );
												}
												else
												{
													echo esc_html__('review', 'grandcarrental' );
												}
											?>
										</div>
								<?php
										}
								?>
									</div>
								<?php
									}    
								?>
								<br class="clear"/>
								<?php
									//Display car attributes
									$car_passengers = get_post_meta($post->ID, 'car_passengers', true);
									$car_luggages = get_post_meta($post->ID, 'car_luggages', true);
									$car_transmission = get_post_meta($post->ID, 'car_transmission', true);
							
									if(!empty($car_passengers) OR !empty($car_luggages) OR !empty($car_transmission))
									{
								?>
								<div class="one_third">
									<div class="car_attribute_wrapper_icon">
										<?php
											if(!empty($car_passengers))
											{
										?>
											<div class="one_fourth">
												<div class="car_attribute_icon ti-user"></div>
												<div class="car_attribute_content">
												<?php
													echo intval($car_passengers);
												?>
												</div>
											</div>
										<?php
											}
										?>
										
										<?php
											if(!empty($car_luggages))
											{
										?>
											<div class="one_fourth">
												<div class="car_attribute_icon ti-briefcase"></div>
												<div class="car_attribute_content">
													<?php
														echo intval($car_luggages);
													?>
												</div>
											</div>
										<?php
											}
										?>
										
										<?php
											if(!empty($car_transmission))
											{
										?>
											<div class="one_fourth">
												<div class="car_attribute_icon ti-panel"></div>
												<div class="car_attribute_content">
													<?php 
														echo ucfirst($car_transmission);
													?>
												</div>
											</div>
										<?php
											}
										?>
										
									</div><br class="clear"/>
								<?php
									}
								?>
							   </div>
							   
							   <div class="two_third last">
								   <?php
										$car_included = get_post_meta($post->ID, 'car_included', true);
										
										if(!empty($car_included))
										{
									?>
									<ul class="single_car_departure_wrapper themeborder">
										<li>
											<div class="single_car_departure_content full_width">
												<?php
													if(!empty($car_included) && is_array($car_included))
													{
														foreach($car_included as $key => $car_included_item)
														{
															$last_class = '';
															if(($key+1)%2 == 0)	
															{
																$last_class = 'last';
															}
												?>
												<div class="one_half <?php echo esc_attr($last_class); ?>">
													<span class="ti-check"></span><?php echo esc_html($car_included_item); ?>
												</div>
												<?php
														}
													}
												?>
											</div>
										</li>
									</ul>
									<?php
										}
									?>
							   </div>
							   
							   </div>
							   <div class="car_attribute_price car_list">
								<?php
									//Get car price
									$car_price_day = get_post_meta($post->ID, 'car_price_day', true); 
									
									if(!empty($car_price_day))
									{   
								 ?>
								 <div class="car_attribute_price_day two_cols">
									<?php echo grandcarrental_format_car_price($car_price_day); ?>
									<span class="car_unit_day"><?php esc_html_e('Per Day', 'grandcarrental' ); ?></span>
								 </div>
								 <?php
									}
								 ?>
								</div>
							</div>
						</div>
					<?php
						}
					?>
			<?php
				endwhile;
				else:
			?>
					<div class="car_search_noresult"><span class="ti-info-alt"></span><?php esc_html_e("We haven't found any car that matches you're criteria", 'grandcarrental'); ?></div>
			<?php
				endif;
			?>
				
			</div>
			<br class="clear"/>
			<?php
				if($wp_query->max_num_pages > 1)
				{
					if (function_exists("grandcarrental_pagination")) 
					{
						grandcarrental_pagination($wp_query->max_num_pages);
					}
					else
					{
					?>
						<div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
					<?php
					}
				?>
				<div class="pagination_detail">
					<?php
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					?>
					<?php esc_html_e('Page', 'grandcarrental' ); ?> <?php echo esc_html($paged); ?> <?php esc_html_e('of', 'grandcarrental' ); ?> <?php echo esc_html($wp_query->max_num_pages); ?>
				 </div>
				 <?php
				 }
			?>
			
			</div>
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
					<?php } ?>
			  
			  </div>
			 
			 </div>
			</div>

		</div>


		  
		  
		  
		  
		  
		  
		  
	</div>
    <div role="tabpanel" class="tab-pane" id="messages">	
		<div class="">
            <div class="row">
              <div class="col-sm-3">
                <div class="tab_text ">
                  <h5> Pick-Up </h5>
                  <p> 
                            <span id="lblPickupLocation" style="font-weight:bold;">34534</span>
                    </p>
                    <span id="LblPickupDateTime">Tuesday, 18 July 2017 at 12:00 PM</span>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="tab_text">
                  <h5> Return </h5>
                 <p> 
                            <span id="lblReturnLocation" style="font-weight:bold;">Dundas Square</span>
                    </p>
                            <span id="lblReturnDateTime">Wednesday, 19 July 2017 at 12:00 PM</span>
                </div>
              </div>
            </div>
		</div>
		
		<div class="rental_div">
			<div class="row">
				<div class="col-sm-6 col-xs-6">					
					<img src="" alt="">
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="lexus_div">
			<h2>Lexus LS 460</h2>
			<div class="border_top passengers">
				<div class="row">
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div class="row">
							<div class="col-sm-3 col-xs-6">
								<div class="lexus_icon">
									<img src="<?php echo get_template_directory_uri(); ?>/images/user_icon.jpg" alt="">
									<span>5 Passengers</span>
								</div>
							</div>
							<div class="col-sm-3 col-xs-6">
								<div class="lexus_icon">
									<img src="<?php echo get_template_directory_uri(); ?>/images/bag_icon.jpg" alt="">
									<span>4 Luggages</span>
								</div>
							</div>
							<div class="col-sm-3 col-xs-6">
								<div class="lexus_icon lexus_icon2">
									<img src="<?php echo get_template_directory_uri(); ?>/images/setting_icon.jpg" alt="">
									<span>Auto</span>
								</div>
							</div>
							<div class="col-sm-3 col-xs-6">
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
		<div class="includ_div border_top">
			<div class="row">
				<div class="col-md-9 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-sm-3">
							<h3>Included</h3>
						</div>
						<div class="col-sm-4">
							<ul class="list-unstyled">
								<li><img src="<?php echo get_template_directory_uri(); ?>/images/list_img.jpg" alt=""> Audio input</li>
								<li><img src="<?php echo get_template_directory_uri(); ?>/images/list_img.jpg" alt=""> Bluetooth</li>
								<li><img src="<?php echo get_template_directory_uri(); ?>/images/list_img.jpg" alt=""> Heated seats</li>
							</ul>
						</div>
						<div class="col-sm-5">
							<ul class="list-unstyled">
								<li><img src="<?php echo get_template_directory_uri(); ?>/images/list_img.jpg" alt=""> All Wheel drive</li>
								<li><img src="<?php echo get_template_directory_uri(); ?>/images/list_img.jpg" alt=""> USB input</li>
								<li><img src="<?php echo get_template_directory_uri(); ?>/images/list_img.jpg" alt=""> FM Radio</li>
							</ul>
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
						<td><h4><span>$ 15.00<span></h4></td>
					</tr>
					<tr>
						<td><h4>Rental Options</h4></td>
						<td><h4><span>$ 0.00<span></h4></td>
					</tr>
					<tr>
						<td><h4>Total</h4></td>
						<td><h4><span>$ 15.00<span></td>
					</tr>
					<tr>
						<td><h4>Taxes</h4></td>
						<td></td>
					</tr>
					<tr>
						<td><h4>IVA @ 16%</h4></td>
						<td><h4><span>$ 2.40<span></h4></td>
					</tr>
					<tr>
						<td><h4>Total</h4></td>
						<td><h4><span>$ 23.35<span></h4></td>
					</tr>
				</tbody>
			</table>				
		</div>
		
		<div class="service_div border_top">
			<h5>Equipment & Services</h5>
			
			<h4>SIRIUS XM Satellite Radio</h4>
			<span>Make your drive come alive with SiriusXM<b>&reg;</b> Satellite Radio.</span>
			<form class="form_btn">
				<label><input type="checkbox" name="vehicle" value="Car"> $6.99/Day</label>
				<div class="clearfix"></div>
			</form>
		</div>
		<div class="service_div border_top safety_div">
			<h4>Extended Roadside Assistance</h4>
			<span>Pease of Mind for unexpected emergencies. Get fast, reliable 24/7 service when you need it most.</span>
			<form class="form_btn">
				<label><input type="checkbox" name="vehicle" value="Car"> $16.99/Day</label>
				<div class="clearfix"></div>
			</form>
		</div>
		<div class="service_div border_top safety_div">
			<h4>Child Safety Seats</h4>
			<span>Keep kids safe when travelling with our child safety seats.</span>
			<form class="form_btn">
				<label><input type="checkbox" name="vehicle" value="Car"> $6.99/Day</label>
				<div class="clearfix"></div>
			</form>
		</div>
		<div class="service_div border_top safety_div">
			
			<form class="form_btn">
				<label class="continue_btn"><a href="#" title="">Continue</a></label>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
    <div role="tabpanel" class="tab-pane active" id="settings">	
		<div class="">
            <div class="row">
              <div class="col-sm-3">
                <div class="tab_text ">
                  <h5> Pick-Up </h5>
                  <p> 
                            <span id="lblPickupLocation" style="font-weight:bold;">34534</span>
                    </p>
                    <span id="LblPickupDateTime">Tuesday, 18 July 2017 at 12:00 PM</span>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="tab_text">
                  <h5> Return </h5>
                 <p> 
                            <span id="lblReturnLocation" style="font-weight:bold;">Dundas Square</span>
                    </p>
                            <span id="lblReturnDateTime">Wednesday, 19 July 2017 at 12:00 PM</span>
                </div>
              </div>
            </div>
          </div>
		  
		<div class="rental_div">
			<div class="row">
				<div class="col-sm-6 col-xs-6">					
					<img src="<?php echo get_template_directory_uri(); ?>/images/rentaltab-img.jpg" alt="">
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="lexus_div">
			<h2>Lexus LS 460</h2>
			<div class="border_top passengers">
				<div class="row">
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div class="row">
							<div class="col-sm-3 col-xs-6">
								<div class="lexus_icon">
									<img src="<?php echo get_template_directory_uri(); ?>/images/user_icon.jpg" alt="">
									<span>5 Passengers</span>
								</div>
							</div>
							<div class="col-sm-3 col-xs-6">
								<div class="lexus_icon">
									<img src="<?php echo get_template_directory_uri(); ?>/images/bag_icon.jpg" alt="">
									<span>4 Luggages</span>
								</div>
							</div>
							<div class="col-sm-3 col-xs-6">
								<div class="lexus_icon lexus_icon2">
									<img src="<?php echo get_template_directory_uri(); ?>/images/setting_icon.jpg" alt="">
									<span>Auto</span>
								</div>
							</div>
							<div class="col-sm-3 col-xs-6">
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
		<div class="includ_div border_top">
			<div class="row">
				<div class="col-md-9 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-sm-3">
							<h3>Included</h3>
						</div>
						<div class="col-sm-4">
							<ul class="list-unstyled">
								<li><img src="<?php echo get_template_directory_uri(); ?>/images/list_img.jpg" alt=""> Audio input</li>
								<li><img src="<?php echo get_template_directory_uri(); ?>/images/list_img.jpg" alt=""> Bluetooth</li>
								<li><img src="<?php echo get_template_directory_uri(); ?>/images/list_img.jpg" alt=""> Heated seats</li>
							</ul>
						</div>
						<div class="col-sm-5">
							<ul class="list-unstyled">
								<li><img src="<?php echo get_template_directory_uri(); ?>/images/list_img.jpg" alt=""> All Wheel drive</li>
								<li><img src="<?php echo get_template_directory_uri(); ?>/images/list_img.jpg" alt=""> USB input</li>
								<li><img src="<?php echo get_template_directory_uri(); ?>/images/list_img.jpg" alt=""> FM Radio</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>		
		
		<div class="your_info seccuss_div border_top">
			<h2 class="credit_hd">Your Information</h2>
			<p><b>Success !</b> Reservation Complete</p>
			<div class="table-responsive">
				<div class="table_div border_top">
					<table class="table">
						<tbody>
							<tr>
								<td colspan="2"><h4>Your Reservation Number : 875</h4></td>
								<td rowspan="3"><img src="http://carrentalwebsite.biz/wp-content/themes/grandcarrental/images/rentaltab-img.jpg" alt=""></td>
							</tr>
							<tr>
								<td>First Name : Alaa</td>							
							</tr>
							<tr>
								<td>Last Name : Mohammed</td>							
							</tr>
							<tr>
								<td>Phone : 1272841592</td>
								<td><h4>Base Rate</h4></td>
								<td  style="text-align:right;">$ 35.00</td>
							</tr>
							<tr>
								<td>Email : alaa87_ma@hotmail.com</td>
								<td><h4>Rental Options</h4></td>
								<td style="text-align:right;">$ 0.00</td>
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
								<td>Wednesday, 19 July 2017 12:00 PM</td>							
								<td>IVA @ 16%</td>							
								<td  style="text-align:right !important;">$ 5.60</td>							
							</tr>
							<tr>
								<td>Dundas Square</td>	
								<td><h4>Total</h4></td>
								<td style="text-align:right !important;"><h4>$ 40.60</h4></td>
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
								<td>Thursday, 20 July 2017 12:00 PM</td>						
							</tr>
							<tr>
								<td>Dundas Square</td>								
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
			<div class="print_div border_top text-center">
				<a href="#" title="">Cancel</a>
				<a href="#" title="">Add to Outlook Calender</a>
				<a href="#" title="">Print</a>
				<a href="#" title="">Email</a>
				<a href="#" title="" id="modify">Modify</a>
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


<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#modify").on("click",function(){
		jQuery("#pickup_modify").css("display","block");
	});
});
</script>



        <script>

            jQuery(document).ready(function () {
                jQuery(function () {
                    jQuery('#datetimepicker2, #datetimepicker2, #datetimepicker1').datetimepicker({
                        locale: 'en'
                    });
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
		foo= 'Toronto - Edit loc';
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
		drop= 'Toronto - Edit loc';
	}
	
	
	 document.getElementById('lblReturnLocation').innerHTML = drop;
}

</script>
		
<?php get_footer(); ?>
<!-- End content -->
<!-- End content -->