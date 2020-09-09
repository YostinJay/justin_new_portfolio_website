<?php
/**
 * The main content template.
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

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php
				the_content(
					sprintf(
						/* translators: %s: The post title. */
						esc_html__( 'Continue reading %s', 'schism' ),
						the_title( '<span class="screen-reader-text">', '</span>', false )
					)
				);

				wp_link_pages(
					array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'schism' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'schism' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			?>

		<?php endwhile; ?>
	</div>

	<?php do_action( 'schism_content_end' ); ?>
</div>
