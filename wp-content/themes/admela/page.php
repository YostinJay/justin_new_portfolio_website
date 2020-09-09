<?php
/**
 * The Template for displaying all page content
 *
 * @package WordPress
 * @subpackage Admela
 * @since Admela 1.0
 */
 

get_header();

echo '<main id="admela_maincontent" class="admela_maincontent">';
 
?>
<div class="admela_contentarea">
<div class="admela_contentlist">
	<?php
	if ( have_posts() ) : 
		
			//Start the loop.
			while ( have_posts() ) : the_post();
	

  			/*
				 *  Include the page post content template.			
				 */
				get_template_part( 'content', 'page' );	

				//	End the loop.
				
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
				 if(get_theme_mod('admela_commentspost') != true) {
					comments_template();
				  }
				}
		
			endwhile;			

		// If no content, include the "No posts found" template.
		else :
			
		?>
		<p class="admela_nocntpost">
			<?php esc_html_e('Sorry No Posts were Found..!','admela');  ?>
		</p>
		<?php	

		endif;
		
		?>
	
    </div> <!-- .admela_contentlist -->

<div class="admela_primarycontentarea">
        <?php
		
			get_sidebar('right'); // Theme Right Sidebar
		
		?>
</div> <!-- .admela_primarycontentarea -->

</div> <!-- .admela_contentarea -->
<?php  

echo '</main>';  //#admela_maincontent

get_footer(); 

