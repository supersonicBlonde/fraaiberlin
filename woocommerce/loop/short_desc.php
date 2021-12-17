<?php
/**
 * Loop Short Deescription
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;


echo '<div class="short-description">'.get_the_excerpt().'</div>';
