<?php
/**
 * The global theme functionality.
 *
 * @package WordPress
 * @subpackage config
 * @since 1.0.0
 */

if ( ! isset( $content_width ) ) { // @codingStandardsIgnoreLine
	/* Set the content width based on the theme's design and stylesheet. */
	$content_width = 0; // @codingStandardsIgnoreLine
}

/**
 * Theme setup.
 *
 * @since 1.0.0
 */
function schism_theme_setup() {
	/* This theme uses wp_nav_menu() in one location. */
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'schism' ),
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats',
		array(
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
	);

	/* Add support for the custom logo. */
	add_theme_support(
		'custom-logo',
		array(
			'header-text' => array(
				'site-title',
				'site-description',
			),
		)
	);

	/* Add support for Gutenberg wide images */
	add_theme_support( 'align-wide' );
}

add_action( 'after_setup_theme', 'schism_theme_setup' );

/**
 * Register the theme sidebars.
 *
 * @since 1.0.0
 */
function schism_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Main Widget Area', 'schism' ),
			'id'            => 'main-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'schism' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<p class="schism-widget__title"><span>',
			'after_title'   => '</span></p>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer column 1', 'schism' ),
			'id'            => 'footer-col-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer column.', 'schism' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<p class="schism-widget__title"><span>',
			'after_title'   => '</span></p>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer column 2', 'schism' ),
			'id'            => 'footer-col-2',
			'description'   => esc_html__( 'Add widgets here to appear in your footer column.', 'schism' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<p class="schism-widget__title"><span>',
			'after_title'   => '</span></p>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer column 3', 'schism' ),
			'id'            => 'footer-col-3',
			'description'   => esc_html__( 'Add widgets here to appear in your footer column.', 'schism' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<p class="schism-widget__title"><span>',
			'after_title'   => '</span></p>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer column 4', 'schism' ),
			'id'            => 'footer-col-4',
			'description'   => esc_html__( 'Add widgets here to appear in your footer column.', 'schism' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<p class="schism-widget__title"><span>',
			'after_title'   => '</span></p>',
		)
	);
}

add_action( 'widgets_init', 'schism_widgets_init' );

/**
 * Enqueue the assets that are required by the theme.
 *
 * @since 1.0.0
 */
function schism_enqueue_main_stylesheet() {
	$evolvethemes_key = evolvethemes_theme_key();

	/* Main style dependencies. */
	$theme_style_dependencies = apply_filters( 'evolvethemes_theme_main_style_dependencies', array( 'wp-mediaelement' ) );

	/* Main stylesheet. */
	wp_enqueue_style( $evolvethemes_key . '-style', get_template_directory_uri() . '/css/theme-style.css', array(), '1.0.0' );

	if ( is_child_theme() ) {
		/* Including the parent theme stylesheet in the event that we're using a child theme. */
		wp_enqueue_style( $evolvethemes_key . '-child-style', get_stylesheet_directory_uri() . '/style.css', array( $evolvethemes_key . '-style' ), '1.0.0' );
	}

	/* Theme scripts. */
	$theme_script_dependencies = array( 'evolvethemes-preloader', 'evolvethemes-fonts', 'jquery' );
	$theme_script_dependencies = apply_filters( 'evolvethemes_theme_main_style_dependencies', $theme_script_dependencies );

	wp_enqueue_script( $evolvethemes_key . '-fitvids', get_template_directory_uri() . '/js/libs/jquery.fitvids.js', $theme_script_dependencies, '1.0.0', true );
	wp_enqueue_script( $evolvethemes_key . '-sticky', get_template_directory_uri() . '/js/sticky.js', $theme_script_dependencies, '1.0.0', true );
	wp_enqueue_script( $evolvethemes_key . '-menu', get_template_directory_uri() . '/js/menu.js', $theme_script_dependencies, '1.0.0', true );
	wp_enqueue_script( $evolvethemes_key . '-script', get_template_directory_uri() . '/js/script.js', $theme_script_dependencies, '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		/* If we're in a single post page with comments ON, include the threaded comments JavaScript helper. */
		wp_enqueue_script( 'comment-reply' );
	}

	/* Main script localization. */
	wp_localize_script(
		$evolvethemes_key . '-script',
		$evolvethemes_key,
		apply_filters(
			'schism_localize_script',
			array()
		)
	);
}

add_action( 'evolvethemes_assets_styles', 'schism_enqueue_main_stylesheet' );

/**
 * Add the "skip to content" link after the body opens.
 *
 * @since 1.0.0
 */
function schism_themename_skip_to_content() {
	?>
	<a class="screen-reader-text" href="#main-content"><?php esc_html_e( 'Skip to content', 'schism' ); ?></a>
	<?php
}

add_action( 'wp_body_open', 'schism_themename_skip_to_content' );

/**
 * Configurate the theme preloader.
 *
 * @since 1.0.0
 * @param array $config The theme localization array.
 * @return array
 */
function schism_preloader_config( $config ) {
	$config['preloader'] = array(
		'fonts',
	);

	$config['preloader'] = apply_filters( 'schism_preloader_config', $config['preloader'] );

	return $config;
}

add_filter( 'schism_localize_script', 'schism_preloader_config' );

/**
 * Load theme webfonts.
 *
 * @since 1.0.0
 * @param array $config The theme localization array.
 * @return array
 */
function schism_theme_load_fonts( $config ) {
	$config['fonts'] = array(
		array(
			'source' => 'custom',
			'custom' => array(
				'font_family' => 'Inter var',
				'url' => get_stylesheet_directory_uri() . '/fonts/inter.css',
			),
		),
		array(
			'source' => 'custom',
			'custom' => array(
				'font_family' => 'ibm_plex_serifitalic',
				'url' => get_stylesheet_directory_uri() . '/fonts/ibmplexserif.css',
			),
		),
	);

	return $config;
}

add_filter( 'schism_localize_script', 'schism_theme_load_fonts' );

/**
 * Definition of a theme palette.
 *
 * @return void
 */
function schism_color_setup() {
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Highlight', 'schism' ),
				'slug'  => 'highlight',
				'color' => '#F8E71C',
			),
			array(
				'name'  => __( 'Black', 'schism' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
			array(
				'name'  => __( 'Grey 40', 'schism' ),
				'slug'  => 'grey-40',
				'color' => '#666666',
			),
			array(
				'name'  => __( 'Grey 95', 'schism' ),
				'slug'  => 'grey-95',
				'color' => '#f2f2f2',
			),
			array(
				'name'  => __( 'White', 'schism' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
		)
	);
}
add_action( 'after_setup_theme', 'schism_color_setup' );
