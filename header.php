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
	<?php wp_head();  ?>
</head>

<body <?php body_class(); ?>>

	<header class="master-header" id="master-header">
		<div class="global-container">
			<?php //get_template_part('template-parts/nav' , 'topbar'); ?>
		</div>
		<div class="main-navigation">	
			<div class="global-container">
				<?php //get_template_part('template-parts/nav' , 'main'); ?>
			</div>
		</div>