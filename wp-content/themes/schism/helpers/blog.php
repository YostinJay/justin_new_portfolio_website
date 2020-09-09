<?php
/**
 * The page content helpers.
 *
 * @package theme\helpers
 */

/**
 * Load the main sidebar if is active.
 *
 * @return void
 */
function schism_main_sidebar() {
	if ( is_active_sidebar( 'main-sidebar' ) && is_singular( 'post' ) ) {
		$evolvethemes_key = evolvethemes_theme_key();

		printf( '<div class="%1$s-main-sidebar %1$s-spacing">', esc_attr( $evolvethemes_key ) );
			get_sidebar( 'main-sidebar' );
		echo '</div>';
	}
}

add_action( 'schism_content_end', 'schism_main_sidebar', 20 );

/**
 * Add extra classes to body.
 *
 * @param array $class The body classes.
 * @return array
 */
function schism_is_active_sidebar_class( $class ) {
	$evolvethemes_key = evolvethemes_theme_key();

	if ( is_active_sidebar( 'main-sidebar' ) && is_singular( 'post' ) ) {
		$class[] = esc_attr( $evolvethemes_key ) . '-sidebar_active';
	}

	return $class;
}

add_filter( 'body_class', 'schism_is_active_sidebar_class' );

/**
 * Filter the entry title class.
 *
 * @param array $classes The entry title classes.
 * @return array
 */
function schism_entry_title_classes( $classes ) {
	$classes = array( 'schism-entry__title' );

	return $classes;
}

add_filter( 'evolvethemes_entry_title_classes', 'schism_entry_title_classes' );

/**
 * Display the comments count for the current entry.
 *
 * @since 1.0.0
 */
function schism_comments_count() {
	global $post;

	$comments_number = get_comments_number( $post->ID );

	if ( $comments_number > 0 ) {
		$comment = get_comments_number_text();

		$comment_markup = '<p class="schism-entry__comment schism-sticky_bottom">';
		$comment_markup .= '<svg height="12" viewBox="0 0 12 12" width="12" xmlns="http://www.w3.org/2000/svg"><path d="m10.2014052 0h-8.40281035c-.50585732 0-.93208257.1711737-1.27868853.5135265-.34660595.34235279-.51990632.7714603-.51990632 1.28733512v9.59521488c0 .121934.03044465.2368315.09133489.3446963.06089025.1078645.15222417.1758651.27400469.2040037.02810322.0281387.06791548.0445526.11943785.0492424.05152255.0046897.0913348.0070346.11943803.0070346.09367729 0 .17095985-.0140691.2318502-.0422077.06089017-.0281386.12412139-.0750356.18969546-.1406923l2.22014142-2.22293949h6.95550266c.5058566 0 .9320822-.1711737 1.2786876-.5135265.3466072-.3423528.5199072-.7714603.5199072-1.28733512v-5.99349077c0-.51587482-.1733-.94498233-.5199072-1.28733512-.3466054-.3423528-.772831-.5135265-1.2786876-.5135265zm.5901639 7.79435239c0 .18759215-.0538643.33531683-.161593.44318124-.1077286.1078644-.2505838.16179661-.4285709.16179661h-7.19437944c-.09367801 0-.17330181.01406833-.23887678.04220859-.06557317.02813847-.1264628.0750347-.18266889.14069052l-1.37704918 1.37878647v-8.1601542c0-.18759216.0538636-.33531683.1615926-.44318124.10772882-.10786441.25058455-.16179661.42857134-.16179661h8.40281035c.1779871 0 .3208423.0539322.4285709.16179661.1077287.10786441.161593.25558908.161593.44318124z" fill-rule="evenodd"/></svg> ';
		$comment_markup .= sprintf( '<a href="%s#post-comments">%s</a></p>', esc_attr( get_permalink( $post->ID ) ), esc_html( $comment ) );

		echo wp_kses_post( $comment_markup );
	}
}

/**
 * Display an icon for each post format.
 *
 * @return void
 */
function schism_format_icon() {

}

add_action( 'schism_entry_header_start', 'schism_comments_count' );

/**
 * Display the content of the entry meta column.
 *
 * @return void
 */
function schism_entry_meta() {
	$evolvethemes_key = evolvethemes_theme_key();

	printf( '<div class="%s-sticky_top">', esc_attr( $evolvethemes_key ) );

	if ( evolvethemes_get_post_categories() ) {
		printf( '<div class="%s-meta__categories">', esc_attr( $evolvethemes_key ) );
			printf( '<p class="%s-heading_small">%s</p>', esc_attr( $evolvethemes_key ), esc_html__( 'in:', 'schism' ) );
			evolvethemes_post_categories();
		echo '</div>';
	}

	if ( has_post_format( 'gallery' ) ) {
		printf( '<div class="%s-entry__format">%s</div>', esc_attr( $evolvethemes_key ), wp_kses_post( '<svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m0 0h24v24h-24z" fill="transparent"/><g fill="#000"><path d="m20 2h-12c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-12c0-1.103-.897-2-2-2zm-12 14v-12h12l.002 12z"/><path d="m4 8h-2v12c0 1.103.897 2 2 2h12v-2h-12z"/><path d="m12 12-1-1-2 3h10l-4-6z"/></g></svg>' ) );
	} else if ( has_post_format( 'image' ) ) {
		printf( '<div class="%s-entry__format">%s</div>', esc_attr( $evolvethemes_key ), wp_kses_post( '<svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m0 0h24v24h-24z" fill="transparent"/><g fill="#000"><path d="m7.49902 11c.82843 0 1.5-.6716 1.5-1.5 0-.82843-.67157-1.5-1.5-1.5-.82842 0-1.5.67157-1.5 1.5 0 .8284.67158 1.5 1.5 1.5z"/><path d="m10.499 14-1.49998-2-3 4h11.99998l-4.5-6z"/><path d="m19.999 4h-15.99998c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h15.99998c1.103 0 2-.897 2-2v-12c0-1.103-.897-2-2-2zm-15.99998 14v-12h15.99998l.002 12z"/></g></svg>' ) );
	} else if ( has_post_format( 'video' ) ) {
		printf( '<div class="%s-entry__format">%s</div>', esc_attr( $evolvethemes_key ), wp_kses_post( '<svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m0 0h24v24h-24z" fill="transparent"/><path d="m18 7c0-1.103-.897-2-2-2h-12c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-3.333l4 3.333v-10l-4 3.333zm-1.998 10h-12.002v-10h12l.001 4.999-.001.001.001.001z" fill="#000"/></svg>' ) );
	} else if ( has_post_format( 'quote' ) ) {
		printf( '<div class="%s-entry__format">%s</div>', esc_attr( $evolvethemes_key ), wp_kses_post( '<svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m0 0h24v24h-24z" fill="transparent"/><path d="m3.69094 6.292c1.403-1.521 3.526-2.292 6.309-2.292h.99996v2.819l-.804.161c-1.36996.274-2.32296.813-2.83296 1.604-.26611.42613-.41703.91404-.438 1.416h3.075c.26526 0 .51956.1054.70706.2929.1876.1875.2929.4419.2929.7071v7c0 1.103-.897 2-1.99996 2h-6c-.26522 0-.51957-.1054-.70711-.2929-.18753-.1875-.29289-.4419-.29289-.7071v-5l.003-2.919c-.009-.111-.199-2.741 1.688-4.789zm16.30896 13.708h-6c-.2652 0-.5195-.1054-.7071-.2929-.1875-.1875-.2929-.4419-.2929-.7071v-5l.003-2.919c-.009-.111-.199-2.741 1.688-4.789 1.403-1.521 3.526-2.292 6.309-2.292h1v2.819l-.804.161c-1.37.274-2.323.813-2.833 1.604-.2661.42613-.417.91404-.438 1.416h3.075c.2653 0 .5196.1054.7071.2929.1876.1875.2929.4419.2929.7071v7c0 1.103-.897 2-2 2z" fill="#000"/></svg>' ) );
	} else if ( has_post_format( 'link' ) ) {
		printf( '<div class="%s-entry__format">%s</div>', esc_attr( $evolvethemes_key ), wp_kses_post( '<svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m0 0h24v24h-24z" fill="transparent"/><g fill="#000"><path d="m8.46502 11.293c1.133-1.133 3.10898-1.133 4.24198 0l.707.707 1.414-1.414-.707-.707c-.943-.944-2.199-1.465-3.535-1.465-1.33598 0-2.59198.521-3.53498 1.465l-2.122 2.121c-.9357.9387-1.46112 2.2101-1.46112 3.5355s.52542 2.5968 1.46112 3.5355c.46388.4645 1.01497.8328 1.62162 1.0837s1.2569.3795 1.91338.3783c.65666.0014 1.30712-.1271 1.91398-.378.6068-.2509 1.1581-.6193 1.622-1.084l.707-.707-1.414-1.414-.707.707c-.5635.561-1.32631.876-2.12148.876s-1.55797-.315-2.1215-.876c-.56149-.5633-.87679-1.3262-.87679-2.1215s.3153-1.5582.87679-2.1215z"/><path d="m12 4.92899-.707.707 1.414 1.414.707-.707c.5635-.56101 1.3263-.87597 2.1215-.87597s1.558.31496 2.1215.87597c.5615.56327.8768 1.32617.8768 2.1215 0 .79534-.3153 1.55821-.8768 2.12151l-2.122 2.121c-1.133 1.133-3.109 1.133-4.242 0l-.707-.707-1.414 1.414.707.707c.943.944 2.199 1.465 3.535 1.465s2.592-.521 3.535-1.465l2.122-2.121c.9357-.9387 1.4611-2.21009 1.4611-3.53551 0-1.32541-.5254-2.59678-1.4611-3.5355-.9385-.93619-2.2099-1.46195-3.5355-1.46195s-2.597.52576-3.5355 1.46195z"/></g></svg>' ) );
	} else if ( has_post_format( 'chat' ) ) {
		printf( '<div class="%s-entry__format">%s</div>', esc_attr( $evolvethemes_key ), wp_kses_post( '<svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m0 0h24v24h-24z" fill="transparent"/><g fill="#000"><path d="m5 18v3.766l1.515-.909 4.762-2.857h4.723c1.103 0 2-.897 2-2v-8c0-1.103-.897-2-2-2h-12c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2zm-1-10h12v8h-5.277l-3.723 2.234v-2.234h-3z"/><path d="m20 2h-12c-1.103 0-2 .897-2 2h12c1.103 0 2 .897 2 2v8c1.103 0 2-.897 2-2v-8c0-1.103-.897-2-2-2z"/></g></svg>' ) );
	}

	echo '</div>';
}

add_action( 'schism_entry_meta', 'schism_entry_meta' );
