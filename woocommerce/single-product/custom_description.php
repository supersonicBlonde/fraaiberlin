<?php
/**
 * Custom description
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

	<div class="custom-description">
    <?php
    $fields_desc = [];
    $fields_desc[0] = get_field_object('source_materials');
    $fields_desc[1] = get_field_object('dimension_options');
    $fields_desc[2] = get_field_object('availability_shipping');

    foreach($fields_desc as $field):
     if($field['value'] != ''): ?>
      <div class="desc-container">
        <div class="label">
          <?php echo $field['label']; ?>
        </div>
        <p class="value-field">
          <?php echo $field['value']; ?>
        </p>
      </div>
     <?php endif;
    endforeach;?>
	</div>


