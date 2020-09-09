<?php
/**
 * The template for the primary sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Admela
 * @since Admela 1.0
 */
?>
<?php if ( is_active_sidebar( 'admela-primary-sidebar' )  ) : ?>
<aside id="admela_primarysidebar" class="admela_primarysidebar widget-area">
  <?php dynamic_sidebar( 'admela-primary-sidebar' ); ?>
</aside>
<!-- .admela_primarysidebar .widget-area -->
<?php endif; ?>