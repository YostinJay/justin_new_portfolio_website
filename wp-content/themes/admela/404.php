<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Admela
 * @since Admela 1.0
 */

get_header(); 

echo '<main id="admela_maincontent" class="admela_sitemaincontent" role="main">';
?>

<div class="admela_404contentarea">
  <header class="admela_404header">
    <h1 class="admela_404title">
      <?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'admela' ); ?>
    </h1>
  </header>
  <!-- .admela_404header -->
  
  <div class="admela_404content">
    <p>
      <?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'admela' ); ?>
    </p>
    <?php get_search_form(); ?>
  </div>
  <!-- .admela_404content --> 
  
</div> <!-- .admela_404contentarea --> 
<?php 
echo '</main>';  //#admela_maincontent
get_footer(); 

?>