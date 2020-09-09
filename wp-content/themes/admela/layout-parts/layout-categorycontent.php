<?php
/**
 * The template part for displaying home page category content
 *
 * @package WordPress
 * @subpackage Admela
 * @since Admela 1.0
 */
	
	if(!is_paged()){ // Displaying category content only on home page not to nagavigated page.
	
	$admela_home_catname = get_theme_mod('admela_home_category_post_setting');
	$admela_home_cat_postorderby = get_theme_mod('admela_home_category_post_order_setting');
    $admela_home_cat_subtitle = get_theme_mod('admela_home_category_post_subtitle_setting');
    
	if($admela_home_cat_postorderby == '1'):
		$admela_post_orderby = 'rand';
	else:
		$admela_post_orderby = 'date';
	endif;
		
	
	if($admela_home_catname != ''){

	$admela_home_cat_displayname = get_cat_name($admela_home_catname);
	
	?>
    
    <div class="admela_contentlistmain admela_contentcatmain1">
		<div class="admela_contentlisttitle">
		  <h4><?php echo esc_html($admela_home_cat_displayname); ?></h4>
		  <p><?php echo esc_html(get_theme_mod('admela_home_category_post_subtitle_setting')); ?></p>
		</div>
		<div class="admela_contentlistinner">
		   
		    <?php
		   
			$admela_catpostcount = 6;
			
			$admela_home_catargs = array(
			'post_type' => 'post',	
			'cat' => $admela_home_catname,
			'orderby'=> $admela_post_orderby,
			'posts_per_page'=>$admela_catpostcount,
			'ignore_sticky_posts' => 1, 
			);
			
			$admela_home_cat_query = new WP_Query($admela_home_catargs);
			
			global $post;
			
			if ( $admela_home_cat_query->have_posts() ) : while ( $admela_home_cat_query->have_posts() ) : $admela_home_cat_query->the_post(); /* Start Posts */
			
			if(has_post_thumbnail()) {
				$admela_slider_no_img = '';
			}
			else {
				$admela_slider_no_img = 'admela_sliderwotimg';
			}	
				
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('admela_entry'); ?>>					
				
				<div class="admela_entryheader <?php echo esc_attr($admela_slider_no_img); ?>">
					 <?php				
					if ( has_post_thumbnail() ) {
						$admela_post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'admela-post-featured-image' );
					?>
					<a href="<?php the_permalink(); ?>">
						<img src="<?php echo esc_url($admela_post_thumbnail[0]); ?>" alt="<?php esc_html_e('featuredimage','admela'); ?>"/>
					</a>
					<?php
					}	
					?>
					<div class="admela_postfa">	
					<?php
					
					/*
					 * Include the Post-Format-specific for the content.			
					*/		
					admela_postformat();
					
                    ?>
					</div>
					
				</div> <!-- .admela_entryheader -->
				
				<div class="admela_entrycontent">
					<?php  the_title('<h2 itemprop="headline"><a href="'.esc_url(get_permalink()).'">','</a></h2>'); ?>
				    <div class="admela_entrymeta">						
						<span><?php esc_html_e('By','admela'); ?> <?php  the_author_posts_link(); ?></span> 
						<span><?php esc_html_e('On','admela'); ?> <?php the_time(get_option( 'date_format')); ?></span>						
					</div>					
				</div> <!-- .admela_entrycontent -->
				
			</article>	
			<?php
			
			endwhile; /** end of one post **/ else : /** if no posts exist **/ endif; /** end loop **/
			wp_reset_postdata();
			?>
        </div>
		<div class="admela_entrycontentad">
			<?php 
			
			   /** Include the after category post section ad **/
			   
				get_template_part('ad-parts/home-after-catsection-ad'); 
				
			?> 
		</div>
    </div> <!-- .admela_contentlistmain -->
	
	<?php 
	}	
	} 
	?>