<?php
/**
* Template Name: Home
*
* @package fraaiberlin
*/

get_header('home');


?>

	</header>


  <div class="primary" class="content-area top-spacing">

    <main id="main" class="site-main" role="main">

    <!-- FLEXIBLE CONTENT -->
    <?php
        if( have_rows('home_layout') ):

          
            while ( have_rows('home_layout') ) : the_row();

                // Case: PRODUCT CATEGORIES
                if( get_row_layout() == 'push_product_categories' ): ?>
                  
                  <?php
                    if(have_rows('product__category')): ?>
                      <div class="section push-categories global-container">
                        <div class="container-fluid gx-md-5">
                          <div class="row">
                            <?php while(have_rows('product__category')): the_row();
                            $cat_id = get_sub_field('category');
                            $term = get_term(  $cat_id, 'product_cat');
                            
                            $thumbnail_id = get_term_meta($term->term_id , 'thumbnail_id', true); 
                            $image = wp_get_attachment_url( $thumbnail_id );  ?>
                            <div class="col-12 col-md-4 d-flex justify-content-center mb-3">
                              <a class="w-100 href="<?php echo $term->slug; ?>" class="no-underline">
                                <div class="bg-categories background-image position-relative" style="background-image:url(<?php echo $image; ?>">
                                  <div class="title white uppercase display-4 bold position-absolute"><?php echo $term->name; ?></div>
                                </div>
                              </a>
                            </div>
                            <?php endwhile; //have_rows('product__category') ?>
                          </div>
                      </div>
                      <?php get_template_part('template-parts/element' , 'buttongroup'); ?>
                    </div><!-- .push-categories -->
                  <?php endif; //have_rows('product__category') ?>
                <?php elseif(get_row_layout() == 'module_image_text' ): 
                      $title_option = get_sub_field('title_options');
                      $image_option = get_sub_field('image_options');
                      $bg_container_class = '';
                      if($image_option == 'fullwidth') {
                        $image_full_width = get_sub_field('image_full_width');
                        $image_class = 'background-image bgheight600';
                      }
                      elseif($image_option == 'offset') {
                        $image_left = get_sub_field('image_left');
                        $image_right = get_sub_field('image_right');
                      }
                      else { 
                        $image_class = 'circled';
                        $image_full_width = get_sub_field('image_full_width');
                        $bg_container_class = 'd-flex justify-content-center';
                      } 
                      ?>
                     <div class="section module-image-text">
                        <div class="w-100">
                          <?php if($title_option == 'above'): ?>
                            <div>
                              <h2 class="title-lines text-center"><?php the_sub_field('title'); ?></h2>
                            </div>
                          <?php endif; ?>
                            <div class="<?php echo $bg_container_class; ?>">
                              <?php if($image_option == 'fullwidth' || $image_option == 'circled'): ?>
                                <div class="d-flex justify-content-center align-items-center <?php echo $image_class; ?>" style="background-image:url(<?php echo $image_full_width; ?>);">
                                <?php if($title_option == 'on'): ?>
                                  <div class="w-100">
                                    <h2 class="title-lines text-center white"><?php the_sub_field('title') ?></h2>
                                  </div>
                                <?php endif; ?>
                                </div>
                            <?php if($title_option == 'under'): ?>
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-12 mt-5">
                                  <h2 class="text-center"><?php the_sub_field('title'); ?></h2>
                                </div>
                              </div>
                            </div>
                            <?php endif; ?>
                              <?php else: ?>
                                <div class="offseted-images">
                                  <div class="container-fluid">
                                    <div class="row">             
                                      <div class="col-md-5 col-6 d-flex justify-content-center justify-content-md-end">
                                        <img  class="non-resp object-fit-cover" src="<?php echo esc_url($image_left['url']); ?>" alt="<?php echo esc_attr($image_left['alt']); ?>">
                                      </div>
                                      <div class="offseted col-md-5 col-6 d-flex justify-content-center justify-content-md-end">
                                        <img  class="non-resp object-fit-cover" src="<?php echo esc_url($image_right['url']); ?>" alt="<?php echo esc_attr($image_left['alt']); ?>">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <?php endif; ?>
                            </div>
                            <div class="paragraph center my-md-5 my-4">
                              <p><?php the_sub_field('paragraph'); ?></p>
                            </div>
                            <?php get_template_part('template-parts/element' , 'buttongroup'); ?>
                        </div>
                     </div><!-- .module-image-text -->
                <?php elseif(get_row_layout() == 'video' ): 
                      $iframe = get_sub_field('youtube_video');

                      // Use preg_match to find iframe src.
                      preg_match('/src="(.+?)"/', $iframe, $matches);
                      $src = $matches[1];

                      // Add extra parameters to src and replcae HTML.
                      $params = array(
                          'controls'  => 0,
                          'hd'        => 1,
                          'autohide'  => 1
                      );
                      $new_src = add_query_arg($params, $src);
                      $iframe = str_replace($src, $new_src, $iframe);

                      // Add extra attributes to iframe HTML.
                      $attributes = 'frameborder="0"';
                      $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe); ?>
                    <div class="embed-container">
                      <?php echo $iframe; ?>
                    </div>
                <?php elseif(get_row_layout() == 'grid_products' ): 
                        if(have_rows('products_selection')):    ?>
                           <div class="section module-image-text">
                              <div class="container-fluid">
                                <div class="row">
                                  <?php while(have_rows('products_selection')): the_row(); ?>
                                  <div class="col-12 col-md-4">
                                    <div class="prod-grid-item-container">
                                      <?php
                                      $product = get_sub_field('product');
                                      $permalink = get_permalink( $product->ID );
                                      $title = get_the_title( $product->ID );
                                      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->ID ), 'medium' );
                                      
                                      ?>
                                      <img src="<?php  echo $image[0]; ?>">
                                    </div>
                                  </div>
                                    <?php endwhile; ?>
                                  </div>
                                </div>
                              </div>
                           </div>
                           <?php else: echo "pas ok"; ?>
                      <?php endif;
                     endif; ?>
                  
          <?php endwhile;
          
        endif;
      ?>
    </main>
  </div>


<?php get_footer(); ?>