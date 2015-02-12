<?php
/**
 * East Blue functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage East_Blue
 * @since East Blue 1.0
 */


/**
 * East Blue setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * East Blue supports.
 */
function eastBlue_setup() {
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	register_nav_menus(
		array(
			'primary' => __( 'Header Menu', 'eastBlue' ),
			'topbar' => __( 'Topbar Menu', 'eastBlue' )
		)
	);

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 620, 150, true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'eastBlue_setup' );



/**
 * Enqueue scripts and styles for the front end.
 *
 * @since East Blue 1.0
 */
function eastBlue_scripts_styles() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Loads JavaScript file with functionality specific to East Blue.
	wp_enqueue_script( 'eastBlue-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2015-01-08', true );

}
add_action( 'wp_enqueue_scripts', 'eastBlue_scripts_styles' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since East Blue 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function eastBlue_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'eastBlue' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'eastBlue_wp_title', 10, 2 );

/**
 * Register two widget areas.
 *
 * @since East Blue 1.0
 */
function eastBlue_widgets_init() {
	register_sidebar( array(
		'name'          => __( '侧边', 'eastBlue' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the aside of the site.', 'eastBlue' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( '底部左边', 'eastBlue' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the bottom left.', 'eastBlue' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( '底部中间', 'eastBlue' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears on posts and pages in the bottom middle.', 'eastBlue' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( '底部右边', 'eastBlue' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Appears on posts and pages in the bottom right.', 'eastBlue' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'eastBlue_widgets_init' );

if ( ! function_exists( 'eastBlue_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function eastBlue_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<div class="screen-reader-text"><?php _e( '文章分页', 'eastBlue' ); ?></div>
		<div class="nav-links">
			<?php
			$big = 999999999; // need an unlikely integer

			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages
			) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->

	<?php
}
endif;

if ( ! function_exists( 'eastBlue_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function eastBlue_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( '文章导航', 'eastBlue' ); ?></h1>
			<?php previous_post_link( '%link', _x( '<span class="icon-angle-left"></span>', 'Previous post link', 'eastBlue' ) ); ?>
			<?php next_post_link( '%link', _x( '<span class="icon-angle-right"></span>', 'Next post link', 'eastBlue' ) ); ?>
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'eastBlue_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 */
function eastBlue_entry_meta() {
	//  Sticky post
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'eastBlue' ) . '</span>';
	
	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="icon-user author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( '查看%s的所有文章', 'eastBlue' ), get_the_author() ) ),
			get_the_author()
		);
	}
	// post time
	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		eastBlue_entry_date();
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'eastBlue' ) );
	if ( $categories_list ) {
		echo '<span class="icon-cat">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'eastBlue' ) );
	if (  is_single() && $tag_list ) {
		echo '<span class="icon-tag">' . $tag_list . '</span>';
	}

}
endif;

if ( ! function_exists( 'eastBlue_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 */
function eastBlue_entry_date( $echo = true ) {
	$format_prefix = '%2$s';

	$date = sprintf( '<span class="icon-date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'eastBlue_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 */
function eastBlue_the_attached_image() {
	$attachment_size     = apply_filters( 'eastBlue_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();

	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 */
function eastBlue_body_class( $classes ) {
	$useragent = $_SERVER['HTTP_USER_AGENT'];
    if(strchr($useragent,'Windows')) $classes[] = 'isWindows';
	return $classes;
}
add_filter( 'body_class', 'eastBlue_body_class' );


/**
 * Add postMessage support for site title and description for the Customizer.
 *
 */
function eastBlue_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'eastBlue_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JavaScript handlers to make the Customizer preview
 * reload changes asynchronously.
 */
function eastBlue_customize_preview_js() {
	wp_enqueue_script( 'eastBlue-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20141120', true );
}
add_action( 'customize_preview_init', 'eastBlue_customize_preview_js' );

/*
remove un used script,and put js to bottom of document.
*/
function footer_enqueue_scripts() {
   remove_action('wp_head', 'wp_print_scripts');
    //remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts',1);
   add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 1);
    //add_action('wp_footer', 'wp_print_head_scripts', 5);
}
add_action('after_setup_theme', 'footer_enqueue_scripts');

// replace gavatar to duoshuo, fuck GFW.
function rccoder_get_avatar($avatar) {
	$avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),
	"gravatar.duoshuo.com",$avatar);
	return $avatar;
}
add_filter( 'get_avatar', 'rccoder_get_avatar', 10, 3 );

//hot posts

function eastBlue_hot_posts($days=7, $nums=10) { //$days参数限制时间值，单位为‘天’，默认是7天；$nums是要显示文章数量
	global $wpdb;
	$today = date("Y-m-d H:i:s"); //获取今天日期时间
	$daysago = date( "Y-m-d H:i:s", strtotime($today) - ($days * 24 * 60 * 60) );  //Today - $days
	$result = $wpdb->get_results("SELECT comment_count, ID, post_title, post_date FROM $wpdb->posts WHERE post_date BETWEEN '$daysago' AND '$today' ORDER BY comment_count DESC LIMIT 0 , $nums");
	$output = '';
	if(empty($result)) {
		$output = '<li>暂无数据.</li>';
	} else {
		foreach ($result as $topten) {
			$postid = $topten->ID;
			$title = $topten->post_title;
			$commentcount = $topten->comment_count;
			if ($commentcount != 0) {
				$output .= '<li><a href="'.get_permalink($postid).'" title="'.$title.'">'.$title.'</a></li>';
			}
		}
	}
	echo $output;
}