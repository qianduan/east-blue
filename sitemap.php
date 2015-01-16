<?php
/**
 * Template Name: Sitemap
 *
 * @package WordPress
 * @subpackage East_Blue
 * @since East Blue 1.0
 */

get_header(); ?>

<div id="content" class="inner">
	<div class="content"  role="main">
		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" class="article">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			<div class="article-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php endif; ?>
			<header class="article-header">
				<h1 class="article-title"><?php the_title(); ?></h1>
			</header>
			<div class="article-content">
				<h3>Pages</h3>
				<ul>
					<?php wp_list_pages('depth=1&sort_column=menu_order&title_li=' ); ?>
				</ul>
				<h3>Categories</h3>
				<ul>
					<?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>
				</ul>
			<?php 
				$cats = get_categories(); 
				foreach ($cats as $cat) {
				query_posts('cat='.$cat->cat_ID);
				?>
				<h3><?php echo $cat->cat_name; ?></h3>
				<ul>
					<?php while (have_posts()) : the_post(); ?>
					<li style="font-weight:normal !important;"><a href="<?php the_permalink() ?>">
						<?php the_title(); ?>
						</a> - Comments (<?php echo $post->comment_count ?>)</li>
					<?php endwhile;  ?>
				</ul>
			<?php } ?>
			</div>
		</article>
		<?php endwhile; ?>
	</div><?php get_sidebar(); ?>
</div><!-- #primary -->
<?php get_footer(); ?>