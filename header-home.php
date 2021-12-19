<?php
	/*
		
	This is the template for the header

	@package fraaiberlin

	*/
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php wp_head();  ?>
</head>

<body <?php body_class(); ?>>
  <?php $header_bg = get_field('header_background'); ?>
	<header class="master-header home background-image" id="master-header" style="background-image:url(<?php echo $header_bg; ?>)">
			<div class="hero-text"><?php the_field('text_on_hero'); ?></div>
			<div class="main-navigation">	
				<?php get_template_part('template-parts/nav' , 'main'); ?>
		</div>