<?php
/**
 * The page content helpers.
 *
 * @package theme\helpers
 */

/**
 * Display the output for the page content.
 *
 * @since 1.0.0
 */
function schism_page_content_output() {
	$template = 'templates/page-content/content';

	if ( is_home() ) {
		$template = 'templates/page-content/content-loop';
	} elseif ( is_search() ) {
		$template = 'templates/page-content/content-loop-search';
	} elseif ( is_archive() ) {
		$template = 'templates/page-content/archive';
	} elseif ( is_attachment() ) {
		$template = 'templates/page-content/attachment';
	} elseif ( is_404() ) {
		$template = 'templates/page-content/404';
	}

	get_template_part( evolvethemes_apply_filters( 'page_content_output', $template ) );
}

/* Hooking the page content. */
add_action( 'evolvethemes_page_content', 'schism_page_content_output' );

/**
 * Disable comments template on specific pages.
 *
 * @since 1.0.0
 * @return void
 */
function schism_disable_comments() {
	if ( is_front_page() || is_archive() || is_search() || is_404() ) {
		add_filter( 'evolvethemes_comments_template', '__return_empty_string' );
	}
}

add_action( 'wp_head', 'schism_disable_comments' );

/**
 * Extend the wp_kses allowed html elements.
 *
 * @since 1.0.0
 * @param array  $allowedposttags The allowed tags array.
 * @param string $context The context.
 * @return array
 */
function schism_extended_kses_ruleset( $allowedposttags, $context ) {
	if ( 'post' != $context ) {
		return $allowedposttags;
	}

	$svg_args = array(
		'svg'   => array(
			'class'           => true,
			'aria-hidden'     => true,
			'aria-labelledby' => true,
			'role'            => true,
			'xmlns'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true, // <= Must be lower case!
		),
		'g'     => array( 'fill' => true ),
		'title' => array( 'title' => true ),
		'path'  => array(
			'd'    => true,
			'fill' => true,
		),
	);
	return array_merge( $allowedposttags, $svg_args );
}

add_filter( 'wp_kses_allowed_html', 'schism_extended_kses_ruleset', 10, 2 );
