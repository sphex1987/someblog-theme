<?php get_header(); ?>

	<div class="container">
		<div class="row">

			<div class="col-md-8">

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>				

					<div class="home_blog_box single_box">
						<?php get_template_part('content', get_post_format()); ?>
					</div>

					<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
						<div class="home_blog_box">
							<div class="comments_cont">
							<?php
								// If comments are open or we have at least one comment, load up the comment template
								comments_template( '', true );
							?>
							</div>
						</div>
					<?php endif; ?>

				<?php endwhile; ?>

			</div>

			<?php get_sidebar(); ?>

		</div>
	</div>

<?php get_footer(); ?>