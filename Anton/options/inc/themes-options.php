<?php

if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/options/' );

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Don't load if optionsframework_init is already defined
if (is_admin() && ! function_exists( 'optionsframework_init' ) ) :

function optionsframework_init() {

	//  If user can't edit theme options, exit
	if ( ! current_user_can( 'edit_theme_options' ) )
		return;

	// Loads the required Options Framework classes.
	require plugin_dir_path( __FILE__ ) . 'framework.php';
	require plugin_dir_path( __FILE__ ) . 'framework-admin.php';
	require plugin_dir_path( __FILE__ ) . 'interface.php';
	require plugin_dir_path( __FILE__ ) . 'media-uploader.php';
	require plugin_dir_path( __FILE__ ) . 'sanitization.php';

	// Instantiate the main plugin class.
	$options_framework = new Options_Framework;
	$options_framework->init();

	// Instantiate the options page.
	$options_framework_admin = new Options_Framework_Admin;
	$options_framework_admin->init();

	// Instantiate the media uploader class
	$options_framework_media_uploader = new Options_Framework_Media_Uploader;
	$options_framework_media_uploader->init();
}

add_action( 'init', 'optionsframework_init', 20 );

endif;


/**
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * Not in a class to support backwards compatibility in themes.
 */

if ( ! function_exists( 'aoton' ) ) :

function aoton( $name, $default = false ) {
	$config = get_option( 'optionsframework' );

	if ( ! isset( $config['id'] ) ) {
		return $default;
	}

	$options = get_option( $config['id'] );

	if ( isset( $options[$name] ) ) {
		return $options[$name];
	}

	return $default;
}

endif;


/*  Add custom script to theme options  */
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');
add_action('optionsframework_after','exampletheme_options_after', 100);
}

function exampletheme_options_after() { ?>

<?php
}

/*
 * This is an example of how to override a default filter
 * for 'textarea' sanitization and $allowedposttags + embed and script.
 */
add_action('admin_init','optionscheck_change_santiziation', 100);

function optionscheck_change_santiziation() {
   remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
   add_filter( 'of_sanitize_textarea', function($input) {return $input;} );
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 *
 * You can delete it if you not using that option
 */

add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#cms_top').click(function() {
		jQuery('.top_no').fadeToggle(400);
	});

	if (jQuery('#cms_top:checked').val() !== undefined) {
		jQuery('.top_no').show();
	}

	jQuery('#cms_cat_tab').click(function() {
		jQuery('.c_c_t_no').fadeToggle(400);
	});

	if (jQuery('#cms_cat_tab:checked').val() !== undefined) {
		jQuery('.c_c_t_no').show();
	}

	jQuery('#logos').click(function() {
		jQuery('#section-logo').fadeToggle(400);
	});

	if (jQuery('#logos:checked').val() !== undefined) {
		jQuery('#section-logo').show();
	}

	jQuery('#logo_small').click(function() {
		jQuery('#section-logo_small_b').fadeToggle(400);
	});

	if (jQuery('#logo_small:checked').val() !== undefined) {
		jQuery('#section-logo_small_b').show();
	}

	jQuery('#begin-news_model-news_list').click(function() {
		jQuery('#section-cms_new_img').fadeToggle(400);
	});
	jQuery('#slider').click(function() {
		jQuery('.slider_on').fadeToggle(400);
	});

	if (jQuery('#slider:checked').val() !== undefined) {
		jQuery('.slider_on').show();
	}

	jQuery('#grid_cat_new').click(function() {
		jQuery('.g_c_n').fadeToggle(400);
	});

	if (jQuery('#grid_cat_new:checked').val() !== undefined) {
		jQuery('.g_c_n').show();
	}

	jQuery('#cat_all').click(function() {
		jQuery('#section-cat_all_e').fadeToggle(400);
	});

	if (jQuery('#cat_all:checked').val() !== undefined) {
		jQuery('#section-cat_all_e').show();
	}

	jQuery('#grid_carousel').click(function() {
		jQuery('.g_cl_on').fadeToggle(400);
	});

	if (jQuery('#grid_carousel:checked').val() !== undefined) {
		jQuery('.g_cl_on').show();
	}

	jQuery('#grid_cat_a').click(function() {
		jQuery('.g_ca_no').fadeToggle(400);
	});

	if (jQuery('#grid_cat_a:checked').val() !== undefined) {
		jQuery('.g_ca_no').show();
	}

	jQuery('#grid_cat_b').click(function() {
		jQuery('.g_cat_b_on').fadeToggle(400);
	});

	if (jQuery('#grid_cat_b:checked').val() !== undefined) {
		jQuery('.g_cat_b_on').show();
	}

	jQuery('#grid_cat_c').click(function() {
		jQuery('.g_cat_c_on').fadeToggle(400);
	});

	if (jQuery('#grid_cat_c:checked').val() !== undefined) {
		jQuery('.g_cat_c_on').show();
	}

	jQuery('#news').click(function() {
		jQuery('.news_no').fadeToggle(400);
	});
	if (jQuery('#news:checked').val() !== undefined) {
		jQuery('.news_no').show();
	}

	jQuery('#cms_special').click(function() {
		jQuery('.cms_special_on').fadeToggle(400);
	});
	if (jQuery('#cms_special:checked').val() !== undefined) {
		jQuery('.cms_special_on').show();
	}

	jQuery('#blog_special').click(function() {
		jQuery('.b_s_no').fadeToggle(400);
	});
	if (jQuery('#blog_special:checked').val() !== undefined) {
		jQuery('.b_s_no').show();
	}

	jQuery('#post_img').click(function() {
		jQuery('#section-post_img_n').fadeToggle(400);
	});
	if (jQuery('#post_img:checked').val() !== undefined) {
		jQuery('#section-post_img_n').show();
	}

	jQuery('#cms_widget_one').click(function() {
		jQuery('#section-cms_widget_one_s').fadeToggle(400);
	});

	if (jQuery('#cms_widget_one:checked').val() !== undefined) {
		jQuery('#section-cms_widget_one_s').show();
	}

	jQuery('#cms_filter_h').click(function() {
		jQuery('#section-cms_filter_s').fadeToggle(400);
	});
	if (jQuery('#cms_filter_h:checked').val() !== undefined) {
		jQuery('#section-cms_filter_s').show();
	}

	jQuery('#picture_box').click(function() {
		jQuery('.c_img_no').fadeToggle(400);
	});

	if (jQuery('#picture_box:checked').val() !== undefined) {
		jQuery('.c_img_no').show();
	}

	jQuery('#picture').click(function() {
		jQuery('#section-picture_id').fadeToggle(400);
	});

	if (jQuery('#picture:checked').val() !== undefined) {
		jQuery('#section-picture_id').show();
	}

	jQuery('#picture_post').click(function() {
		jQuery('#section-img_id').fadeToggle(400);
	});

	if (jQuery('#picture_post:checked').val() !== undefined) {
		jQuery('#section-img_id').show();
	}

	jQuery('#cms_widget_two').click(function() {
		jQuery('#section-cms_widget_two_s').fadeToggle(400);
	});
	if (jQuery('#cms_widget_two:checked').val() !== undefined) {
		jQuery('#section-cms_widget_two_s').show();
	}

	jQuery('#cat_one_5').click(function() {
		jQuery('#section-cat_one_5_id, #section-cat_one_5_s').fadeToggle(400);
	});

	if (jQuery('#cat_one_5:checked').val() !== undefined) {
		jQuery('#section-cat_one_5_id, #section-cat_one_5_s').show();
	}

	jQuery('#cat_one_on_img').click(function() {
		jQuery('.c_o_no').fadeToggle(400);
	});

	if (jQuery('#cat_one_on_img:checked').val() !== undefined) {
		jQuery('.c_o_no').show();
	}

	jQuery('#cat_one_10').click(function() {
		jQuery('.cat_one_10_on').fadeToggle(400);
	});

	if (jQuery('#cat_one_10:checked').val() !== undefined) {
		jQuery('.cat_one_10_on').show();
	}

	jQuery('#video_box').click(function() {
		jQuery('#section-video_n, #section-video_post, #section-video, #section-video_s').fadeToggle(400);
	});

	if (jQuery('#video_box:checked').val() !== undefined) {
		jQuery('#section-video_n, #section-video_post, #section-video, #section-video_s').show();
	}

	jQuery('#video').click(function() {
		jQuery('#section-video_id').fadeToggle(400);
	});

	if (jQuery('#video:checked').val() !== undefined) {
		jQuery('#section-video_id').show();
	}

	jQuery('#video_post').click(function() {
		jQuery('#section-video_post_id').fadeToggle(400);
	});

	if (jQuery('#video_post:checked').val() !== undefined) {
		jQuery('#section-video_post_id').show();
	}

	jQuery('#cat_small').click(function() {
		jQuery('.c_s_no').fadeToggle(400);
	});

	if (jQuery('#cat_small:checked').val() !== undefined) {
		jQuery('.c_s_no').show();
	}
	jQuery('#cat_lead').click(function() {
		jQuery('.c_l_no').fadeToggle(400);
	});

	if (jQuery('#cat_lead:checked').val() !== undefined) {
		jQuery('.c_l_no').show();
	}

	jQuery('#products_on').click(function() {
		jQuery('.p_on_on').fadeToggle(400);
	});

	if (jQuery('#products_on:checked').val() !== undefined) {
		jQuery('.p_on_on').show();
	}

	jQuery('#cat_square').click(function() {
		jQuery('.cat_square_on').fadeToggle(400);
	});

	if (jQuery('#cat_square:checked').val() !== undefined) {
		jQuery('.cat_square_on').show();
	}

	jQuery('#cat_grid').click(function() {
		jQuery('.cat_grid_on').fadeToggle(400);
	});

	if (jQuery('#cat_grid:checked').val() !== undefined) {
		jQuery('.cat_grid_on').show();
	}

	jQuery('#flexisel').click(function() {
		jQuery('.cms-owl-no').fadeToggle(400);
	});

	if (jQuery('#flexisel:checked').val() !== undefined) {
		jQuery('.cms-owl-no').show();
	}

	jQuery('#cat_big').click(function() {
		jQuery('.c_b_no').fadeToggle(400);
	});

	if (jQuery('#cat_big:checked').val() !== undefined) {
		jQuery('.c_b_no').show();
	}

	jQuery('#tao_h').click(function() {
		jQuery('.t_h_no').fadeToggle(400);
	});

	if (jQuery('#tao_h:checked').val() !== undefined) {
		jQuery('.t_h_no').show();
	}

	jQuery('#g_tao_h').click(function() {
		jQuery('.g_t_h_no').fadeToggle(400);
	});

	if (jQuery('#g_tao_h:checked').val() !== undefined) {
		jQuery('.g_t_h_no').show();
	}

	jQuery('#product_h').click(function() {
		jQuery('.product_h_on').fadeToggle(400);
	});

	if (jQuery('#product_h:checked').val() !== undefined) {
		jQuery('.product_h_on').show();
	}

	jQuery('#cat_big_not').click(function() {
		jQuery('.b_n_no').fadeToggle(400);
	});

	if (jQuery('#cat_big_not:checked').val() !== undefined) {
		jQuery('.b_n_no').show();
	}

	jQuery('#group_slider').click(function() {
		jQuery('.g_s_no').fadeToggle(400);
	});

	if (jQuery('#group_slider:checked').val() !== undefined) {
		jQuery('.g_s_no').show();
	}

	jQuery('#group_bulletin').click(function() {
		jQuery('.g_b_no').fadeToggle(400);
	});

	if (jQuery('#group_bulletin:checked').val() !== undefined) {
		jQuery('.g_b_no').show();
	}

	jQuery('#group_contact').click(function() {
		jQuery('.contact_no').fadeToggle(400);
	});

	if (jQuery('#group_contact:checked').val() !== undefined) {
		jQuery('.contact_no').show();
	}

	jQuery('#dean').click(function() {
		jQuery('.de_no').fadeToggle(400);
	});

	if (jQuery('#dean:checked').val() !== undefined) {
		jQuery('.de_no').show();
	}

	jQuery('#group_tool').click(function() {
		jQuery('.tool_no').fadeToggle(400);
	});

	if (jQuery('#group_tool:checked').val() !== undefined) {
		jQuery('.tool_no').show();
	}

	jQuery('#group_products').click(function() {
		jQuery('.pr_no').fadeToggle(400);
	});

	if (jQuery('#group_products:checked').val() !== undefined) {
		jQuery('.pr_no').show();
	}

	jQuery('#service').click(function() {
		jQuery('.se_no').fadeToggle(400);
	});

	if (jQuery('#service:checked').val() !== undefined) {
		jQuery('.se_no').show();
	}

	jQuery('#g_product').click(function() {
		jQuery('.woo_no').fadeToggle(400);
	});
	if (jQuery('#g_product:checked').val() !== undefined) {
		jQuery('.woo_no').show();
	}

	jQuery('#group_features').click(function() {
		jQuery('.g_f_no').fadeToggle(400);
	});

	if (jQuery('#group_features:checked').val() !== undefined) {
		jQuery('.g_f_no').show();
	}

	jQuery('#group_wd').click(function() {
		jQuery('.group_wd_on').fadeToggle(400);
	});
	if (jQuery('#group_wd:checked').val() !== undefined) {
		jQuery('.group_wd_on').show();
	}

	jQuery('#group_ico').click(function() {
		jQuery('.g_ico_on').fadeToggle(400);
	});

	if (jQuery('#group_ico:checked').val() !== undefined) {
		jQuery('.g_ico_on').show();
	}

	jQuery('#group_explain').click(function() {
		jQuery('.g_e_on').fadeToggle(400);
	});
	if (jQuery('#group_explain:checked').val() !== undefined) {
		jQuery('.g_e_on').show();
	}

	jQuery('#group_widget_one').click(function() {
		jQuery('#section-group_widget_one_s, #section-bg_10').fadeToggle(400);
	});
	if (jQuery('#group_widget_one:checked').val() !== undefined) {
		jQuery('#section-group_widget_one_s, #section-bg_10').show();
	}

	jQuery('#group_new').click(function() {
		jQuery('.g_new_on').fadeToggle(400);
	});
	if (jQuery('#group_new:checked').val() !== undefined) {
		jQuery('.g_new_on').show();
	}

	jQuery('#group_widget_three').click(function() {
		jQuery('.g_w_t').fadeToggle(400);
	});
	if (jQuery('#group_widget_three:checked').val() !== undefined) {
		jQuery('.g_w_t').show();
	}

	jQuery('#group_cat_a').click(function() {
		jQuery('.g_c_a_on').fadeToggle(400);
	});
	if (jQuery('#group_cat_a:checked').val() !== undefined) {
		jQuery('.g_c_a_on').show();
	}

	jQuery('#group_widget_two').click(function() {
		jQuery('.g_wt_on').fadeToggle(400);
	});
	if (jQuery('#group_widget_two:checked').val() !== undefined) {
		jQuery('.g_wt_on').show();
	}

	jQuery('#group_cat_b').click(function() {
		jQuery('.g_c_b_on').fadeToggle(400);
	});

	if (jQuery('#group_cat_b:checked').val() !== undefined) {
		jQuery('.g_c_b_on').show();
	}

	jQuery('#group_tab').click(function() {
		jQuery('.g_tab_hide').fadeToggle(400);
	});

	if (jQuery('#group_tab:checked').val() !== undefined) {
		jQuery('.g_tab_hide').show();
	}

	jQuery('#group_cat_c').click(function() {
		jQuery('.g_c_on').fadeToggle(400);
	});

	if (jQuery('#group_cat_c:checked').val() !== undefined) {
		jQuery('.g_c_on').show();
	}

	jQuery('#group_carousel').click(function() {
		jQuery('.g_owl_hide').fadeToggle(400);
	});

	if (jQuery('#group_carousel:checked').val() !== undefined) {
		jQuery('.g_owl_hide').show();
	}

	jQuery('#keyword_link').click(function() {
		jQuery('.k_l_on').fadeToggle(400);
	});

	if (jQuery('#keyword_link:checked').val() !== undefined) {
		jQuery('.k_l_on').show();
	}

	jQuery('#front_tougao').click(function() {
		jQuery('.f_t_on').fadeToggle(400);
	});

	if (jQuery('#front_tougao:checked').val() !== undefined) {
		jQuery('.f_t_on').show();
	}

	jQuery('#qq_online').click(function() {
		jQuery('.q_no').fadeToggle(400);
	});

	if (jQuery('#qq_online:checked').val() !== undefined) {
		jQuery('.q_no').show();
	}

	jQuery('#single_weixin').click(function() {
		jQuery('.s_w_no').fadeToggle(400);
	});

	if (jQuery('#single_weixin:checked').val() !== undefined) {
		jQuery('.s_w_no').show();
	}

	jQuery('#ad_h_t').click(function() {
		jQuery('#section-ad_ht_c, #section-ad_ht_m, #section-ad_h_t_h').fadeToggle(400);
	});

	if (jQuery('#ad_h_t:checked').val() !== undefined) {
		jQuery('#section-ad_ht_c, #section-ad_ht_m, #section-ad_h_t_h').show();
	}

	jQuery('#ad_h').click(function() {
		jQuery('#section-ad_h_c, #section-ad_h_c_m, #section-ad_h_c_x, #section-ad_h_cr, #section-ad_h_h').fadeToggle(400);
	});
	if (jQuery('#ad_h:checked').val() !== undefined) {
		jQuery('#section-ad_h_c, #section-ad_h_c_m, #section-ad_h_c_x, #section-ad_h_cr, #section-ad_h_h').show();
	}

	jQuery('#ad_s').click(function() {
		jQuery('#section-ad_s_c, #section-ad_s_c_m').fadeToggle(400);
	});
	if (jQuery('#ad_s:checked').val() !== undefined) {
		jQuery('#section-ad_s_c, #section-ad_s_c_m').show();
	}

	jQuery('#ad_a').click(function() {
		jQuery('#section-ad_a_c, #section-ad_a_c_m').fadeToggle(400);
	});
	if (jQuery('#ad_a:checked').val() !== undefined) {
		jQuery('#section-ad_a_c, #section-ad_a_c_m').show();
	}

	jQuery('#ad_s_b').click(function() {
		jQuery('#section-ad_s_c_b, #section-ad_s_c_b_m').fadeToggle(400);
	});
	if (jQuery('#ad_s_b:checked').val() !== undefined) {
		jQuery('#section-ad_s_c_b, #section-ad_s_c_b_m').show();
	}

	jQuery('#ad_c').click(function() {
		jQuery('#section-ad_c_c, #section-ad_c_c_m').fadeToggle(400);
	});
	if (jQuery('#ad_c:checked').val() !== undefined) {
		jQuery('#section-ad_c_c, #section-ad_c_c_m').show();
	}

	jQuery('#bulletin').click(function() {
		jQuery('#section-bulletin_id, .bulletin_id, #section-bulletin_n').fadeToggle(400);
	});
	if (jQuery('#bulletin:checked').val() !== undefined) {
		jQuery('#section-bulletin_id, .bulletin_id, #section-bulletin_n').show();
	}

	jQuery('#wp_s').click(function() {
		jQuery('.wp_s_no').fadeToggle(400);
	});
	if (jQuery('#wp_s:checked').val() !== undefined) {
		jQuery('.wp_s_no').show();
	}

	jQuery('#wp_title').click(function() {
		jQuery('.seo_no').fadeToggle(400);
	});
	if (jQuery('#wp_title:checked').val() !== undefined) {
		jQuery('.seo_no').show();
	}

	jQuery('#filters').click(function() {
		jQuery('.fil_no').fadeToggle(400);
	});
	if (jQuery('#filters:checked').val() !== undefined) {
		jQuery('.fil_no').show();
	}

	jQuery('#header_normal').click(function() {
		jQuery('#section-header_contact, #section-menu_full, #section-top_bg').fadeToggle(400);
	});
	if (jQuery('#header_normal:checked').val() !== undefined) {
		jQuery('#section-header_contact, #section-menu_full, #section-top_bg').show();
	}

	jQuery('#menu_post').click(function() {
		jQuery('.m_p_no').fadeToggle(400);
	});
	if (jQuery('#menu_post:checked').val() !== undefined) {
		jQuery('.m_p_no').show();
	}

	jQuery('#nav_cat').click(function() {
		jQuery('#section-nav_cat_my, #section-nav_cat_md, #section-nav_cat_e_id').fadeToggle(400);
	});
	if (jQuery('#nav_cat:checked').val() !== undefined) {
		jQuery('#section-nav_cat_my, #section-nav_cat_md, #section-nav_cat_e_id').show();
	}

	jQuery('#random_avatars').click(function() {
		jQuery('#section-random_avatars_url').fadeToggle(400);
	});

	if (jQuery('#random_avatars:checked').val() !== undefined) {
		jQuery('#section-random_avatars_url').show();
	}

	jQuery('#copyright').click(function() {
		jQuery('.cr_no').fadeToggle(400);
	});

	if (jQuery('#copyright:checked').val() !== undefined) {
		jQuery('.cr_no').show();
	}

	jQuery('#tag_c').click(function() {
		jQuery('#section-chain_n').fadeToggle(400);
	});

	if (jQuery('#tag_c:checked').val() !== undefined) {
		jQuery('#section-chain_n').show();
	}

	jQuery('#cat_des').click(function() {
		jQuery('.c_d_on').fadeToggle(400);
	});

	if (jQuery('#cat_des:checked').val() !== undefined) {
		jQuery('.c_d_on').show();
	}

	jQuery('#grid_ico_cms').click(function() {
		jQuery('.g_ico_c_on').fadeToggle(400);
	});

	if (jQuery('#grid_ico_cms:checked').val() !== undefined) {
		jQuery('.g_ico_c_on').show();
	}

	jQuery('#cms_tool').click(function() {
		jQuery('#section-cms_tool_s').fadeToggle(400);
	});

	if (jQuery('#cms_tool:checked').val() !== undefined) {
		jQuery('#section-cms_tool_s').show();
	}

	jQuery('#post_meta_inf').click(function() {
		jQuery('.p_m_no').fadeToggle(400);
	});

	if (jQuery('#post_meta_inf:checked').val() !== undefined) {
		jQuery('.p_m_no').show();
	}

	jQuery('#comment_related').click(function() {
		jQuery('.pl_no').fadeToggle(400);
	});

	if (jQuery('#comment_related:checked').val() !== undefined) {
		jQuery('.pl_no').show();
	}

	jQuery('#group_post').click(function() {
		jQuery('#section-group_post_s, #section-bg_21, #section-group_post_id').fadeToggle(400);
	});

	if (jQuery('#group_post:checked').val() !== undefined) {
		jQuery('#section-group_post_s, #section-bg_21, #section-group_post_id').show();
	}

	jQuery('.options-caid').click(function() {
		jQuery('.catid-list').fadeToggle(400);
	});

	if (jQuery('.options-caid:checked').val() !== undefined) {
		jQuery('.catid-list').show();
	}

	jQuery('.type-caid').click(function() {
		jQuery('.type-catid-list').fadeToggle(400);
	});

	if (jQuery('.type-caid:checked').val() !== undefined) {
		jQuery('.type-catid-list').show();
	}

	jQuery('.special-id').click(function() {
		jQuery('.special-id-list').fadeToggle(400);
	});

	if (jQuery('.special-id:checked').val() !== undefined) {
		jQuery('.special-id-list').show();
	}

	jQuery('#follow_button').click(function() {
		jQuery('.s_l_no').fadeToggle(400);
	});

	if (jQuery('#follow_button:checked').val() !== undefined) {
		jQuery('.s_l_no').show();
	}

	jQuery('#h_cat_cover').click(function() {
		jQuery('.h_cover_no').fadeToggle(400);
	});

	if (jQuery('#h_cat_cover:checked').val() !== undefined) {
		jQuery('.h_cover_no').show();
	}

	jQuery('#setup_email_show').click(function() {
		jQuery('.s_e_no').fadeToggle(400);
	});

	if (jQuery('#setup_email_show:checked').val() !== undefined) {
		jQuery('.s_e_no').show();
	}

	jQuery('#contact_us').click(function() {
		jQuery('.c_u_no').fadeToggle(400);
	});

	if (jQuery('#contact_us:checked').val() !== undefined) {
		jQuery('.c_u_no').show();
	}

	jQuery('#ajax_tabs').click(function() {
		jQuery('.a_t_no').fadeToggle(400);
	});

	if (jQuery('#ajax_tabs:checked').val() !== undefined) {
		jQuery('.a_t_no').show();
	}

	jQuery('#cache_avatar').click(function() {
		jQuery('#section-avatar_sm, #section-avatar_url, #section-random_avatar_url').fadeToggle(400);
	});

	if (jQuery('#cache_avatar:checked').val() !== undefined) {
		jQuery('#section-avatar_sm, #section-avatar_url, #section-random_avatar_url').show();
	}

	jQuery('#social_login').click(function() {
		jQuery('.social_hide').fadeToggle(400);
	});

	if (jQuery('#social_login:checked').val() !== undefined) {
		jQuery('.social_hide').show();
	}

	jQuery('#letter_show').click(function() {
		jQuery('.letter_no').fadeToggle(400);
	});

	if (jQuery('#letter_show:checked').val() !== undefined) {
		jQuery('.letter_no').show();
	}

	jQuery('#group_img').click(function() {
		jQuery('.g_i_no').fadeToggle(400);
	});

	if (jQuery('#group_img:checked').val() !== undefined) {
		jQuery('.g_i_no').show();
	}

	jQuery('#wechat_unite').click(function() {
		jQuery('.wei_no').fadeToggle(400);
	});

	if (jQuery('#wechat_unite:checked').val() !== undefined) {
		jQuery('.wei_no').show();
	}

	jQuery('#ie_browser_tips').click(function() {
		jQuery('.brtxt').fadeToggle(400);
	});

	if (jQuery('#ie_browser_tips:checked').val() !== undefined) {
		jQuery('.brtxt').show();
	}

	jQuery('#login_link').click(function() {
		jQuery('.t_l').fadeToggle(400);
	});

	if (jQuery('#login_link:checked').val() !== undefined) {
		jQuery('.t_l').show();
	}

	jQuery('#redirect_login').click(function() {
		jQuery('.r_l').fadeToggle(400);
	});

	if (jQuery('#redirect_login:checked').val() !== undefined) {
		jQuery('.r_l').show();
	}

	jQuery('#child_cat').click(function() {
		jQuery('#section-child_cat_no').fadeToggle(400);
	});

	if (jQuery('#child_cat:checked').val() !== undefined) {
		jQuery('#section-child_cat_no').show();
	}

	jQuery('#thumb_bl').click(function() {
		jQuery('.bl').fadeToggle(400);
	});

	if (jQuery('#thumb_bl:checked').val() !== undefined) {
		jQuery('.bl').show();
	}
});

jQuery(document).ready(function($) {
	$('#section-qq_id_url a, #section-weibo_key_url a, #section-keyword_link_settings a, #section-sitemap_xml a, #section-sitemap_txt a, #section-iconfont_cn a, #section-setup_views a, #section-add_invitation a').attr({target: "_blank"});
});
</script>

<?php
}