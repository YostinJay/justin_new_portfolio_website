<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Admela
 * @since Admela 1.0
 */
 

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
		<div class="admela_postfa admela_postormat">	
			<?php
					
			/*
			* Include the Post-Format-specific for the content.			
			*/		
			admela_postformat();
					
            ?>
		</div>
					
		<?php
			if ( is_sticky() && is_home() ){
		?>
		<div class="admela_sticky">						
			<?php esc_html_e( 'Featured', 'admela' ); ?>
		</div>
		<?php
		}						
		?>
	</div><!-- .admela_entryheader -->
				
	<div class="admela_entrycontent">
		<?php  the_title('<h2 itemprop="headline"><a href="'.esc_url(get_permalink()).'">','</a></h2>'); ?>
			<div class="admela_entrymeta">						
				<span><?php esc_html_e('By','admela'); ?> <?php  the_author_posts_link(); ?></span> 
				<span><?php esc_html_e('On','admela'); ?> <?php the_time(get_option( 'date_format')); ?></span>
			</div>		    		
		<?php 
		    $admela_contentlimit = get_the_excerpt(); 	
            if($admela_contentlimit != ''){
		?>
		<p>
        <?php			
				
			echo esc_html(wp_trim_words($admela_contentlimit,30,'.'));
							
			wp_link_pages( array(
				'before'=> '<div class="admela_pagelinks"><span class="admela_pagelinkstitle">' . esc_html__( 'Pages:', 'admela' ) . '</span>',
				'after'=> '</div>',
				'link_before' => '<span>',
				'link_after' => '</span>',
				'pagelink'  => '<span class="admela_screenreadertext">' . esc_html__( 'Page', 'admela' ) . ' </span><span class="admela_pglnlksaf">%</span>',
				'separator'  => '<span class="admela_screenreadertext">, </span>',
			) );
		?>
		</p>				
	    <a href="<?php the_permalink(); ?>" class="admela_readmore"><?php esc_html_e('Keep Reading','admela'); ?> &rarr;</a>
		<?php
		}       
		?>	
	</div><!-- .admela_entrycontent -->
</article>