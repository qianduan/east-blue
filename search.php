<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage East_Blue
 * @since East Blue 1.0
 */

get_header(); ?>

	<div id="content" class="inner">
		<div class="content"  role="main">
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( '搜索结果: %s', 'eastBlue' ), get_search_query() ); ?></h1>
			</header>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php eastBlue_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
		</div><?php get_sidebar(); ?>
</div><!-- #content -->
<?php get_footer(); ?>