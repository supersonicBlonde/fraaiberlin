<?php
/**
* 
*
* @package purnatur
*/

function quanta_get_attachment( $num = 1 ) {

	$output = '';

	if (has_post_thumbnail() && $num == 1 ): 
			
		$output = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()));

	 else: 

		$attachments = get_posts( array(
			'post_type'   		=> 'attachment',
			'posts_per_page'	=> $num,
			'post_parent'		=> get_the_ID()
		));


		if($attachments && $num == 1):
		
			foreach($attachments as $attachment):
				$output = wp_get_attachment_url( $attachment->ID );
			endforeach;

		elseif($attachments && $num > 1):

			$output = $attachments;
		
		endif;

		wp_reset_postdata();

	 endif;

	return $output;
}

function quanta_get_categories_by_id($id) {

	$cat = wp_get_post_categories( $id);
	
	$cats = array();

	$html = '<div class="cat-container"><ul>';
	foreach($cat as $c){
	    $cat = get_category( $c );
	    //$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
	    $html .= '<li class="mx-1"><a href="/category/'.$cat->slug.'" class="bgaccent py-1 px-3">'.$cat->name.'</a></li>';
	}

	$html .= '</ul></div>';

	return $html;
}