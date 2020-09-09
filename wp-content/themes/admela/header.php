<?php
/**
 * The template for displaying the header content
 *
 * 
 * @package WordPress
 * @subpackage Admela
 * @since Admela 1.0
 * @version 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head itemscope="itemscope" itemtype="http://schema.org/WebSite">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />	
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>">
	<?php endif;		
	/**
	* This hook is important for wordpress plugins and other many things
	*/
	wp_head();
	
?>
</head>

<?php 
 
$admela_blog_bdyclass = 'admela_layout1';

?>

<body <?php body_class(''.esc_attr($admela_blog_bdyclass).''); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">

<div class="admela_sitepushmenu">
	<div class="admela_pushclose">&#9540;</div>
	<div class="admela_pushmenutit">
	<?php
	
	 	if ( has_custom_logo() ) {			
		if(is_home()): ?>
		    <h1 class="admela_sitetitle" itemprop="headline">
				
				<?php the_custom_logo(); ?>
				
			</h1>
			<?php else: 
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
	<?php }	 ?>
	</div>	
	<?php if(has_nav_menu('admela-primary-menu')): ?>
		<nav class="admela_menu" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
			<?php 				
				wp_nav_menu(array('menu' => 'admela-primary-menu', 'theme_location' => 'admela-primary-menu'));  
			?>
		</nav>	
	<?php endif; ?>
</div>

<div class="admela_sitecontainer">

   
	<div class="admela_searchout"> 
	<span class="admela_searchcls"><i class="fas fa-window-close"></i></span>
	<div class="admela_searchget">
		<?php get_search_form(); ?>
	<span class="admela_subtext"><?php esc_html_e('Hit enter after type your search item','admela'); ?></span>
	</div>
	</div>	
	
	<header class="admela_siteheader" itemscope="" itemtype="http://schema.org/WPHeader">
		
		<?php 
		
		get_template_part('header-parts/header','content'); // layout header content
	   	   				
		?>
				
	</header>
	
	
	<?php 
	
    /*
	* Include the After Header Ad Content Template.			
	*/
		
	 get_template_part('ad-parts/afterheader','ad'); 
	   	   				
	?>

<div class="admela_siteinner">
	