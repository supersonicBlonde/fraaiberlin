<?php

	/*
		
	This is the template for the footer

	@package fraaiberlin
	*/
?>

<footer class="quanta-footer my-5">
	<div class="global-container">
		<?php if ( is_active_sidebar( 'footer-1' ) ): ?>
			<?php dynamic_sidebar('footer-1'); ?>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'footer-2' ) ): ?>
			<?php dynamic_sidebar('footer-2'); ?>
		<?php endif; ?>
	</div>
	<div>
		<div class="logo-footer d-flex justify-content-center mt-3 mt-md-0">
			<img class="non-resp" src="<?php echo get_template_directory_uri() ?>/img/logo_fraai_berlin_footer.png" alt="Logo FraaiBerlin">	
		</div>
		<div class="mt-3 d-flex justify-content-center">© Fraai Berlin 2021</div>
	</div>
</footer>
</div><!-- #global-container -->

<?php wp_footer(); ?>
</body>
</html>