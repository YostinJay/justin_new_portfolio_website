<?php
/**
 * The post navigation template.
 *
 * @package WordPress
 * @subpackage Schism
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();
$schism_next_post = get_next_post();
$schism_prev_post = get_previous_post();
?>
<?php if ( is_singular( 'post' ) && ( ! empty( $schism_next_post ) || ! empty( $schism_prev_post ) ) ) : ?>
	<?php printf( '<div class="%1$s-row %1$s-post-nav %1$s-row_break">', esc_attr( $evolvethemes_key ) ); ?>


		<?php if ( ! empty( $schism_prev_post ) ) : ?>
			<?php
			$schism_prev_post_class = '';
			if ( empty( $schism_next_post ) ) {
				$schism_prev_post_class = $evolvethemes_key . '-post-nav__item_without-next';
			}

			$schism_prev_post_title = ! empty( $schism_prev_post->post_title ) ? $schism_prev_post->post_title : __( 'No title', 'schism' );
			?>
			<?php printf( '<div class="%1$s-post-nav__item %1$s-post-nav__item_prev %1$s-spacing %2$s">', esc_attr( $evolvethemes_key ), esc_attr( $schism_prev_post_class ) ); ?>
				<p><?php esc_html_e( 'Previous article', 'schism' ); ?></p>
				<a href="<?php echo esc_url( get_permalink( $schism_prev_post->ID ) ); ?>"><?php echo esc_html( $schism_prev_post_title ); ?></a>
				<svg height="31" viewBox="0 0 50 31" width="50" xmlns="http://www.w3.org/2000/svg"><path d="m1060.3125 264.84375c-.625-.625003-.625-1.249997 0-1.875l10.46875-11.5625h-44.53125c-.83334 0-1.25-.41666-1.25-1.25s.41666-1.25 1.25-1.25h44.53125l-10.46875-11.5625c-.625-.625-.625-1.25 0-1.875s1.25-.625 1.875 0c8.22921 9.06255 12.39583 13.64583 12.5 13.75.20833.20833.3125.52083.3125.9375s-.10417.72917-.3125.9375l-12.5 13.75c-.20833.208334-.52083.3125-.9375.3125s-.72917-.104166-.9375-.3125z" fill-rule="evenodd" transform="translate(-1025 -235)"/></svg>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $schism_next_post ) ) : ?>
			<?php
				$schism_next_post_title = ! empty( $schism_next_post->post_title ) ? $schism_next_post->post_title : __( 'No title', 'schism' );
			?>
			<?php printf( '<div class="%1$s-post-nav__item %1$s-post-nav__item_next %1$s-spacing">', esc_attr( $evolvethemes_key ) ); ?>
				<p><?php esc_html_e( 'Next article', 'schism' ); ?></p>
				<a href="<?php echo esc_url( get_permalink( $schism_next_post->ID ) ); ?>"><?php echo esc_html( $schism_next_post_title ); ?></a>
				<svg height="31" viewBox="0 0 50 31" width="50" xmlns="http://www.w3.org/2000/svg"><path d="m1060.3125 264.84375c-.625-.625003-.625-1.249997 0-1.875l10.46875-11.5625h-44.53125c-.83334 0-1.25-.41666-1.25-1.25s.41666-1.25 1.25-1.25h44.53125l-10.46875-11.5625c-.625-.625-.625-1.25 0-1.875s1.25-.625 1.875 0c8.22921 9.06255 12.39583 13.64583 12.5 13.75.20833.20833.3125.52083.3125.9375s-.10417.72917-.3125.9375l-12.5 13.75c-.20833.208334-.52083.3125-.9375.3125s-.72917-.104166-.9375-.3125z" fill-rule="evenodd" transform="translate(-1025 -235)"/></svg>
			</div>
		<?php endif; ?>

	</div>
<?php endif; ?>
