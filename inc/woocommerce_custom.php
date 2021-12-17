<?php

/*
	
@package fraaiberlin
	
	========================
		WOOCOMMERCE
	========================
*/

/**
 * Opening div for our content wrapper
 */
add_action('woocommerce_before_main_content', 'fraai_open_div', 5);

function fraai_open_div() {
    echo '<div class="global-container"><div class="container-fluid"><div class="row"><div class="col-12">';
}

/**
 * Closing div for our content wrapper
 */
add_action('woocommerce_after_main_content', 'fraai_close_div', 50);

function fraai_close_div() {
    echo '</div></div></div></div>';
}

// gallery fraai
add_action( 'woocommerce_product_fraai_gallery', 'fraai_show_gallery', 20 );

if ( ! function_exists( 'fraai_show_gallery' ) ) {

	/**
	 * Output the product thumbnails.
	 */
	function fraai_show_gallery() {
		wc_get_template( 'single-product/product-gallery.php' );
	}
}

// add suffix to price
/* add_filter( 'woocommerce_get_price_html', 'valtesse_text_after_price' );

function valtesse_text_after_price($price){

    $text_to_add_after_price  = ' + shipping<br><span class="price_suff">inkl. 16% MwSt.</span>';
		  
	return $price .   $text_to_add_after_price;
		  
} */ 

// Custom fields

add_action( 'woocommerce_single_product_summary', 'fraai_insert_custom_description', 29 );

if ( ! function_exists( 'fraai_insert_custom_description' ) ) {

	/**
	 * Output the product price.
	 */
	function fraai_insert_custom_description() {
		wc_get_template( 'single-product/custom_description.php' );
	}
}

add_action( 'woocommerce_single_product_summary', 'fraai_insert_assemblage_time', 23 );

if ( ! function_exists( 'fraai_insert_assemblage_time' ) ) {

	/**
	 * Output the product price.
	 */
	function fraai_insert_assemblage_time() {
		wc_get_template( 'single-product/assemblage-time.php' );
	}
}

// remove sku and categorieson product
add_filter( 'wc_product_sku_enabled', '__return_false' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
// remove additional information
/** Remove product data tabs */
 
add_filter( 'woocommerce_product_tabs', 'valtesse_remove_product_tabs', 98 );
 
function valtesse_remove_product_tabs( $tabs ) {
  unset( $tabs['additional_information'] ); // To remove the additional information tab
  return $tabs;
}

// Change "Add to Cart" text in Single Page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_single_page_add_to_cart_callback' ); 
function woocommerce_single_page_add_to_cart_callback() {
    return __( 'Add to cart', 'fraaiberlin' ); 
}


// Add section after product description - Albert's word
add_action( 'woocommerce_after_single_product', 'valtesse_output_extra_description', 5 );

if ( ! function_exists( 'valtesse_output_extra_description' ) ) {
	function valtesse_output_extra_description() {
		wc_get_template( 'single-product/extra-description.php' );
	}
}

// Add section after product description - Albert's word
add_action( 'woocommerce_after_single_product', 'valtesse_output_know_more', 35 );

if ( ! function_exists( 'valtesse_output_know_more' ) ) {
	function valtesse_output_know_more() {
		wc_get_template( 'single-product/know-more.php' );
	}
}

// remove related product from product summary and move it to after single product
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 10 );
//add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 15 );

// change position of variation add to cart
remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_variable_add_to_cart', 25 );

/**
 * Change number of upsells output
 */
add_filter( 'woocommerce_upsell_display_args', 'wc_change_number_related_products', 20 );

function wc_change_number_related_products( $args ) {
 
 $args['posts_per_page'] = 3;
 $args['columns'] = 3; //change number of upsells here
 return $args;
}

/**
 * Change the breadcrumb separator
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = ' &gt; ';
	return $defaults;
}

// hide sortering select on shop page
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// hide button in loop archive-product
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

// add short description in archive-product
add_action( 'woocommerce_after_shop_loop_item', 'valtesse_template_loop_short_description', 10 );

if ( ! function_exists( 'valtesse_template_loop_short_description' ) ) {
	function valtesse_template_loop_short_description() {
		wc_get_template( 'loop/short_desc.php');
	}
}

// change position of price in archive-product
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 15 );

// formatting price
add_filter( 'formatted_woocommerce_price', 'fraai_custom_price_formatting', 10, 5 );
function fraai_custom_price_formatting( $number_format, $price, $decimals, $decimal_separator, $thousand_separator){
    return '<span class="custom-prc">'.$price.'</span>';
}
