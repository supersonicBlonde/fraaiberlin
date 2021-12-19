<?php

/**
* Ajax functions
*
* @package fraaiberlin

*/

add_action('wp_ajax_loadmoregeneric', 'loadmoregeneric'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmoregeneric', 'loadmoregeneric'); // wp_ajax_nopriv_{action}

function loadmoregeneric(){
 
	// it is always better to use WP_Query but not here
	$args = array(
    'post_type' => 'product',
    'post_status'  => 'publish',
    'posts_per_page' => 12,
    'paged' => $_POST['page'] + 1,
);

  $loop = new WP_Query($args);

  $data = '';


	if( $loop->have_posts() ) :
    ob_start();
		// run the loop
	while( $loop->have_posts() ): $loop->the_post();
    $product = wc_get_product( get_the_ID() );
    $price = '<span class="price">'.$product->get_price_html().'</span>';
      
	  $data .= 	'<div class="col-md-4 mb-4 product-catalogue-item">';
    $data .=  '<a href="'.get_the_permalink().'">';                  
    $data .=   woocommerce_get_product_thumbnail();
    $data .=   '</a>';
    $data .=   '<h2 class="mt-3 woocommerce-loop-product__title">';
    $data .=   '<a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>';
    $data .=   '<div class="short-description">'.get_the_excerpt().'</div>';
    $data .=   $price;
    $data .= '</div>'; 
     
		endwhile;

    ob_end_clean();
 
	endif; 

  echo $data;
	die; 


}

/* add_action('wp_ajax_filter_by_category', 'filter_by_category');
add_action('wp_ajax_nopriv_filter_by_category', 'filter_by_category');

function filter_by_category() {
  $filter = sanitize_text_field($_POST['filter']);

  $args = array(
      'post_type' => 'product',
      'post_status'  => 'publish',
      'posts_per_page' => -1,
      'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $filter,
        ),
      ),
  );
 
  $loop = new WP_Query($args);
  $res = [];
  $res['posts'] = [];  
  while($loop->have_posts()): $loop->the_post();
  $product = wc_get_product( get_the_ID() );
   $res['posts'][] = array(
    'title' => get_the_title(),
    'thumbnail' => woocommerce_get_product_thumbnail(),
    'excerpt' => get_the_excerpt(),
    'price' => $product->get_price_html()
    ); 
  endwhile;
  
  ob_start();
  get_template_part('template-parts/loop', 'product' , $res);
  wp_send_json_success(ob_get_clean()); 
  wp_die();
}

add_action('wp_ajax_clear_filter', 'clear_filter');
add_action('wp_ajax_nopriv_clear_filter', 'clear_filter');

function clear_filter() {
  $filter = sanitize_text_field($_POST['filter']);

  $args = array(
      'post_type' => 'product',
      'post_status'  => 'publish',
      'posts_per_page' => 12
  );
 
  $loop = new WP_Query($args);
  $res = [];
  $res['posts'] = [];  
  while($loop->have_posts()): $loop->the_post();
  $product = wc_get_product( get_the_ID() );
   $res['posts'][] = array(
    'title' => get_the_title(),
    'thumbnail' => woocommerce_get_product_thumbnail(),
    'excerpt' => get_the_excerpt(),
    'price' => $product->get_price_html()
    ); 
  endwhile;
  
  ob_start();
  get_template_part('template-parts/loop', 'product' , $res);
  wp_send_json_success(ob_get_clean()); 
  wp_die();
} */