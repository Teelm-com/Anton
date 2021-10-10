<?php
// 评论等级
	function get_author_class($comment_author_email,$user_id){
		global $wpdb;
		$author_count = count($wpdb->get_results(
		"SELECT comment_ID as author_count FROM $wpdb->comments WHERE comment_author_email = '$comment_author_email' "));
		$adminEmail = get_option('admin_email');if($comment_author_email ==$adminEmail) return;
		if($author_count>=0 && $author_count<2)
			echo '<a class="vip vip0" title="评论达人 VIP.0"></a>';
		else if($author_count>=2 && $author_count<5)
			echo '<a class="vip vip1" title="评论达人 VIP.1"></a>';
		else if($author_count>=5 && $author_count<10)
			echo '<a class="vip vip2" title="评论达人 VIP.2"></a>';
		else if($author_count>=10 && $author_count<20)
			echo '<a class="vip vip3" title="评论达人 VIP.3"></a>';
		else if($author_count>=20 && $author_count<50)
			echo '<a class="vip vip4" title="评论达人 VIP.4"></a>';
		else if($author_count>=50 && $author_count<100)
			echo '<a class="vip vip5" title="评论达人 VIP.5"></a>';
		else if($author_count>=100 && $author_count<200)
			echo '<a class="vip vip6" title="评论达人 VIP.6"></a>';
		else if($author_count>=200 && $author_count<300)
			echo '<a class="vip vip7" title="评论达人 VIP.7"></a>';
		else if($author_count>=300 && $author_count<400)
			echo '<a class="vip vip8" title="评论达人 VIP.8"></a>';
		else if($author_count>=400)
			echo '<a class="vip vip9" title="评论达人 VIP.9"></a>';
	}

// 判断作者
function begin_comment_by_post_author( $comment = null ) {
	if ( is_object( $comment ) && $comment->user_id > 0 ) {
		$user = get_userdata( $comment->user_id );
		$post = get_post( $comment->comment_post_ID );
		if ( ! empty( $user ) && ! empty( $post ) ) {
			return $comment->user_id === $post->post_author;
		}
	}
	return false;
}
// 禁止评论HTML
add_filter('comment_text', 'wp_filter_nohtml_kses');
add_filter('comment_text_rss', 'wp_filter_nohtml_kses');
add_filter('comment_excerpt', 'wp_filter_nohtml_kses');
// 评论贴图
add_action('comment_text', 'comments_embed_img', 2); 
function comments_embed_img($comment) {
    $size = 'auto';
    $comment = preg_replace(array('#(http://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#','#(https://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#'),'<img src="$1" alt="评论" style="width:'.$size.'; height:'.$size.'" />', $comment);
    return $comment;
}
/**评论表情 */
require THEME_DIR . "/inc/smilies.php";
// 评论加nofollow
function nofollow_comments_popup_link(){
	return ' rel="external nofollow"';
}
add_filter("comments_popup_link_attributes", "nofollow_comments_popup_link");
// 禁止无中文留言
if ( current_user_can('level_10') ) {
} else {
function refused_spam_comments( $comment_data ) {
    $pattern = '/[一-龥]/u';  
    if(!preg_match($pattern,$comment_data['comment_content'])) {
        err('评论必须含中文！');
    }
    return( $comment_data );
}
add_filter('preprocess_comment','refused_spam_comments');
}
// 评论者链接跳转
function comment_author_link_go($content){
	preg_match_all('/\shref=(\'|\")(http[^\'\"#]*?)(\'|\")([\s]?)/',$content,$matches);
	if($matches){
		foreach($matches[2] as $val){
			if(strpos($val,home_url())===false){
				$rep = $matches[1][0].$val.$matches[3][0];
				$go = '"'. get_template_directory_uri() .'/go.php?url='. base64_encode($val).'" rel="external nofollow" target="_blank"';
				$content = str_replace("$rep","$go", $content);
			}
		}
	}
	return $content;
}
add_filter('comment_text','comment_author_link_go',99);
add_filter('get_comment_author_link','comment_author_link_go',99);
/**评论添加@*/
function aoton_comment_add_at( $commentdata ) {
  if( $commentdata['comment_parent'] > 0) {
    $commentdata['comment_content'] = '@<a href="#comment-' . $commentdata['comment_parent'] . '">'.get_comment_author( $commentdata['comment_parent'] ) . '</a> ' . $commentdata['comment_content'];
  }
  return $commentdata;
}
add_action( 'preprocess_comment' , 'aoton_comment_add_at', 20);
// 回复replytocom
add_filter('comment_reply_link', 'del_replytocom', 420, 4);
function del_replytocom($link, $args, $comment, $post){
	return preg_replace( '/href=\'(.*(\?|&)replytocom=(\d+)#respond)/', 'href=\'#comment-$3', $link );
}
function aotonhemes_timeago( $ptime ) {
    date_default_timezone_set('Asia/Shanghai');
    if('post_date_format'){
      return date("Y-m-d",strtotime($ptime));
    }else{
      $ptime = strtotime($ptime);
      $etime = time() - $ptime;
      if($etime < 1) return '刚刚';
      if($etime > 30 * 24 * 60 * 60) return date('m-d', $ptime);
      $interval = array (
        12 * 30 * 24 * 60 * 60  =>  '年前',
        30 * 24 * 60 * 60       =>  '月前',
        7 * 24 * 60 * 60        =>  '周前',
        24 * 60 * 60            =>  '天前',
        60 * 60                 =>  '小时前',
        60                      =>  '分钟前',
        1                       =>  '秒前'
      );
      foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
          $r = round($d);
          return $r . $str;
        }
      };
    }
  }

function aotonThemes_comments_list($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    global $wpdb, $post;
  
    echo '<li '; comment_class(); echo ' id="comment-'.get_comment_ID().'">';
  
    echo '<div class="comt-avatar">';
    aotonhemes_avatar($comment->user_id);
    echo '</div>';
  
  
    echo '<div class="comt-main" id="div-comment-'.get_comment_ID().'">';
    echo convert_smilies(get_comment_text());
  
    echo '<div class="comt-meta">';
    if ($comment->comment_approved == '0'){
      echo '<span class="comt-approved">待审核</span>';
    }
  
    echo '<span class="comt-author">';
    if($comment->user_id){
      echo get_user_by('ID',$comment->user_id)->nickname;
    }else{
      echo get_comment_author_link(); 
    }
    $_commenttime = strtotime($comment->comment_date);
    
    echo get_author_class($comment->comment_author_email, $comment->user_id);
    if(user_can($comment->user_id, 1));
    
    echo ' ';
    echo aotonhemes_timeago(date('Y-m-d G:i:s', $_commenttime));
    if ($comment->comment_approved !== '0'){
      $replyText = get_comment_reply_link( array_merge( $args, array('add_below' => 'div-comment', 'reply_text' => '<i class="ico ico-reply"></i> 回复', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
      echo preg_replace('# href=[\s\S]*? onclick=#', ' href="javascript:;" onclick=', $replyText );
    }
    echo '</div>';
    echo '</div>';
  }