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

	<div class="assemblage-time">
    <?php
    $fields_desc = get_field('assemblage_time'); 
    if(!empty($fields_desc)):
    ?>
      <p class="value-field">
        <?php echo $fields_desc; ?>
      </p>
     <?php endif;?>
	</div>


