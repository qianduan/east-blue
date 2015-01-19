<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php if ( is_home() ) { ?>
<? bloginfo('name'); ?> | <?php bloginfo('description'); ?>
<?php } ?>
<?php if ( is_search() ) { ?>
搜索结果 for
<?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); echo $key; _e(' &mdash; '); echo $count . ' '; _e('篇文章'); wp_reset_query(); ?>
<?php } ?>
<?php if ( is_404() ) { ?>
<? bloginfo('name'); ?> | 404 页面未找到
<?php } ?>
<?php if ( is_author() ) { ?>
<? bloginfo('name'); ?> | 作者归档
<?php } ?>
<?php if ( is_single() ) { ?>
<?php wp_title(''); ?> | <?php $category = get_the_category(); echo $category[0]->cat_name; ?> | <? bloginfo('name'); ?>
<?php } ?>
<?php if ( is_page() ) { ?>
<? bloginfo('name'); ?> | <?php $category = get_the_category(); echo $category[0]->cat_name;  ?> | <?php wp_title(''); ?>
<?php } ?>
<?php if ( is_category() ) { ?>
<?php single_cat_title(); ?> | <?php $category = get_the_category(); echo $category[0]->category_description; ?> | <? bloginfo('name'); ?>
<?php } ?>
<?php if ( is_month() ) { ?>
<? bloginfo('name'); ?> | 归档 | <?php the_time('F, Y'); ?>
<?php } ?>
<?php if ( is_day() ) { ?>
<? bloginfo('name'); ?> | 归档 | <?php the_time('F j, Y'); ?>
<?php } ?>
<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?>
<?php single_tag_title("", true); } } ?>
</title>
<?php if (is_home()){
$description = "前端观察，关注国内外最新最好的前端设计资源和前端开发技术的专业博客";
$keywords = "前端, 前端设计, 前端开发, 设计, 开发, 前端资源, CSS, JavaScript, Ajax, resources, showcase,设计展示, 设计秀, 技巧, tips";
} elseif (is_single()){
    if ($post->post_excerpt) {
        $description     = $post->post_excerpt;
    } else {
        $description = substr(strip_tags($post->post_content),0,220);
    }
    $keywords = "";       
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {
        $keywords = $keywords . $tag->name . ", ";
    }
} ?>
<meta name="keywords" content="<?=$keywords?>" />
<meta name="description" content="<?=$description?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php the_permalink() ?>" />
<meta property="og:title" content="<?php wp_title(''); ?> | <? bloginfo('name'); ?>" />
<meta property="og:description" content="<?=$description?>" />
<meta itemprop="name" content="<?php wp_title(''); ?> | <? bloginfo('name'); ?>">
<meta itemprop="description" content="<?=$description?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->
<link rel='stylesheet' href='<?php echo get_stylesheet_uri() ?>?d=20150119' type='text/css' media='all' />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="header" role="banner">
	<a class="screen-reader-text skip-link" id="pageTop" href="#content" title="<?php esc_attr_e( 'Skip to content', 'eastBlue' ); ?>"><?php _e( 'Skip to content', 'eastBlue' ); ?></a>
	<div class="topbar">
		<div class="inner">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class='logo-mobile'><?php bloginfo( 'name' ); ?></a>
			<a class="icon-bars" href="javascript:;"></a><a class="icon-search" href="javascript:;"></a>
			<nav class="nav-top">
			<?php wp_nav_menu( array( 'theme_location' => 'topbar', 'menu_class' => 'top-menu' ) ); ?>
			</nav>
			<?php get_search_form(); ?>
		</div>
	</div>
<?php if ( is_single() || is_page()) : ?>
	<h2 class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
<?php else : ?>
	<h1 class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
<?php endif; ?>
	<!-- 	<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2> -->
	<nav class="navigation main-navigation" role="navigation">
		<button class="menu-toggle"><?php _e( 'Menu', 'eastBlue' ); ?></button>
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
	</nav><!-- #site-navigation -->
</header>
<div id="main" class="body">