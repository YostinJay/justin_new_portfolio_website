<?php
/**
 * Custom template tags for Admela
 *
 * @package WordPress
 * @subpackage Admela
 * @since Admela 1.0
 */



/*-----------------------------------------------------------------------------------*/
# Admela Previous/next post navigation.
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'admela_postnav' ) ) :

function admela_postnav() {

global $post;

$admela_prev_post = '';
$admela_nxt_post = '';

$admela_prev_post = get_previous_post();				 
$admela_next_post = get_next_post();


				 
	if(!empty($admela_prev_post) || !empty($admela_next_post) ):
	
	if(!empty($admela_prev_post) == ''):
	$admela_nextpost_class = 'admela_nxtpst_dsgn';
	else:
	$admela_nextpost_class = '';
	endif;
	
	?>

	<div class="admela_prenext <?php echo esc_attr($admela_nextpost_class); ?>"> <!--Single post prev/next-->
  
		<?php  
   
		the_post_navigation( array(
	
		'prev_text' => 
				'<div class="admela_snlgepdsg">'.esc_html__('Prev Post','admela').'</div>'.
				'<div class="admela_snlgenpntit"><h4>%title</h4></div>',
		'next_text' => 
				'<div class="admela_snlgepdsg">'.esc_html__('Next Post','admela').'</div>'.
				'<div class="admela_snlgenpntit"><h4>%title</h4></div>',					
		) );  
 
		?>
	
	</div>	<!-- .admela_prenext -->

<?php 				
	endif;
}

endif;

/*-----------------------------------------------------------------------------------*/
# Admela RelatedPost
/*-----------------------------------------------------------------------------------*/


if(! function_exists( 'admela_relatedpost' ) ):

function admela_relatedpost() {

if(is_single()) {
	
global $post;

$post_id = $post->ID;

$admela_relatedpost_type = get_theme_mod('admela_single_post_relatedpost_type_setting');

$admela_relatedpost_order = get_theme_mod('admela_single_post_relatedpost_order_setting');

if($admela_relatedpost_order == 'latest'):

$admela_relatedpostorder = 'date';

elseif($admela_relatedpost_order == 'random'):

$admela_relatedpostorder = 'rand';

else:

$admela_relatedpostorder = 'date';

endif;


$admela_relatedpostcount = '4';
	
	

if($admela_relatedpost_type == 'tag'){
	
		
	$admela_relatedpost_tags = wp_get_post_tags($post->ID);
	if ($admela_relatedpost_tags) {
	
	$admela_tag_ids = array();
	foreach($admela_relatedpost_tags as $admela_relatedpost_individual_tag) $admela_tag_ids[] = $admela_relatedpost_individual_tag->term_id;
	$admela_relatedpost_args=array(
	'tag__in' => $admela_tag_ids,
	'orderby'=> $admela_relatedpostorder,
	'post__not_in' => array($post->ID),
	'posts_per_page'=> $admela_relatedpostcount, // Number of related posts that will be displayed.
    'ignore_sticky_posts'=>1,	
	);
	$admela_relatedpost_tagquery = new wp_query( $admela_relatedpost_args );
	if( $admela_relatedpost_tagquery->have_posts() ) {				
	
	echo '<div class="admela_related_posts">
	<h5 class="admela_related_postsheading">'.esc_html__('You May Also Like','admela').'</h5><ul>';
	while( $admela_relatedpost_tagquery->have_posts() ) {
	$admela_relatedpost_tagquery->the_post(); 
	
	?>
<li>
  <?php			  
  
 
        if(has_post_thumbnail()){
			the_post_thumbnail( 'admela-related-post-featured-image' );
		}
			
	        ?>
  <div class="admela_post_entry_meta">
    <?php the_title( sprintf( '<h2 class="admela_entry_title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );?>
    
    <div class="admela_entry_category">
      
      <span class="admela_entry_date">
      <?php esc_html_e('On','admela'); ?>
      <?php the_time(get_option( 'date_format' )); ?>
      </span>
     
      <span class="admela_catgory">
      <?php esc_html_e('In','admela'); ?>
      <?php  the_category(' ,');?>
      </span>
     
    </div>
    
  </div>
</li>
<?php		
	}
	echo '</ul></div>';
	} }
	
	wp_reset_postdata(); 
}

if($admela_relatedpost_type == 'category') // related posts display by category
	{
	
	$admela_relatedpost_categories = get_the_category($post->ID);
	if ($admela_relatedpost_categories) {		
	
	$admela_relatedpost_category_ids = array();
	foreach($admela_relatedpost_categories as $admela_individual_category) $admela_admela_relatedpost_category_ids[] = $admela_individual_category->term_id;
	$admela_relatedpost_category_args = array(
	'category__in' => $admela_relatedpost_category_ids,
	'orderby'=> $admela_relatedpostorder,
	'post__not_in' => array($post->ID),
	'posts_per_page'=> $admela_relatedpostcount, // Number of related posts that will be displayed.
	'ignore_sticky_posts'=>1,	
	);
				
	$admela_relatedpost_category_query = new wp_query( $admela_relatedpost_category_args );
	
		
	if( $admela_relatedpost_category_query->have_posts() ) {
		
	 
	echo '<div class="admela_related_posts">
	<h5 class="admela_related_postsheading">'.esc_html__('You May Also Like','admela').'</h5><ul>';
	while( $admela_relatedpost_category_query->have_posts() ) {
	$admela_relatedpost_category_query->the_post(); 
	?>
<li>
  <?php			  
  
 
        if(has_post_thumbnail()){
			the_post_thumbnail( 'admela-related-post-featured-image' );
		}
			
	        ?>
  <div class="admela_post_entry_meta">
    <?php the_title( sprintf( '<h2 class="admela_entry_title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );?>
    
    <div class="admela_entry_category">
      
      <span class="admela_entry_date">
      <?php esc_html_e('On','admela'); ?>
      <?php the_time(get_option( 'date_format' )); ?>
      </span>
     
      <span class="admela_catgory">
      <?php esc_html_e('In','admela'); ?>
      <?php  the_category(' ,');?>
      </span>
     
    </div>
    
  </div>
</li>
<?php

	}
	echo '</ul></div>';
	} 
	}
	
	wp_reset_postdata();
	
	}

}
}

endif;

/*-----------------------------------------------------------------------------------*/
# Admela Pagination
/*-----------------------------------------------------------------------------------*/


if ( ! function_exists( 'admela_paging_nav' ) ) :
/**
 *
 * @global WP_Query   $wp_query   WordPress Query object.
 * @global WP_Rewrite $wp_rewrite WordPress Rewrite object.
 */
function admela_paging_nav() {

	
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$admela_paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$admela_pagenum_link = html_entity_decode( get_pagenum_link() );
	$admela_query_args   = array();
	$admela_url_parts    = explode( '?', $admela_pagenum_link );

	if ( isset( $admela_url_parts[1] ) ) {
		wp_parse_str( $admela_url_parts[1], $admela_query_args );
	}

	$admela_pagenum_link = remove_query_arg( array_keys( $admela_query_args ), $admela_pagenum_link );
	$admela_pagenum_link = trailingslashit( $admela_pagenum_link ) . '%_%';

	$admela_format  = $wp_rewrite->using_index_permalinks() && ! strpos( $admela_pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$admela_format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$admela_pagenav_links = paginate_links( array(
		'base'     => $admela_pagenum_link,
		'format'   => $admela_format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $admela_paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $admela_query_args ),
		'prev_text' => esc_html__( '&larr; Previous', 'admela' ),
		'next_text' => esc_html__( 'Next &rarr;', 'admela' ),
	) );

	if ( $admela_pagenav_links ) :

	?>
<div class="admela_pagination"> <?php echo wp_kses_post($admela_pagenav_links); ?> </div>
<!-- .admela_pagination -->
<?php
endif;

}
endif;

	
/*-----------------------------------------------------------------------------------*/
# Admela Post/Page Entry Meta
/*-----------------------------------------------------------------------------------*/


if ( ! function_exists( 'admela_entrymeta' ) ) :

function admela_entrymeta() {	

if(is_single()) {			
?>
<div class="admela_entrybyline admela_etrymeta">   
    <div class="admela_ebyleft">
		<?php
		echo get_avatar( get_the_author_meta( 'user_email' ), 51 );
		?>		
		<div class="admela_entrymeta">
		<span class="admela_bylinetext">
		<?php esc_html_e('By','admela'); ?> 
		<?php the_author_posts_link(); ?>
		</span>		
	    <span class="admela_bylinetext"><?php the_time(get_option( 'date_format')); ?> 
		<?php esc_html_e('At','admela'); ?>
		<?php the_time(get_option( 'time_format')); ?>	    
		</span>		
		</div>
	</div>  
   <?php if(get_theme_mod('admela_active_postsocialshare') != false) {	 
	$admela_onclickjs = 'javascript:window.open(this.href,"","menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=800,width=800");return false;';
	?>
    <div class="admela_ebyright">		
		<a href="<?php echo esc_url('//www.facebook.com/sharer.php?u=');?><?php the_permalink();?>&amp;t=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>" class="admela_eshfb" target="_blank" onclick="<?php echo esc_js($admela_onclickjs); ?>"> <i class="fab fa-facebook-f"></i><span class="admela_esfbtext"><?php esc_html_e('Share on Facebook','admela'); ?></span></a>
		<!--facebook-->		
		<a href="<?php echo esc_url('//twitter.com/share?text=');?><?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>&amp;url=<?php the_permalink(); ?>" target="_blank" onclick="<?php echo esc_js($admela_onclickjs); ?>" class="admela_eshtwt"> <i class="fab fa-twitter"></i><span class="admela_esfbtext"><?php esc_html_e('Share on Twitter','admela'); ?></span></a>
		<!--twitter-->			
	</div>
	<?php }	?>
</div>
<?php  
}
if(is_page()) {		
?>
<div class="admela_entrybyline admela_entrypgbyline">
  <div class="admela_entryauthor">
    <?php
		echo get_avatar( get_the_author_meta( 'user_email' ), 20 );
		?>
    <?php esc_html_e('By','admela'); ?>
    <?php the_author_posts_link(); ?>
  </div>
  <div class="admela_entryline"> / </div>  
  <div class="admela_entrydate">
    <?php esc_html_e('On','admela'); ?>
    <?php the_time(get_option( 'date_format')); ?>
  </div> 
</div>
<?php 
} 
}	 
endif;

if ( ! function_exists( 'admela_custom_header_setup' ) ) :

function admela_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'admela_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 400,
		'wp-head-callback'       => 'admela_header_style',
	) ) );
}

endif;

add_action( 'after_setup_theme', 'admela_custom_header_setup' );

if ( ! function_exists( 'admela_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see admela_custom_header_setup().
 */
function admela_header_style() {

	?>
		<style type="text/css">
			<?php
				//Check if user has defined any header image.
				if ( get_header_image() ) :
			?>
				.admela_siteheader {
					background-image:url(<?php echo esc_url(get_header_image()); ?>);
					background-repeat:no-repeat;
					background-position:50% 50%;
					background-size:cover;
				}
				
				.admela_siteheader .admela_header1 {background-color:transparent;}
				
			<?php endif; ?>	
		</style>
	<?php
}
endif; // admela_header_style

if ( ! function_exists( 'admela_postformat' ) ) :
/**
 * postformat displayed on the blog post
 *
 * @see admela_postformat().
 */
function admela_postformat() {
	
$admela_getpostfmt = get_post_format(); 
					
	switch ($admela_getpostfmt) {

		case 'aside':

			if ($admela_getpostfmt == 'aside'):

			 echo '<i class="fas fa-file-alt"></i>';

			endif;

			break;

			case 'chat':

			if ($admela_getpostfmt == 'chat'):

				echo '<i class="fas fa-comments"></i>';

			endif;

			break;

			case 'audio':

			if ($admela_getpostfmt == 'audio'):

				echo '<i class="fas fa-music"></i>';

			endif;

			break;

			case 'gallery':

				if ($admela_getpostfmt == 'gallery'):

					echo '<i class="fas fa-images"></i>';

				endif;

			break;

			case 'video':

				if ($admela_getpostfmt == 'video'):

					echo '<i class="fas fa-video"></i>';

				endif;

				break;

				case 'image':

					if ($admela_getpostfmt == 'image'):

						echo '<i class="fas fa-image"></i>';

					endif;

				break;

				case 'link':

					if ($admela_getpostfmt == 'link'):

						echo '<i class="fas fa-link"></i>';

					endif;

				break;

				case 'quote':

					if ($admela_getpostfmt == 'quote'):

						echo '<i class="fas fa-quote-left"></i>';

					endif;

				break;

				case 'status':

					if ($admela_getpostfmt == 'status'):

						echo '<i class="fas fa-comment-dots"></i>';

					endif;

				break;

                default:
					echo '<i class="fas fa-thumbtack"></i>';                  				
				}		
                    
}
endif; // admela_postformat.