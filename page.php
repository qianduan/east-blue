<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
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
						<h1 class="article-titlee"><?php the_title(); ?></h1>
					</header><!-- .article-header -->

					<div class="article-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'eastBlue' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .article-content -->

					<footer class="article-meta">
						<?php edit_post_link( __( 'Edit', 'eastBlue' ), '<span class="icon-edit">', '</span>' ); ?>
					</footer><!-- .article-meta -->
				</article><!-- #post -->

				<?php comments_template(); ?>
			<?php endwhile; ?>

	</div><?php get_sidebar(); ?>
</div><!-- #primary -->


<?php get_footer(); ?>