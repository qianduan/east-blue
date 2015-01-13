<?php
/**
 * The sidebar containing the secondary widget area
 *
 * Displays on posts and pages.
 *
 * If no active widgets are in this sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage East_Blue
 * @since East Blue 1.0
 */

if ( is_active_sidebar( 'sidebar-1' ) ) : ?><div id="tertiary" class="sidebar-container" role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area">
				<div class="widget give-me-five"><a href="https://100offer.com/join/cha"><img src="http://feimg.qiniudn.com/100topright.jpg" alt=""></a></div>
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #tertiary -->
<?php endif; ?>