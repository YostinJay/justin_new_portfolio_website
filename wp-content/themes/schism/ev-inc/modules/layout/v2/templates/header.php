<?php
/**
 * Header templates.
 *
 * @package WordPress
 * @subpackage ev-inc
 * @since 1.0.0
 */

/**
 * Display the site header according to its type and the page context.
 *
 * @since 1.0.0
 */
function evolvethemes_header() {
	evolvethemes_do_action( 'header_before' );

		evolvethemes_do_action( 'header' );

	evolvethemes_do_action( 'header_after' );
}

/**
 * Get the template part relative to the footer.
 *
 * @since 1.0.0
 */
function evolvethemes_header_load_template() {
	$evolvethemes_header_path = 'templates/header/header';
	$evolvethemes_header_path = evolvethemes_apply_filters( 'header_path', $evolvethemes_header_path );
	get_template_part( $evolvethemes_header_path );
}

add_action( 'evolvethemes_header', 'evolvethemes_header_load_template' );

/**
 * Display the site's navigation.
 *
 * @since 1.0.0
 * @param string $location The menu location name.
 * @param string $classes The menu classes.
 */
function evolvethemes_nav( $location = 'primary', $classes = '' ) {
	$locations = get_nav_menu_locations();

	if ( ! isset( $locations[ $location ] ) ) {
		return;
	}

	// Menu output.
	$menu_markup     = '';
	$menu_nav_markup = '';
	$theme_key       = evolvethemes_theme_key();

	if ( $location ) {
		ob_start();
		wp_nav_menu(
			array(
				'theme_location' => $location,
			)
		);
		$menu_nav_markup = ob_get_contents();
		ob_end_clean();
	}

	$menu_class = esc_attr( $theme_key ) . '-nav';
	$menu_class = evolvethemes_apply_filters( 'menu_class', $menu_class );

	$menu_id = esc_attr( $theme_key ) . '-nav-' . esc_html( $location );

	if ( $menu_nav_markup ) {
		$menu_markup  = '<nav id="' . esc_attr( $menu_id ) . '" class="' . esc_attr( $menu_class ) . '">';
		$menu_markup .= $menu_nav_markup;
		$menu_markup .= '</nav>';
	}

	// Menu wrapper output.
	ob_start();

	do_action( 'evolvethemes_nav_menu_before', $location );
	do_action( "evolvethemes_nav_menu_before_location_$location", $location );

	print wp_kses_post( $menu_markup ); // @codingStandardsIgnoreLine

	do_action( 'evolvethemes_nav_menu_after', $location );
	do_action( "evolvethemes_nav_menu_after_location_$location", $location );

	$menu_wrapper_markup = ob_get_contents();
	ob_end_clean();

	if ( ! $menu_wrapper_markup ) {
		return;
	}
	?>
	<div class="<?php echo esc_attr( $theme_key ); ?>-nav__wrapper <?php echo esc_attr( $classes ); ?>">
		<?php print wp_kses_post( $menu_wrapper_markup ); // @codingStandardsIgnoreLine ?>
	</div>
	<?php
}

/**
 * Check the display site title and tagline option.
 *
 * @since 1.0.0
 * @return boolean
 */
function evolvethemes_display_header_text() {
	$header_text = get_theme_mod( 'header_text', 1 );

	if ( current_theme_supports( 'custom-header', 'header-text' ) ) {
		$header_text = display_header_text();
	}

	return (bool) $header_text;
}

/**
 * The theme logo
 *
 * @since 1.0.0
 */
function evolvethemes_logo() {
	$site_name = get_bloginfo( 'name', true );
	$site_desc = get_bloginfo( 'description', true );
	$theme_key = evolvethemes_theme_key();

	printf( "<div class='%s-logo'>", esc_html( $theme_key ) );

	evolvethemes_custom_logo();

	if ( evolvethemes_display_header_text() ) {
		printf( '<a href="%s" rel="home" itemprop="url">', esc_attr( home_url( '/' ) ) );
		if ( $site_name ) {
			printf( '<p class="%s-site__title">%s</p>', esc_attr( $theme_key ), esc_html( $site_name ) );
		}
		if ( $site_desc ) {
			printf( '<p class="%s-site__description">%s</p>', esc_attr( $theme_key ), esc_html( $site_desc ) );
		}
		echo '</a>';
	}

	echo '</div>';
}

/**
 * The custom logo.
 *
 * @since 1.0.0
 */
function evolvethemes_custom_logo() {
	if ( has_custom_logo() ) {
		the_custom_logo();
	}
}
