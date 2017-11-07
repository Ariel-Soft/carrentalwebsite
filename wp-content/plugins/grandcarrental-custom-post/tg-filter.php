<?php
function grandcarrental_carbrand_custom_fields($tag) {

   // Check for existing taxonomy meta for the term you're editing
    $t_id = $tag->term_id; // Get the ID of the term you're editing
    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check
?>

<tr class="form-field">
	<th scope="row" valign="top">
		<label for="carbrand_template"><?php _e('Car Brand Page Template', 'grandcarrental'); ?></label>
	</th>
	<td>
		<select name="carbrand_template" id="carbrand_template">
			<?php
				$tg_car_archive_templates = array(
				  'car-2-classic'		=> 'Car 2 Columns Classic',
				  'car-3-classic'		=> 'Car 3 Columns Classic',
				  'car-4-classic'		=> 'Car 4 Columns Classic',
				  'car-2-classic-r'		=> 'Car Classic Right Sidebar',
				  'car-2-classic-l'		=> 'Car Classic Left Sidebar',
				  'car-2-grid'			=> 'Car 2 Columns Grid',
				  'car-3-grid'			=> 'Car 3 Columns Grid',
				  'car-4-grid'			=> 'Car 4 Columns Grid',
				  'car-2-grid-r'		=> 'Car Grid Right Sidebar',
				  'car-2-grid-l'		=> 'Car Grid Left Sidebar',
				  'car-list-r'			=> 'Car List Right Sidebar',
				  'car-list-l'			=> 'Car List Left Sidebar',
				  'car-list-thumb-r'	=> 'Car List Thumbnail Right Sidebar',
				  'car-list-thumb-l'	=> 'Car List Thumbnail Left Sidebar',
				);
				
				foreach($tg_car_archive_templates as $key => $tg_car_archive_template)
				{
			?>
			<option value="<?php echo esc_attr($key); ?>" <?php if($term_meta['carbrand_template']==$key) { ?>selected<?php } ?>><?php echo esc_html($tg_car_archive_template); ?></option>
			<?php
				}
			?>
		</select>
		<br />
		<span class="description"><?php _e('Select page template for this car brand', 'grandcarrental'); ?></span>
	</td>
</tr>

<?php
}

// A callback function to save our extra taxonomy field(s)
function grandcarrental_save_carbrand_custom_fields( $term_id ) {
    if ( isset( $_POST['carbrand_template'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_term_$t_id" );

        if ( isset( $_POST['carbrand_template'] ) ){
            $term_meta['carbrand_template'] = $_POST['carbrand_template'];
        }
        
        //save the option array
        update_option( "taxonomy_term_$t_id", $term_meta );
    }
}

add_action( 'carbrand_edit_form_fields', 'grandcarrental_carbrand_custom_fields', 10, 2 );

add_action( 'edited_carbrand', 'grandcarrental_save_carbrand_custom_fields', 10, 2 );


function grandcarrental_cartype_custom_fields($tag) {

   // Check for existing taxonomy meta for the term you're editing
    $t_id = $tag->term_id; // Get the ID of the term you're editing
    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check
?>

<tr class="form-field">
	<th scope="row" valign="top">
		<label for="cartype_template"><?php _e('Car Type Page Template', 'grandcarrental'); ?></label>
	</th>
	<td>
		<select name="cartype_template" id="cartype_template">
			<?php
				$tg_car_archive_templates = array(
				  'car-2-classic'		=> 'Car 2 Columns Classic',
				  'car-3-classic'		=> 'Car 3 Columns Classic',
				  'car-4-classic'		=> 'Car 4 Columns Classic',
				  'car-2-classic-r'		=> 'Car Classic Right Sidebar',
				  'car-2-classic-l'		=> 'Car Classic Left Sidebar',
				  'car-2-grid'			=> 'Car 2 Columns Grid',
				  'car-3-grid'			=> 'Car 3 Columns Grid',
				  'car-4-grid'			=> 'Car 4 Columns Grid',
				  'car-2-grid-r'		=> 'Car Grid Right Sidebar',
				  'car-2-grid-l'		=> 'Car Grid Left Sidebar',
				  'car-list-r'			=> 'Car List Right Sidebar',
				  'car-list-l'			=> 'Car List Left Sidebar',
				  'car-list-thumb-r'	=> 'Car List Thumbnail Right Sidebar',
				  'car-list-thumb-l'	=> 'Car List Thumbnail Left Sidebar',
				);
				
				foreach($tg_car_archive_templates as $key => $tg_car_archive_template)
				{
			?>
			<option value="<?php echo esc_attr($key); ?>" <?php if($term_meta['cartype_template']==$key) { ?>selected<?php } ?>><?php echo esc_html($tg_car_archive_template); ?></option>
			<?php
				}
			?>
		</select>
		<br />
		<span class="description"><?php _e('Select page template for this car type', 'grandcarrental'); ?></span>
	</td>
</tr>

<?php
}

// A callback function to save our extra taxonomy field(s)
function grandcarrental_save_cartype_custom_fields( $term_id ) {
    if ( isset( $_POST['cartype_template'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_term_$t_id" );

        if ( isset( $_POST['cartype_template'] ) ){
            $term_meta['cartype_template'] = $_POST['cartype_template'];
        }
        
        //save the option array
        update_option( "taxonomy_term_$t_id", $term_meta );
    }
}

// Add the fields to the "gallery categories" taxonomy, using our callback function
add_action( 'cartype_edit_form_fields', 'grandcarrental_cartype_custom_fields', 10, 2 );

// Save the changes made on the "presenters" taxonomy, using our callback function
add_action( 'edited_cartype', 'grandcarrental_save_cartype_custom_fields', 10, 2 );


//Add upload form to page
if (is_admin()) {
  $current_admin_page = substr(strrchr($_SERVER['PHP_SELF'], '/'), 1, -4);

  if ($current_admin_page == 'post' || $current_admin_page == 'post-new')
  {
 
    /** Need to force the form to have the correct enctype. */
    function grandcarrental_add_post_enctype() {
      echo "<script type=\"text/javascript\">
        jQuery(document).ready(function(){
        jQuery('#post').attr('enctype','multipart/form-data');
        jQuery('#post').attr('encoding', 'multipart/form-data');
        });
        </script>";
    }
 
    add_action('admin_head', 'grandcarrental_add_post_enctype');
  }
}

add_action( 'edit_form_after_title', 'grandcarrental_content_builder_enable');

function grandcarrental_content_builder_enable ($post) 
{
	//Check if enable content builder
	$ppb_enable = get_post_meta($post->ID, 'ppb_enable');
	$enable_builder_class = '';
	$enable_classic_builder_class = '';
	
	if(!empty($ppb_enable))
	{
		$enable_builder_class = 'hidden';
		$enable_classic_builder_class = 'visible';
	}
	
	//Check if user edit page
	$page_id = '';
	
	if (isset($_GET['action']) && $_GET['action'] == 'edit')
	{
		$page_id = $post->ID;
	}

	//Display only on page and portfolio
	if($post->post_type == 'page')
	
    echo '<a href="javascript:;" id="enable_builder" class="'.esc_attr($enable_builder_class).'" data-page-id="'.esc_attr($page_id).'"><i class="fa fa-th-list"></i>'.esc_html__('Edit in Content Builder', 'grandcarrental' ).'</a>';
    echo '<a href="javascript:;" id="enable_classic_builder" class="'.esc_attr($enable_classic_builder_class).'"><i class="fa fa-edit"></i>'.esc_html__('Edit in Classic Editor', 'grandcarrental' ).'</a>';
}

if ( ! function_exists( 'grandcarrental_theme_kirki_update_url' ) ) {
    function grandcarrental_theme_kirki_update_url( $config ) {
        $config['url_path'] = get_template_directory_uri() . '/modules/kirki/';
        return $config;
    }
}
add_filter( 'kirki/config', 'grandcarrental_theme_kirki_update_url' );

add_action( 'customize_register', function( $wp_customize ) {
	/**
	 * The custom control class
	 */
	class Kirki_Controls_Title_Control extends WP_Customize_Control {
		public $type = 'title';
		public function render_content() { 
			echo $this->label;
		}
	}
	// Register our custom control with Kirki
	add_filter( 'kirki/control_types', function( $controls ) {
		$controls['title'] = 'Kirki_Controls_Title_Control';
		return $controls;
	} );

} );

add_action( 'wp_enqueue_scripts', 'grandcarrental_enqueue_front_end_scripts' );
function grandcarrental_enqueue_front_end_scripts() 
{
	wp_enqueue_style("fontawesome-stars", WP_PLUGIN_URL."/grandcarrental-custom-post/css/fontawesome-stars-o.css", false);
	wp_enqueue_script('barrating', WP_PLUGIN_URL.'/grandcarrental-custom-post/js/jquery.barrating.js', false);
}

add_action( 'admin_enqueue_scripts', 'grandcarrental_enqueue_back_end_scripts' );
function grandcarrental_enqueue_back_end_scripts() 
{
	wp_enqueue_style("fontawesome-stars", WP_PLUGIN_URL."/grandcarrental-custom-post/css/fontawesome-stars-o.css", false);
	wp_enqueue_script('barrating', WP_PLUGIN_URL.'/grandcarrental-custom-post/js/jquery.barrating.js', false);
}

// Add fields after default fields above the comment box, always visible
add_action( 'comment_form_logged_in_after', 'grandcarrental_additional_fields' );
add_action( 'comment_form_after_fields', 'grandcarrental_additional_fields' );

function grandcarrental_additional_fields() 
{
	$post_type = get_post_type();
	
	if($post_type == 'car')
	{
		wp_enqueue_style("fontawesome-stars", WP_PLUGIN_URL."/grandcarrental-custom-post/css/fontawesome-stars-o.css", false);
		wp_enqueue_script('barrating', WP_PLUGIN_URL.'/grandcarrental-custom-post/js/jquery.barrating.js', false);
		
		echo '<p class="comment-form-rating">'.
		'<label for="driving_rating">'. esc_html__('Driving', 'grandcarrental') . '</label>
		<span class="commentratingbox">
		<select id="driving_rating" name="driving_rating">';
		for( $i=1; $i <= 5; $i++ )
		echo '<option value="'. $i .'">'. $i .'</option>';
		echo'</select></p>';
		
		echo '<p class="comment-form-rating">'.
		'<label for="interior_rating">'. esc_html__('Interior Layout', 'grandcarrental') . '</label>
		<span class="commentratingbox">
		<select id="interior_rating" name="interior_rating">';
		for( $i=1; $i <= 5; $i++ )
		echo '<option value="'. $i .'">'. $i .'</option>';
		echo'</select></p>';
		
		echo '<p class="comment-form-rating">'.
		'<label for="space_rating">'. esc_html__('Space & Practicality', 'grandcarrental') . '</label>
		<span class="commentratingbox">
		<select id="space_rating" name="space_rating">';
		for( $i=1; $i <= 5; $i++ )
		echo '<option value="'. $i .'">'. $i .'</option>';
		echo'</select></p>';
		
		echo '<p class="comment-form-rating">'.
		'<label for="overall_rating">'. esc_html__('Overall', 'grandcarrental') . '</label>
		<span class="commentratingbox">
		<select id="overall_rating" name="overall_rating">';
		for( $i=1; $i <= 5; $i++ )
		echo '<option value="'. $i .'">'. $i .'</option>';
		echo'</select></p>';
		
		echo '<script>';
		echo 'jQuery(function() {
	      	jQuery("#driving_rating, #interior_rating, #space_rating, #overall_rating").barrating({
	        	theme: "fontawesome-stars-o",
	        	emptyValue: 0,
	        	allowEmpty: true
	      	});
	      	
	      	jQuery("#driving_rating, #interior_rating, #space_rating, #overall_rating").barrating("set", 0);
	    });';
	    echo '</script>';
	}
}

// Save the comment meta data along with comment

add_action( 'comment_post', 'grandcarrental_save_comment_meta_data' );
function grandcarrental_save_comment_meta_data( $comment_id ) 
{
	$obj_comment = get_comment($comment_id);
	$post_type = get_post_type($obj_comment->comment_post_ID);
	
	if($post_type == 'car')
	{
		if ( ( isset( $_POST['driving_rating'] ) ) && ( $_POST['driving_rating'] != '') )
		$rating = wp_filter_nohtml_kses($_POST['driving_rating']);
		add_comment_meta( $comment_id, 'driving_rating', $rating );
		
		if ( ( isset( $_POST['interior_rating'] ) ) && ( $_POST['interior_rating'] != '') )
		$rating = wp_filter_nohtml_kses($_POST['interior_rating']);
		add_comment_meta( $comment_id, 'interior_rating', $rating );
		
		if ( ( isset( $_POST['space_rating'] ) ) && ( $_POST['space_rating'] != '') )
		$rating = wp_filter_nohtml_kses($_POST['space_rating']);
		add_comment_meta( $comment_id, 'space_rating', $rating );
		
		if ( ( isset( $_POST['overall_rating'] ) ) && ( $_POST['overall_rating'] != '') )
		$rating = wp_filter_nohtml_kses($_POST['overall_rating']);
		add_comment_meta( $comment_id, 'overall_rating', $rating );
	}
}


// Add the filter to check if the comment meta data has been filled or not

add_filter( 'preprocess_comment', 'grandcarrental_verify_comment_meta_data' );
function grandcarrental_verify_comment_meta_data( $commentdata ) 
{
	$post_type = get_post_type($commentdata['comment_post_ID']);
	
	if($post_type == 'car')
	{
		if ( ! isset( $_POST['driving_rating'] ) OR empty($_POST['driving_rating']) )
		wp_die( esc_html__( 'Error: You did not add your rating. Hit the BACK button of your Web browser and resubmit your comment with driving rating.', 'grandcarrental' ) );
		
		if ( ! isset( $_POST['interior_rating'] ) OR empty($_POST['interior_rating']) )
		wp_die( esc_html__( 'Error: You did not add your rating. Hit the BACK button of your Web browser and resubmit your comment with interior layout rating.', 'grandcarrental' ) );
		
		if ( ! isset( $_POST['space_rating'] ) OR empty($_POST['space_rating']) )
		wp_die( esc_html__( 'Error: You did not add your rating. Hit the BACK button of your Web browser and resubmit your comment with space & praticality rating.', 'grandcarrental' ) );
		
		if ( ! isset( $_POST['overall_rating'] ) OR empty($_POST['overall_rating']) )
		wp_die( esc_html__( 'Error: You did not add your rating. Hit the BACK button of your Web browser and resubmit your comment with overall rating.', 'grandcarrental' ) );
	}
	
	return $commentdata;
}

//Add an edit option in comment edit screen  

add_action( 'add_meta_boxes_comment', 'grandcarrental_extend_comment_add_meta_box' );
function grandcarrental_extend_comment_add_meta_box($comment) 
{
	$post_type = get_post_type($comment->comment_post_ID);
	
	if($post_type == 'car')
	{
		add_meta_box( 'title', esc_html__( 'Comment Metadata - Rating', 'grandcarrental' ), 'grandcarrental_extend_comment_meta_box', 'comment', 'normal', 'high' );
	}
}
 
function grandcarrental_extend_comment_meta_box ($comment) 
{
	$post_type = get_post_type($comment->comment_post_ID);
	
	if($post_type == 'car')
	{
	    $driving_rating = get_comment_meta( $comment->comment_ID, 'driving_rating', true );
	    $interior_rating = get_comment_meta( $comment->comment_ID, 'interior_rating', true );
	    $space_rating = get_comment_meta( $comment->comment_ID, 'space_rating', true );
	    $overall_rating = get_comment_meta( $comment->comment_ID, 'overall_rating', true );
	    
	    wp_nonce_field( 'grandcarrental_extend_comment_update', 'grandcarrental_extend_comment_update', false );
	    wp_enqueue_style("fontawesome-stars", WP_PLUGIN_URL."/grandcarrental-custom-post/css/fontawesome-stars-o.css", false);
		wp_enqueue_script('barrating', WP_PLUGIN_URL.'/grandcarrental-custom-post/js/jquery.barrating.js', false);
?>
    <p>
        <label for="driving_rating"><?php esc_html_e( 'Driving ', 'grandcarrental' ); ?></label>
			<select id="driving_rating" name="driving_rating">
			<?php for( $i=1; $i <= 5; $i++ ) {
				echo '<option value="'. $i .'"';
				if ( $driving_rating == $i ) echo ' selected';
				echo '>'. $i .' </option>'; 
				}
			?>
			</select>
    </p>
    
    <p>
        <label for="interior_rating"><?php esc_html_e( 'Interior Layout ', 'grandcarrental' ); ?></label>
			<select id="interior_rating" name="interior_rating">
			<?php for( $i=1; $i <= 5; $i++ ) {
				echo '<option value="'. $i .'"';
				if ( $interior_rating == $i ) echo ' selected';
				echo '>'. $i .' </option>'; 
				}
			?>
			</select>
    </p>
    
    <p>
        <label for="space_rating"><?php esc_html_e( 'Space & Practicality ', 'grandcarrental' ); ?></label>
			<select id="space_rating" name="space_rating">
			<?php for( $i=1; $i <= 5; $i++ ) {
				echo '<option value="'. $i .'"';
				if ( $space_rating == $i ) echo ' selected';
				echo '>'. $i .' </option>'; 
				}
			?>
			</select>
    </p>
    
    <p>
        <label for="overall_rating"><?php esc_html_e( 'Overall ', 'grandcarrental' ); ?></label>
			<select id="overall_rating" name="overall_rating">
			<?php for( $i=1; $i <= 5; $i++ ) {
				echo '<option value="'. $i .'"';
				if ( $overall_rating == $i ) echo ' selected';
				echo '>'. $i .' </option>'; 
				}
			?>
			</select>
    </p>
    <?php
		echo '<script>';
		echo 'jQuery(function() {
	      	jQuery("#driving_rating, #interior_rating, #space_rating, #overall_rating").barrating({
	        	theme: "fontawesome-stars-o",
	        	emptyValue: 0,
	        	allowEmpty: true
	      	});
	    });';
	    echo '</script>';
    }
}

// Update comment meta data from comment edit screen 

add_action( 'edit_comment', 'grandcarrental_extend_comment_edit_metafields' );
function grandcarrental_extend_comment_edit_metafields( $comment_id ) 
{
	$obj_comment = get_comment($comment_id);
	$post_type = get_post_type($obj_comment->comment_post_ID);
	
	if($post_type == 'car')
	{
	    if( ! isset( $_POST['grandcarrental_extend_comment_update'] ) || ! wp_verify_nonce( $_POST['grandcarrental_extend_comment_update'], 'grandcarrental_extend_comment_update' ) ) return;
	
		if ( ( isset( $_POST['driving_rating'] ) ) && ( $_POST['driving_rating'] != '') ):
		$rating = wp_filter_nohtml_kses($_POST['driving_rating']);
		update_comment_meta( $comment_id, 'driving_rating', $rating );
		else :
		delete_comment_meta( $comment_id, 'driving_rating');
		endif;
		
		if ( ( isset( $_POST['interior_rating'] ) ) && ( $_POST['interior_rating'] != '') ):
		$rating = wp_filter_nohtml_kses($_POST['interior_rating']);
		update_comment_meta( $comment_id, 'interior_rating', $rating );
		else :
		delete_comment_meta( $comment_id, 'interior_rating');
		endif;
		
		if ( ( isset( $_POST['space_rating'] ) ) && ( $_POST['space_rating'] != '') ):
		$rating = wp_filter_nohtml_kses($_POST['space_rating']);
		update_comment_meta( $comment_id, 'space_rating', $rating );
		else :
		delete_comment_meta( $comment_id, 'space_rating');
		endif;
		
		if ( ( isset( $_POST['overall_rating'] ) ) && ( $_POST['overall_rating'] != '') ):
		$rating = wp_filter_nohtml_kses($_POST['overall_rating']);
		update_comment_meta( $comment_id, 'overall_rating', $rating );
		else :
		delete_comment_meta( $comment_id, 'overall_rating');
		endif;
	}
}

// Add the comment meta (saved earlier) to the comment text 
// You can also output the comment meta values directly in comments template  

add_filter( 'comment_text', 'grandcarrental_modify_comment');
function grandcarrental_modify_comment( $text )
{
	$post_type = get_post_type();
	
	if($post_type == 'car')
	{
		$plugin_url_path = WP_PLUGIN_URL;
	
		if( $driving_rating = get_comment_meta( get_comment_ID(), 'driving_rating', true ) ) {
			$text.= '<div class="comment_rating_wrapper">';
			$text.= '<div class="comment_rating_label">'.esc_html__('Driving', 'grandcarrental').'</div>';
			
			$text.= '<div class="br-theme-fontawesome-stars-o"><div class="br-widget">';
			
			for( $i=1; $i <= $driving_rating; $i++ ) {
				$text.= '<a href="javascript:;" class="br-selected"></a>';
			}
			
			$empty_star = 5 - $driving_rating;
			
			if(!empty($empty_star))
			{
				for( $i=1; $i <= $empty_star; $i++ ) {
					$text.= '<a href="javascript:;"></a>';
				}
			}
			
			$text.= '</div></div></div>';		
		}
		
		if( $interior_rating = get_comment_meta( get_comment_ID(), 'interior_rating', true ) ) {
			$text.= '<div class="comment_rating_wrapper">';
			$text.= '<div class="comment_rating_label">'.esc_html__('Interior Layout', 'grandcarrental').'</div>';
			
			$text.= '<div class="br-theme-fontawesome-stars-o"><div class="br-widget">';
			
			for( $i=1; $i <= $interior_rating; $i++ ) {
				$text.= '<a href="javascript:;" class="br-selected"></a>';
			}
			
			$empty_star = 5 - $interior_rating;
			
			if(!empty($empty_star))
			{
				for( $i=1; $i <= $empty_star; $i++ ) {
					$text.= '<a href="javascript:;"></a>';
				}
			}
			
			$text.= '</div></div></div>';	
		}
		
		if( $space_rating = get_comment_meta( get_comment_ID(), 'space_rating', true ) ) {
			$text.= '<div class="comment_rating_wrapper">';
			$text.= '<div class="comment_rating_label">'.esc_html__('Space & Practicality', 'grandcarrental').'</div>';
			
			$text.= '<div class="br-theme-fontawesome-stars-o"><div class="br-widget">';
			
			for( $i=1; $i <= $space_rating; $i++ ) {
				$text.= '<a href="javascript:;" class="br-selected"></a>';
			}
			
			$empty_star = 5 - $space_rating;
			
			if(!empty($empty_star))
			{
				for( $i=1; $i <= $empty_star; $i++ ) {
					$text.= '<a href="javascript:;"></a>';
				}
			}
			
			$text.= '</div></div></div>';	
		}
		
		if( $overall_rating = get_comment_meta( get_comment_ID(), 'overall_rating', true ) ) {
			$text.= '<div class="comment_rating_wrapper">';
			$text.= '<div class="comment_rating_label">'.esc_html__('Overall', 'grandcarrental').'</div>';
			
			$text.= '<div class="br-theme-fontawesome-stars-o"><div class="br-widget">';
			
			for( $i=1; $i <= $overall_rating; $i++ ) {
				$text.= '<a href="javascript:;" class="br-selected"></a>';
			}
			
			$empty_star = 5 - $overall_rating;
			
			if(!empty($empty_star))
			{
				for( $i=1; $i <= $empty_star; $i++ ) {
					$text.= '<a href="javascript:;"></a>';
				}
			}
			
			$text.= '</div></div></div>';	
		}
	}
	
	return $text;
}

add_filter( 'posts_where', 'grandcarrental_search_posts_where', 10, 2 );
function grandcarrental_search_posts_where( $where, &$wp_query )
{
    global $wpdb;
    if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
        $where .= 'OR (' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $post_title_like ) ) . '%\' ';
        $where .= 'AND ' . $wpdb->posts . '.post_type = \'car\')';
    }
    return $where;
}

//Make widget support shortcode
add_filter('widget_text', 'do_shortcode');
?>