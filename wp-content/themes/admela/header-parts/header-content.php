<?php

/**
 * Theme header content.
 *
 * @package WordPress
 * @subpackage Admela
 * @since Admela 1.0
 */
 


if((get_theme_mod('admela_header_social_fb_setting') == false) && (get_theme_mod('admela_header_social_twitter_setting') == false) && (get_theme_mod('admela_header_social_gplus_setting') == false) && (get_theme_mod('admela_header_social_instagram_setting') == false)){ 
   $admela_header_socialclass = 'admela_hdrsocialwot';
}
else {
   $admela_header_socialclass = '';
}
?>
<div class="admela_header admela_header1 <?php echo esc_attr($admela_header_socialclass); ?>">
<div class="admela_headerinner">
	<?php if((get_theme_mod('admela_header_social_fb_setting') != false) || (get_theme_mod('admela_header_social_twitter_setting') != false) || (get_theme_mod('admela_header_social_gplus_setting') != false) || (get_theme_mod('admela_header_social_instagram_setting') != false)){ ?>
	<div class="admela_headerfirst">
	  <div class="admela_headershareicon">
		<i class="fas fa-share-alt"></i>
	  </div>
      <ul class="admela_headerfirstsub">	   
		<?php
		if(get_theme_mod('admela_header_social_fb_setting') != false){
		?>
		<li><a href="<?php echo esc_url(get_theme_mod('admela_header_social_fb_setting')); ?>" class="admela_socialiconfb" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
		<?php } 
        if(get_theme_mod('admela_header_social_twitter_setting') != false) {
		?>
		<li><a href="<?php echo esc_url(get_theme_mod('admela_header_social_twitter_setting')); ?>" class="admela_socialicontwt" target="_blank"><i class="fab fa-twitter"></i></a></li>
		<?php } 
		if(get_theme_mod('admela_header_social_gplus_setting') != false) {
		?>
		<li><a href="<?php echo esc_url(get_theme_mod('admela_header_social_gplus_setting')); ?>" class="admela_socialicongle" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>
		<?php
		}
		if(get_theme_mod('admela_header_social_instagram_setting') != false) {
		?>
		<li><a href="<?php echo esc_url(get_theme_mod('admela_header_social_instagram_setting')); ?>" class="admela_socialiconins" target="_blank"><i class="fab fa-instagram"></i></a></li>
		<?php
		}
		?>
	   </ul>
	</div>
	<?php } ?>
	<div class="admela_headermid">
         <?php  if ( has_custom_logo() ) {					
				    if(is_home()): ?>
					<h1 class="admela_sitetitle" itemprop="headline">
						<?php the_custom_logo(); ?>
					</h1>
					<?php 
					else: 
					   the_custom_logo(); 								
					endif;				
					}
				    elseif (is_home()) { ?>
					<h1 class="admela_sitetitle admela_restitle1" itemprop="headline">
					<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo( 'name' ); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>									
					</h1> 
                   <p class="admela_description"><?php bloginfo( 'description' );  ?></p>						
					<?php } 				
					else { ?>
					<div class="admela_sitetitle admela_restitle" itemprop="headline"> 
					<a href="<?php echo esc_url(home_url('/'));  ?>" title="<?php bloginfo( 'name' ); ?>" class="admela_fontstlye">
						<?php bloginfo( 'name' ); ?>
					</a>  
					<p class="admela_description"><?php bloginfo( 'description' );  ?></p>						
					</div>
					<?php }	?>
			</div>
	<div class="admela_headerlast">
       
			<div class="admela_hdlsticon admela_hdlsrchicon">
				<i class="fas fa-search"></i> 
			</div>
            <?php
            
			if(has_nav_menu('admela-primary-menu')):
            ?>			
        <div class="admela_hdlsticon admela_hdmenuicon">
			<i class="fas fa-bars"></i>
		</div>	
		<?php
        endif;			
        ?>		
	</div>
</div> <!-- .admela_headerinner -->
</div> <!-- .admela_header -->
