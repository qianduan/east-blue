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
<footer id="colophon" class="footer" role="contentinfo">
	<div class="footer-widgets inner">
		<?php get_sidebar('left'); ?><?php get_sidebar('middle'); ?><?php get_sidebar('right'); ?>
	</div>
	<div class="footer-copyright">
		<div class="inner">
		Powered by <a href="http://wordpress.org/">WordPress</a>, Host by <a href="http://www.linode.com/?r=d5156fa674d41bf96fbace51c9fade505f6fd852">Linode VPS</a><br />
Copyright &copy; 2008-2015 前端观察 All rights reserved.
		</div>
	</div>
</footer>
	<?php wp_footer(); ?>
</body>
</html>