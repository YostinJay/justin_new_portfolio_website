<?php
/**
 * The page header template logic.
 *
 * @package WordPress
 * @subpackage Schism
 * @since 1.0.0
 */

/**
 * Get the template part relative to the page header.
 *
 * @since 1.0.0
 */
function schism_page_header() {
	$post_type = get_post_type();

	$template = 'templates/page-header/types/page-header-default';
	$template = evolvethemes_apply_filters( 'page_header_template', $template );
	$template = evolvethemes_apply_filters( "page_header_template_post_type_$post_type", $template );

	get_template_part( $template );
}

add_action( 'schism_content_start', 'schism_page_header', 5 );
