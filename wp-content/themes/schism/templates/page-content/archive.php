<?php
/**
 * The main archive loop template.
 *
 * @package WordPress
 * @subpackage Bootstrap
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();
?>

<?php printf( '<div class="%s-row" id="main-content">', esc_attr( $evolvethemes_key ) ); ?>
	<?php do_action( 'schism_content_start' ); ?>

	<?php evolvethemes_loop(); ?>
</div>
