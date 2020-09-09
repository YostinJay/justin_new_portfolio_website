<?php

/**
 * Theme After Header Section Ad.
 *
 * @package WordPress
 * @subpackage Admela
 * @since Admela 1.0
 */
	if(!is_paged()){ // displaying ad only on home page not to navigated pages.
	if(!is_404())  { // displaying ad only on home page not to 404 pages.
			
			if(get_theme_mod('admela_after_header_ad_setting') != '') {
			
			$admela_adcode_shortcode_matchexpression = "/\/|\[|\]/";  // checks the user input ad code is shortcode format or not.
			
			?>

			<div class="admela_afterheaderad admela_themead admela_headerinner">
			
			<?php     	
			if(preg_match($admela_adcode_shortcode_matchexpression , get_theme_mod('admela_after_header_ad_setting'))) {
			  echo do_shortcode(''.get_theme_mod('admela_after_header_ad_setting').'');
			}
			else {
			  echo esc_html(get_theme_mod('admela_after_header_ad_setting'));
			}
			?>
			
			</div>	<!-- .admela_afterheaderad -->
			<?php 
			}
			}
			}
			?>