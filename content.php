<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage East_Blue
 * @since East Blue 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" class="article">
	<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
	<div class="article-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div>
	<?php endif; ?>
	<header class="article-header">
		<h1 class="article-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<div class="article-meta">
			<?php eastBlue_entry_meta(); ?>
		<?php if ( comments_open() && ! is_single() ) : ?>
		<span class="icon-comment"><?php comments_popup_link('发表评论', '1 条评论', '% 条评论'); ?></span>
		<?php endif; // comments_open() ?>
		<?php edit_post_link( __( 'Edit', 'eastBlue' ), '<span class="icon-edit">', '</span>' ); ?>
		</div><!-- .article-meta -->
	</header><!-- .article-header -->

	<?php if ( !is_single() ) : // Only display Excerpts for Search ?>
	<div class="article-summary">
		<?php the_excerpt(); ?>
		<p><a href="<?php the_permalink() ?>" title="查看 <?php the_title(); ?> 的全部内容" class="btn btn-warning btn-read-all">阅读全文 &#187;</a></p>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="article-content">
		<!-- <div class="give-me-five"><a href="https://100offer.com/join/cha"><img src="http://feimg.qiniudn.com/100topright.jpg" alt=""></a></div> -->
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( '<br><span class="btn btn-warning btn-read-all">查看全文 %s </span>', 'eastBlue' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'eastBlue' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
		?>
		<div class="give-me-five"><a href="https://100offer.com/join/cha"><img src="http://feimg.qiniudn.com/1002015l.jpg" alt=""></a></div>
	</div><!-- .article-content -->
	<?php endif; ?>

	<!-- <div class="share-box">
		<span class="icon-share"></span>
		<a class="icon-weixin" href="javascript:;"></a>
		<a class="icon-weibo" href="javascript:;"></a>
		<a class="icon-twitter" href="javascript:;"></a>
	</div -->
	<?php if ( is_single() && get_the_author_meta( 'description' ) ) : ?>
		<footer class="article-meta">
			<?php get_template_part( 'author-bio' ); ?>
		</footer><!-- .article-meta -->
	<?php endif; ?>
</article><!-- #post -->
