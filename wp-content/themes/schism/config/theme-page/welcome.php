<?php
/**
 * The theme page content.
 *
 * @package WordPress
 * @subpackage theme-page
 * @since 1.0.0
 */

?>
<div class="wp-clearfix">
	<div class="schism-themepage">

		<div class="schism-themepage__hero">
			<div class="schism-themepage__inner">
				<?php printf( '<h3>%s</h3>', esc_html__( 'Professional themes and plugins for your website', 'schism' ) ); ?>
				<?php printf( '<p>%s</p>', esc_html__( 'Our themes and plugins are designed to help you build your ideas with a solid code base and are professionally supported by our team.', 'schism' ) ); ?>
				<?php printf( '<a href="%s" class="button button-primary button-hero">%s</a>', 'https://justevolve.it/', esc_html__( 'Browse our catalog', 'schism' ) ); ?>
			</div>
		</div>

		<div class="schism-themepage__col">
			<img class="schism-themepage__icon" src="<?php echo esc_url( get_template_directory_uri() . '/config/theme-page/img/grids-icon.png' ); ?>">
			<?php printf( '<h4>%s</h4>', esc_html__( 'Layout builder for WordPress', 'schism' ) ); ?>
			<?php printf( '<p>%s</p>', esc_html__( 'Create columns and advanced layouts with an interactive visual composer designed for the WordPress Block Editor and Gutenberg.', 'schism' ) ); ?>
			<?php printf( '<a href="%s" class="button button-secondary">%s</a>', esc_url( __( 'https://wordpress.org', 'schism' ) ) . '/plugins/grids/', esc_html__( 'Download', 'schism' ) ); ?>
		</div>

		<div class="schism-themepage__col">
			<img class="schism-themepage__icon" src="<?php echo esc_url( get_template_directory_uri() . '/config/theme-page/img/carto-icon.png' ); ?>">
			<?php printf( '<h4>%s</h4>', esc_html__( 'Maps for WordPress', 'schism' ) ); ?>
			<?php printf( '<p>%s</p>', esc_html__( 'Add beautiful clickable maps to WordPress and place as many markers as you like, and customize them with colors and tooltips.', 'schism' ) ); ?>
			<?php printf( '<a href="%s" class="button button-secondary">%s</a>', esc_url( __( 'https://wordpress.org', 'schism' ) ) . '/plugins/carto/', esc_html__( 'Download', 'schism' ) ); ?>
		</div>

		<div class="schism-themepage__col">
			<img class="schism-themepage__icon" src="<?php echo esc_url( get_template_directory_uri() . '/config/theme-page/img/private-icon.png' ); ?>">
			<?php printf( '<h4>%s</h4>', esc_html__( 'Create truly private pages', 'schism' ) ); ?>
			<?php printf( '<p>%s</p>', esc_html__( 'Create restricted sections of your website that only logged users can access, and that are completely invisible to search engines.', 'schism' ) ); ?>
			<?php printf( '<a href="%s" class="button button-secondary">%s</a>', esc_url( __( 'https://wordpress.org', 'schism' ) ) . '/plugins/wp-private-area/', esc_html__( 'Download', 'schism' ) ); ?>
		</div>

	</div>
</div>
