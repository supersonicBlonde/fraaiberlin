<?php

/*
	
@package gsc
	
	========================
		THEME CUSTOM POST TYPES
	========================
*/

add_action( 'init', 'gsc_stories' );

function gsc_stories() {
	$labels = array(
		'name' 				=> 'Stories',
		'singular_name' 	=> 'Story',
		'menu_name'			=> 'Stories',
		'name_admin_bar'	=> 'Stories'
	);
	
	$args = array(
		'labels'				=> $labels,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'capability_type'		=> 'post',
		'hierarchical'			=> true,
	 	'has_archive'		  	=> false,
		'public'  	=> true,
		'show_in_rest' => true,
		'query_var' => true, 
		'rewrite' => array('slug' => 'customer-stories'),
		'menu_icon'				=> 'dashicons-format-status',
		'supports'				=> array( 'title', 'author' , 'editor' , 'thumbnail' , 'excerpt' )
	);
	
	register_post_type( 'customer_stories', $args );
}

add_action( 'init', 'gsc_integration' );

function gsc_integration() {
	$labels = array(
		'name' 				=> 'Integration',
		'singular_name' 	=> 'Integration',
		'menu_name'			=> 'Integrations',
		'name_admin_bar'	=> 'Integrations'
	);
	
	$args = array(
		'labels'				=> $labels,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'capability_type'		=> 'post',
		'hierarchical'			=> true,
		'has_archive'		  	=> false,
		'public'  	=> true,
		'menu_position'			=> 10,
		'show_in_rest'	=> true,
		'menu_icon'				=> 'dashicons-format-status',
		'supports'				=> array( 'title', 'author' , 'editor' , 'thumbnail' , 'excerpt' )
	);
	
	register_post_type( 'integration', $args );
}


//************************************** */
add_action( 'init', 'gsc_testimonies' );

function gsc_testimonies() {
	$labels = array(
		'name' 				=> 'Testimonials',
		'singular_name' 	=> 'Testimonial',
		'menu_name'			=> 'Testimonials',
		'name_admin_bar'	=> 'Testimonials'
	);
	
	$args = array(
		'labels'				=> $labels,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'capability_type'		=> 'post',
		'hierarchical'			=> true,
		'has_archive'		  	=> false,
		'public'  	=> true,
		'menu_position'			=> 10,
		'menu_icon'				=> 'dashicons-format-status',
		'supports'				=> array( 'title')
	);
	
	register_post_type( 'testimonies', $args );
}


add_action( 'init', 'gsc_faq' );

function gsc_faq() {
	$labels = array(
		'name' 				=> 'K. Base',
		'singular_name' 	=> 'K. Base',
		'menu_name'			=> 'K. Base',
		'name_admin_bar'	=> 'K. Base'
	);
	
	$args = array(
		'labels'				=> $labels,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'capability_type'		=> 'post',
		'hierarchical'			=> true,
		'has_archive'		  	=> false,
		'public'  	=> true,
		'menu_position'			=> 10,
		'menu_icon'				=> 'dashicons-admin-tools',
		'show_in_rest' => true,
		'query_var' => true, 
		'rewrite' => array('slug' => 'knowledge-base'),
		
		'supports'				=> array( 'title' , 'thumbnail' , 'editor' , 'excerpt' )
	);
	
	register_post_type( 'faq', $args );
}

add_action( 'init', 'gsc_pricing_plan' );
add_action( 'init', 'gsc_pricing_tax' );


function gsc_pricing_plan() {
	$labels = array(
		'name' 				=> 'Pricing',
		'singular_name' 	=> 'Pricing',
		'menu_name'			=> 'Pricing',
		'name_admin_bar'	=> 'Pricing'
	);
	
	$args = array(
		'labels'				=> $labels,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'capability_type'		=> 'post',
		'hierarchical'			=> true,
		'has_archive'		  	=> false,
		'public'  	=> false,
		'menu_position'			=> 10,
		'menu_icon'				=> 'dashicons-money-alt',
		'supports'				=> array( 'title' )
	);
	
	register_post_type( 'pricing', $args );
}


function gsc_pricing_tax() {
	
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => __( 'Categories' ),
		'singular_name'     => __( 'Categorie' ),
		'menu_name'         => __( 'Catégorie'),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'frequency' ),
	);

	register_taxonomy( 'frequency', array( 'pricing' ), $args );
}

add_action( 'init', 'gsc_cta' );

function gsc_cta() {
	$labels = array(
		'name' 				=> 'CTA',
		'singular_name' 	=> 'CTA',
		'menu_name'			=> 'CTA',
		'name_admin_bar'	=> 'CTA'
	);
	
	$args = array(
		'labels'				=> $labels,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'capability_type'		=> 'post',
		'hierarchical'			=> false,
		'has_archive'		  	=> false,
		'public'  					=> false,
		'menu_position'			=> 10,
		'register_meta_box_cb' => 'gsc_add_shortcode_metaboxes',
		'menu_icon'				=> 'dashicons-carrot',
		'supports'				=> array( 'title' )
	);
	
	register_post_type( 'gsc_cta', $args );
}


/**
 * Adds a metabox to the right side of the screen under the â€œPublishâ€ box
 */
function gsc_add_shortcode_metaboxes() {
	add_meta_box(
		'gsc_shortcode',
		'Shortcode',
		'gsc_shortcode',
		'gsc_cta',
		'side',
		'default'
	);
}

/**
 * Output the HTML for the metabox.
 */
function gsc_shortcode() {
	global $post;

	// Nonce field to validate form request came from current site
	wp_nonce_field( basename( __FILE__ ), 'shortcode_fields' );

	// Get the location data if it's already been entered
	$shortcode = get_post_meta( $post->ID, 'shortcode', true );

	// Output the field
	echo '<input type="text" name="shortcode" readonly value="[block-cta id='.$post->ID.']" class="widefat">';

}

/**
 * Save the metabox data
 */
function gsc_save_shortcode_meta( $post_id, $post ) {

	// Return if the user doesn't have edit permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if ( ! isset( $_POST['shortcode'] ) || ! wp_verify_nonce( $_POST['shortcode_fields'], basename(__FILE__) ) ) {
		return $post_id;
	}

	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $events_meta.
	$events_meta['shortcode'] = esc_textarea( $_POST['shortcode'] );

	// Cycle through the $events_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
	foreach ( $events_meta as $key => $value ) :

		// Don't store custom data twice
		if ( 'revision' === $post->post_type ) {
			return;
		}

		if ( get_post_meta( $post_id, $key, false ) ) {
			// If the custom field already has a value, update it.
			update_post_meta( $post_id, $key, $value );
		} else {
			// If the custom field doesn't have a value, add it.
			add_post_meta( $post_id, $key, $value);
		}

		if ( ! $value ) {
			// Delete the meta key if there's no value
			delete_post_meta( $post_id, $key );
		}

	endforeach;

}
add_action( 'save_post', 'gsc_save_shortcode_meta', 1, 2 );

add_action( 'manage_gsc_cta_posts_columns', 'set_custom_columns' );
add_action('manage_gsc_cta_posts_custom_column' , 'setCustomColumnsData' , 10 , 2);
/* add_filter('manage_edit-gsc_cta_sortable_columns' , 'setColumnsSortable'); */

function set_custom_columns($columns)
{
	$columns['shortcode'] = 'Shortcode';

	return $columns;
}

function setCustomColumnsData($columns , $post_id) 
{

	$data = get_post_meta($post_id, 'shortcode' , true);

	
	$shortcode = isset($data)?$data:'';

	switch($columns) {
	
		case 'shortcode':
			echo $shortcode;
			break;
	}


	return $columns;

}

/* function setColumnsSortable($column)
{
	$columns['shortcode'] = 'shortcode';

	return $columns;
} */