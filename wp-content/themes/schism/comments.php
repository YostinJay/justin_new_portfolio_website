<?php
/**
 * The template for displaying comments
 *
 * @package WordPress
 * @subpackage Schism
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();
?>

<div id="comments">
	<?php if ( have_comments() ) : ?>
		<ol class="<?php echo esc_attr( $evolvethemes_key ); ?>-comments">
			<?php
				wp_list_comments(
					array(
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 60,
					)
				);
			?>
		</ol>

		<?php
		the_comments_pagination(
			array(
				'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous', 'schism' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next', 'schism' ) . '</span>',
			)
		);
		?>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="<?php echo esc_attr( $evolvethemes_key ); ?>-comments_closed"><?php esc_html_e( 'Comments are closed.', 'schism' ); ?></p>
	<?php endif; ?>

	<?php
		comment_form(
			array(
				'submit_button' => '<button name="%1$s" id="%2$s" class="%3$s">%4$s</button>',
			)
		);
		?>

</div>
