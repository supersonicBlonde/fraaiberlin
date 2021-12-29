<?php
/**
* Template Name: Contact
*
* @package fraaiberlin
*/

get_header();


?>

	</header>


  <div class="primary" class="content-area top-spacing">

    <main id="main" class="site-main" role="main">

      <div class="section module-image-text">
        <?php if(have_rows('first_section')): ?>
          <?php while(have_rows('first_section')) : the_row(); ?>
          <div class="w-100">
            <h2 class="text-center"><?php the_sub_field('title') ?></h2>
          </div>
          <div class="paragraph center my-md-5 my-4">
            <p><?php the_sub_field('paragraph'); ?></p>
          </div>
          <div class="text-center">
            <p><?php the_sub_field('tel_number'); ?></p>
          </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>

      <div class="section module-image-text">
        <?php if(have_rows('location_section')): ?>
          <?php while(have_rows('location_section')) : the_row(); ?>
          <div class="w-100">
            <div>
              <h2 class="title-lines text-center"><?php the_sub_field('title'); ?></h2>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <?php if(have_rows('locations')): ?>
                <?php while(have_rows('locations')) : the_row(); ?>
                  <?php $image = get_sub_field('image'); ?>
                  <div class="col-12 col-md-6 text-center">
                    <?php if(!empty($image)):  ?>
                    <div>
                      <img class="circled" src="<?php echo esc_url($image['sizes']['medium'])?>" alt="<?php echo esc_url($image['alt']); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="mt-3"><?php the_sub_field('address'); ?></div>
                    <div class="my-3"><?php the_sub_field('tel'); ?></div>
                    <div class="my-3"><?php the_sub_field('opening_hours'); ?></div>
                    <div class="my-4">
                      <a href="<?php the_sub_field('action_button'); ?>" class="button"><?php the_sub_field('text_button'); ?></a>
                    </div>
                  </div>
                <?php endwhile; ?>
              <?php endif; ?>
            </div>
          </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>

      <div class="section module-image-text">
        <?php if(have_rows('last_section')): ?>
          <?php while(have_rows('last_section')) : the_row(); ?>
          <div class="w-100">
          <h2 class="title-lines text-center mb-3"><?php the_sub_field('title') ?></h2>
          <div class="background-image" style="height:600px; background-image: url(<?php the_sub_field('image') ?>)" >
          </div>
          </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>


       <div class="section section-icones">
        <?php if(have_rows('icon_section')): ?>
          <?php while(have_rows('icon_section')) : the_row(); ?>
          <div class="w-100 mb-4">
            <div class="title text-center"><?php the_sub_field('title') ?></div>
          </div>
          <div class="container">
            <div class="row">
             
              <?php while(have_rows('icones')) : the_row(); ?>
                  <div class="col-12 col-md-4 text-center">
                    <div class="d-flex justify-content-center">
                      <div style="background-color:<?php the_sub_field('bg_color') ?>; width:111px; height:111px;" class="d-flex justify-content-center align-items-center circled">
                        <div><i class="fa <?php the_sub_field('icone') ?>"></i></div>
                      </div>
                    </div>
                    <div class="my-3"><?php the_sub_field('texte'); ?></div>
                  </div>
                <?php endwhile; ?>
              
            </div>
          </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
      
      
    
    </main>
  </div>


<?php get_footer(); ?>