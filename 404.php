<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage East_Blue
 * @since East Blue 1.0
 */

get_header(); ?>

<div id="content" class="inner">
	<div class="error-wrapper">
		<div class="error-content">
			<header class="error-header">
				<h1 class="error-title"><?php _e( '什么都没有', 'eastBlue' ); ?></h1>
			</header>
			
			<div class="error-msg">
				<h2><?php _e( '囧', 'eastBlue' ); ?></h2>
				<p><?php _e( '但是你要访问的内容真的不在这里啊，不如搜索下试试？', 'eastBlue' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .page-content -->
		</div><!-- .page-wrapper -->
	</div>
</div><!-- #primary -->

<?php get_footer(); ?>