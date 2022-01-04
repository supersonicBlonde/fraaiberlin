<?php

/*
	
@package fraaiberlin
	



/*
	
	========================
		FRONT ENQUEUE FUNCTIONS
	========================
*/

function quanta_load_scripts() {

		if(!is_admin()) {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', get_template_directory_uri().'/dist/js/jquery-3.5.1.min.js', array(), '3.5.1', true );
			wp_enqueue_script( 'jquery' );
		}

		wp_enqueue_style('josefin' , 'https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;300;400;700&display=swap');
		wp_enqueue_style('abril' , 'https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap');
		wp_enqueue_style('abril' , 'https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap');

		
		wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', array(), '4.0.0', 'all' );
		wp_enqueue_style( 'slick', get_template_directory_uri().'/dist/css/slick.css', array() );
		/* wp_enqueue_style('uicss' , '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
		wp_enqueue_script('jquery-ui' , 'https://code.jquery.com/ui/1.12.1/jquery-ui.js' , array('jquery'), '' , true);
		wp_enqueue_script('waypoints' , get_template_directory_uri().'/dist/js/noframework.waypoints.min.js', array('jquery'), '', true ); */

		/* wp_enqueue_style( 'font-awesome',get_template_directory_uri().'/dist/css/all.css'); */
		wp_enqueue_style( 'fraaiberlin', get_template_directory_uri().'/dist/css/styles.min.css', array(), '1.0.0', 'all' );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/dist/js/bootstrap.min.js', array('jquery'), '4.5.2', true );	
		wp_enqueue_script( 'slick', get_template_directory_uri().'/dist/js/slick.min.js', array('jquery'), '', true );	
	
		/* wp_enqueue_script( 'matchheight', get_template_directory_uri().'/dist/js/jquery.matchHeight-min.js', array('jquery'), '', true ); */
		wp_enqueue_script( 'main', get_template_directory_uri().'/dist/js/scripts.min.js', array('jquery' , 'bootstrap'), '', true );
		//wp_enqueue_script( 'filter', get_template_directory_uri().'/dist/js/filter.min.js', array('jquery'), '', true );
		 wp_enqueue_script( 'loadmore', get_template_directory_uri().'/dist/js/loadmore.min.js', array('jquery'), '', true );

		
		wp_localize_script('filter', 'ajax_var', array(
			'url' => admin_url('admin-ajax.php'),
			'check_nonce' => wp_create_nonce('ajax-nonce'),
			/* 'posts' => get_post_type( get_queried_object() ), // everything about your loop is here
			'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
			'max_page' => $wp_query->max_num_pages */
		)
		);

		wp_localize_script('loadmore', 'ajax_var', array(
			'url' => admin_url('admin-ajax.php'),
			'check_nonce' => wp_create_nonce('ajax-nonce'),
			'posts' => get_post_type( get_queried_object() ), // everything about your loop is here
			'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
			//'max_page' => $wp_query->max_num_pages
		)
	); 

}

add_action( 'wp_enqueue_scripts', 'quanta_load_scripts');

