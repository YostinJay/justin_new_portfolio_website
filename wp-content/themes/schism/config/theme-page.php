<?php
/**
 * The theme page configuration.
 *
 * @package WordPress
 * @subpackage config
 * @since 1.0.0
 */

/**
 * Return the about text for the Theme Page.
 *
 * @since 1.0.0
 * @return string
 */
function schism_theme_page_about() {
	$about = __( 'Schism is a free blog theme with clean type and a unique layout that makes it perfect for a personal blog.', 'schism' );

	return $about;
}

add_filter( 'evolvethemes_theme_page_about', 'schism_theme_page_about' );

/**
 * Configuration of the theme page tabs
 *
 * @since 1.0.0
 * @param  array $tabs The theme page tabs.
 * @return array
 */
function schism_theme_page_tabs( $tabs ) {
	$tabs[] = array(
		'slug'    => '',
		'title'   => __( 'Welcome', 'schism' ),
		'content' => trailingslashit( get_template_directory() ) . 'config/theme-page/welcome.php',
	);

	return $tabs;
}

add_filter( 'evolvethemes_theme_page_tabs', 'schism_theme_page_tabs' );

/**
 * Theme page style.
 *
 * @param string $hook The page hook name identifier.
 * @since 1.0.0
 */
function schism_welcome_page_style( $hook ) {
	if ( 'appearance_page_evolvethemes_about' != $hook ) {
		return;
	}
	wp_enqueue_style( 'schism-theme-page-css', get_template_directory_uri() . '/css/theme-page.css', array( 'evolvethemes-theme-page-css' ), '1.0.0' );
}

add_action( 'admin_enqueue_scripts', 'schism_welcome_page_style' );
