<?php
/**
 * The meta template.
 *
 * @package WordPress
 * @subpackage Schism
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();
?>
<?php printf( '<div class="%1$s-meta %1$s-spacing">', esc_attr( $evolvethemes_key ) ); ?>
	<?php printf( '<div class="%1$s-meta__wrapper %1$s-sticky_top">', esc_attr( $evolvethemes_key ) ); ?>
		<?php if ( is_singular( 'post' ) ) : ?>
			<?php printf( '<div class="%s-meta__date">', esc_attr( $evolvethemes_key ) ); ?>
			<?php evolvethemes_entry_date(); ?>
		</div>
		<?php endif; ?>

		<?php if ( evolvethemes_get_post_categories() ) : ?>
			<?php printf( '<div class="%s-meta__categories">', esc_attr( $evolvethemes_key ) ); ?>
				<?php printf( '<p class="%s-heading_small">%s</p>', esc_attr( $evolvethemes_key ), esc_html__( 'in:', 'schism' ) ); ?>
				<?php evolvethemes_post_categories(); ?>
			</div>
		<?php endif; ?>

		<?php if ( evolvethemes_get_post_tags() ) : ?>
			<?php printf( '<div class="%s-meta__tags">', esc_attr( $evolvethemes_key ) ); ?>
				<?php printf( '<p class="%s-heading_small">%s</p>', esc_attr( $evolvethemes_key ), esc_html__( 'Tagged:', 'schism' ) ); ?>
				<?php evolvethemes_post_tags(); ?>
			</div>
		<?php endif; ?>

		<?php if ( is_singular( 'post' ) ) : ?>
			<?php printf( '<div class="%s-meta__sharing">', esc_attr( $evolvethemes_key ) ); ?>
				<?php printf( '<p class="%s-heading_small">%s</p>', esc_attr( $evolvethemes_key ), esc_html__( 'Share on:', 'schism' ) ); ?>
				<?php do_action( 'schism_sharing' ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
