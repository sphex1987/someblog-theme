<?php
add_action( 'admin_init', 'someblog_options_init' );
add_action( 'admin_menu', 'someblog_options_add_page' );

function someblog_options_init(){
	register_setting( 'someblog_options', 'someblog_theme_options', 'someblog_options_validate' );
}
 
function someblog_options_add_page() {
	add_theme_page( __( 'Theme Options', 'someblog' ), __( 'Theme Options', 'someblog' ), 'edit_theme_options', 'theme_options', 'someblog_options_do_page' );
}
 
function someblog_options_do_page() {

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	?>
	<div class="wrap">
		<?php echo "<h2>" . wp_get_theme() . __( ' Theme Options', 'someblog' ) . "</h2>"; ?>
		
		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
			<div class="updated fade"><p><strong><?php _e( 'Options saved', 'someblog' ); ?></strong></p></div>
		<?php endif; ?>
			
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><strong><?php _e( 'Need Help?', 'someblog' ); ?></strong></th>
				<td>
					<p>
						<a href="http://www.logicbaseinteractive.com/someblog-wordpress-theme-premium/"><?php _e( 'Click here for the Documentation', 'someblog' ); ?></a>
					</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><strong><?php _e( 'SomeBlog Premium Version', 'someblog' ); ?></strong></th>
				<td>
					<p>
						<?php _e( 'Want more features and flexibility?', 'someblog' ); ?>
						<a href="http://www.logicbaseinteractive.com/someblog-wordpress-theme-premium/"><strong><?php _e( 'Click Here for SomeBlog Premium Version.', 'someblog' ); ?></strong></a>
					</p>
				</td>
			</tr>
		</table>	

		<form method="post" action="options.php">
		<?php settings_fields( 'someblog_options' ); ?>
		<?php $options = get_option( 'someblog_theme_options' ); ?>			

		<hr>
		<h3><?php _e( 'Header Logo', 'someblog' ); ?></h3>
		<p><?php _e( 'You can input the URL of your logo here. You can leave it as blank if you want to use the default WP title and desription to show.', 'someblog' ); ?></p>

			<table class="form-table">

				<?php
				/**
				 * Logo
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Logo URL', 'someblog' ); ?></th>
					<td>
						<input id="someblog_theme_options[logo_url]" class="regular-text" type="text" name="someblog_theme_options[logo_url]" value="<?php echo esc_attr( $options['logo_url'] ); ?>" />
					</td>
				</tr>

			</table>


		<hr>
		<h3><?php _e( 'Slider', 'someblog' ); ?></h3>

			<table class="form-table">

				<?php
				/**
				 * Slider Category
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Slider Category', 'someblog' ); ?></th>
					<td>
						<?php $feat_cat = esc_attr( $options['featured_cat'] ); ?>
						<select id="someblog_theme_options[featured_cat]" name="someblog_theme_options[featured_cat]">
							<option value="">- select one -</option>
							<?php							
							$terms = get_terms( 'category' );
							foreach ( $terms as $term ) {
								$is_selected = '';
								if($term->term_id == $feat_cat)
									$is_selected = 'selected="selected"';
								echo '<option value="' . $term->term_id . '" ' . $is_selected . '>' . $term->name . '</option>';  
							}
							?>						
						</select>
					</td>
				</tr>

			</table>
			
		
		<hr>
		<h3><?php _e( 'Social Links', 'someblog' ); ?></h3>
		<p><?php _e( 'You can input the URL of your social accounts here. You can leave it as blank and icons will be hidden.', 'someblog' ); ?></p>

			<table class="form-table">

				<?php
				/**
				 * RSS Icon
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Hide RSS Icon?', 'someblog' ); ?></th>
					<td>
						<input id="someblog_theme_options[hiderss]" name="someblog_theme_options[hiderss]" type="checkbox" value="1" <?php checked( '1', $options['hiderss'] ); ?> />
						<label class="description" for="someblog_theme_options[hiderss]"><?php _e( 'Hide the RSS feed icon?', 'someblog' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Facebook Icon
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Facebook URL', 'someblog' ); ?></th>
					<td>
						<input id="someblog_theme_options[facebookurl]" class="regular-text" type="text" name="someblog_theme_options[facebookurl]" value="<?php echo esc_attr( $options['facebookurl'] ); ?>" />
					</td>
				</tr>
				
				<?php
				/**
				 * Twitter URL
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Twitter URL', 'someblog' ); ?></th>
					<td>
						<input id="someblog_theme_options[twitterurl]" class="regular-text" type="text" name="someblog_theme_options[twitterurl]" value="<?php echo esc_attr( $options['twitterurl'] ); ?>" />
					</td>
				</tr>
				
				<?php
				/**
				 * Google +
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Google + URL', 'someblog' ); ?></th>
					<td>
						<input id="someblog_theme_options[googleplusurl]" class="regular-text" type="text" name="someblog_theme_options[googleplusurl]" value="<?php echo esc_attr( $options['googleplusurl'] ); ?>" />
					</td>
				</tr>

				<?php
				/**
				 * Behance +
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Behance URL', 'someblog' ); ?></th>
					<td>
						<input id="someblog_theme_options[behanceurl]" class="regular-text" type="text" name="someblog_theme_options[behanceurl]" value="<?php echo esc_attr( $options['behanceurl'] ); ?>" />
					</td>
				</tr>

				<?php
				/**
				 * Dribbble +
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Dribbble URL', 'someblog' ); ?></th>
					<td>
						<input id="someblog_theme_options[dribbbleurl]" class="regular-text" type="text" name="someblog_theme_options[dribbbleurl]" value="<?php echo esc_attr( $options['dribbbleurl'] ); ?>" />
					</td>
				</tr>
				
				<?php
				/**
				 * LinkedIn
				 */
				?>
				<!--
				<tr valign="top"><th scope="row"><?php _e( 'LinkedIn URL', 'someblog' ); ?></th>
					<td>
						<input id="someblog_theme_options[linkedinurl]" class="regular-text" type="text" name="someblog_theme_options[linkedinurl]" value="<?php echo esc_attr( $options['linkedinurl'] ); ?>" />
					</td>
				</tr>
				-->
				
				<?php
				/**
				 * Instagram
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Instagram URL', 'someblog' ); ?></th>
					<td>
						<input id="someblog_theme_options[instagramurl]" class="regular-text" type="text" name="someblog_theme_options[instagramurl]" value="<?php echo esc_attr( $options['instagramurl'] ); ?>" />
					</td>
				</tr>
				
				<?php
				/**
				 * YouTube
				 */
				?>
				<!--
				<tr valign="top"><th scope="row"><?php _e( 'YouTube URL', 'someblog' ); ?></th>
					<td>
						<input id="someblog_theme_options[youtubeurl]" class="regular-text" type="text" name="someblog_theme_options[youtubeurl]" value="<?php echo esc_attr( $options['youtubeurl'] ); ?>" />
					</td>
				</tr>
				-->
				
				<?php
				/**
				 * Pinterest
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Pinterest URL', 'someblog' ); ?></th>
					<td>
						<input id="someblog_theme_options[pinteresturl]" class="regular-text" type="text" name="someblog_theme_options[pinteresturl]" value="<?php echo esc_attr( $options['pinteresturl'] ); ?>" />
					</td>
				</tr>
				
				<?php
				/**
				 * StumbleUpon
				 */
				?>
				<!--
				<tr valign="top"><th scope="row"><?php _e( 'StumbleUpon URL', 'someblog' ); ?></th>
					<td>
						<input id="someblog_theme_options[stumbleuponurl]" class="regular-text" type="text" name="someblog_theme_options[stumbleuponurl]" value="<?php echo esc_attr( $options['stumbleuponurl'] ); ?>" />
					</td>
				</tr>
				-->
				
				<?php
				/**
				 * Flickr
				 */
				?>
				<!--
				<tr valign="top"><th scope="row"><?php _e( 'Flickr URL', 'someblog' ); ?></th>
					<td>
						<input id="someblog_theme_options[flickrurl]" class="regular-text" type="text" name="someblog_theme_options[flickrurl]" value="<?php echo esc_attr( $options['flickrurl'] ); ?>" />
					</td>
				</tr>			
				-->
				
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'someblog' ); ?>" />
			</p>
			
		</form>
	</div>
	<?php
}


/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 *
 */
 
function someblog_options_validate( $input ) {
		
	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['hiderss'] ) )
		$input['hiderss'] = null;
		$input['hiderss'] = ( $input['hiderss'] == 1 ? 1 : 0 );

	// Our text option must be safe text with no HTML tags
	$input['twitterurl'] = wp_filter_nohtml_kses( $input['twitterurl'] );
	$input['facebookurl'] = wp_filter_nohtml_kses( $input['facebookurl'] );
	$input['googleplusurl'] = wp_filter_nohtml_kses( $input['googleplusurl'] );
	$input['linkedinurl'] = wp_filter_nohtml_kses( $input['linkedinurl'] );
	$input['instagramurl'] = wp_filter_nohtml_kses( $input['instagramurl'] );
	$input['youtubeurl'] = wp_filter_nohtml_kses( $input['youtubeurl'] );
	$input['pinteresturl'] = wp_filter_nohtml_kses( $input['pinteresturl'] );
	$input['stumbleuponurl'] = wp_filter_nohtml_kses( $input['stumbleuponurl'] );
	$input['flickrurl'] = wp_filter_nohtml_kses( $input['flickrurl'] );
	$input['tumblrurl'] = wp_filter_nohtml_kses( $input['tumblrurl'] );
	$input['mediumurl'] = wp_filter_nohtml_kses( $input['mediumurl'] );
	$input['githuburl'] = wp_filter_nohtml_kses( $input['githuburl'] );
	$input['behanceurl'] = wp_filter_nohtml_kses( $input['behanceurl'] );
	$input['dribbbleurl'] = wp_filter_nohtml_kses( $input['dribbbleurl'] );
	$input['logo_url'] = wp_filter_nohtml_kses( $input['logo_url'] );
	//$input['featured_cat'] = wp_filter_nohtml_kses( $input['featured_cat'] );
	
	// Encode URLs
	$input['twitterurl'] = esc_url_raw( $input['twitterurl'] );
	$input['facebookurl'] = esc_url_raw( $input['facebookurl'] );
	$input['googleplusurl'] = esc_url_raw( $input['googleplusurl'] );
	$input['linkedinurl'] = esc_url_raw( $input['linkedinurl'] );
	$input['instagramurl'] = esc_url_raw( $input['instagramurl'] );
	$input['youtubeurl'] = esc_url_raw( $input['youtubeurl'] );
	$input['pinteresturl'] = esc_url_raw( $input['pinteresturl'] );
	$input['stumbleuponurl'] = esc_url_raw( $input['stumbleuponurl'] );
	$input['flickrurl'] = esc_url_raw( $input['flickrurl'] );
	$input['tumblrurl'] = esc_url_raw( $input['tumblrurl'] );
	$input['mediumurl'] = esc_url_raw( $input['mediumurl'] );
	$input['githuburl'] = esc_url_raw( $input['githuburl'] );
	$input['behanceurl'] = esc_url_raw( $input['behanceurl'] );
	$input['dribbbleurl'] = esc_url_raw( $input['dribbbleurl'] );
	$input['logo_url'] = esc_url_raw( $input['logo_url'] );
	//$input['featured_cat'] = esc_url_raw( $input['featured_cat'] );
	
	return $input;
}