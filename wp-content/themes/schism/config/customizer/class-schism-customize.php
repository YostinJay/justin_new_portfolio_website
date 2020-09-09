<?php
/**
 * Theme customization.
 *
 * @package theme\config\customizer
 */

/**
 * Contains methods for customizing the theme customization screen.
 * Using the example class from with modifications
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 */
class Schism_Customize {

	/**
	 * Register all fields necessary for editing the hero area.
	 *
	 * @param object $wp_customize The wp_customize object.
	 * @return void
	 */
	public static function register( $wp_customize ) {
		$transport = ( $wp_customize->selective_refresh ? 'postMessage' : 'refresh' );

		// Add setting & control for hero background color.
		$wp_customize->add_setting(
			'highlight_color',
			array(
				'default'           => '#F8E71C',
				'transport'         => $transport,
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'highlight_color',
					array(
						'label' => __( 'Highlight color', 'schism' ),
						'section' => 'colors',
						'settings' => 'highlight_color',
						'description' => __( 'The accent color is used to highlight specific parts of the template, in order to make them stand out compared to the standard text color.', 'schism' ),
					)
				)
			);
	}

	/**
	 * Selective refresh
	 *
	 * @param WP_Customize_Manager $wp_customize The wp_customize object.
	 * @return void
	 */
	public static function refresh( WP_Customize_Manager $wp_customize ) {
		// Abort if selective refresh is not available.
		if ( ! isset( $wp_customize->selective_refresh ) ) {
			return;
		}

		$wp_customize->selective_refresh->add_partial(
			'highlight_color',
			array(
				'selector' => '#schism-highlight-css',
				'settings' => 'highlight_color',
				'render_callback' => function() {
					echo esc_attr( self::css( 'highlight', 'variable', 'highlight_color' ) );
				},
			)
		);
	}

	/**
	 * For hooking into `wp_head` mostly to output CSS.
	 *
	 * @return void
	 */
	public static function output() {
		echo '<style id="schism-highlight-css">';
		echo esc_attr( self::css( 'highlight', 'variable', 'highlight_color' ) );
		echo '</style>';
	}

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @uses get_theme_mod()
	 * @param string $selector CSS selector.
	 * @param string $property The name of the CSS *property* to modify.
	 * @param string $theme_mod The name of the 'theme_mod' option to fetch.
	 * @return string Returns a single line of CSS with selectors and a property.
	 */
	public static function css( $selector, $property, $theme_mod ) {
		$return = '';
		$theme_mod = get_theme_mod( $theme_mod );

		if ( ! empty( $theme_mod ) ) {
			if ( 'variable' == $property ) {
				$return = ':root {';
					$return .= sprintf(
						'--%s:%s;',
						$selector,
						$theme_mod
					);
				$return .= '}';
			} else {
				$return = sprintf(
					'%s { %s:%s; }',
					$selector,
					$property,
					$theme_mod
				);
			}

			return $return;
		}
	}
}

// Setup the Theme Customizer settings and controls.
add_action( 'customize_register', array( 'Schism_Customize', 'register' ) );

// Setup the selective refresh functionality.
add_action( 'customize_register', array( 'Schism_Customize', 'refresh' ) );

// Output custom CSS to live site.
add_action( 'wp_head', array( 'Schism_Customize', 'output' ) );
