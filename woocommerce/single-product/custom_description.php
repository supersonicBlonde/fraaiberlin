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

    $count = 0; foreach($fields_desc as $field):
     if($field['value'] != ''): ?>
      <div class="desc-container">
        <div class="label closed" data-toggle="collapse" href="#collapse<?php echo $count; ?>">
          <?php echo $field['label']; ?>
        </div>
        <div class="value-field collapse" id="collapse<?php echo $count; ?>"> 
          <?php echo $field['value']; ?>
        </div>
      </div>
     <?php endif;
    $count++; endforeach;?>
	</div>


