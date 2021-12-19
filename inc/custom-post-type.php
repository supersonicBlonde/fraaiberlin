<?php

/*
	
@package fraaiberlin
	
	========================
		THEME CUSTOM POST TYPES
	========================
*/


add_action( 'init', 'fraai_faq' );

function fraai_faq() {
	$labels = array(
		'name' 				=> 'FAQ',
		'singular_name' 	=> 'FAQ',
		'menu_name'			=> 'FAQ',
		'name_admin_bar'	=> 'FAQ'
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
		'menu_icon'				=> 'dashicons-paperclip',
		'supports'				=> array(  'title', 'revisions', 'author', 'excerpt')
	);
	
	register_post_type( 'faq', $args );
}

add_action( 'init', 'fraai_faq_tax' );


function fraai_faq_tax() {
	
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => __( 'FAQ Categories' ),
		'singular_name'     => __( 'FAQ Category' ),
		'menu_name'         => __( 'Categories'),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in-rest'			=> true,
		'show_admin_column' => true,
		'query_var'         => true,
	);

	register_taxonomy( 'faq_cat', array( 'faq' ), $args );
}

