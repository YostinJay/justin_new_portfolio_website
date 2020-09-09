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
<?php printf( '<header class="%1$s-h %1$s-row">', esc_attr( $evolvethemes_key ) ); ?>
	<?php printf( '<div class="%s-spacing">', esc_attr( $evolvethemes_key ) ); ?>
		<?php evolvethemes_logo(); ?>
	</div>

	<?php if ( has_nav_menu( 'primary' ) ) : ?>
		<?php printf( '<div class="%1$s-h__right-col %1$s-spacing">', esc_attr( $evolvethemes_key ) ); ?>
			<?php printf( '<button type="button" class="%s-h-nav__trigger"><span></span><span class="screen-reader-text">%s</span></button>', esc_attr( $evolvethemes_key ), esc_html__( 'Menu', 'schism' ) ); ?>
			<?php evolvethemes_nav(); ?>
		</div>
	<?php endif; ?>
</header>
