<?php
/**
 * functions and definitions
 *
 * 
 *
 * @package fraaiberlin
 */



require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';
//require get_template_directory() . '/inc/cleanup.php';	
require get_template_directory() . '/inc/helpers.php';
//require get_template_directory() . '/inc/function-admin.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/theme-support.php';
require get_template_directory() . '/inc/custom-post-type.php';
require get_template_directory() . '/inc/ajax.php';
require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/woocommerce_custom.php';





# Highlight query in search results

function generate_excerpt($text, $query, $length) {

	$words = explode(' ', $text);
	$total_words = count($words);

	if ($total_words > $length) {

		$queryLow = array_map('strtolower', $query);
		$wordsLow = array_map('strtolower', $words);

		for ($i=0; $i <= $total_words; $i++) {

			foreach ($queryLow as $queryItem) {

				if (preg_match("/\b$queryItem\b/", $wordsLow[$i])) {
					$posFound = $i;
					break;
				}
			}

			if ($posFound) {
				break;
			}
		}

		if ($i > ($length+($length/2))) {
			$i = $i - ($length/2);
		} else {
      $i = 0;
    }

	}

	$cutword = array_splice($words,$i,$length);
	$excerpt = implode(' ', $cutword);

	$keys = implode('|', $query);
	$excerpt = preg_replace('/(' . $keys .')/iu', '<strong class="tx-indexedsearch-redMarkup">\0</strong>', $excerpt);
	$excerptRet = '<p>';
  if ($i !== 0) {
    $excerptRet .= '... ';
  }
  $excerptRet .= $excerpt . ' ...</p>';

	return $excerptRet;
  
}

function search_excerpt_highlight($content) {

    # Length in word count
    $excerptLength = 32;

    $text = wp_strip_all_tags( $content );

    # Filter double quotes from query. They will
    # work on the results side but won't help with
    # text highlighting and displaying.
    $query=get_search_query(false);
    $query=str_replace('"','',$query);
    $query=esc_html($query);

    $query = explode(' ', $query);

    echo generate_excerpt($text, $query, $excerptLength);

}

function archive_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}
 