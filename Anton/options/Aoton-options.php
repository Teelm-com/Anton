<?php

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

function optionsframework_options() {

	$blogpath =  get_stylesheet_directory_uri() . '/assets/images';
	$bloghome =  home_url( '/' );

	$options_categories = array();
	$options_categories_obj = get_categories(array('hide_empty' => 0));
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	$categories = get_categories(array('taxonomy' => 'product_cat', 'hide_empty' => 0)); 
	foreach ($categories as $cat) {
	$catr_id .= '<li>'.$cat->cat_name.' [ '.$cat->cat_ID.' ]</li>';
	}

	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = '选择页面:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	$custom_slider = array();
	$custom_slider_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$custom_slider[''] = '选择页面:';
	foreach ( $custom_slider_obj as $page ) {
		$sliders[$page->ID] = $page->post_title;
	}
	$test_array = array(
		'' => '中',
		't' => '上',
		'b' => '下',
		'l' => '左',
		'r' => '右'
	);

	$rand_link = array(
		'rating' => '正常',
		'rand' => '随机'
	);

	$inks_img_txt = array(
		'0' => '文字',
		'1' => '图片'
	);

	$grid_ico_cms_n = array(
		'2' => '两栏',
		'4' => '四栏',
		'' => '六栏',
		'8' => '八栏'
	);

	$grid_ico_group_n = array(
		'2' => '两栏',
		'4' => '四栏',
		'' => '六栏',
		'8' => '八栏'
	);

	$cms_widget_three_fl = array(
		'1' => '1栏',
		'2' => '2栏',
		'3' => '3栏',
		'4' => '4栏'
	);

	$cms_widget_three_fl = array(
		'1' => '1栏',
		'2' => '2栏',
		'3' => '3栏',
		'4' => '4栏'
	);

	$grid_new_f = array(
		'4' => '4栏',
		'5' => '5栏',
		'6' => '6栏'
	);

	$grid_cat_a_f = array(
		'4' => '4栏',
		'5' => '5栏',
		'6' => '6栏'
	);

	$grid_cat_b_f = array(
		'4' => '4栏',
		'5' => '5栏',
		'6' => '6栏'
	);

	$grid_cat_c_f = array(
		'4' => '4栏',
		'5' => '5栏',
		'6' => '6栏'
	);

	$items_f = array(
		'4' => '4栏',
		'5' => '5栏',
		'6' => '6栏'
	);

	$img_top_f = array(
		'4' => '4栏',
		'5' => '5栏',
		'6' => '6栏'
	);

	$img_f = array(
		'4' => '4栏',
		'5' => '5栏',
		'6' => '6栏'
	);

	$cover_f = array(
		'4' => '4栏',
		'5' => '5栏',
		'6' => '6栏'
	);

	$special_f = array(
		'4' => '4栏',
		'5' => '5栏',
		'6' => '6栏'
	);

	$options = array();

	// 首页设置

	$options[] = array(
		'name' => '首页设置',
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => '首页幻灯',
		'desc' => '显示（注：至少添加两张幻灯片）',
		'id' => 'slider',
		'class' => 'be_ico',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义排序，需给幻灯中的文章添加排序编号',
		'id' => 'show_order',
		'std' => '0',
		'class' => '',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '幻灯显示篇数',
		'id' => 'slider_n',
		'std' => '2',
		'class' => 'mini',
		'type' => 'text'
	);
	
	$options[] = array(
		'name' => '',
		'desc' => '显示首页置顶文章',
		'id' => 'top_slider',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '置顶文章显示篇数',
		'id' => 'top_slider_n',
		'std' => '8',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '文章列表截断字数',
		'desc' => '自动截断字数，默认值：100',
		'id' => 'words_n',
		'std' => '100',
		'class' => 'mini be_ico',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '摘要截断字数，默认值：90',
		'id' => 'word_n',
		'std' => '90',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '博客布局排除的分类文章',
		'desc' => '输入排除的分类ID，多个分类用英文半角逗号","隔开',
		'id' => 'not_cat_n',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '侧边栏跟随滚动',
		'id' => 'sidebar_sticky',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '上传亮色Logo',
		'desc' => '透明png或svg图片最佳，比例 370×85px',
		'id' => 'logo',
		'class' => 'be_ico rr',
		"std" => "$blogpath/logo-light.png",
		'type' => 'upload'
	);

	$options[] = array(
		'name' => '上传暗色Logo',
		'desc' => '透明png或svg图片最佳，比例 370×85px；移动端使用',
		'id' => 'logo_small',
		"std" => "$blogpath/logo.png",
		'type' => 'upload'
	);

	$options[] = array(
		'name' => '上传Favicon',
		'desc' => '透明png或svg图片最佳，比例 50×50px',
		'id' => 'favicon',
		"std" => "$blogpath/favicon.png",
		'type' => 'upload'
	);
	
	$options[] = array(
		'name' => '',
		'desc' => '移动端不显示侧栏小工具',
		'id' => 'sidebar_no',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '是否使用自定义分类文章',
		'desc' => '公告',
		'id' => 'no_bulletin',
		'class' => 'be_ico',
		'std' => '1',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => '',
		'desc' => '显示公告',
		'id' => 'notiviation',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '自定义公告固定链接前缀',
		'desc' => '“公告”固定链接前缀',
		'id' => 'bull_url',
		'class' => 'be_ico',
		'std' => 'bulletin',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '“公告分类”固定链接前缀',
		'id' => 'bull_cat_url',
		'std' => 'notice',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '公告分类文章',
		'desc' => '输入公告分类ID，多个分类用英文半角逗号","隔开',
		'id' => 'notiviation_id',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '更新站点地图txt格式，查看：<a href="' . home_url() . '/sitemap.txt">sitemap.txt</a>',
		'id' => 'sitemap_txt',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '更新文章数，输入“-1”为全部',
		'id' => 'sitemap_n',
		'std' => '100',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '包括标签',
		'id' => 'no_sitemap_tag',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '登录验证码',
		'desc' => '启用干扰图形验证码',
		'id' => 'login_captcha',
		'class' => 'be_ico',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '启用注册',
		'desc' => '',
		'id' => 'register',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '启用注册协议',
		'desc' => '',
		'id' => 'register_policy',
		'std' => '0',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => '启用注册验证码',
		'id' => 'captcha',
		'std' => 'none',
		'type' => 'radio',
		'options' => array(
			'none'  => '不启用启用',
			'image' => '启用干扰图形验证码',
			'email' => '启用邮箱数字验证码(需要主机支持邮件发送，请先配置)',
		)
	);

	$options[] = array(
		'name' => '',
		'desc' => '替换wordpress默认登录页',
		'id' => 'redirect_login_page',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '海报',
		'desc' => '',
		'id' => 'poster',
		'class' => 'be_ico',
		'std' => '0',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '',
		'desc' => '上传海报logo',
		'id' => 'poster_logo',
        "std" => "$blogpath/favicon.png",
		'type' => 'upload'
	);
	$options[] = array(
		'name' => '',
		'desc' => '上传海报默认图片',
		'id' => 'poster_img',
        "std" => "https://s1.ax1x.com/2020/10/25/BmKDC4.jpg",
		'type' => 'upload'
	);
	$options[] = array(
		'name' => '打赏',
		'desc' => '',
		'id' => 'give',
		'class' => 'be_ico',
		'std' => '0',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '打赏二维码',
		'desc' => '上传微信收款二维码',
		'id' => 'qr_w',
		"std" => "$blogpath/favicon.png",
		'type' => 'upload'
	);
	$options[] = array(
		'name' => '',
		'desc' => '上传支付宝收款二维码',
		'id' => 'qr_a',
		"std" => "$blogpath/favicon.png",
		'type' => 'upload'
	);
	$options[] = array(
		'name' => '',
		'desc' => '点赞',
		'id' => 'praise',
		'std' => '0',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '',
		'desc' => '收藏',
		'id' => 'favorites',
		'std' => '0',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '',
		'desc' => '分享',
		'id' => 'share',
		'std' => '0',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => '',
		'desc' => '打印',
		'id' => 'print',
		'std' => '0',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => '',
		'desc' => '链接复制',
		'id' => 'link_copy',
		'std' => '0',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => '',
		'desc' => '文章底部hitokoto',
		'id' => 'hitokoto',
		'std' => '0',
		'type' => 'checkbox'
	);

	
	// 基本设置

	$options[] = array(
		'name' => '配置授权',
		'type' => 'heading'
	);

	$options[] = array(
		'name' => '配置SMTP',
		'desc' => '启用',
		'id' => 'setup_email_smtp',
		'class' => 's_e_no',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '发件人名称',
		'id' => 'email_name',
		'class' => 's_e_no',
		'std' => '来自网站',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '邮箱SMTP服务器',
		'id' => 'email_smtp',
		'class' => 's_e_no',
		'std' => 'smtp.exmail.qq.com',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '邮箱账户',
		'id' => 'email_account',
		'class' => 's_e_no',
		'std' => 'service@teelm.com',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '客户端授权密码 ( 不是邮箱登录密码 )',
		'id' => 'email_authorize',
		'class' => 's_e_no',
		'std' => 'jii4zM8FexBepjtB',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '短信登录',
		'desc' => '支持阿里云短信验证服务',
		'id' => 'sms_login',
		'std' => '0',
		'type' => 'checkbox'
	);
	

	$options[] = array(
		'name' => '',
		'desc' => 'accessKeyId',
		'id' => 'oauth_aliyun_access_id',
		'class' => 's_e_non',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => 'accessKeySecret',
		'id' => 'oauth_aliyun_access_secret',
		'class' => 's_e_no',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => 'signName',
		'id' => 'oauth_aliyun_sms_sign',
		'class' => 's_e_no',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => 'templateCode',
		'id' => 'oauth_aliyun_sms_temp',
		'class' => 's_e_no',
		'std' => '',
		'type' => 'text'
	);
	
	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '社会化登录',
	);

	$options[] = array(
		'name' => '第三方登录',
		'desc' => 'QQ、微博等社交登录',
		'id' => 'social_login',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => 'QQ',
		'desc' => '启用',
		'id' => 'qq_login',
		'class' => 'social_hide hidden hidden',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'desc' => '申请地址：<a href="https://connect.qq.com/" title="申请地址">https://connect.qq.com</a>',
		'id' => 'qq_id_url',
		'class' => 'social_hide social_sm hidden'
	);
	
	$options[] = array(
		'desc' => '网站回调域(注意是否带`s`)：'.$bloghome.'oauth/qq/callback.php',
		'id' => 'qq_id_auth',
		'class' => 'social_hide social_sm hidden'
	);

	$options[] = array(
		'name' => '',
		'desc' => 'QQ APP ID',
		'id' => 'qq_id',
		'class' => 'social_hide hidden',
		'std' => '123',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => 'QQ APP Key',
		'id' => 'qq_key',
		'class' => 'social_hide hidden',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '微博',
		'desc' => '启用',
		'id' => 'weibo_login',
		'class' => 'social_hide hidden',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'desc' => '申请地址：<a href="https://open.weibo.com/" title="申请地址">https://open.weibo.com</a>',
		'id' => 'weibo_key_url',
		'class' => 'social_hide social_sm hidden'
	);

	$options[] = array(
		'desc' => '应用地址(注意是否带`s`)：'.$bloghome.'oauth/qq/callback.php',
		'id' => 'weibo_key_auth',
		'class' => 'social_hide social_sm hidden'
	);

	$options[] = array(
		'name' => '',
		'desc' => '微博 App Key',
		'id' => 'weibo_key',
		'class' => 'social_hide hidden',
		'std' => '123',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '微博 App Secret',
		'id' => 'weibo_secret',
		'class' => 'social_hide hidden',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '微信',
		'desc' => '启用',
		'id' => 'weixin_login',
		'class' => 'social_hide hidden',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'desc' => '申请地址：<a href="https://open.weixin.qq.com/" title="申请地址">https://open.weixin.qq.com</a>',
		'id' => 'weibo_key_url',
		'class' => 'social_hide social_sm hidden'
	);

	$options[] = array(
		'name' => '',
		'desc' => '微信 APP ID',
		'id' => 'weixin_id',
		'class' => 'social_hide hidden',
		'std' => '123',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '微信 App Secret',
		'id' => 'weixin_secret',
		'class' => 'social_hide hidden',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '登录后跳转的地址',
		'desc' => '比如网站首页链接,默认不需要修改',
		'id' => 'social_login_url',
		'class' => 'social_hide',
		'std' => $bloghome,
		'type' => 'text'
	);	

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '百度收录',
		'desc' => '百度普通token',
		'id' => 'link_token',
		'class' => 'be_ico',
		'std' => 'xxxxxxxx',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '百度快速token',
		'id' => 'daily_token',
		'std' => 'xxxxxxxx',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);
	
	// 友情链接设置
	$options[] = array(
		'name' => '友情链接',
		'type' => 'heading'
	);

	$options[] = array(
		'name' => '首页页脚链接',
		'desc' => '显示',
		'id' => 'footer_link',
		'class' => 'be_ico',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '可以输入链接分类ID，显示特定的链接在首页，留空则显示全部链接',
		'id' => 'link_f_cat',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '显示网站Favicon图标',
		'id' => 'home_link_ico',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '图片链接',
		'id' => 'footer_img',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '移动端不显示',
		'id' => 'footer_link_no',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '更多链接按钮',
		'desc' => '选择友情链接页面',
		'id' => 'link_url',
		'type' => 'select',
		'class' => 'mini',
		'options' => $options_pages
	);

	$options[] = array(
		'id' => 'clear'
	);
	
	$options[] = array(
		'name' => '友情链接页面',
		'desc' => '自助友情链接',
		'id' => 'add_link',
		'class' => 'be_ico',
		'std' => '1',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => '',
		'desc' => '自助友情链接申请bing背景图',
		'id' => 'link_bing',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '显示模式',
		'id' => 'links_model',
		'std' => 'links_ico',
		'class' => 'news_no hidden rr',
		'type' => 'radio',
		'options' => array(
			'links_ico' => '图标模式',
			'links_default' => '默认模式',
		)
	);

	$options[] = array(
		'name' => '图标模式选择',
		'desc' => '',
		'id' => 'link_favicon',
		'class' => 'rr',
		'std' => 'first_ico',
		'type' => 'radio',
		'options' => array(
			'favicon_ico' => 'Favicon图标',
			'first_ico' => '首字图标',
		)
	);

	$options[] = array(
		'name' => '图标模式排序',
		'desc' => '',
		'id' => 'rand_link',
		'class' => 'rr',
		'std' => 'rating',
		'type' => 'radio',
		'options' => $rand_link
	);

	$options[] = array(
		'name' => '默认模式选择',
		'desc' => '',
		'id' => 'links_img_txt',
		'class' => 'rr',
		'std' => '0',
		'type' => 'radio',
		'options' => $inks_img_txt
	);

	$options[] = array(
		'name' => '排除的链接',
		'desc' => '输入排除的链接ID，多个ID用","隔开',
		'id' => 'link_cat',
		'class' => '',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '链接Favicon图标API',
		'desc' => '输入获取链接favicon图标API地址',
		'id' => 'favicon_api',
		'class' => '',
		'std' => 'https://tool.bitefu.net/ico/?url=',
		'type' => 'textarea'
	);

	// SEO设置

	$options[] = array(
		'name' => 'SEO',
		'type' => 'heading'
	);

	$options[] = array(
		'name' => '站点SEO',
		'desc' => '启用主题自带SEO功能，如使用其它SEO插件，请取消勾选',
		'id' => 'wp_title',
		'class' => 'be_ico',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '显示OG协议标签',
		'id' => 'og_title',
		'class' => 'seo_no hidden',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '首页描述（Description）',
		'desc' => '',
		'id' => 'description',
		'class' => 'seo_no hidden',
		'std' => '一般不超过200个字符',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '首页关键词（KeyWords）',
		'desc' => '',
		'id' => 'keyword',
		'class' => 'seo_no hidden',
		'std' => '一般不超过100个字符',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '自定义网站首页title',
		'desc' => '留空则不显示自定义title',
		'id' => 'home_title',
		'class' => 'seo_no hidden',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '自定义网站首页副标题',
		'desc' => '留空则不显示副标题',
		'id' => 'home_info',
		'class' => 'seo_no hidden',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '',
		'desc' => '首页显示站点副标题',
		'id' => 'blog_info',
		'class' => 'seo_no hidden',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '文章title无网站名称',
		'id' => 'blog_name',
		'class' => 'seo_no hidden',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '修改站点分隔符',
		'id' => 'connector',
		'std' => '|',
		'class' => 'seo_no mini hidden',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '分隔符无空格',
		'id' => 'blank_connector',
		'class' => 'seo_no hidden',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '自定义404页面标题',
		'desc' => '',
		'id' => '404_t',
		'class' => 'be_ico',
		'std' => '亲，你迷路了！',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '页脚版权信息',
		'desc' => '版权声明',
		'id' => 'copyright',
		'class' => 'be_ico',
		'std' => '© 2020 <strong><a href="https://miget.net">Anton主题</a></strong>. All Rights Reserved.',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '',
		'desc' => 'ICP备案号',
		'id' => 'icp',
		'std' => '渝ICP备17000488号',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	// 广告设置

	$options[] = array(
		'name' => '广告位',
		'type' => 'heading'
	);

	$options[] = array(
		'name' => '评论框上方广告位',
		'desc' => '显示',
		'id' => 'commentsad',
		'class' => 'be_ico',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '评论框上方广告代码（PC端）',
		'desc' => '宽度大于等于 1080px',
		'id' => 'comments_ad_pc',
		'std' => '<a href="#" target="_blank"><img src="https://pan.teelm.com/api/v3/file/get/51/ad.jpg?sign=ac3Ab8-NPEPLb0mFaOaVj31lWenVBafDNbdOMACLVdQ%3D%3A0" alt="广告"></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '评论框上方广告代码（移动端）',
		'desc' => '宽度大于等于 1080px',
		'id' => 'comments_ad_m',
		'std' => '<a href="#" target="_blank"><img src="https://pan.teelm.com/api/v3/file/get/51/ad.jpg?sign=ac3Ab8-NPEPLb0mFaOaVj31lWenVBafDNbdOMACLVdQ%3D%3A0" alt="广告"></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '文章页上方广告位',
		'desc' => '显示',
		'id' => 'articlead',
		'class' => 'be_ico',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '文章页上方广告代码（PC端）',
		'desc' => '宽度大于等于 1080px',
		'id' => 'article_ad_pc',
		'std' => '<a href="#" target="_blank"><img src="https://pan.teelm.com/api/v3/file/get/51/ad.jpg?sign=ac3Ab8-NPEPLb0mFaOaVj31lWenVBafDNbdOMACLVdQ%3D%3A0" alt="广告"></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '文章页上方广告代码（移动端）',
		'desc' => '宽度大于等于 1080px',
		'id' => 'article_ad_m',
		'std' => '<a href="#" target="_blank"><img src="https://pan.teelm.com/api/v3/file/get/51/ad.jpg?sign=ac3Ab8-NPEPLb0mFaOaVj31lWenVBafDNbdOMACLVdQ%3D%3A0" alt="广告"></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '文章列表广告位',
		'desc' => '显示',
		'id' => 'listad',
		'class' => 'be_ico',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '文章页列表广告代码（PC端）',
		'desc' => '宽度大于等于 1080px',
		'id' => 'list_ad_pc',
		'std' => '<a href="#" target="_blank"><img src="https://pan.teelm.com/api/v3/file/get/51/ad.jpg?sign=ac3Ab8-NPEPLb0mFaOaVj31lWenVBafDNbdOMACLVdQ%3D%3A0" alt="广告"></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '文章页上方广告代码（移动端）',
		'desc' => '宽度大于等于 1080px',
		'id' => 'list_ad_m',
		'std' => '<a href="#" target="_blank"><img src="https://pan.teelm.com/api/v3/file/get/51/ad.jpg?sign=ac3Ab8-NPEPLb0mFaOaVj31lWenVBafDNbdOMACLVdQ%3D%3A0" alt="广告"></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '搜索页广告位',
		'desc' => '显示',
		'id' => 'searchad',
		'class' => 'be_ico',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '搜索页广告代码（PC端）',
		'desc' => '宽度大于等于 1080px',
		'id' => 'search_ad_pc',
		'std' => '<a href="#" target="_blank"><img src="https://pan.teelm.com/api/v3/file/get/51/ad.jpg?sign=ac3Ab8-NPEPLb0mFaOaVj31lWenVBafDNbdOMACLVdQ%3D%3A0" alt="广告"></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '搜索页广告代码（移动端）',
		'desc' => '宽度大于等于 1080px',
		'id' => 'search_ad_m',
		'std' => '<a href="#" target="_blank"><img src="https://pan.teelm.com/api/v3/file/get/51/ad.jpg?sign=ac3Ab8-NPEPLb0mFaOaVj31lWenVBafDNbdOMACLVdQ%3D%3A0" alt="广告"></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'id' => 'clear'
	);

	return $options;
}