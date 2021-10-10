<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="Cache-Control" content="no-transform" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <meta name="referrer" content="never" />
        <?php aoton_title(); ?>    
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="icon" href="<?php echo aoton('favicon'); ?>">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有文章" href="<?php echo get_bloginfo('rss2_url'); ?>" />
        <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有评论" href="<?php bloginfo('comments_rss2_url'); ?>" />
        <?php wp_head(); ?>
        <script>window._aoton = {uri: '<?php bloginfo('template_url'); ?>',url: '<?php bloginfo('url');?>',admin_ajax: '<?php echo admin_url('admin-ajax.php ');?>',}</script>
    </head>
    <!---<?php flush(); ?>--->
    <body <?php body_class(); ?>>
    <?php get_menu(); ?>