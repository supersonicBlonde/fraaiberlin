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
            <?php
            $desc = get_field('albert_words'); 
            if(!empty($desc)):
            ?>
              <div class="albert-pic text-center">
                <img class="circle" src="<?php echo get_template_directory_uri()?>/img/portrait-albert 1.jpg">
              </div>
              <h3 class="text-center my-5">In Albert's words</h3>
              <p>
                <?php echo $desc; ?>
              </p>
              <h3 class="text-center my-5">How about designing your own Fraai piece?</h3>
              <p>When it comes to size, finishes or materials, every Fraai product can be personalized down to the tiniest detail. Got a wild idea? Try our configurator or get in touch with us!</p>
              <?php endif;?>
              <div class="text-center my-5">
                <a class="button default" href="/contact"><?php echo __('Contact us'); ?></a>
              </div>
      </div>
    </div>
  </div>
</div>


