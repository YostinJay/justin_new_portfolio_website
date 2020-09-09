<?php
/**
 * The template for the footer Content 
 *
 * @package WordPress
 * @subpackage Admela
 * @since Admela 1.0
 */

 ?>
    <div class="admela_sitefooterinner"> 
  
		<div class="admela_footermiddle">
		
			<div class="admela_sitefooterlogo">
			<?php if ( has_custom_logo() ) { ?> 
			<?php the_custom_logo(); ?>
			<p class="admela_description">     
			<?php 
				bloginfo( 'description' ); 
			?>
			</p>
			<?php			
			}				   		
			else { 	
			?>
			<div class="admela_sitetitle admela_restitle"> 
				<a href="<?php echo esc_url(home_url('/'));  ?>" title="<?php bloginfo( 'name' ); ?>">
					<?php bloginfo( 'name' ); ?>
				</a>
				<p class="admela_description">
				  <?php bloginfo( 'description' );  ?>
				</p>
			</div>
			<?php }	?>
			</div>  
			<?php if(get_theme_mod('admela_footer_aboutus_text_setting') != ''){  ?>
			<div class="admela_sitefooterabtus">
 				<p> <?php echo esc_textarea(get_theme_mod('admela_footer_aboutus_text_setting')); ?> </p>
			</div>
			<?php  } ?>
		</div> <!-- .admela_footermiddle --> 
		
		<div class="admela_footerbottom">	  
			<?php echo esc_textarea(get_theme_mod('admela_footer_copyrights_setting','Admela Theme All Rights Reserved')); ?> 
		</div> <!-- .admela_footerbottom -->
		
		<div class="admela_top" id="admela_top"> 
			<a href="#top">&uarr;</a> 
		</div>  <!-- #admela_top -->
	  
    </div><!-- .admela_sitefooterinner -->  