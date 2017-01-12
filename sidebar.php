<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */


<?PHP
if (is_front_page()) {
    echo "	<div id="home_sidebar" class="widget-area" role="complementary">
    		<?php dynamic_sidebar( 'home_sidebar' ); ?>
	</div>";
}else {
    echo "";
}
?>

<?php
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->


