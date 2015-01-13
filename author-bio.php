<?php
/**
 * The template for displaying Author bios
 *
 * @package WordPress
 * @subpackage East_Blue
 * @since East Blue 1.0
 */
?>
<div class="article-author">
	<h3 class="author-header">关于作者</h3>
	<div class="author-info">
		<div class="author-avatar">
			<?php
			$author_bio_avatar_size = apply_filters( 'eastBlue_author_bio_avatar_size', 74 );
			echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
			?>
		</div><!-- .author-avatar -->
		<div class="author-description">
			<h3 class="author-title"><?php printf( __( '%s', 'eastBlue' ), get_the_author() ); ?></h3>
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( '查看%s的所以文章', 'eastBlue' ), get_the_author() ); ?>
			</a>
		</div><!-- .author-description -->
	</div><!-- .author-info -->
</div>