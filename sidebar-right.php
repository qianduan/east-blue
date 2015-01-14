<?php
/**
 * The sidebar containing the footer widget area
 *
 * If no active widgets in this sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage East_Blue
 * @since East Blue 1.0
 */

if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
<div class="widget-area">
	<?php dynamic_sidebar( 'sidebar-4' ); ?>
</div>
<?php endif; ?>