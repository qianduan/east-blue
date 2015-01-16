<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, East Blue
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage East_Blue
 * @since East Blue 1.0
 */

get_header(); ?>

	<div id="content" class="inner">
		<div class="content"  role="main">
		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( '按日归档: %s', 'eastBlue' ), get_the_date() );
					elseif ( is_month() ) :
						printf( __( '按月归档: %s', 'eastBlue' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'eastBlue' ) ) );
					elseif ( is_year() ) :
						printf( __( '按年归档: %s', 'eastBlue' ), get_the_date( _x( 'Y', 'yearly archives date format', 'eastBlue' ) ) );
					else :
						_e( '归档', 'eastBlue' );
					endif;
				?></h1>
			</header><!-- .archive-header -->

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