<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php wp_head(); ?>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body <?php body_class(); ?>>

	<?php $options = get_option( 'someblog_theme_options' ); ?>

	<header>
		<div class="header_inside_cont">
			<?php if ( $options['logo_url'] != '' ) : ?>
				<div class="header_logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $options['logo_url']; ?>" alt="logo" /></a></div>
			<?php else : ?>
				<div class="header_title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
				<div class="header_subtitle"><?php echo get_bloginfo( 'description', 'display' ); ?></div>
			<?php endif; ?>

			<div class="header_social">
				<?php if ( $options['facebookurl'] != '' ) : ?>
					<a href="<?php echo $options['facebookurl']; ?>" target="_blank"><span class="fa fa-facebook"></span></a>
				<?php endif; ?>
				<?php if ( $options['twitterurl'] != '' ) : ?>
					<a href="<?php echo $options['twitterurl']; ?>" target="_blank"><span class="fa fa-twitter"></span></a>
				<?php endif; ?>
				<?php if ( $options['pinteresturl'] != '' ) : ?>
					<a href="<?php echo $options['pinteresturl']; ?>" target="_blank"><span class="fa fa-pinterest-p"></span></a>
				<?php endif; ?>
				<?php if ( $options['googleplusurl'] != '' ) : ?>
					<a href="<?php echo $options['googleplusurl']; ?>" target="_blank"><span class="fa fa-google-plus"></span></a>
				<?php endif; ?>
				<?php if ( $options['behanceurl'] != '' ) : ?>
					<a href="<?php echo $options['behanceurl']; ?>" target="_blank"><span class="fa fa-behance"></span></a>
				<?php endif; ?>
				<?php if ( $options['dribbbleurl'] != '' ) : ?>
					<a href="<?php echo $options['dribbbleurl']; ?>" target="_blank"><span class="fa fa-dribbble"></span></a>
				<?php endif; ?>
				<?php if ( $options['instagramurl'] != '' ) : ?>
					<a href="<?php echo $options['instagramurl']; ?>" target="_blank"><span class="fa fa-instagram"></span></a>
				<?php endif; ?>
				<?php if ( ! $options['hiderss'] ) : ?>
					<a href="<?php bloginfo( 'rss2_url' ); ?>" class="rss"><span class="fa fa-rss"></span></a>
				<?php endif; ?>
			</div>

			<div class="header_menu"><?php wp_nav_menu('theme_location=header-menu&container=false&menu_id=main_header_menu'); ?></div>
		</div>
	</header>

	<?php if ( is_front_page() && is_home() ) : ?>

		<?php if ( $options['featured_cat'] != '' ): ?>

			<div class="slider_cont">

				<div class="container">

					<div id="home-slider" class="carousel slide" data-ride="carousel">
					  <!-- Indicators -->

				  		<ol class="carousel-indicators">
							<?php
							// The Query
							$args = array(
									'post_type' => 'post',
									'posts_per_page' => 7,
									'cat' => $options['featured_cat']
								);

							$the_query = new WP_Query( $args );

							// The Loop
							$x = 0;
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								$is_active = '';
								if($x == 0) { $is_active = 'class="active"'; }
								echo '<li data-target="#home-slider" data-slide-to="' . $x . '" ' . $is_active . '></li>';
								$x++;
							}
							/* Restore original Post Data */
							wp_reset_postdata();
							?>
						</ol>

					  <!-- Wrapper for slides -->
					  <div class="carousel-inner" role="listbox">
					  	<?php 
					  	$the_query = new WP_Query( $args );
					  	$x = 0;
					  	while ( $the_query->have_posts() ) { $the_query->the_post(); ?>

						    <div class="item <?php if($x == 0) { echo 'active'; } ?>">
						      <?php the_post_thumbnail('full'); ?>
						      <div class="carousel-caption">
						        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						        <!--<p>some description here</p>-->
						      </div>
						    </div>
						<?php $x++; } wp_reset_postdata(); ?>
					  </div>

					  <!-- Controls -->
					  <a class="left carousel-control" href="#home-slider" role="button" data-slide="prev">
					    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="right carousel-control" href="#home-slider" role="button" data-slide="next">
					    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
					</div>

				</div>

			</div> <!-- //slider_cont -->

		<?php endif; ?>

	<?php endif; ?>