<?php
/**
 * The template part for displaying page content
 *
 * @package WordPress
 * @subpackage Admela
 * @since Admela 1.0
 */



?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="admela_entryheader">
	
	   	<?php
		
        if(get_theme_mod('admela_breadcrumb_post') != '') {
		
		admela_breadcrumb(); // Admela-BreadCrumb
		
		}
       
		the_title( '<h1 class="admela_entrytitle" itemprop="headline">', '</h1>' ); 
		
		admela_entrymeta(); // Admela-EntryMeta
		
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
			
		
		 the_content();

	      wp_link_pages( array(
				'before'      => '<div class="admela_pagelinks"><span class="admela_pagelinkstitle">' . esc_html__( 'Pages:', 'admela' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="admela_screenreadertext">' . esc_html__( 'Page', 'admela' ) . ' </span><span class="admela_pglnlksaf">%</span>',
				'separator'   => '<span class="admela_screenreadertext">, </span>',
			) );
			
			
		
		?>

	</div> <!-- .admela_entrycontent -->

	
</article><!-- #post-## -->