<?php

/**
 * Theme slider content section.
 *
 * @package WordPress
 * @subpackage Admela
 * @since Admela 1.0
 */
 
 ?>

<!-- #Admela-SliderSection  -## -->

<?php 
if(!is_paged()){ // Displaying slider section only on home page not to navigated page.

if(get_theme_mod('admela_slider_category_setting') != false):  ?>

<div class="admela_sliderinner" id="admela_owldemo1">

  <?php

    // gets the slider customizer option in custom variable
  
	$admela_slider_catname = get_theme_mod('admela_slider_category_setting');		
	$admela_slider_postperpage = get_theme_mod('admela_slider_post_perpage_setting');		
	$admela_slider_postorder = get_theme_mod('admela_slider_post_order_setting');


if($admela_slider_postorder == 'random'):

$admela_slider_orderby = 'rand';

else:

$admela_slider_orderby = 'date';

endif;

// gets the slider query arguments

$admela_slider_args = array( 
'cat' => $admela_slider_catname,
'orderby'=>$admela_slider_orderby,
'posts_per_page'=>$admela_slider_postperpage,
'ignore_sticky_posts' => 1 
);


if((!empty($admela_slider_catname) != '')){
	
	// gets the slider query  
	
    $admela_slider_query = new WP_Query( $admela_slider_args );
	
	while ( $admela_slider_query->have_posts() ) : $admela_slider_query->the_post();
		
	
	if(has_post_thumbnail()) {
		$admela_slider_no_img = 'admela_sliderwithimg';
	}
	else {
		$admela_slider_no_img = 'admela_sliderwotimg';
	}		
	?>
		
	<div class="admela_slideritem <?php echo esc_attr($admela_slider_no_img); ?>">
	   
	   <?php 
	    if ( has_post_thumbnail() ) {
			$admela_slider_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'admela-slider-featured-image' );
	    ?>
		<a href="<?php the_permalink(); ?>">
			<img src="<?php echo esc_url($admela_slider_thumbnail[0]); ?>" alt="<?php esc_html_e('sliderimage','admela'); ?>"/>
		</a>
		<?php
		}
		?>
		
	   <div class="admela_sliderheader">
	   
	     <h2>
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
	     </h2>
		 <?php if(get_theme_mod('admela_ebylfp') != TRUE){ ?>
	     <div class="admela_sliderbyline">
		  <?php if(get_theme_mod('admela_ppostedby') != TRUE){ ?>
		  <span><?php esc_html_e('By','admela'); ?>
		  <?php  the_author_posts_link(); ?>		  
		  <?php } ?> 
		  </span>
		  <?php
		  if(get_theme_mod('admela_ppostedon') != TRUE) { ?>
		  <span><?php esc_html_e('On','admela'); ?> <?php the_time(get_option( 'date_format')); ?></span>
		  <?php } ?>		 
		 </div>
		 <?php } ?>
		 
	   </div> <!-- .admela_sliderheader -->
	   
	</div>	<!-- .admela_slideritem -->
	
  <?php 
   endwhile; 
   wp_reset_postdata();
   }
   ?>
</div> <!-- #admela_owldemo1 -->
<?php 
endif; 
}
?>