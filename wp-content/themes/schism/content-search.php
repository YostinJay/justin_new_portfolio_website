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
$evolvethemes_post_classes = array( esc_attr( $evolvethemes_key ) . '-spacing' );
$evolvethemes_post_classes[] = esc_attr( $evolvethemes_key ) . '-entry_archive';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $evolvethemes_post_classes ); ?>>
	<?php printf( '<div class="%s-entry__header">', esc_attr( $evolvethemes_key ) ); ?>
		<header>
			<p class="<?php echo esc_attr( $evolvethemes_key ); ?>-entry__before-title">
				<?php evolvethemes_entry_date(); ?>
			</p>

			<h2 <?php evolvethemes_entry_title_attrs(); ?>>
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php echo wp_kses_post( evolvethemes_get_entry_title() ); ?>
				</a>
			</h2>
		</header>
	</div>

	<?php printf( '<div class="%s-entry__content">', esc_attr( $evolvethemes_key ) ); ?>
		<?php the_excerpt(); ?>
	</div>
</article>
