<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>


		</div><!-- #content -->
<div class"footer-color" style="background-color: <?php
$options =  get_option('sleepy_options');
echo esc_html($options['footer-color']);
?>">
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrap">
				<?php
				get_template_part( 'template-parts/footer/footer', 'widgets' );

				if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="social-navigation" role="navigation" aria-label="<?php _e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
							) );
						?>
					</nav><!-- .social-navigation -->
				<?php endif;

				get_template_part( 'template-parts/footer/site', 'info' );
				?>
</div><!-- .wrap --!>


		<!-- Enter copy right in here --!><Div class="footer-copyright"><Div Align="center" class="copyright-blog"><br><font size=5>&copy; <?php echo get_first_post_year(); ?> - <script type="text/javascript">myDate = new Date() ;myYear = myDate.getFullYear ();document.write(myYear);</script> <a href="<?php echo home_url(); ?>"><font color="white"><?php bloginfo('name'); ?></a></font><br><br></font></Div><div align="center" class=after-copyright"><font size=4><?php
$options =  get_option('sleepy_options');
echo esc_html($options['text01']);?><br><br></font></div></footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div></div><!-- #page --></script>
<!-- Load Fontawesome -->
<link href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/font-awesome.min.css" rel="stylesheet">
<?php wp_footer(); ?>
</body>

</div>
</div>
</body>
</html>
