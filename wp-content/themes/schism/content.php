<?php
/**
 * Template of a single post in a loop.
 *
 * This template can be used by loop pages such as the index page, or archives.
 *
 * @package WordPress
 * @subpackage Schism
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();

/* Custom post classes. */
$schism_post_classes = esc_attr( $evolvethemes_key ) . '-entry';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $schism_post_classes ); ?>>
	<?php printf( '<div class="%s-row">', esc_attr( $evolvethemes_key ) ); ?>
		<?php printf( '<div class="%1$s-entry__header %1$s-spacing %1$s-sticky">', esc_attr( $evolvethemes_key ) ); ?>
			<?php printf( '<header class="%s-sticky_top">', esc_attr( $evolvethemes_key ) ); ?>
				<p class="<?php echo esc_attr( $evolvethemes_key ); ?>-entry__before-title">
					<?php evolvethemes_entry_date(); ?>
				</p>

				<h2 <?php evolvethemes_entry_title_attrs(); ?>>
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<?php echo wp_kses_post( evolvethemes_get_entry_title() ); ?>
					</a>
				</h2>
			</header>

			<?php schism_comments_count(); ?>
		</div>

		<?php printf( '<div class="%1$s-entry__content %1$s-spacing">', esc_attr( $evolvethemes_key ) ); ?>
			<?php the_content(); ?>
		</div>

		<?php printf( '<div class="%1$s-entry__meta %1$s-spacing">', esc_attr( $evolvethemes_key ) ); ?>
			<?php do_action( 'schism_entry_meta' ); ?>
		</div>
	</div>
</article>
