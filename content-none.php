<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage East_Blue
 * @since East Blue 1.0
 */
?>

<header class="page-header">
	<h1 class="page-title"><?php _e( '找不到啊！', 'eastBlue' ); ?></h1>
</header>

<div class="page-content">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf( __( '准备好了发布你的第一篇文章了? <a href="%1$s">点击这里开始</a>.', 'eastBlue' ), admin_url( 'post-new.php' ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

	<p><?php _e( '抱歉，但是真的没有搜索到相关内容啊，换个关键词再搜索试试？', 'eastBlue' ); ?></p>
	<?php get_search_form(); ?>

	<?php else : ?>

	<p><?php _e( '不知道是什么原因没有你要访问的内容诶。搜索一下试试？', 'eastBlue' ); ?></p>
	<?php get_search_form(); ?>

	<?php endif; ?>
</div><!-- .page-content -->
