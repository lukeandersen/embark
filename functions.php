<?php

// Constants
define('THEME_NAME', 'Embark');
define('THEME_SLUG', 'embark');
define('THEME_DIR', get_template_directory());
define('THEME_URI', get_template_directory_uri());


// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 640; // pixels

if ( ! function_exists( 'Embark_setup' ) ):


// Sets up theme defaults and registers support for various WordPress features.
function embark_setup() {

	// Custom template tags for this theme.
	require( THEME_DIR . '/functions/template-tags.php' );

  // Custom functions that act independently of the theme templates
  require( THEME_DIR . '/functions/extras.php' );

  //Customizer additions
  require( THEME_DIR . '/functions/customizer.php' );

  // Custom post types 
  require( THEME_DIR . '/functions/custom-post-types/gallery.php' );

  // Language support
  // load_theme_textdomain( 'Embark', THEME_DIR . '/languages' );

	// Custom nav manus
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'THEME_SLUG' ),
    // 'footer' => __( 'Footer Menu', 'THEME_SLUG' ),
	) );

  // theme supports, uncomment these lines to use any or all of them
  //add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
  
  // Post thubnails
  add_theme_support( 'post-thumbnails' );
  // set_post_thumbnail_size(300, 220, true); // Normal post thumbnails
  add_image_size('social-gallery', 90, 90, true); //(cropped)

  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'custom-background' );
  add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'  ) );
  add_editor_style(); //remember to make this sass file in the sass root

  // Remove wordpress gallery styles
  add_filter( 'use_default_gallery_style', '__return_false' );

  // Adds a rel="lightbox" tag to all linked image files
  add_filter('the_content', 'addlightboxrel_replace', 12);
  add_filter('get_comment_text', 'addlightboxrel_replace');
  function addlightboxrel_replace ($content)
  {   global $post;
    $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
    $replacement = '<a$1href=$2$3.$4$5 rel="lightbox"$6>$7</a>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
  }

}
endif; // Embark_setup
add_action( 'after_setup_theme', 'embark_setup' );


// Custom sidebars
function embark_widgets_init() {

  if ( function_exists('register_sidebar') ) {
    $allWidgetizedAreas = array("Sidebar", "Intro sidebar", "Header ad space", "Footer directory");
    foreach ($allWidgetizedAreas as $WidgetAreaName) {
      register_sidebar(array(
        'name'=> $WidgetAreaName,
        'before_widget' => '<aside id="%1$s" class="widget sidebar-widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
      ));
    }
  }

}
  
/* Useage for multiple - <?php dynamic_sidebar( 'sidebar-2' ); ?> */
add_action( 'widgets_init', 'embark_widgets_init' );


// Load all the .php files found in /functions/custom-widgets/ directory and prefixed with "widget-"
$preview_template = _preview_theme_template_filter();
if(!empty($preview_template)){
  $widgets_dir = WP_CONTENT_DIR . "/themes/".$preview_template."/functions/custom_widgets/";
} else {
  $widgets_dir = WP_CONTENT_DIR . "/themes/".get_option('template')."/functions/custom_widgets/";
}
if (@is_dir($widgets_dir)) {
  $widgets_dh = opendir($widgets_dir);
  while (($widgets_file = readdir($widgets_dh)) !== false) {
    if(strpos($widgets_file,'.php') && $widgets_file != "widget-blank.php") {
      include_once($widgets_dir . $widgets_file);
    }
  }
  closedir($widgets_dh);
}


// Enqueue scripts and styles
function embark_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'modernizr', THEME_URI .'/js/libs/modernizr-min.js', array(),'2.6.1');

  // jQuery
  wp_deregister_script( 'jquery' );
  wp_register_script('jquery', THEME_URI .'/js/libs/jquery-1.8.3.min.js', array(), '1.8.3', false );
  wp_enqueue_script('jquery');

	// Plugins and scripts load
	wp_enqueue_script( 'jquery-plugins', THEME_URI .'/js/plugins.js', array('jquery'), '0',true);
	wp_enqueue_script( 'jquery-script', THEME_URI .'/js/script.js', array('jquery'), '0', true);

	// Conditional loading scripts
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'embark_scripts' );


// Implement the Custom Header feature
//require( get_template_directory() . '/functions/custom-header.php' );


// Shortcodes
require( THEME_DIR . '/functions/shortcodes.php' );

// Add shortcodes select option
add_action('media_buttons','add_sc_select',11);
function add_sc_select(){
  global $shortcode_tags;
  // enter names of shortcode to exclude bellow 
  $exclude = array("wp_caption", "embed", "gallery", "caption", "loginform");
  echo '&nbsp;<select id="sc_select"><option>Shortcode</option>';
  foreach ($shortcode_tags as $key => $val){
    if(!in_array($key,$exclude)){
      $shortcodes_list .= '<option value="['.$key.'][/'.$key.']">'.$key.'</option>';
    }
  }
  echo $shortcodes_list;
  echo '</select>';
}
add_action('admin_head', 'button_js');
function button_js() {
  echo '<script type="text/javascript">
  jQuery(document).ready(function(){
     jQuery("#sc_select").change(function() {
        send_to_editor(jQuery("#sc_select :selected").val());
        return false;});
  });
  </script>';
}


// Shorten titles
// Character limit
function shortTitle($length) {
  $string = the_title('','',FALSE);
  if(strlen($string) > $length)
    $string = (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . '...';
  echo $string;
}
// Word limit
// function shortTitle($length) {
//   $title = explode(' ', get_the_title(), $length);
//     if (count($title)>=$length) {
//       array_pop($title);
//       $title = implode(" ",$title). '...';
//     } else {
//       $title = implode(" ",$title);
//   }
//   return $title;
// }
/* Useage - <?php shortTitle(50); ?> */



// Tags without links
// function linklessTags() {
//   $posttags = wp_get_post_terms( get_the_ID() , 'post_tag' , 'fields=names' );
//   if( $posttags ) echo implode( ' ' , $posttags );
// }
/* Useage - <?php linklessTags(); ?> */



// Removes WordPress version number from site
remove_action( 'wp_head', 'wp-generator' );

?>
