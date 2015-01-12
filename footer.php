<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage East_Blue
 * @since East Blue 1.0
 */
?>
</div><!-- #main -->
<footer id="colophon" class="site-footer" role="contentinfo">
	<div id="secondary" class="sidebar-container" role="complementary">
		<div class="sidebar-footer">
			<?php get_sidebar( 'sidebar-left' ); ?>
			<?php get_sidebar( 'sidebar-middle' ); ?>
			<?php get_sidebar( 'sidebar-right' ); ?>
		</div>
	</div>
		<div class="site-info">
			Powered by <a href="http://wordpress.org/">WordPress</a>, Host by <a href="http://www.linode.com/?r=d5156fa674d41bf96fbace51c9fade505f6fd852">Linode VPS</a><br />
	Copyright &copy; 2008-2014 前端观察 All rights reserved.
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<?php wp_footer(); ?>
</body>
</html>