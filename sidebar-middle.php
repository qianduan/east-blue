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

if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
<div class="widget-area widget-links">
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
</div>
<?php endif; ?>