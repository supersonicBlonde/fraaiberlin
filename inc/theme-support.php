<?php

/*
	
@package fraaiberlin
	
	========================
		THEME SUPPORT
	========================
*/

/*
========================
ENABLE WOOCOMMERCE SUPPORT
	========================
*/
add_action( 'after_setup_theme', 'enable_woocommerce_support' );

function enable_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}



//menu options
function quanta_register_nav_menu() {
	
	register_nav_menu( 'primary' , 'This is the Main Nav ' );
	register_nav_menu( 'footer' , 'This is the Footer Menu' );
}

add_action( 'after_setup_theme', 'quanta_register_nav_menu');


/*
========================
		BLOG LOOP CUSTOM FUNCTIONS
	========================
*/



function quanta_time_ago() {
	return 'Il y a '.human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) );
}


function quanta_posted_meta() {

	$posted_on = human_time_diff( get_the_time('U'), current_time( 'timestamp') ) . 'ago';

	$categories = get_the_category();
	$separator = ',';
	$output = '';
	$i = 1;

	if(!empty($categories)):
		foreach ($categories as $cat) {
			
			if($i > 1 ): $output .= $separator; endif;

			$output .= '<a href="'. esc_url(get_category_link( $cat->term_id ) ).'" alt="'.esc_attr('View all posts in %s', $cat->name  ).'">'.esc_html($cat->name).'</a>';
			$i++;
		}
	endif;

	return '<span class="posted-on">Posted <a href="'. esc_url(get_the_permalink() ).'">'.$posted_on.'</a></span> / <span class="posted-in">'. $output .'</span>';
}

function quanta_posted_footer() {
	$comments_num = get_comments_number();
	if(comments_open()) {
		if($comments_num == 0) {
			$comments = __('No comments');
		}
		elseif($comments_num > 1) {
			$comments = $comments_num. __(' Comments');
		}
		else {
			$comments = __('1 Comment');	
		}
		$comments = '<a class="comments-link" href="'. get_comments_link() .'">'.$comments.'<span class="np-icons np-comment"></span></a>';
	} else {
		$comments = 'Comments are closed';
	}

	return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">'. get_the_tag_list( '<div class="tags-list"><span class="np-icons quanta-tag"></span>', '', '</div>') .'</div><div class="col-xs-12 col-sm-6 text-right">'. $comments .'</div></div></div>';
}




function quanta_embed_media($type = array()) {
		$content = do_shortcode( apply_filters ('the_content' , get_the_content()));

		$embed = get_media_embedded_in_content( $content, array('audio' , 'iframe') );

		if( in_array('audio' , $type) ):
			$output = str_replace( '?visual=true' , '?visual=false' , $embed[0]);
		else:
			$output = $embed[0];
		endif;

		return $output;
}



function quanta_grab_url() {
	if( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links ) ){
		return false;
	}
	return esc_url_raw( $links[1] );
}


function quanta_get_current_url() {
	$http = isset($_SERVER['HTTPS'])?'https://':'http://';
	$referer = $http . $_SERVER['HTTP_HOST'];
	return  $referer.$_SERVER['REQUEST_URI']; 
}


/* add multiple widgets areas */
function widget_registration($name, $id, $description,$beforeWidget, $afterWidget, $beforeTitle, $afterTitle){
	register_sidebar( array(
			'name' => $name,
			'id' => $id,
			'description' => $description,
			'before_widget' => $beforeWidget,
			'after_widget' => $afterWidget,
			'before_title' => $beforeTitle,
			'after_title' => $afterTitle,
	));
}

function multiple_widget_init(){
	widget_registration('Footer Left', 'footer-1', 'Menu', '', '', '', '');
	widget_registration('Footer Right', 'footer-2', 'Menu', '', '', '', '');
}

add_action('widgets_init', 'multiple_widget_init');

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}


// COUNT POSTS
function quanta_set_post_views($postID) {
	$count_key = 'quanta_post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
	}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
	}
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function quanta_get_post_views($postID){
	$count_key = 'quanta_post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0 View";
	}
	return $count.' Views';
}


function prefix_nav_description( $item_output, $item, $depth, $args ) {
	if ( !empty( $item->description ) ) {
			$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'prefix_nav_description', 10, 4 );