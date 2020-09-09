<?php
/**
 * admela functions 
 *
 *
 @ package WordPress
 * @subpackage admela
 * @since Admela 1.0
 *
 *
 */

 /**
 *
 * Load the required functions
 *
 */
 
 
  
  /**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Admela 1.0
 */
 
if ( ! isset( $content_width ) ) {
	$content_width = 840;
}


add_action( 'after_setup_theme', 'admela_setup' );

/**
 * All setup functionalities.
 *
 * @since 1.0.4
 */
 
if( !function_exists( 'admela_setup' ) ) :

function admela_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'admela', get_template_directory() . '/languages' );
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'admela-slider-featured-image', 380, 480, true );

	add_image_size( 'admela-post-featured-image', 264, 176, true );
	
	add_image_size( 'admela-single-post-featured-image', 864, 550, true );
	
	add_image_size( 'admela-related-post-featured-image', 410, 245, true );
	
	add_image_size( 'admela-single-post-topbar-image', 50, 50, true );
	
    // Supporting title tag via add_theme_support (since WordPress 4.1)
    add_theme_support( 'title-tag' );
	
	/*
	* Enable support for custom-header
	*/
	add_theme_support( 'custom-header' );
	
	/*
	* Enable support for add_editor_style
	*/
	add_editor_style( 'lib/css/editor-style.css' );


	// Registering navigation menus.
	register_nav_menus( array(
		'admela-primary-menu' 	=> esc_html__( 'Primary Menu','admela' ),
		'admela-secondary-menu' 	=> esc_html__( 'Secondary Menu','admela' ) 		
        
	) );
	
		
	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'admela_custom_background_args', array(
		'default-color' => 'ffffff'
	) ) );
	

   /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
   add_theme_support('html5', array(
       'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
   ));
   	
	// Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo', array(
			'width'      => 150,
			'height'     => 55,
			'flex-width' => true,			
		)
	);

	
    // Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
   
    /*
	 * Enable support for Post Formats.
	 *
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	));
   
   add_action('widgets_init', 'admela_widgets_init' ); // Register  admela widget areas.   
   add_action('wp_enqueue_scripts', 'admela_enqueue_scripts');  
  
	
}

endif;


/*register the widget  */


if(! function_exists( 'admela_widgets_init' )):
 
function admela_widgets_init() {	
  

	/*register right sidebar widget  */

	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'admela' ),
		'id'            => 'admela-primary-sidebar',
		'description'   => esc_html__( 'primary sidebar that appears on the Right.', 'admela' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="admela_widgettit"><h3 class="widget-title admela_widgetsbrtit">',
		'after_title'   => '</h3></div>',
	) );
	
}

endif;

/*
Register Google Fonts
*/

if(! function_exists( 'admela_fonts_url' )):

function admela_fonts_url() {
	
	
	$admela_googlefont = 'Oswald';
	
	$admela_bdygooglefont = 'Noto Sans';
				
    $admela_fonturl = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'admela' ) ) {
        $admela_fonturl = add_query_arg( 'family', urlencode( ''.$admela_googlefont.':100,300,400,700 |'.$admela_bdygooglefont.':100,300,400,700&subset=latin,latin-ext,greek,cyrillic' ), "//fonts.googleapis.com/css" );
    }
    return esc_url_raw($admela_fonturl);
}
		
endif;		
		
 
// Load Custom Js And style. 

if(! function_exists( 'admela_enqueue_scripts' )):

function admela_enqueue_scripts() {

        global $post,$admela_customcss;

		$admela_customcss .= '';
		$admela_admargin = '';
	    

		// Enqueue Theme Style

		$admela_dir_uri = get_template_directory_uri();

        wp_enqueue_style( 'admela-fonts', admela_fonts_url(), array(), null );
			
		wp_enqueue_style('admela-style', get_stylesheet_uri());
				    	
		// Enqueue Theme Inline-Style
		
		if(get_theme_mod('admela_custom_logo') == true) {
			$admela_customcss .= ".admela_sitetitle {padding: 0 0 0px;} \r\n";
        }
		
		if(get_theme_mod('admela_single_post_top_ad_setting') != '') {

		if((get_theme_mod('admela_single_post_top_ad_alignment_setting') == 'none')):

		$admela_admargin = '12px 0px 20px';

		elseif((get_theme_mod('admela_single_post_top_ad_alignment_setting') == 'left')):

		$admela_admargin = '10px 25px 0px 0';

		elseif((get_theme_mod('admela_single_post_top_ad_alignment_setting') == 'right')):

		$admela_admargin = '10px 0px 0px 25px';

		endif;
		
		$admela_customcss .= ".admela_ectpad {float:". esc_html((get_theme_mod('admela_single_post_top_ad_alignment_setting')) ? get_theme_mod('admela_single_post_top_ad_alignment_setting') :'none').";margin:".esc_html($admela_admargin).";}\r\n";
		
		}
		
		
		wp_add_inline_style('admela-style', $admela_customcss);
		
	
		// Enqueue Theme Javascript  		   
		 	
		wp_enqueue_script('admelacustom', $admela_dir_uri . '/js/admelacustom.js', array('jquery'), null, true); 	
		
    
		if (is_single() || is_page()) {
            wp_enqueue_script('comment-reply');
		}
  
		
    }
endif;


  /* Customizer additions. */ 
  require get_parent_theme_file_path('/lib/includes/customizer.php');
  
  /* Custom template tags for this theme. */ 
  require get_parent_theme_file_path('/lib/includes/admela-customtemp-tags.php');
  