<?php
/**
 * The page header helpers.
 *
 * @package theme\helpers
 */

/**
 * Display a page title.
 *
 * @since 1.0.0
 */
function schism_page_title() {
	$title            = '';
	$data_attrs       = array();
	$classes          = array();
	$evolvethemes_key = evolvethemes_theme_key();

	if ( is_search() ) {
		$title = sprintf( '&#8220;%s&#8221;', get_search_query() );
	} elseif ( is_archive() ) {
		$title = get_the_archive_title();
	} elseif ( is_404() ) {
		$title = __( 'Page not found', 'schism' );
	} else {
		$title = get_the_title();
	}

	$title = evolvethemes_apply_filters( 'page_title', $title );

	if ( ! $title ) {
		return;
	}

	$classes[] = $evolvethemes_key . '-ph__title';

	if ( is_front_page() ) {
		$title_markup = 'h2';
	} else {
		$title_markup = 'h1';
	}

	printf( '<%s class="%s" %s>', esc_html( $title_markup ), esc_attr( implode( ' ', $classes ) ), esc_attr( implode( ' ', $data_attrs ) ) );
		echo wp_kses_post( $title );
	printf( '</%s>', esc_html( $title_markup ) );
}

/**
 * Remove the prefix from the archive title.
 *
 * @since 1.0.0
 * @param  string $title The title.
 * @return string
 */
function schism_change_the_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_year() ) {
		$title = get_the_date( _x( 'Y', 'yearly archives date format', 'schism' ) );
	} elseif ( is_month() ) {
		$title = get_the_date( _x( 'F Y', 'monthly archives date format', 'schism' ) );
	} elseif ( is_day() ) {
		$title = get_the_date( _x( 'F j, Y', 'daily archives date format', 'schism' ) );
	}

	return $title;
}

add_filter( 'get_the_archive_title', 'schism_change_the_archive_title' );


/**
 * Before page title output.
 *
 * @since 1.0.0
 */
function schism_before_page_title() {
	$classes = array();
	$before_title = '';
	$allowed_html = array(
		'time' => array(
			'class' => array(),
		),
		'span' => array(),
		'a' => array(
			'href' => true,
			'rel' => true,
			'rev' => true,
			'name' => true,
			'target' => true,
		),
		'b' => array(),
		'strong' => array(),
		'sub' => array(),
		'sup' => array(),
	);

	$classes[] = 'schism-ph__before-title';

	if ( is_search() ) {
		$before_title = __( 'Search results for:', 'schism' );
	} else if ( is_author() ) {
		$before_title = __( 'Author archive:', 'schism' );
	} else if ( is_archive() ) {
		$before_title = __( 'Archive:', 'schism' );
	} else if ( is_404() ) {
		$before_title = __( 'Error 404', 'schism' );
	}

	if ( post_password_required() ) {
		$before_title = __( 'Protected', 'schism' );
	}

	$before_title = apply_filters( 'schism_before_page_title', $before_title );

	if ( $before_title ) {
		printf( '<p class="%s">%s</p>', esc_attr( implode( ' ', $classes ) ), wp_kses( $before_title, $allowed_html ) );
	}
}

/**
 * Return the post author element for the current post in a loop.
 *
 * @since 1.0.0
 * @param boolean $link Set to true to display the author link.
 * @return string
 */
function schism_get_entry_author( $link = false ) {
	global $post;

	$post_author = '';

	if ( $post ) {
		$author_id = $post->post_author;

		if ( ! $author_id ) {
			return '';
		}

		if ( true !== $link ) {
			$post_author = '<span class="author vcard"><span>%1$s</span></span>';

			$post_author = sprintf(
				$post_author,
				esc_html( get_the_author_meta( 'display_name', $author_id ) )
			);
		} else {
			$post_author = '<span class="author vcard"><a class="url fn" href="%1$s"><span>%2$s</span></a></span>';

			$post_author = sprintf(
				$post_author,
				esc_url( get_author_posts_url( $author_id ) ),
				esc_html( get_the_author_meta( 'display_name', $author_id ) )
			);
		}
	}

	return $post_author;
}

/**
 * Display the post author element for the current post in a loop.
 *
 * @since 1.0.0
 * @param boolean $link Set to true to display the author link.
 */
function schism_entry_author( $link = false ) {
	echo schism_get_entry_author( $link ); // @codingStandardsIgnoreLine
}

/**
 * Disable the page header in the blog index.
 *
 * @since 1.0.0
 */
function schism_disable_page_header() {
	if ( is_home() ) {
		remove_action( 'evolvethemes_page_content', 'evolvethemes_page_header', 5 );
	}
}

add_action( 'wp_head', 'schism_disable_page_header' );


/**
 * Add extra information to the page title container.
 *
 * @since 1.0.0
 * @return mixed
 */
function schism_page_title_extra() {
	if ( ! is_singular( 'post' ) ) {
		return;
	}

	$evolvethemes_key = evolvethemes_theme_key();

	printf( '<div class="%1$s-ph__author %1$s-sticky_bottom">', esc_attr( $evolvethemes_key ) );
		global $post;

	if ( $post->post_author ) {
		echo get_avatar( $post->post_author, 36 );
	}
		echo '<div>';
			printf( '<p>%s</p>', esc_html__( 'Written by', 'schism' ) );
			schism_entry_author( true );
		echo '</div>';
	echo '</div>';
}

add_action( 'schism_after_page_title', 'schism_page_title_extra' );

/**
 * Display the featured image.
 *
 * @since 1.0.0
 * @return mixed
 */
function schism_featured_image() {
	if ( post_password_required() ) {
		return;
	}

	if ( get_post_thumbnail_id() ) {
		$evolvethemes_key = evolvethemes_theme_key();

		printf( '<div class="%s-featured-image">', esc_attr( $evolvethemes_key ) );
			echo wp_get_attachment_image(
				get_post_thumbnail_id(),
				'large'
			);
		echo '</div>';
	}
}

add_action( 'schism_featured_image', 'schism_featured_image' );

/**
 * Filter the password protected post title.
 *
 * @since 1.0.0
 * @param string  $prepend Text displayed before the post title.
 * @param WP_Post $post Current post object.
 * @return string
 */
function schism_protected_title_format( $prepend, $post ) {
	return '%s';
}

add_filter( 'protected_title_format', 'schism_protected_title_format', 10, 2 );
