<?php 
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( !defined( 'THEME_DIR' ) ) {
	define( 'THEME_DIR', get_template_directory() );
}
if ( !defined( 'STYLESHEET_DIR' ) ) {
	define( 'STYLESHEET_DIR', get_stylesheet_directory() );
}
if ( !defined( 'THEME_URI' ) ) {
	define( 'THEME_URI', get_template_directory_uri() );
}
define( 'version', '2021/04/10' );
require THEME_DIR . '/inc/aoton-inc.php';//主要参数
// 头部冗余代码
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
// 禁止代码标点转换
remove_filter( 'the_content', 'wptexturize' );
// 禁用xmlrpc
add_filter('xmlrpc_enabled', '__return_false');
// 禁止评论自动超链接
remove_filter('comment_text', 'make_clickable', 9);
// 链接管理
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
// 禁用版本修订
add_filter( 'wp_revisions_to_keep', 'disable_wp_revisions_to_keep', 10, 2 );
function disable_wp_revisions_to_keep( $num, $post ) {
	return 0;
}
// 禁用admin_bar
add_filter('show_admin_bar', '__return_false');
// 禁止后台加载谷歌字体
function wp_remove_open_sans_from_wp_core() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
	wp_enqueue_style('open-sans','');
}
add_action( 'init', 'wp_remove_open_sans_from_wp_core' );
// 禁用emoji
function disable_emojis() {
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'disable_emojis' );
// 移除表情
remove_action( 'wp_head' , 'print_emoji_detection_script', 7 );
// 禁用oembed/rest
function disable_embeds_init() {
	global $wp;
	$wp->public_query_vars = array_diff( $wp->public_query_vars, array(
		'embed',
	) );
	remove_action( 'rest_api_init', 'wp_oembed_register_route' );
	add_filter( 'embed_oembed_discover', '__return_false' );
	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
	add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
}
add_action( 'init', 'disable_embeds_init', 9999 );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
function disable_embeds_tiny_mce_plugin( $plugins ) {
	return array_diff( $plugins, array( 'wpembed' ) );
}
function disable_embeds_rewrites( $rules ) {
	foreach ( $rules as $rule => $rewrite ) {
		if ( false !== strpos( $rewrite, 'embed=true' ) ) {
			unset( $rules[ $rule ] );
		}
	}
	return $rules;
}
function disable_embeds_remove_rewrite_rules() {
	add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );
function disable_embeds_flush_rewrite_rules() {
	remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );
// 禁止dns-prefetch
function remove_dns_prefetch( $hints, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		return array_diff( wp_dependencies_unique_hosts(), $hints );
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );
// 移除wp-json链接
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
// 打开缓冲区
add_action('init', 'do_output_buffer');
function do_output_buffer() {
	ob_start();
}
//注册CSS和JS
function aoton_scripts() {
    //<!-- CSS ============== ==================================== -->
	wp_enqueue_style( 'uikit', THEME_URI . '/assets/css/uikit.css', array(), version );
	wp_enqueue_style( 'style', THEME_URI . '/assets/css/style.css', array(), version );
	wp_enqueue_style( 'icons', THEME_URI . '/assets/css/icons.css', array(), version );
	wp_enqueue_style( 'iconfont', THEME_URI . '/assets/fonts/iconfont/iconfont.css', array(), version );
	if(is_page_template("template/user.php")){
		wp_enqueue_style('user', THEME_URI . '/assets/css/user.css', array(), version, 'screen');
		wp_enqueue_script( 'user', THEME_URI . '/assets/js/user.js', array(), version, true );
	  }
	if ( !is_admin() ) {
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'html5', THEME_URI . '/assets/js/html5.js', array(), version, true );
		wp_enqueue_script( 'qrious', THEME_URI . '/assets/js/qrious.js', array(), version, true );
		wp_enqueue_script( 'fontawesome', THEME_URI . '/assets/js/FontAwesomeKit.js', array(), version, true );
		wp_enqueue_script( 'jquery_form', THEME_URI . '/assets/js/jquery.form.js', array(), version, true );
		wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
		wp_enqueue_script( 'uikit', THEME_URI . '/assets/js/uikit.js', array(), version, true );
		wp_enqueue_script( 'iconfont', THEME_URI . '/assets/fonts/iconfont/iconfont.js', array(), version, true );
		wp_enqueue_script( 'simplebar', THEME_URI . '/assets/js/simplebar.js', array(), version, true );
		wp_register_script( '3dtag', THEME_URI . '/assets/js/3dtag.js', array(), version, true );
		if (aoton('sidebar_sticky')) {
			wp_enqueue_script( 'sticky', THEME_URI . '/assets/js/sticky.js', array(), '1.7.0', true );
		}
	}
	if(wp_is_erphpdown_active()){
		wp_enqueue_script( 'erphpdown', constant("erphpdown")."static/erphpdown.js", false, $erphpdown_version, true);
		wp_localize_script( 'erphpdown', 'erphpdown_ajax_url', admin_url("admin-ajax.php"));
	  }
}
add_action( 'wp_enqueue_scripts', 'aoton_scripts' );
