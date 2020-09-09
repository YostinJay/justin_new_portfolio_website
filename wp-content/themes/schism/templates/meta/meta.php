<?php
/**
 * The page meta template logic.
 *
 * @package WordPress
 * @subpackage Schism
 * @since 1.0.0
 */

/**
 * Get the template part relative to the meta.
 *
 * @since 1.0.0
 */
function schism_meta() {
	$post_type = get_post_type();

	$template = 'templates/meta/meta-template';
	$template = evolvethemes_apply_filters( 'meta', $template );
	$template = evolvethemes_apply_filters( "meta_post_type_$post_type", $template );

	get_template_part( $template );
}

add_action( 'schism_content_end', 'schism_meta' );
