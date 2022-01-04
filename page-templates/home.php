<?php
/**
* Template Name: Home
*
* @package fraaiberlin
*/

get_header();


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
                                  <div class="title position-absolute text-center"><?php the_sub_field('text'); ?></div>
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
                <?php elseif(get_row_layout() == 'module_faqs' ):
                      if(have_rows('faq_selection')): $count = 0;
                      $terms_ar = $questions_ar = [];
                        while(have_rows('faq_selection')): the_row(); 
                          $question_obj = get_sub_field('question');
                          $id =  $question_obj->ID;
                          $questions_ar[] = $id;
                          $cat = get_the_terms($id , 'faq_cat');
                          $terms_ar[] = $cat[0]->name; 
                          $count++; 
                        endwhile; 
                          $terms_ar = array_unique($terms_ar); ?>
                        <div id="home-faq" class="accordion section">
                        <?php $count = 0; foreach($terms_ar as $term): ?>
                        <div class="card">
                            <div class="card-header" id="heading<?php echo $count; ?>">
                              <div class="mb-0" >
                                  <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $count; ?>" aria-expanded="true" aria-controls="collapse<?php echo $count; ?>">
                                    <?php echo $term; ?>
                                  </button>
                                </div>
                              </div>
                              <?php
                              foreach($questions_ar as $question):
                            
                                $cat = get_the_terms($question , 'faq_cat');
                                $cat_name = $cat[0]->name; 
                                if($cat_name == $term): ?>
                            
                               <div id="collapse<?php echo $count; ?>" class="collapse hide" aria-labelledby="heading<?php echo $count; ?>" data-parent="#home-faq">
                                  <div class="card-body">
                                    <div class="question-container">                                  <div class="question"><?php echo  get_field('question' , $question); ?></div>
                                    <div class="answer-container">
                                    <div class="answer"><?php echo  get_field('answer' , $question); ?></div>
                                  </div>
                                  </div>
                                  </div>
                              </div><!-- collapse -->
                              <?php endif; ?>
                              <?php endforeach; ?>
                        </div>
                        <?php $count++; endforeach; ?>
                                </div>
                       <?php endif;
                     elseif(get_row_layout() == 'instagram_feed' ): ?>
                      <div class="section" id="instagram-feed">
                        <?php echo do_shortcode(get_sub_field("instagram_shortcode")); ?>
                        <div class="insta-link"><a href="https://www.instagram.com/fraaiberlin/" target="_blank"><?php the_sub_field('instagram_text_link'); ?></a></div>
                      </div>
                    <?php endif; ?>
          <?php endwhile; ?>

       <?php endif; ?>
    
    </main>
  </div>


<?php get_footer(); ?>