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
             
              <?php 
              $id = $product->get_id(); 
              $terms = get_the_terms($id , 'product_cat');
              $term_id= [];
              foreach($terms as $term) {
                $term_id[] = $term->term_id;
              }
              
              $options = get_field('apply_on_product_categories' , 'options');
             
              if(count(array_intersect($term_id, $options)) > 0):
              ?>
              
                <h3 class="text-center my-5"><?php the_field('configurator_title' , 'options'); ?></h3>
                <p><?php the_field('configurator_paragraph' , 'options') ?></p>s
                <div class="text-center my-5">
                  <a class="button default" href="/contact"><?php echo __('Contact us'); ?></a>
                </div>
                <?php endif;?>
              <?php endif; ?>
      </div>
    </div>
  </div>
</div>


