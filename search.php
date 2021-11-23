<?php
/**
* Search results page
*
* @package fraaiberlin
*/
/* $search_refer = $_GET[“site_section”];
if ($search_refer == ‘recipe’) { load_template(TEMPLATEPATH . ‘/recipe-search.php’); }
elseif ($search_refer == ‘site-search’) { load_template(TEMPLATEPATH . ‘/site-search.php’); }; 


var_dump(TEMPLATEPATH ); die; */



global $query_string;
$query_args = explode("&amp;", $query_string);
$search_query = array();
if( strlen($query_string) > 0 ) {
  foreach($query_args as $key => $string) {
    $query_split = explode("=", $string);
    $search_query[$query_split[0]] = urldecode($query_split[1]);
  } 
}

if(isset($_GET['search-type'])) {
  $type = $_GET['search-type'];
  if($type == 'post') {
      //load_template(TEMPLATEPATH . '/all-search.php')
      $args = array( 'post_type' => array('post' ));
      $args = array_merge( $args, $wp_query->query );
      $total_results = count(query_posts( $args ));
      $search = new WP_Query($args);
  }elseif($type == 'knowledgebase') {
    $args = array( 'post_type' => 'faq' );
      $args = array_merge( $args, $wp_query->query );
      $total_results = count(query_posts( $args ));
      $search = new WP_Query($args);

  } elseif($type == 'all') {
    global $wp_query;
    $total_results = $wp_query->found_posts;
    $search = new WP_Query($search_query);
        // load_template(TEMPLATEPATH . '/post-search.php');
      }
}

get_header();

/* global $wp_query;

$total_results = $wp_query->found_posts;
global $query_string;
$query_args = explode("&amp;", $query_string);
$search_query = array();
if( strlen($query_string) > 0 ) {
  foreach($query_args as $key => $string) {
    $query_split = explode("=", $string);
    $search_query[$query_split[0]] = urldecode($query_split[1]);
  } 
}
$search = new WP_Query($search_query); */
/* $search_query['posts_per_page'] = 4; */


?>

	</header>

	<div class="primary content-area">

		<main id="main" class="site-main" role="main">

    <!-- <div class="section h1-spacing">
        <div class="container">
          <div class="row text-center w-60 center">
            <div class="col-12">
              <h1 class="h2-sized"><?php echo __ ?></h1>
            </div>
          </div>
        </div>
      </div> -->

      <?php get_template_part('template-parts/search' , 'form'); ?>

      <div class="container my-5" id="search-results">
        <div class="row">
          <div class="col-12">
            <div class="text-center my-2"><strong><?php echo __('Search results' , 'gsc'); ?></strong></div>
            <div class="text-center">
              <?php 
                if($total_results > 0):
                  echo __('We found ' , 'gsc');
                  echo '<span class="total-results">'.$total_results.' '.__('result(s)' , 'gsc').'</span>'; 
                  echo __(' with the keyword ' , 'gsc'); 
                  echo '<strong>"'.$search_query['s'].'"</strong>';
                else:
                  echo __('Sorry, nothing on ' , 'gsc');
                  echo "<strong>".$search_query['s']."</strong> keyword"; 
                endif;
                ?>
                </div>
            </div>
        </div>
        
      </div>

      <?php if($total_results > 0): ?>
      <div class="section regular-spacing">
        <div class="container">
          <div class="row">
            <?php

                if($search->have_posts()):
                
                  while($search->have_posts()): $search->the_post(); 
                
                  ?>

                  <div class="col-12 result-item">
                    <div class="row">
                      <div class="col-2"></div>
                      <div class="col-10">
                          <?php
                          $post_type =  get_post_type();
                          if($post_type == "faq") $post_type = 'knowledge base';
                          ?>
                          <div class="post-type">#<?php echo $post_type; ?></div>
                      </div>
                    </div>
                    <div class="row align-items-center">
                      <div class="col-2">
                          <?php 
                            $src = !get_the_post_thumbnail_url()?'':get_the_post_thumbnail_url(get_the_ID() , 'thumbnail'); 
                          ?>
                          <?php if($src!=''): ?><img class="shadowed" src="<?php echo $src ?>" alt=""><?php endif; ?>
                        </div>
                        <div class="col-10">
                         
                          <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                          <p class="tx-indexedsearch-description">
                              <?php search_excerpt_highlight(get_the_content()); ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-2"></div>
                      <div class="col-10">
                        <a class="search-url" href="<?php the_permalink(); ?>"><?php echo get_the_permalink(); ?></a>
                      </div>
                    </div>
                  </div>
                  
                 <!--  <div class="col-12">
                    <div class="blogitem">
                      <div class="post-type">#<?php echo get_post_type(); ?></div>
                      <?php 
                      $default_url = get_template_directory_uri().'/img/blog-default.png';
                      $src = !get_the_post_thumbnail_url()?$default_url:get_the_post_thumbnail_url(); 
                      ?>
                      <div><img src="<?php echo $src ?>" alt=""></div>
                      <div class="blog-meta my-3">
                        <?php echo get_the_date(); ?> / 
                        <?php the_author() ?> / 
                        <?php echo comments_number('0' , '1' , 'comments')." ".__('comment' , 'gsc'); ?>
                      </div>
                      <h2 class="entry-title"><?php the_title(); ?></h2>
                      <?php $content = get_the_content(); ?>
                      <p><?php echo wp_trim_words($content); ?></p>
                      <a href="<?php the_permalink(); ?>" class="button default"><?php echo __('Read more' , 'gsc'); ?></a>
                    </div>
                  </div> -->
                 <?php endwhile;
                endif; wp_reset_postdata();
            ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
    
      <div class="background-light section regular-padding regular-spacing">
        <div class="container">
          <div class="row justify-content-center mb-2">
            <div class="col text-center">
            <h2><?php echo __("Didn't find what you were looking for?" , 'gsc'); ?></h2>
            <p><?php echo __("Don't worry, you can always contact us directly on any matter." , "gsc"); ?></p>
              </div>
          </div>
          <div class="row text-center justify-content-center mb-4">
              <a href="#" class="button default mx-3"><?php echo __("Start a chat" , "gsc"); ?></a>
              <a href="#" class="button default mx-3"><?php echo __("Book a call" , "gsc"); ?></a>
              <a href="#" class="button dark mx-3"><?php echo __("Send us a message" , "gsc"); ?></a>
          </div>
          <div class="row">
              <div class="col"></div>
              <div class="col-8">
                <form class="form-grid">
                  <div class="row mb-3">
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="col">
                      <input type="email" class="form-control" placeholder="Email">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col">
                      <textarea name="message" id="" cols="30" rows="5" placeholder="Message" class="form-control" ></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 text-center">
                      <button type="submit" class="button default"><?php echo __('Submit' , 'gsc'); ?></button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col"></div>
          </div>
        </div>
      </div>

      <div class="section regular-spacing">
        <div class="container">
            <div class="row">
                <!-- COLUMN LEFT BLOG AND TESTIMONIALS -->
                <div class="col-12 col-md-8">
                  <div class="container">
                    <?php get_template_part('template-parts/resource' , 'blog'); ?>
                    <?php get_template_part('template-parts/resource' , 'stories'); ?>
                  </div>
                </div>
                 <!-- COLUMN LEFT BLOG AND TESTIMONIALS -->
                 <div class="col-12 col-md-4">
                 <?php get_template_part('template-parts/sidebar', 'faq') ?> 
                 </div>
            </div>
        </div>
      </div>

      <?php get_template_part('template-parts/cta' , 'resources'); ?>


		</main>

	</div><!-- .primary -->

  <script tyep="text/javascript">
   var anchor = document.querySelector('#search-results');
anchor.scrollIntoView();
  </script>

<?php get_footer(); ?>