<?php
/**
* Template Name: Front Shop
*
* @package fraaiberlin
*/

get_header();


?>

	</header>


  <div class="primary" class="content-area top-spacing">

    <main id="main" class="site-main" role="main">

      <div class="container-fluid">

        <div class="col-4">
          <?php if ( is_active_sidebar( 'sidebar-shop' ) ) : ?>
              <ul id="sidebar">
                  <?php dynamic_sidebar('sidebar-shop'); ?>
              </ul>
          <?php endif; ?>
        </div>

        <div class="col-8">

        </div>

      </div>
    
    </main>
  </div>


<?php get_footer(); ?>