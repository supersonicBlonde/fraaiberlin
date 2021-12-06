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
add_action('woocommerce_before_main_content', 'iconic_open_div', 5);

function iconic_open_div() {
    echo '<div class="global-container"><div class="container-fluid"><div class="row"><div class="col-12">';
}

/**
 * Closing div for our content wrapper
 */
add_action('woocommerce_after_main_content', 'iconic_close_div', 50);

function iconic_close_div() {
    echo '</div></div></div></div>';
}