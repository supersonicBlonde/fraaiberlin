
<div class="global-container">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 text-center ">
				<div class="header-search-form-container justify-content-center align-items-center">
						<?php get_search_form(); ?>
						<div class="form-close"><i class="fa fa-times-circle"></i></div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg">
		<div class="container-fluid">
			<a class="navbar-brand" href="/">
				<img class="non-resp" src="<?php echo get_template_directory_uri() ?>/img/logo_fraai_berlin.png" alt="Logo FraaiBerlin">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
			<?php
			wp_nav_menu( array(
				'theme_location'	=> 'primary',
				'container' 		=> false,
				'menu_class' 		=> 'navbar-nav mx-auto',
				'walker'     		=> new wp_bootstrap_navwalker()
			)) 
			?>
			<?php do_action('wpml_add_language_selector');  ?>
			</div>
		</div>
	</nav>
</div>

