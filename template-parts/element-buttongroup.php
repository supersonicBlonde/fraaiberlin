<?php if(have_rows('button_group')): ?>
  <div class="button-group mt-md-5">
    <div class="container">
      <div class="row">
        <?php 
        while(have_rows('button_group')): the_row();
        $post_id = get_sub_field('button_link');
        ?>
          <div class="col-12 col-md d-flex justify-content-center my-2">
            <a href="<?php get_the_permalink($post_id); ?>" class="button"><?php the_sub_field('button_text'); ?></a>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
<?php endif; ?>