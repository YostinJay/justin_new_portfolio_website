<?php
/**
 * The header template.
 *
 * @package WordPress
 * @subpackage Schism
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();
?>
<?php printf( '<div class="%1$s-ph %1$s-spacing %1$s-sticky">', esc_attr( $evolvethemes_key ) ); ?>
	<?php printf( '<div class="%1$s-ph__wrapper %1$s-sticky_top">', esc_attr( $evolvethemes_key ) ); ?>
		<?php schism_before_page_title(); ?>
		<?php schism_page_title(); ?>
	</div>

	<?php do_action( 'schism_after_page_title' ); ?>
</div>
