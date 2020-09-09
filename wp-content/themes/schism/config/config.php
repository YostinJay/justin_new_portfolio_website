<?php
/**
 * Theme configuration.
 *
 * @package theme\config
 */

/* Configuration base folder path. */
$evolvethemes_config_base_folder = trailingslashit( get_template_directory() . '/config' );

/* Templates folder path. */
$evolvethemes_templates_folder = trailingslashit( get_template_directory() . '/templates' );

/* Helpers folder path. */
$evolvethemes_helpers_folder = trailingslashit( get_template_directory() . '/helpers' );

/* Theme page configuration. */
require_once $evolvethemes_config_base_folder . 'theme-page.php';

/* Modules configuration. */
require_once $evolvethemes_config_base_folder . 'config-modules.php';

/* Global functionality and theme setup. */
require_once $evolvethemes_config_base_folder . 'global-functionality.php';

/* Page content */
require_once $evolvethemes_helpers_folder . 'page-content.php';

/* Page header */
require_once $evolvethemes_helpers_folder . 'page-header.php';

/* Sharing. */
require_once $evolvethemes_helpers_folder . 'sharing.php';

/* Blog. */
require_once $evolvethemes_helpers_folder . 'blog.php';

/* Page header templates. */
require_once $evolvethemes_templates_folder . 'page-header/page-header.php';

/* Page metas. */
require_once $evolvethemes_templates_folder . 'meta/meta.php';

/* Post navigation. */
require_once $evolvethemes_templates_folder . 'post-navigation/post-navigation.php';

/* Comments. */
require_once $evolvethemes_templates_folder . 'comments/comments.php';

/* Customizer. */
require_once $evolvethemes_config_base_folder . 'customizer/class-schism-customize.php';

/**
 * Define the theme key.
 *
 * @since 1.0.0
 * @return string
 */
function schism_theme_key() {
	$theme_key = 'schism';

	return $theme_key;
}

add_filter( 'evolvethemes_theme_key', 'schism_theme_key' );

/**
 * Define the theme name.
 *
 * @since 1.0.0
 * @param  string $theme_name The theme name.
 * @return string
 */
function schism_theme_name( $theme_name ) {
	$theme_name = 'Schism';

	return $theme_name;
}

add_filter( 'evolvethemes_theme_name', 'schism_theme_name' );
