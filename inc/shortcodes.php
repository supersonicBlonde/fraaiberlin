<?php
/**
* Shortcodes
*
* @package gsc
*/

// >> Create Shortcode to Display CTA
 
function gsc_create_shortcode_cta($atts){


    $a = shortcode_atts( array(
      'id' => null
    ), $atts );


   

 
    $args = array(
      'post_type'      => 'gsc_cta',
      'p' => $a['id'],
      'publish_status' => 'published',
    );
 
    $query = new WP_Query($args);

   
 
    if($query->have_posts()) :

 
        while($query->have_posts()) :
 
            $query->the_post() ;


        $background_color = get_field('background_color');
        $text_color = get_field('background_color') == 'light'?'#304D60':'#fff';
        $start = '<div class="cta-item section half-spacing total-half-padding background-'.$background_color.'">';
        $start .= '<div class="container"><div class="row align-items-center">';
        $end = '</div></div></div>';
                     
        $result  = '<div class="col-12 col-md-6">';
        $result .= '<div class="cta-title" style="color:'.$text_color.'">' .get_field('title'). '</div>';
        $result .= '<div class="cta-sub-title mt-3" style="color:'.$text_color.'">' . get_field('sub_title') . '</div>';
        $result .= '</div>';
        $result .= '<div class="col-12 col-md-6 text-center">';
        if( have_rows('button_group') ):
          while( have_rows('button_group') ): the_row(); 
   
              $button_type = get_sub_field('type_button');
              $button_text = get_sub_field('button_text');
              $button_link = get_sub_field('link_button');
              $button_target = get_sub_field('target');
              $button_target = $button_target[0] == '_blank'?'_blank':'_self';
              $data_layer = get_sub_field('data_layer') == ''?'':get_sub_field('data_layer');
              $data_form = get_sub_field('data_form') == ''?'':get_sub_field('data_form');
              $data_form = 'data-form="'.$data_form.'"';
              $id = get_sub_field('id') == ''?'':get_sub_field('id');
              $id = 'id="'.$id.'"'; 
              $class = '';

              switch($button_type) {
                case 'modal':
                  $link_attr = 'data-toggle="modal" data-target="#myModal" '.$data_form;
                  break;
                case 'video':
                  $link_attr = 'data-toggle="modal" data-target="#videoModal" data-video="'.$button_link.'"';
                  break;
                case 'calendly':
                  $link_attr = '';
                  $class =  'calendly-link';
                  break;
                case 'link':
                  $link_attr = '';
                  break;
                case 'chat':
                  $link_attr = '';
                  $class =  'chat-link';
                  break;
              }
            endwhile; endif; 

            
        if(!empty($button_text)):
         /* $result .=  '<a target="'.$button_target.'" href="'.$button_link.'"   '.$id.' onclick="dataLayer.push({\'event\': '.$data_layer.'});" "class="button default mr-3 '.$class.'" '.$link_attr.'>'.$button_text.'</a>'; */
         $result .= '<a onclick="dataLayer.push({\'event\': \''.$data_layer.'\'})" target="'.$button_target.'" href="'.$button_link.'"  class="button default mr-3 '.$class.'" '.$id.'  '.$link_attr.'>'.$button_text.'</a>';
        endif;
       /*  $result .= '<div class=""><a class="calendly-link button default" href=" '. get_field('link_button') .' ">' . get_field('text_button') . '</a></div>';  */
        $result .= '</div>';
 
        endwhile;
 
        wp_reset_postdata();
 
    endif;    
 
    return $start.$result.$end;            
}
 
add_shortcode( 'block-cta', 'gsc_create_shortcode_cta' ); 
 
// shortcode code ends here
