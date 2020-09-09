<?php
/**
 * The template for displaying admela bloglayout content
 *
 * @package WordPress
 * @subpackage admela
 * @since Admela 1.0
 */
  

get_header(); 


echo '<main id="admela_maincontent" class="admela_maincontent">';
 		
	        
		/*
		* Include the Slider And Featured Content Template.			
		*/

		get_template_part('slider-parts/sliderandfeatured','content');	
		
 
?>

<div class="admela_contentarea">
<div class="admela_contentlist">
     
    <?php
	
		/** Include the home page category post content **/			   
		get_template_part('layout-parts/layout-categorycontent'); 
				
	?>
	
	<div class="admela_contentlistmain admela_contentlistlatestmain">
		<div class="admela_contentlisttitle">
			<?php
			if(get_theme_mod('admela_latest_post_title_setting') != ''){			  
			   $admela_latest_title = get_theme_mod('admela_latest_post_title_setting');			
			}
			else {
				 $admela_latest_title = 'Latest Stories...!';
			}
			if(get_theme_mod('admela_latest_post_subtitle_setting') != ''){			  
			     $admela_latest_sub_title = get_theme_mod('admela_latest_post_subtitle_setting');			
			}
			else {
				 $admela_latest_sub_title = 'Latest stories from recent published posts';
			}
			?>
		  <h4><?php echo esc_html($admela_latest_title); ?></h4>
		  <p><?php echo esc_html($admela_latest_sub_title); ?></p>
		</div>
		<div class="admela_contentlistinner">
	      
		<?php
						
        if ( have_posts() ) : 
		   
		
			//Start the loop.
			while ( have_posts() ) : the_post();
				// gets the post content part.
				get_template_part('layout-parts/content'); 		
			// End the loop.
			endwhile;			

			// If no content, include the "No posts found" template.
			else :
		
			esc_html_e('Sorry No Posts Were Found','admela');		

			endif;
										
			admela_paging_nav(); // admela-pagination
						
			/*
			* Include the After Latest Post Section Ad Template.			
			*/			
			get_template_part('ad-parts/home-after-latestpost-ad');
			
			?>
  </div>
  </div>
    <!-- .content-area-inner -->

 
  </div>


<div class="admela_primarycontentarea">

    <?php		

		get_sidebar('right'); // Theme Right Sidebar

	?>
	
</div> <!-- .admela_primarycontentarea -->

</div> <!-- .admela_contentarea -->

<?php 

echo '</main>';  //#admela_maincontent

get_footer(); 