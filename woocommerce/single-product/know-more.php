<?php
/**
 * Assemblage time
 *
 *  *
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add some cutom fields 
 *
 */
  global $product;
?>

	<div class="extra-description">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-10 offset-1">
          <h3 class="text-center my-5">Would you like to know more?</h3>
          <p>Then please check our collection of frequently asked questions & answers. You may find them quite useful!</p>
          <div class="text-center my-5">
            <a class="button default" href="/contact"><?php echo __("Show FAQ's"); ?></a>
          </div>
      </div>
    </div>
  </div>
</div>


