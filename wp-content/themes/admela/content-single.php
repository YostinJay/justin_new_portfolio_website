<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Admela
 * @since Admela 1.0
 */



?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
	
	<header class="admela_entryheader">
	
		<div class="admela_entrybyline admela_entrybymeta">
			<?php the_category(','); ?>
		</div>	
		<?php
		
		the_title( '<h1 class="admela_entrytitle" itemprop="headline">', '</h1>' ); 
		
		admela_entrymeta(); // Admela-EntryMeta
		
		if(has_post_thumbnail()){
			the_post_thumbnail( 'admela-single-post-featured-image' );
		}
		
		?>
		
	 
	</header> <!-- .admela_entryheader -->

    <div id="admela_postinfobar">		  
		    <div id="admela_postredbar">		  
			</div>
			<div class="admela_headerinner">
				
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail('admela-single-post-topbar-image');
				}
				?>
				<span><?php esc_html_e('You are Reading..','admela'); ?></span>
				<?php  the_title( '<h4>', '</h4>' ); ?>
				    </div>
	</div>
	<div class="admela_entrycontent">
	    <?php
		
		/*
		* Include the Before Single Post Content Section Ad Template.			
		*/
			
		get_template_part('ad-parts/postpage-top-ad');
		
		 the_content();

	      wp_link_pages( array(
				'before'      => '<div class="admela_pagelinks"><span class="admela_pagelinkstitle">' . esc_html__( 'Pages:', 'admela' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="admela_screenreadertext">' . esc_html__( 'Page', 'admela' ) . ' </span><span class="admela_pglnlksaf">%</span>',
				'separator'   => '<span class="admela_screenreadertext">, </span>',
			) );
			
			
			if(has_tag()){
			?>
			<div class="admela_tag">
	
				<span class="admela_tagslinks">
					<?php the_tags('');?>
				</span>
					
		    </div>
			
			<?php
			}
			/*
			* Include the Before Single Post Content Section Bottom Ad Template.			
			*/

			get_template_part('ad-parts/postpage-bottom-ad');
			
		?>

	</div> <!-- .admela_entrycontent -->

	<footer class="admela_entryfooter admela_entrypgfooter">
		
		
		   <div class="admela_postsharecnt">
    
    <?php
					
				if(get_theme_mod('admela_single_post_socialshare_setting') != false) {	
			    $admela_onclickjs = 'javascript:window.open(this.href,"","menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=800,width=800");return false;';
				?>
				
				<div class="admela_singleshare">					
				  
					<ul class="admela_postsocial admela_socialsharecount">
						
						<li class="admela_share_fb"> 
							<a href="<?php echo esc_url('//www.facebook.com/sharer.php?u=');?><?php the_permalink();?>&amp;t=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>"  target="_blank" onclick="<?php echo esc_js($admela_onclickjs); ?>"> <i class="fab fa-facebook-f"></i><span class="admela_sharetext"><?php esc_html_e('Facebook','admela'); ?></span></a>
						</li>
						<!--facebook-->
						
						<li class="admela_share_tweet">
							<a href="<?php echo esc_url('//twitter.com/share?text=');?><?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>&amp;url=<?php the_permalink(); ?>" target="_blank" onclick="<?php echo esc_js($admela_onclickjs); ?>"> <i class="fab fa-twitter"></i><span class="admela_sharetext"><?php esc_html_e('Twitter','admela'); ?></span></a>
						</li>
						<!--twitter-->							
						<li class="admela_share_plus"> <a href="<?php echo esc_url('//plus.google.com/share?url=');?><?php the_permalink(); ?>" target="_blank" title="<?php esc_html_e('Click to share','admela'); ?>"  onclick="<?php echo esc_js($admela_onclickjs); ?>"> <i class="fab fa-google-plus-g"></i><span class="admela_sharetext"><?php esc_html_e('Google+','admela'); ?></span>
						</a> 
						</li>
						<!--gplus-->	
						<li class="admela_share_linkedin"> <a target="_blank" href="<?php echo esc_url('//www.linkedin.com/shareArticle?mini=true&amp;url=');?><?php the_permalink(); ?>" onclick="<?php echo esc_js($admela_onclickjs); ?>"> <i class="fab fa-linkedin-in"></i><span class="admela_sharetext"><?php esc_html_e('Linkedin','admela'); ?></span></a> 
						</li>
						<!--linkedin--> 
						<?php			
						$admela_pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
						$admela_pinImage = $admela_pinterestimage[0];
						?>
						<li class="admela_share_pintrest"> <a target="_blank" href="<?php echo esc_url('//pinterest.com/pin/create/bookmarklet/?url=');?><?php echo urlencode(get_permalink( $post->ID )).'&amp;media='. esc_url($admela_pinImage).'&amp;description='. htmlspecialchars(urlencode(html_entity_decode(get_the_title( $post->ID ), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');?>"  onclick="<?php echo esc_js($admela_onclickjs); ?>"> <i class="fab fa-pinterest"></i><span class="admela_sharetext"><?php esc_html_e('Pinterest','admela'); ?></span></a>
						
						</li>
						 <!--pinterest-->
						  
						
                        <li class="admela_share_buffer">      
							<a target="_blank" href="<?php echo esc_url('//bufferapp.com/add?url=');?><?php the_permalink(); ?>&amp;text=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>&amp;utm_source=<?php the_permalink(); ?>&amp;utm_medium=<?php the_permalink(); ?>&amp;utm_campaign=buffer&amp;source=button"  onclick="<?php echo esc_js($admela_onclickjs); ?>">
							<i class="fa-stack-exchange fab"></i>
							<span class="admela_sharetext"><?php esc_html_e('Buffer','admela'); ?></span>
							</a>
						</li>

						<li class="admela_share_pocket">       
							<a target="_blank" href="<?php echo esc_url('//getpocket.com/save?title=');?><?php 						the_title(); ?>&amp;url=<?php the_permalink(); ?>" onclick="<?php echo esc_js($admela_onclickjs); ?>">
							<i class="fas fa-angle-down" aria-hidden="true"></i>
							<span class="admela_sharetext"><?php esc_html_e('Pocket','admela'); ?></span>
							</a>     
						</li>
						
     <li class="admela_share_stumble"> 
	 <a target="_blank" href="<?php echo esc_url('//www.stumbleupon.com/submit?url=');?><?php the_permalink(); ?>" onclick="<?php echo esc_js($admela_onclickjs); ?>"> <i class="fab fa-stumbleupon"></i><span class="admela_sharetext"><?php esc_html_e('stumbleupon','admela'); ?></span></a> </li>
         
		 <li class="admela_share_reddit"> <a target="_blank" href="<?php echo esc_url('//www.reddit.com/submit?url=');?>			 <?php the_permalink(); ?>&amp;title=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>" onclick="<?php echo esc_js($admela_onclickjs); ?>"> <i class="fa-reddit fab"></i><span class="admela_sharetext"><?php esc_html_e('Reddit','admela'); ?></span></a> </li>
        <?php
			
			 if(wp_is_mobile()){ ?>            
                        
                        <div class="admela_whatsup"> <a href="<?php echo esc_url('whatsapp://send?text=');?><?php echo the_title();?> <?php the_permalink(); ?>" data-action="<?php echo esc_attr('share/whatsapp/share'); ?>" onclick="<?php echo esc_js($admela_onclickjs); ?>"><i class="icon fab fa-whatsapp"></i><span class="admela_sharetext"><?php esc_html_e('Whatsapp','admela'); ?></span></a></div>
						<?php } ?>  
						</ul>					
				

				</div>

				<!--End of the Single post social share section--> 
				  <?php } ?>

    </div>
	
	</footer> <!-- .admela_entryfooter -->
		
		<?php
		
        /*
		 *  Include the author bio template		
		 */
		
		get_template_part( 'author','bio' );
	
	    
       
		?>
        <div class="admela_reltdwthad">
			<?php	                
				admela_relatedpost(); // Related post 					
			?>
		</div>
		<?php
	         
				admela_postnav(); // single post nav
				
			
			?>
		
	
</article><!-- #post-## -->
