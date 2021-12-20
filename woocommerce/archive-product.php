<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

$obj = get_queried_object();
if(isset($obj->slug)) {
	$tax = array(array(
		'taxonomy' => 'product_cat',
		'field'    => 'slug',
		'terms'    => $obj->slug,
),);
}
else {
	$tax='';
}

 ?>
<div class="primary content-area top-spacing" id="shop-page">

	<main id="main" class="site-main" role="main">

	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
					<?php echo woocommerce_breadcrumb(); ?>
			</div>
		</div>
	</div>
			
		

		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3 col-12">
					<div class="filter-col">
						<div class="head-col"><?php echo __('Filters'); ?></div>
							<?php echo do_shortcode('[yith_wcan_filters slug="draft-preset"]'); ?>
						</div>
				</div>
				
				<div class="col-md-9 col-12">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="search-form-container">
									<?php get_search_form(); ?>
								</div>
							</div>	
						</div>
					</div>
					<div class="catalogue-container">
				<?php
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => 12,
					'tax_query' => $tax,
					'paged' => $paged
        );
       
        $the_query = new WP_Query( $args );
		 		$max_pages = $the_query->max_num_pages;
        if ( $the_query->have_posts() ): ?>
          <div class="container-fluid">
            <div class="row product-catalogue-item__container test">
          <?php 
          while ( $the_query->have_posts() ):
              $the_query->the_post();
          ?>
              <div class="col-md-4 mb-4 product-catalogue-item">
									<a href="<?php the_permalink() ?>">                  
									<?php echo woocommerce_get_product_thumbnail(); ?>
									</a>
									       
										<h2 class="mt-3 woocommerce-loop-product__title"><a href="<?php the_permalink() ?>"><?php echo get_the_title(); ?></a></h2>
									
									<div class="short-description"><?php echo get_the_excerpt(); ?></div>
									<?php wc_get_template( 'loop/price.php' );?>
              </div>
          <?php endwhile; ?>
            </div>
						<div class="row">
							<div class="col-12 text-center">
							<?php global $the_query;?>
								<?php if($max_pages > 1):  ?>
									<a href="" data-current="1" data-max='<?php echo $max_pages ?>'  class="loadmore button default"><?php echo __('Show more' , 'gsc'); ?></a>
								<?php endif; ?>
							</div>
						</div>
          </div>
          <?php else: 
          echo "no products found";
          endif;
				?>
					</div>
				</div>
			</div>
		</div>
	</main>

</div>



<?php

get_footer();