<?php


/**
 * The template for displaying Author bio
 *
 * @package WordPress
 * @subpackage admela
 * @since Admela 1.0
 */


 $admela_authordesc = get_the_author_meta( 'description' );

 if(!empty($admela_authordesc)) {
 
?>

<div class="admela_authorbox" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"> <!-- Author bio Section --> 
  
  <?php echo get_avatar( get_the_author_meta( 'user_email' ), 100 ); ?>
  <div class="admela_authorinfo">
    <div class="admela_author_link"> <h5> <?php esc_html_e('Written By','admela'); ?></h5><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"> <?php echo get_the_author(); ?> </a></div>
	<?php wp_filter_nohtml_kses(the_author_meta( 'description' )); ?>
  </div>
	
</div> <!-- .admela_authorbox --> 
 <?php  } ?>


