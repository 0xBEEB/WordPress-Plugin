<?php
/**
 * The Top widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<?php
	/* The top widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'top-widget-area'  ) )
		return;
	// If we get this far, we have widgets. Let do this.
?>

<div id="top-widget-areas" role="complementary">
    <?php dynamic_sidebar( 'top-widget-area' ); ?>
</div>
