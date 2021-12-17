
<div class="global-container">
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
				'walker'     		=> new bootstrap_5_wp_nav_menu_walker()
			)) 
			?>
			</div>
		</div>
	</nav>
</div>

