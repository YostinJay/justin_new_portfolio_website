<?php
/**
 * The post navigation template logic.
 *
 * @package WordPress
 * @subpackage Schism
 * @since 1.0.0
 */

/**
 * Get the template part relative to the post navigation.
 *
 * @since 1.0.0
 */
function schism_post_navigation() {
	$post_type = get_post_type();

	$template = 'templates/post-navigation/post-navigation-template';
	$template = evolvethemes_apply_filters( 'post_navigation', $template );
	$template = evolvethemes_apply_filters( "post_navigation_post_type_$post_type", $template );

	get_template_part( $template );
}

add_action( 'schism_after_content', 'schism_post_navigation' );
