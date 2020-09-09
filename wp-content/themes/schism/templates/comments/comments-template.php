<?php
/**
 * The comments template.
 *
 * @package WordPress
 * @subpackage Schism
 * @since 1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$schism_post_id = get_the_ID();
$schism_comments = get_comments(
	array(
		'post_id' => $schism_post_id,
	)
);

if ( $schism_comments || comments_open() ) : ?>
	<?php $evolvethemes_key = evolvethemes_theme_key(); ?>
	<?php printf( '<div id="post-comments" class="%1$s-row %1$s-row_break">', esc_attr( $evolvethemes_key ) ); ?>
	<?php printf( '<div class="%1$s-comments__heading %1$s-spacing">', esc_attr( $evolvethemes_key ) ); ?>
		<?php printf( '<h2 class="%1$s-comments__title %1$s-sticky_top">', esc_attr( $evolvethemes_key ) ); ?>
			<?php
			if ( comments_open() ) {
				esc_html_e( 'Join the discussion', 'schism' );
			} else {
				esc_html_e( 'Read the discussion', 'schism' );
			}
			?>
		</h2>
	</div>

	<?php printf( '<div class="%1$s-comments__loop %1$s-spacing">', esc_attr( $evolvethemes_key ) ); ?>
		<?php comments_template(); ?>
	</div>

</div>
<?php endif; ?>
