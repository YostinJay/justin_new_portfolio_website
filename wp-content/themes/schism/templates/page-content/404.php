<?php
/**
 * The 404 template.
 *
 * @package WordPress
 * @subpackage Schism
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();
?>

<?php printf( '<div class="%s-row" id="main-content">', esc_attr( $evolvethemes_key ) ); ?>
	<?php do_action( 'schism_content_start' ); ?>

	<?php printf( '<div class="%1$s-content %1$s-spacing">', esc_attr( $evolvethemes_key ) ); ?>
			<p><?php echo wp_kses_post( __( 'We are sorry, but the page you are looking for does not exist. Please check entered address and try again or go to home page.', 'schism' ) ); ?></p>
			<?php printf( '<a href="%s">%s</a>', esc_url( home_url() ), esc_html__( 'Back to home page', 'schism' ) ); ?>
	</div>
</div>
