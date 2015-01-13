<?php
/**
 * The template for displaying all single posts
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

			<?php get_template_part( 'content', get_post_format() ); ?>
			<?php eastBlue_post_nav(); ?>
			<?php comments_template(); ?>

		<?php endwhile; ?>

	</div><?php get_sidebar(); ?>
</div><!-- #primary -->


<?php get_footer(); ?>