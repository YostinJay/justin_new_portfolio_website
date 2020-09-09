<?php
/**
 * The main archive loop template.
 *
 * @package WordPress
 * @subpackage Schism
 * @since 1.0.0
 */

$evolvethemes_key = evolvethemes_theme_key();
?>

<?php printf( '<div class="%s-row" id="main-content">', esc_attr( $evolvethemes_key ) ); ?>
	<?php do_action( 'schism_content_start' ); ?>

	<?php evolvethemes_loop(); ?>

	<?php
		global $wp_query;

	if ( $wp_query->found_posts ) {
		printf( '<div class="%s-loop-search">', esc_attr( $evolvethemes_key ) );
			printf( '<p>%s</p>', esc_html__( 'Didn\'t you find what you were looking for?', 'schism' ) );
		get_search_form();
		echo '</div>';
	} else {
		printf( '<div class="%s-loop-search_no-results">', esc_attr( $evolvethemes_key ) );
			printf( '<p>%s</p>', esc_html__( 'We could not find any results for your search. You can give it another try through the search form below.', 'schism' ) );
		get_search_form();
		echo '</div>';
	}
	?>

</div>
