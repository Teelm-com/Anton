<?php
//加载功能
require THEME_DIR . '/inc/copyright.php';
//非管理员重定向到用户页面
if ( is_admin() && ( !defined( 'DOING_AJAX' ) || !DOING_AJAX ) ) {
	$current_user = wp_get_current_user();
	if($current_user->roles[0] == get_option('default_role')) {
		wp_safe_redirect( get_permalink(aotonThemes_page('pages/user.php')) );
		exit();
	}
}
// 修改搜索URL
function change_search_url_rewrite() {
	if ( is_search() && ! empty( $_GET['s'] ) ) {
		wp_redirect( home_url( '/search/' ) . urlencode( get_query_var( 's' ) ) . '/');
		exit();
	}
}
add_action( 'template_redirect', 'change_search_url_rewrite' );
// 搜索跳转
add_action('template_redirect', 'redirect_search_post');
function redirect_search_post() {
	if (is_search()) {
		global $wp_query;
		if ($wp_query->post_count == 1 && $wp_query->max_num_pages == 1) {
			wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
			exit;
		}
	}
}
// 字数统计 用法：<?php echo word_num();
function word_num () {
	global $post;
	$text_num = mb_strlen(preg_replace('/\s/','',html_entity_decode(strip_tags($post->post_content))),'UTF-8');
	return $text_num;
}
// 分类优化
function aoton_category() {
	$category = get_the_category();
	if(@$category[0]){
	echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
	}
}
// 索引
function aoton_get_current_count() {
	global $wpdb;
	$current_post = get_the_ID();
	$query = "SELECT post_id, meta_value, post_status FROM $wpdb->postmeta";
	$query .= " LEFT JOIN $wpdb->posts ON post_id=$wpdb->posts.ID";
	$query .= " WHERE post_status='publish' AND meta_key='aoton_like' AND post_id = '".$current_post."'";
	$results = $wpdb->get_results($query);
	if ($results) {
		foreach ($results as $o):
			echo $o->meta_value;
		endforeach;
	} else {echo( '0' );}
}
// 目录h4
function article_catalog($content) {
	$matches = array();
	$ul_li = '';
	$r = "/<h4>([^<]+)<\/h4>/im";

	if(preg_match_all($r, $content, $matches)) {
		foreach($matches[1] as $num => $title) {
			$content = str_replace($matches[0][$num], '<span class="directory"></span><h4 id="title-'.$num.'">'.$title.'</h4>', $content);
			$ul_li .= '<li><a href="#title-'.$num.'"><i class="be be-sort"></i> '.$title."</a></li>\n";
		}
		$content = $content ."
			\n<div id=\"log-box\" class=\"bk da fd\">
				<div id=\"catalog\"><ul id=\"catalog-ul\">\n" . $ul_li . "</ul><span class=\"log-zd bk da\"><span class=\"log-close\"><a title=\"" . sprintf(__( '隐藏目录', 'aoton' )) . "\"><i class=\"be be-cross\"></i><strong>" . sprintf(__( '目录', 'aoton' )) . "</strong></a></span></span></div>
			</div>\n";
	}
	return $content;
}
add_filter( "the_content", "article_catalog" );
// 图片自动alt
function image_alt_title($content) {
	global $post;
	$pattern = "/<img(.*?)src=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
	$replacement = '<img$1src=$2$3.$4$5 alt="'.$post->post_title.'" $6>';
	$content = preg_replace($pattern,$replacement,$content);
	return $content;
}
add_filter('the_content','image_alt_title',15); 
// 编辑_blank
function edit_blank($text) {
	return str_replace('<a', '<a target="_blank"', $text);
}
add_filter('edit_post_link', 'edit_blank');
// 外链跳转
add_filter('the_content','the_content_go',999);
	function the_content_go($content){
		preg_match_all('/href="(http.*?)"/',$content,$matches);
		if($matches){
			foreach($matches[1] as $val){
				 if( strpos($val,home_url())===false && !preg_match('/\.(jpg|jpeg|png|ico|bmp|gif|tiff)/i',$val) && !preg_match('/(ed2k|thunder|Flashget|flashget|qqdl):\/\//i',$val))
				 $content=str_replace("href=\"$val\"", "rel=\"external nofollow\" target=\"_blank\" href=\"" .get_template_directory_uri(). "/go.php?url=" .base64_encode($val). "\"",$content);
			}
	 	}
		return $content;
	}
// 外链nofollow
add_filter('the_content','wl_the_content',999);
function wl_the_content($content){
	preg_match_all('/href="(http.*?)"/',$content,$matches);
	if($matches){
		foreach($matches[1] as $val){
			 if( strpos($val,home_url())===false && !preg_match('/\.(jpg|jepg|png|ico|bmp|gif|tiff)/i',$val) && !preg_match('/(ed2k|thunder|Flashget|flashget|qqdl):\/\//i',$val))
			 $content=str_replace("href=\"$val\"", "rel=\"external nofollow\" target=\"_blank\" href=\"$val\" ",$content);
 		}
 	}
	return $content;
}
// 网址跳转
function sites_nofollow($url) {
	$url = str_replace($url, get_template_directory_uri()."/go.php?url=".$url,$url);
	return $url;
}
// 添加斜杠
function nice_trailingslashit($string, $type_of_url) {
	if ( $type_of_url != 'single' && $type_of_url != 'page' && $type_of_url != 'single_paged' )
		$string = trailingslashit($string);
	return $string;
}
add_filter('user_trailingslashit', 'nice_trailingslashit', 10, 2);
function be_html_page_permalink() {
	global $wp_rewrite;
	if ( !strpos($wp_rewrite->get_page_permastruct(), '.html')){
		$wp_rewrite->page_structure = $wp_rewrite->page_structure . '.html';
	}
}
// 关键词加链接
$match_num_from = 1; //一个关键字少于多少不替换
$match_num_to = 2;

add_filter('the_content','tag_link',1);

function tag_sort($a, $b){
	if ( $a->name == $b->name ) return 0;
	return ( strlen($a->name) > strlen($b->name) ) ? -1 : 1;
}

function tag_link($content){
global $match_num_from,$match_num_to;
$posttags = get_the_tags();
	if ($posttags) {
		usort($posttags, "tag_sort");
		foreach($posttags as $tag) {
			$link = get_tag_link($tag->term_id);
			$keyword = $tag->name;
			if (preg_match_all('|(<h[^>]+>)(.*?)'.$keyword.'(.*?)(</h[^>]*>)|U', $content, $matchs)) {continue;}
			if (preg_match_all('|(<a[^>]+>)(.*?)'.$keyword.'(.*?)(</a[^>]*>)|U', $content, $matchs)) {continue;}

			$cleankeyword = stripslashes($keyword);
			$url = "<a href=\"$link\" title=\"".str_replace('%s',addcslashes($cleankeyword, '$'),__('查看与 %s 相关的文章', 'aoton' ))."\"";
			$url .= ' target="_blank"';
			$url .= ">".addcslashes($cleankeyword, '$')."</a>";
			$limit = rand($match_num_from,$match_num_to);

			$content = preg_replace( '|(<a[^>]+>)(.*)('.@$ex_word.')(.*)(</a[^>]*>)|U'.@$case, '$1$2%&&&&&%$4$5', $content);
			$content = preg_replace( '|(<img)(.*?)('.@$ex_word.')(.*?)(>)|U'.@$case, '$1$2%&&&&&%$4$5', $content);
			$cleankeyword = preg_quote($cleankeyword,'\'');
			$regEx = '\'(?!((<.*?)|(<a.*?)))('. $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . @$case;
			$content = preg_replace($regEx,$url,$content,$limit);
			$content = str_replace( '%&&&&&%', stripslashes(@$ex_word), $content);
		}
	}
	return $content;
}
// 页面添加标签
class PTCFP{
	function __construct(){
	add_action( 'init', array( $this, 'taxonomies_for_pages' ) );
		if ( ! is_admin() ) {
			add_action( 'pre_get_posts', array( $this, 'tags_archives' ) );
		}
	}
	function taxonomies_for_pages() {
		register_taxonomy_for_object_type( 'post_tag', 'page' );
	}
	function tags_archives( $wp_query ) {
	if ( $wp_query->get( 'tag' ) )
		$wp_query->set( 'post_type', 'any' );
	}
}
$ptcfp = new PTCFP();
// 分类标签
function get_category_tags($args) {
	global $wpdb;
	$tags = $wpdb->get_results ("
		SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name
		FROM
			$wpdb->posts as p1
			LEFT JOIN $wpdb->term_relationships as r1 ON p1.ID = r1.object_ID
			LEFT JOIN $wpdb->term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
			LEFT JOIN $wpdb->terms as terms1 ON t1.term_id = terms1.term_id,

			$wpdb->posts as p2
			LEFT JOIN $wpdb->term_relationships as r2 ON p2.ID = r2.object_ID
			LEFT JOIN $wpdb->term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
			LEFT JOIN $wpdb->terms as terms2 ON t2.term_id = terms2.term_id
		WHERE
			t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id IN (".$args['categories'].") AND
			t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
			AND p1.ID = p2.ID
			ORDER by tag_name
	");
	$count = 0;

	if($tags) {
		foreach ($tags as $tag) {
			$mytag[$count] = get_term_by('id', $tag->tag_id, 'post_tag');
			$count++;
		}
	} else {
		$mytag = NULL;
	}
	return $mytag;
}
// 获取当前页面地址   
/*** <?php echo currenturl(); ?>
 **/                                       
function currenturl() {
	$current_url = home_url(add_query_arg(array()));
	if (is_single()) {
		$current_url = preg_replace('/(\/comment|page|#).*$/','',$current_url);
	} else {
		$current_url = preg_replace('/(comment|page|#).*$/','',$current_url);
	}
	echo $current_url;
}
// 注册时间  
/*** <?php echo user_registered(); ?>
 **/
function user_registered(){
	$userinfo=get_userdata(get_current_user_id());
	$authorID= $userinfo->ID;
	$user = get_userdata( $authorID );
	$registered = $user->user_registered;
	echo '' . date( "" . sprintf(__( 'Y年m月d日', 'aoton' )) . "", strtotime( $registered ) );
}
// 登录角色
/** <?php echo get_user_role(); ?>
 */ 
function get_user_role() {
	global $current_user;
	$user_roles = $current_user->roles;
	$user_role = array_shift($user_roles);
	return $user_role;
}
// 历史今天发布的文章
function aoton_today(){
	global $wpdb;
	$post_year = get_the_time('Y');
	$post_month = get_the_time('m');
	$post_day = get_the_time('j');
	$sql = "select ID, year(post_date_gmt) as today_year, post_title, comment_count FROM 
			$wpdb->posts WHERE post_password = '' AND post_type = 'post' AND post_status = 'publish'
			AND year(post_date_gmt)!='$post_year' AND month(post_date_gmt)='$post_month' AND day(post_date_gmt)='$post_day'
			order by post_date_gmt DESC limit 8";
	$histtory_post = $wpdb->get_results($sql);
	if( $histtory_post ){
		foreach( $histtory_post as $post ){
			$today_year = $post->today_year;
			$today_post_title = $post->post_title;
			$today_permalink = get_permalink( $post->ID );
			// $today_comments = $post->comment_count;
			@$today_post .= '<li><a href="'.$today_permalink.'" target="_blank"><span>'.$today_year.'</span>'.$today_post_title.'</a></li>';
		}
	}
	if ( @$today_post ){
		$result = '<div class="aoton-today"><fieldset><legend><h5>'. sprintf(__( '历史上的今天', 'aoton' )) .'</h5></legend><div class="today-date"><div class="today-m">'.get_the_date( 'F' ).'</div><div class="today-d">'.get_the_date( 'j' ).'</div></div><ul>'.$today_post.'</ul></fieldset></div>';
	}
	return @$result;
}
//显示页面查询次数、加载时间和内存占用
/**
 * 调用 ：<?php if(function_exists('performance')) performance(true) ;?>
 */
function performance( $visible = false ) {
	$stat = sprintf(  '%d 次查询 耗时 %.3f 秒, 使用 %.2fMB 内存',
	get_num_queries(),
	timer_stop( 0, 3 ),
	memory_get_peak_usage() / 1024 / 1024
	);
	echo $visible ? $stat : "<!-- {$stat} -->" ;
}
// webp
function webp_filter_mime_types( $array ) {
	$array['webp'] = 'image/webp';
	return $array;
}
add_filter( 'mime_types', 'webp_filter_mime_types', 10, 1 );

function webp_file_is_displayable_image($result, $path) {
	$info = @getimagesize( $path );
	if($info['mime'] == 'image/webp') {
		$result = true;
	}
	return $result;
}
add_filter( 'file_is_displayable_image', 'webp_file_is_displayable_image', 10, 2 );

// 普通收录
function Baidu_Submit($post_ID) {
	$WEB_TOKEN = aoton('link_token');
	$WEB_DOMAIN = home_url();
	if(get_post_meta($post_ID,'Baidusubmit',true) == 1) return;
	$url = get_permalink($post_ID);
	$api = 'http://data.zz.baidu.com/urls?site='.$WEB_DOMAIN.'&token='.$WEB_TOKEN;
	$ch  = curl_init();
	$options =  array(
		CURLOPT_URL => $api,
		CURLOPT_POST => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POSTFIELDS => $url,
		CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
	);
	curl_setopt_array($ch, $options);
	$result = json_decode(curl_exec($ch),true);
	if (array_key_exists('success',$result)) {
		add_post_meta($post_ID, 'Baidusubmit', 1, true);
	}
}
add_action('publish_post', 'Baidu_Submit', 0);
// 快速收录
function Daily_submit($post_ID) {
	$WEB_TOKEN = aoton('daily_token');
	$WEB_DOMAIN = home_url( '/' );
	if(get_post_meta($post_ID,'Dailysubmit',true) == 1) return;
	$url = get_permalink($post_ID);;
	$api = 'http://data.zz.baidu.com/urls?site='.$WEB_DOMAIN.'&token='.$WEB_TOKEN.'&type=daily';
	$ch  = curl_init();
	$options =  array(
		CURLOPT_URL => $api,
		CURLOPT_POST => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POSTFIELDS => $url,
		CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
	);
	curl_setopt_array($ch, $options);
	$result = json_decode(curl_exec($ch),true);
	if (array_key_exists('success',$result)) {
		add_post_meta($post_ID, 'Dailysubmit', 1, true);
	}
}
add_action('publish_post', 'Daily_submit', 0);
// sitemap_txt
if (aoton('sitemap_txt')) {
	function aoton_sitemap_refresh_txt() {
		require_once THEME_DIR . '/inc/sitemap-txt.php';
		$sitemap_txt = aoton_get_txt_sitemap();
		file_put_contents(ABSPATH.'sitemap.txt', $sitemap_txt);
	}
add_action( 'optionsframework_after', 'aoton_sitemap_refresh_txt' );
}
//注册菜单
register_nav_menus(
	array(
		'navigation' => '主菜单',
		'header' => '次菜单',
		'mobile' => '移动端菜单',
		'footer' => '页脚菜单',
	)
);  
add_filter('use_block_editor_for_post', '__return_false');
remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles' );
global $simple_local_avatars;
$simple_local_avatars = new Simple_Local_Avatars();
/***gravatar头像 */
function get_ssl_avatar($avatar) {
    $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
        return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');
/** 小工具 */
if( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => '首页小工具',
		'id'  => 'fourth-sidebar',
		'before_widget' => '<div class="sidebar_content">',
		'after_widget' => '</div>',
		'before_title' => '<div class="sl_sidebar_sugs_title">',
		'after_title' => '</div>'
	));
	register_sidebar(array(
		'name' => '文章页小工具',
		'id'  => 'sidebar-2',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
}
//自定义首页文本长度
 // aoton_trim_words()
function aoton_trim_words() { ?>
  <?php if (has_excerpt('')){
      echo wp_trim_words( get_the_excerpt(), aoton('word_n'), '...' );
    } else {
      $content = get_the_content();
      $content = wp_strip_all_tags(str_replace(array('[',']'),array('<','>'),$content));
      if (aoton('languages_en')) {
        echo aoton_strimwidth(strip_tags($content), 0, aoton('words_n'),'...');
      } else {
        echo wp_trim_words( $content, aoton('words_n'), '...' );
      }
    }
  ?>
<?php }
// 只搜索文章标题
function wpse_11826_search_by_title( $search, $wp_query ) {
	if ( ! empty( $search ) && ! empty( $wp_query->query_vars['search_terms'] ) ) {
		global $wpdb;
		$q = $wp_query->query_vars;
		$n = ! empty( $q['exact'] ) ? '' : '%';
		$search = array();
		foreach ( ( array ) $q['search_terms'] as $term )
			$search[] = $wpdb->prepare( "$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like( $term ) . $n );
		if ( ! is_user_logged_in() )
			$search[] = "$wpdb->posts.post_password = ''";
		$search = ' AND ' . implode( ' AND ', $search );
	}
	return $search;
}
add_filter("posts_search", "wpse_11826_search_by_title", 10, 2);
// 收藏
function post_shoucang(){
    if(!get_current_user_id()){
        exit(json_encode(['msg'=>'请先登录才能收藏哦!']));
    }
    $id = $_POST["id"];
    $meta = get_post_meta($id,'shoucang',true);
    $shoucang1 = explode(',',get_post_meta($id,'shoucang',true));
    $shoucang =  array_filter($shoucang1); 
    $user = get_current_user_id();
    if(in_array($user,$shoucang)){ 
        foreach($shoucang as $k=>$v){
            if($v==$user){
                unset($shoucang[$k]);
            }
        }
        update_post_meta($id, 'shoucang', implode(",",$shoucang));
        exit(json_encode(['msg'=>'已取消收藏']));
    }else{
        array_push($shoucang,$user);
        update_post_meta($id, 'shoucang', implode(",",$shoucang));
        exit(json_encode(['msg'=>'收藏成功']));
    }   
}
add_action('wp_ajax_post_shoucang','post_shoucang');
add_action('wp_ajax_nopriv_post_shoucang','post_shoucang');
//替换WordPress默认的wp-login.php页面
function redirect_login_page() {
    $login_page  = home_url( '/login' );
    $page_viewed = basename($_SERVER['REQUEST_URI']);
   
    if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
      wp_redirect($login_page);
      exit;
    }
}
if(aoton('redirect_login_page')){
  add_action('init','redirect_login_page');
}
//上传头像
add_filter('get_avatar', 'aoton_get_avatar', 10, 3);
function aoton_get_avatar($avatar, $id_or_email, $size = 50){
  $default_avatar = get_bloginfo('template_url').'/assets/images/favicon.png';
  if(is_object($id_or_email)) {
    if($id_or_email->user_id != 0) {
      $email = $id_or_email->user_id;
      $user = get_user_by('email',$email);
      $user_avatar = get_user_meta($id_or_email->user_id, 'photo', true);
      if($user_avatar){
        $user_avatar = str_replace('http://', '//', $user_avatar);
      }
      if($user_avatar)
        return '<img src="'.$user_avatar.'" class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" />';
      else
        return '<img src="'.$default_avatar.'" class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" />';
      
    }elseif(!empty($id_or_email->comment_author_email)) {
      return '<img src="'.$default_avatar.'" class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" />';
    }
  }else{
    if(is_numeric($id_or_email) && $id_or_email > 0){
      $user = get_user_by('id',$id_or_email);
      $user_avatar = get_user_meta($id_or_email, 'photo', true);
      if($user_avatar){
        $user_avatar = str_replace('http://', '//', $user_avatar);
      }
      if($user_avatar)
        return '<img src="'.$user_avatar.'" class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" />';
      else
        return '<img src="'.$default_avatar.'" class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" />';
    }elseif(is_email($id_or_email)){
      $user = get_user_by('email',$id_or_email);
      $user_avatar = get_user_meta($user->ID, 'photo', true);
      if($user_avatar){
        $user_avatar = str_replace('http://', '//', $user_avatar);
      }
      if($user_avatar)
        return '<img src="'.$user_avatar.'" class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" />';
      else
        return '<img src="'.$default_avatar.'" class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" />';
    }else{
      return '<img src="'.$default_avatar.'" class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" />';
    }
  }
  return $avatar;
}

function aotonhemes_get_avatar($uid){
  $photo = get_user_meta($uid, 'photo', true);
  if($photo){ 
    $photo = str_replace('http://', '//', $photo);
    return $photo;
  }
  else return get_bloginfo("template_url").'/assets/images/favicon.png';
}

function aotonhemes_avatar($id=0,$size='50',$class=''){
  $photo = get_user_meta($id, 'photo', true);
  if($photo){ 
    $photo = str_replace('http://', '//', $photo);
    echo '<img class="avatar '.$class.'" src="'.$photo.'" width="'.$size.'" height="'.$size.'" />';
  }
  else echo get_avatar($id,$size);
}

function aoton_selfURL(){  
    //global $wp;
    //return home_url( $wp->request );
    $pageURL = 'http';
    $pageURL .= (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")?"s":"";
    $pageURL .= "://";
    $pageURL .= $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    return $pageURL;   
}

function post_editor_settings($args = array()){
    $img = current_user_can('upload_files');
    return array(
        'textarea_name' => $args['textarea_name'],
        'media_buttons' => false,
        'quicktags' => false,
        'tinymce'       => array(
            'height'        => 350,
            'toolbar1' => 'formatselect,bold,underline,blockquote,forecolor,alignleft,aligncenter,alignright,link,unlink,bullist,numlist,'.($img?'mbtimg,':'image,').'undo,redo,fullscreen,wp_help',
            'toolbar2' => '',
            'toolbar3' => '',
        )
    );
}

function wp_is_erphpdown_active(){
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if(!is_plugin_active( 'erphpdown/erphpdown.php' )){
	  return 0;
	}else{
	  return 1;
	}
  
  }
  //强制邮箱绑定
  add_action( 'template_redirect', 'aotonThemes_force_email' );
function aotonThemes_force_email() {
  if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    return;
  }
  if( is_user_logged_in() ) {
    global $current_user;
    if(aoton('user_force_email') && !$current_user->user_email){
      $schema = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https://' : 'http://';
      $url = $schema . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
      if ( preg_replace( '/\?.*/', '', $url ) !== preg_replace( '/\?.*/', '', get_permalink(aotonThemes_page("pages/user.php")) ) ) {
        $redirect_url = apply_filters( 'aotonThemes_force_email', $url );
        nocache_headers();
        wp_safe_redirect(add_query_arg('action','info',get_permalink(aotonThemes_page("pages/user.php"))), 302);
        exit;
      }
    }
  }
}
  function aotonThemes_is_phone($mobile) {
	if (!is_numeric($mobile)) {
	  return false;
	}
	return preg_match("/^1[3456789]{1}\d{9}$/", $mobile) ? true : false;
  }
  function aoton_is_mobile(){  
    $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';  
    $mobile_browser = '0';  
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
      $clientkeywords = array('iphone', 'android', 'phone', 'mobile', 'wap', 'netfront', 'java', 'opera mobi', 'opera mini','ucweb', 'windows ce', 'symbian', 'series', 'webos', 'sony', 'blackberry', 'dopod', 'nokia', 'samsung','palmsource', 'xda', 'pieplus', 'meizu', 'midp', 'cldc', 'motorola', 'foma', 'docomo', 'up.browser','up.link', 'blazer', 'helio', 'hosin', 'huawei', 'xiaomi', 'novarra', 'coolpad', 'webos', 'techfaith', 'palmsource','alcatel', 'amoi', 'ktouch', 'nexian', 'ericsson', 'philips', 'sagem', 'wellcom', 'bunjalloo', 'maui', 'smartphone','iemobile', 'spice', 'bird', 'zte-', 'longcos', 'pantech', 'gionee', 'portalmmm', 'jig browser', 'hiptop','benq', 'haier', '^lct', '320x320', '240x320', '176x220', 'windows phone');
      if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $mobile_browser++;  
      }
    }
    if(preg_match('/(up.browser|up.link|ucweb|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))  
        $mobile_browser++;  
    if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))  
        $mobile_browser++;  
    if(isset($_SERVER['HTTP_X_WAP_PROFILE']))  
        $mobile_browser++;  
    if(isset($_SERVER['HTTP_PROFILE']))  
        $mobile_browser++;  
    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));  
    $mobile_agents = array(  
        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',  
        'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',  
        'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',  
        'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',  
        'newt','noki','oper','palm','pana','pant','phil','play','port','prox',  
        'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',  
        'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',  
        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',  
        'wapr','webc','winw','winw','xda','xda-' 
        );  
    if(in_array($mobile_ua, $mobile_agents))  
        $mobile_browser++;  
    if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)  
        $mobile_browser++;  
    // Pre-final check to reset everything if the user is on Windows  
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)  
        $mobile_browser=0;  
    // But WP7 is also Windows, with a slightly different characteristic  
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)  
        $mobile_browser++;  
    if($mobile_browser>0)  
        return true;  
    else
        return false;  
}

function aoton_is_weixin(){ 
  if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
        return true;
    }  
    return false;
}

function aoton_home_link_ico( $id = null ) {
	global $wpdb,$post;
	$args  = array(
		'orderby'   => 'rating',
		'order'     => 'DESC',
		'category'  => aoton('link_f_cat'),
	);

	$bookmarks = get_bookmarks( $args );
	$output = "";
	if ( !empty( $bookmarks ) ) {
		foreach ($bookmarks as $bookmark) {
			$output .= '<div class="uk-width-small uk-card uk-card-default uk-card-body uk-card-small uk-margin-left uk-margin-top" style="border-radius: 6px;float: left;height: 130px;">';
				$output .= '<a href="' . $bookmark->link_url . ' " target="_blank" ><img style="width: 48px;height: 48px;position: relative;top: 10px;left: calc(50% - 24px);" src="' . aoton("favicon_api") . '' . $bookmark->link_url . '" alt="' . $bookmark->link_name . '"><div style="text-align: center;margin-top: 20px;">' . $bookmark->link_name . '</div></a>';
			$output .= '</div>';
		}
	}
	return $output;
}

function aoton_get_the_link_items( $id = null ) {
	global $wpdb,$post;
	$args  = array(
		'orderby'   => aoton('rand_link'),
		'order'     => 'DESC',
		'exclude'   => aoton('link_cat'),
		'category'  => $id,
	);

	$bookmarks = get_bookmarks( $args );
	$output = "";
	if ( !empty( $bookmarks ) ) {
		foreach ($bookmarks as $bookmark) {
			$output .= '<div><div class="sl_group_list"><a href="' . $bookmark->link_url . ' " target="_blank" ><div class="link-main sup bk da">';
			if (!aoton('link_favicon') || (aoton("link_favicon") == 'favicon_ico')) {
				$output .= '<div class="sl_group_list_media"><img src="' . aoton("favicon_api") . '' . $bookmark->link_url . '" alt="' . $bookmark->link_name . '"></div> <div class="sl_group_list_info"><h3>' . $bookmark->link_name . '</h3><span>' . $bookmark->link_url . '</span></div><span>' . $bookmark->link_description . '</span>';
			}
			if (aoton('link_favicon') == 'first_ico') {
				$output .= '<div class="link-letter">' . getFirstCharter($bookmark->link_name) . '</div><div><div class="sl_group_list_info"><h3>' . $bookmark->link_name . '</h3>' . $bookmark->link_url . '</div><span>' . $bookmark->link_description . '</span>';
			}
			$output .= '</div></a></div></div>';
		}
	}
	return $output;
}
// footer links
function links_footer() { ?>
	<div class="footer-wrapper-sidebar mt-4">
		<hr>
		<ul class="list-inline">
			<?php if (aoton('footer_img')) { ?>
			<?php wp_list_bookmarks('title_li=&before=<li><span class="link-f link-img sup">&after=</span></li>&categorize=1&show_images=1&orderby=rating&order=DESC&category='.aoton('link_f_cat')); ?>
			<?php } else { ?>
				<?php if (aoton('home_link_ico')) { ?>
					<ul class="uk-switcher uk-margin">
						<li class="uk-active">
							<div class="uk-width-* ">
								<?php echo aoton_home_link_ico(); ?>
							</div>
						</li>
					</ul>
				<?php } else { ?>
					<?php wp_list_bookmarks('title_li=&before=<li>&after=</li>&categorize=0&show_images=0&orderby=rating&order=DESC&category='.aoton('link_f_cat')); ?>
				<?php } ?>
			<?php } ?>
			<?php if ( aoton('link_url') == '' ) { ?><?php } else { ?><div class="uk-position-small uk-position-top-right uk-overlay uk-overlay-default uk-padding-small"><a href="<?php echo get_permalink( aoton('link_url') ); ?>" target="_blank" title="更多链接">更多链接</a></div><?php } ?>
		</ul>
		<div class="clear"></div>
		<hr>
	</div>
<?php }

function aoton_get_link_items() {
	$linkcats = get_terms( 'link_category' );
	if ( !empty( $linkcats ) ) {
		foreach( $linkcats as $linkcat ){
			@$result .= '<div class="clear"></div><h3 class="link-cat">'.$linkcat->name.'</h3>';
			if( $linkcat->description ) $result .= '<div class="linkcat-des">'.$linkcat->description .'</div>';
			$result .= aoton_get_the_link_items( $linkcat->term_id );
		}
	} else {
		$result = aoton_get_the_link_items();
	}
	return $result;
}

// 获取首字母
function getFirstCharter($str){
	if(empty($str)){
		return '';
	}
	if(is_numeric($str[0])) return $str[0];
	$fchar=ord($str[0]);
	if($fchar>=ord('A')&&$fchar<=ord('z')) return strtoupper($str[0]);
	$s1=iconv('UTF-8','gb2312',$str);
	$s2=iconv('gb2312','UTF-8',$s1);
	$s=$s2==$str?$s1:$str;
	$asc=ord($s[0])*256+ord($s[1])-65536;
	if($asc>=-20319&&$asc<=-20284) return 'A';
	if($asc>=-20283&&$asc<=-19776) return 'B';
	if($asc>=-19775&&$asc<=-19219) return 'C';
	if($asc>=-19218&&$asc<=-18711) return 'D';
	if($asc>=-18710&&$asc<=-18527) return 'E';
	if($asc>=-18526&&$asc<=-18240) return 'F';
	if($asc>=-18239&&$asc<=-17923) return 'G';
	if($asc>=-17922&&$asc<=-17418) return 'H';
	if($asc>=-17417&&$asc<=-16475) return 'J';
	if($asc>=-16474&&$asc<=-16213) return 'K';
	if($asc>=-16212&&$asc<=-15641) return 'L';
	if($asc>=-15640&&$asc<=-15166) return 'M';
	if($asc>=-15165&&$asc<=-14923) return 'N';
	if($asc>=-14922&&$asc<=-14915) return 'O';
	if($asc>=-14914&&$asc<=-14631) return 'P';
	if($asc>=-14630&&$asc<=-14150) return 'Q';
	if($asc>=-14149&&$asc<=-14091) return 'R';
	if($asc>=-14090&&$asc<=-13319) return 'S';
	if($asc>=-13318&&$asc<=-12839) return 'T';
	if($asc>=-12838&&$asc<=-12557) return 'W';
	if($asc>=-12556&&$asc<=-11848) return 'X';
	if($asc>=-11847&&$asc<=-11056) return 'Y';
	if($asc>=-11055&&$asc<=-10247) return 'Z';
	return null;
} 
// 分类ID
function show_id() {
	$categories = get_categories(array('taxonomy' => array('category'), 'hide_empty' => 0)); 
	foreach ($categories as $cat) {
		$output = '<ol class="show-id">' . $cat->cat_name . '<span>' . $cat->cat_ID . '</span></ol>';
		echo $output;
	}
}
function type_show_id() {
	$categories = get_categories(array('taxonomy' => array('notice'), 'hide_empty' => 0)); 
	foreach ($categories as $cat) {
		$output = '<ol class="show-id">' . $cat->cat_name . '<span>' . $cat->cat_ID . '</span></ol>';
		echo $output;
	}
}
// connector
function connector() {
	if (aoton('blank_connector')) {echo '';}else{echo ' ';}
	echo aoton('connector');
	if (aoton('blank_connector')) {echo '';}else{echo ' ';}
}

// title
if (aoton('wp_title')) {
// filters title
function custom_filters_title() { 
	$separator = ''.aoton('connector').'';
	return $separator;
}
add_filter('document_title_separator', 'custom_filters_title');
} else {
function aoton_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}
	$title .= get_bloginfo( 'name', 'display' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'aoton_wp_title', 10, 2 );
}
/**定义函数 */
function aoton_title()
{
	get_template_part("pages/keywords");
}
function get_menu(){
	get_template_part("pages/menu");
}
function get_navfooter(){
	get_template_part("pages/navfooter");
}
function user_identity(){
	global $current_user;
	wp_get_current_user();
	return $current_user->user_login;
}
function aotonThemes_page($template) {
	global $wpdb;
	$page_id = $wpdb->get_var($wpdb->prepare("SELECT `post_id` 
	  FROM `$wpdb->postmeta`, `$wpdb->posts`
	  WHERE `post_id` = `ID`
	  AND `post_status` = 'publish'
	  AND `meta_key` = '_wp_page_template'
	  AND `meta_value` = %s
	  LIMIT 1;", $template));
	return $page_id;
}
  //翻页
function aotonThemes_custom_paging($paged,$max_page) {
	$p = 2;
	global $wp_query;
	if ( $max_page == 1 ) return; 
	echo '<div class="pagination"><ul class="uk-pagination" uk-margin>';
	if ( empty( $paged ) ) $paged = 1;
	// echo '<span class="pages">Page: ' . $paged . ' of ' . $max_page . ' </span> '; 
	echo '<li class="prev-page">'; previous_posts_link('<span uk-pagination-previous></span>--'); echo '</li>';
  
	if ( $paged > $p + 1 ) p_link( 1, '<li>第一页</li>' );
	if ( $paged > $p + 2 ) echo "<li><span>···</span></li>";
	for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { 
	  if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<li class=\"active\"><span>{$i}</span></li>" : p_link( $i );
	}
	if ( $paged < $max_page - $p - 1 ) echo "<li><span> ... </span></li>";
	if ( $paged < $max_page - $p ) p_link( $max_page, '&raquo;' );
	echo '<li class="next-page">'; next_posts_link('--<span uk-pagination-next></span>'); echo '</li>';
	echo '<li><span>共 '.$max_page.' 页</span></li>';
	echo '</ul></div>';
}
function p_link( $i, $title = '' ) {
	if ( $title == '' ) $title = "第 {$i} 页";
	echo "<li><a href='", esc_html( get_pagenum_link( $i ) ), "'>{$i}</a></li>";
}
function p_curr_link( $i) {
	echo '<li><span class="page-numbers current">'.$i.'</span></li>';
}