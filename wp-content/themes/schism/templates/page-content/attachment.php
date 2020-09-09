<?php
/**
 * The attachment template.
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
		<?php do_action( 'schism_featured_image' ); ?>

		<p><?php evolvethemes_entry_author(); ?></p>
		<p><?php evolvethemes_entry_date(); ?></p>
		<p><?php evolvethemes_image_meta(); ?></p>
	</div>

</div>
