<?php

/**
 * Theme Single Post Bottom Ad.
 *
 * @package WordPress
 * @subpackage Admela
 * @since Admela 1.0
 */
if(!is_paged()){ // Displaying ad only on home page not to nagavigated pages.
 if(!is_404()) { // Displaying ad only on home page not to 404 page.
 			
			$admela_shortcode_matchexpression = "/\/|\[|\]/";  // checks the user input code is shortcode format (or) not.  
						
			if(get_theme_mod('admela_single_post_bottom_ad_setting') != false): ?>

			<div class="admela_themead admela_entrycontentad admela_ecbtmad">
			
			<?php
     	
			if(preg_match($admela_shortcode_matchexpression , get_theme_mod('admela_single_post_bottom_ad_setting'))) {
			  echo do_shortcode(''.get_theme_mod('admela_single_post_bottom_ad_setting').'');
			}
			else {
			  echo esc_html(get_theme_mod('admela_single_post_bottom_ad_setting'));
			}		
			
			?>
			</div> <!-- .admela_entrycontentad -->
			<?php 
			endif;		
			}
			}	