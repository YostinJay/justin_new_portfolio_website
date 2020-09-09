<?php
/**
 * Footer template.
 *
 * @package WordPress
 * @subpackage Schism
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();
?>
		<?php
			/**
			 * Function that is entitled to display footer markup.
			 *
			 * Eg. add_action( 'evolvethemes_footer', 'your_custom_function' );
			 */
			evolvethemes_footer();
		?>

			<?php printf( '<div class="%s-grid">', esc_attr( $evolvethemes_key ) ); ?>
				<?php printf( '<span class="%s-grid_vertical"></span>', esc_attr( $evolvethemes_key ) ); ?>
				<?php printf( '<span class="%s-grid_vertical"></span>', esc_attr( $evolvethemes_key ) ); ?>
				<?php printf( '<span class="%s-grid_vertical"></span>', esc_attr( $evolvethemes_key ) ); ?>
				<?php printf( '<span class="%s-grid_vertical"></span>', esc_attr( $evolvethemes_key ) ); ?>
			</div>

		</div>

		<?php wp_footer(); ?>
	</body>
</html>
