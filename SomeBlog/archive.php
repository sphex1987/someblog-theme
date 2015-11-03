<?php get_header(); ?>

	<div class="container">
		<div class="row">

			<div class="col-md-8">

				<?php if ( have_posts() ) : ?>

					<div class="archive_header">
						<h1 class="archive_header_title">
							<?php
								if ( is_category() ) {
									printf( __( 'Category Archives: %s', 'someblog' ), '<span>' . single_cat_title( '', false ) . '</span>' );

								} elseif ( is_tag() ) {
									printf( __( 'Tag Archives: %s', 'someblog' ), '<span>' . single_tag_title( '', false ) . '</span>' );

								} elseif ( is_author() ) {
									/* Queue the first post, that way we know
									 * what author we're dealing with (if that is the case).
									*/
									the_post();
									printf( __( 'Author Archives: %s', 'someblog' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
									/* Since we called the_post() above, we need to
									 * rewind the loop back to the beginning that way
									 * we can run the loop properly, in full.
									 */
									rewind_posts();

								} elseif ( is_day() ) {
									printf( __( 'Daily Archives: %s', 'someblog' ), '<span>' . get_the_date() . '</span>' );

								} elseif ( is_month() ) {
									printf( __( 'Monthly Archives: %s', 'someblog' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

								} elseif ( is_year() ) {
									printf( __( 'Yearly Archives: %s', 'someblog' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

								} else {
									printf( __( 'Archives: %s', 'someblog' ), '<span>' . $term->name . '</span>' );

								}
							?>
						</h1>
						<?php
							if ( is_category() ) {
								// show an optional category description
								$category_description = category_description();
								if ( ! empty( $category_description ) )
									echo '<h3 class="archive_desc">' . $category_description . '</h3>';
									//echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

							} elseif ( is_tag() ) {
								// show an optional tag description
								$tag_description = tag_description();
								if ( ! empty( $tag_description ) )
									echo '<h3 class="archive_desc">' . $tag_description . '</h3>';
									//echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
							}
						?>
					</div> <!-- //archive_header -->		

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>				

						<div class="home_blog_box">
							<?php get_template_part('content', get_post_format()); ?>
						</div>

					<?php endwhile; ?>

					<div class="someblog_nav">
						<div class="row">
							<div class="col-md-6 someblog_nav_prev"><?php previous_posts_link( '&laquo; Previous Entries' ); ?></div>
							<div class="col-md-6 someblog_nav_next"><?php next_posts_link( 'Next Entries &raquo;', '' ); ?></div>
						</div>
					</div>

				<?php else : ?>

					<div class="home_blog_box">
						<p>It seems we can't find what you're looking for. Perhaps searching can help.</p>
					</div>

				<?php endif; ?>				

			</div>

			<?php get_sidebar(); ?>

		</div>
	</div>

<?php get_footer(); ?>