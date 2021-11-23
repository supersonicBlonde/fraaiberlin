<?php get_header() ?>
	<main>
		<div>
			<?php
				if(have_posts()):

					while(have_posts()):
						the_post();
			?>
				<div class="container intro-section">
						<div class="row">
							<div class="col">
								<h1><?php the_title(); ?></h1>
							</div>
						</div>
				</div>
				<div class="container py-3">
					<div class="row">
						<div class="col content-area">
							<?php the_content(); ?>
						</div>
					</div>
				</div>

			<?php	
					endwhile;
			
				else:
					echo 'No results';

				endif;
			?>
		</div>
	</main>
<?php get_footer() ?>