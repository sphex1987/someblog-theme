<?php

require get_template_directory() . '/theme-options.php';

if (function_exists('add_theme_support')) {
	add_theme_support('menus');
	register_nav_menu('header-menu','Header Menu');
//	register_nav_menu('footer-menu','Footer Menu');

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "title-tag" );
    add_image_size('someblog-home-image',700,467,true);
    add_image_size('someblog-slide-image',1920,1080,true);
}

if ( ! isset( $content_width ) )
	$content_width = 600; /* pixels */

if(is_admin()){

  if(!get_option('someblog_basic_notice')){

    add_action('admin_notices', 'someblog_basic_notice');
    add_action('wp_ajax_someblog_hide_notice', 'someblog_hide_notice');

    function someblog_basic_notice(){
       ?>
      <div class="basic-notice updated" style="position:relative;">
        <p>
          <?php
            printf(__('<strong>Upgrade to SomeBlog Premium</strong> version to get extended functionality and advanced customization options: %1$s', 'someblog'),
            sprintf('<a class="button button-primary" style="text-decoration:none" href="http://www.logicbaseinteractive.com/someblog-wordpress-theme-premium/">%s</a>', '<strong>Try The SomeBlog Premium</strong>')
            );
          ?>
        </p>
         <a class="hide-me" style="position:absolute;top:10px;right:12px;text-decoration:none;cursor:pointer" title="<?php _e('Close and don\'t show this message again', 'someblog'); ?>">
	         <img src="<?php echo get_template_directory_uri(); ?>/img/close-icon.png" alt="close" />
         </a>
      </div>

      <script type="text/javascript">
       jQuery(document).ready(function($){
         $('#wpbody').delegate('.basic-notice a.hide-me', 'click', function(){
           $.ajax({
             url: ajaxurl,
             type: 'GET',
             context: this,
             data: ({
               action: 'someblog_hide_notice',
               _ajax_nonce: '<?php echo wp_create_nonce('someblog_hide_notice'); ?>'
             }),
             success: function(data){
               $(this).parents('.basic-notice').remove();
             }
           });
         });
       });

      </script>
      <?php
    }

    function thebox_hide_notice(){
      check_ajax_referer('someblog_hide_notice');
      update_option('someblog_basic_notice', true);
      die();
    }

  }

  // removes the notice status from the db
  add_action('switch_theme', 'thebox_remove_notice_record');

  function thebox_remove_notice_record(){
    delete_option('thebox_basic_notice');
  }

}


/**
 * Register widgetized area and update sidebar with default widgets
 *
 */
function someblog_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Sidebar Primary', 'someblog' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="side_box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="side_title">',
		'after_title' => '</h3>',	
	) );

	register_sidebar( array(
		'name' => __( 'Footer Col 1', 'someblog' ),
		'id' => 'footer-1',
		'before_widget' => '<div id="%1$s" class="footer_box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer_title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Col 2', 'someblog' ),
		'id' => 'footer-2',
		'before_widget' => '<div id="%1$s" class="footer_box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer_title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Col 3', 'someblog' ),
		'id' => 'footer-3',
		'before_widget' => '<div id="%1$s" class="footer_box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer_title">',
		'after_title' => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'someblog_widgets_init' );



/**
 * Enqueue scripts and styles for the front end.
 *
 */
function someblog_scripts() {
	
	// Add Google Fonts, used in the main stylesheet.
	wp_enqueue_style( 'someblog-fonts', 'http://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic,700italic', array(), null );
	
	// Add Icons Font, used in the main stylesheet.
	//wp_enqueue_style( 'someblog-icons', get_template_directory_uri() . '/fonts/icons-font.css', array(), '1.6' );
	wp_enqueue_style( 'someblog-fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'someblog-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'someblog-slicknav', get_template_directory_uri() . '/css/slicknav.css' );
	wp_enqueue_style( 'someblog-bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.min.css' );
		
	// Loads main stylesheet.
	wp_enqueue_style( 'someblog-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'someblog-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js' );
	wp_enqueue_script( 'someblog-slicknav-js', get_template_directory_uri() . '/js/jquery.slicknav.js' );
	wp_enqueue_script( 'someblog-scripts-js', get_template_directory_uri() . '/js/scripts.js' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

/*
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
*/
	
}
add_action( 'wp_enqueue_scripts', 'someblog_scripts' );


function my_theme_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'my_theme_add_editor_styles' );


$custom_back_args = array(
	'default-color' => 'EBEBEB',
);
add_theme_support( 'custom-background', $custom_back_args );


function someblog_get_excerpt($num_chars) {
    $temp_str = substr(strip_shortcodes(strip_tags(get_the_content())),0,$num_chars);
    $temp_parts = explode(" ",$temp_str);
    $temp_parts[(count($temp_parts) - 1)] = '';
    
    if(strlen(strip_tags(get_the_content())) > 125)
      return implode(" ",$temp_parts) . '[...]';
    else
      return implode(" ",$temp_parts);
}

function show_creds() {
	echo '<p>&copy; 2015 Copyright text goes here &middot; Proudly powered by <a href="http://wordpress.org/" target="_blank">Wordpress</a> &middot; SomeBlog by <a href="http://logicbaseinteractive.com/" target="_blank">Logicbase Interactive</a></p>';
}



?>