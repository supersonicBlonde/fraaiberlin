<?php

/*
	
@package gsc
	



/*
	
	========================
		FRONT ENQUEUE FUNCTIONS
	========================
*/

function quanta_load_scripts() {

		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', get_template_directory_uri().'/dist/js/jquery-3.5.1.min.js', array(), '3.5.1', true );
		wp_enqueue_script( 'jquery' );

		wp_enqueue_style('poppins' , 'https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700&display=swap');
		/* 	wp_enqueue_style('worksans' , 'https://fonts.googleapis.com/css2?family=Work+Sans:wght@100;400;600;700&display=swap');
		wp_enqueue_style('roboto' , 'https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
	 */
		wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/dist/css/bootstrap.min.css', array(), '4.5.2', 'all' );
		wp_enqueue_style( 'slick', get_template_directory_uri().'/dist/css/slick.css', array() );
		wp_enqueue_style('uicss' , '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
		wp_enqueue_style('calendly' , 	"https://assets.calendly.com/assets/external/widget.css");
		/* 	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'); */
		wp_enqueue_script('jquery-ui' , 'https://code.jquery.com/ui/1.12.1/jquery-ui.js' , array('jquery'), '' , true);
		wp_enqueue_script('waypoints' , get_template_directory_uri().'/dist/js/noframework.waypoints.min.js', array('jquery'), '', true );

		wp_enqueue_style( 'font-awesome',get_template_directory_uri().'/dist/css/all.css');
		wp_enqueue_style( 'gsc', get_template_directory_uri().'/dist/css/styles.min.css', array(), '1.0.0', 'all' );

		wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/dist/js/bootstrap.min.js', array('jquery'), '4.5.2', true );
		wp_enqueue_script( 'slick', get_template_directory_uri().'/dist/js/slick.min.js', array('jquery'), '', true );	
	
		wp_enqueue_script( 'matchheight', get_template_directory_uri().'/dist/js/jquery.matchHeight-min.js', array('jquery'), '', true );
		wp_enqueue_script( 'main', get_template_directory_uri().'/dist/js/scripts.min.js', array('jquery' , 'bootstrap'), '', true );

		wp_enqueue_script( 'loadmore', get_template_directory_uri().'/dist/js/loadmore.min.js', array('jquery'), '', true );

		wp_enqueue_script( 'calendly', 'https://assets.calendly.com/assets/external/widget.js', array(), '', true );
		

		wp_localize_script('loadmore', 'ajax_var', array(
			'url' => admin_url('admin-ajax.php'),
			'check_nonce' => wp_create_nonce('ajax-nonce'),
			'posts' => get_post_type( get_queried_object() ), // everything about your loop is here
			'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
			'max_page' => $wp_query->max_num_pages
		)
	);

		/* if(is_page(290)):
			wp_enqueue_style('aos' , 'https://unpkg.com/aos@next/dist/aos.css');
			wp_enqueue_script( 'aos', 'https://unpkg.com/aos@next/dist/aos.js', array('jquery'), '', true );
			wp_enqueue_script( 'timeline', get_template_directory_uri().'/dist/js/timeline.min.js', array('jquery'), '', true );
		endif; */		

}

add_action( 'wp_enqueue_scripts', 'quanta_load_scripts');