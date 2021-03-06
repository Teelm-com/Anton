<?php
if ( get_option('default_comment_status') !== 'open' ) return;
defined('ABSPATH') or die('This file can not be loaded directly.');

if ( !comments_open() ) return;

$tit = '评论';
if(is_page_template('template/guestbook.php')){
	$tit = '留言';
}

$my_email = get_bloginfo ( 'admin_email' );
$str = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_approved = '1' AND comment_type = '' AND comment_author_email";
$count_t = $post->comment_count;

date_default_timezone_set('PRC');
$closeTimer = (strtotime(date('Y-m-d G:i:s'))-strtotime(get_the_time('Y-m-d G:i:s')))/86400;

?>
<?php get_template_part('ad/ad', 'comments'); ?>
<div class="single-comment">
	<h3 class="comments-title" id="comments">
		<?php echo $tit;?><small><?php echo $count_t ? $count_t : '0'; ?></small>
	</h3>
	<div id="respond" class="comments-respond no_webshot">
		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) { ?>
		<div class="comment-signarea">
			<h3 class="text-muted">请先 <a href="javascript:;" class="signin-loader">登录</a> ！</h3>
		</div>
		<?php }elseif( get_option('close_comments_for_old_posts') && $closeTimer > get_option('close_comments_days_old') ) { ?>
		<h3 class="title">
			<strong><?php echo $tit;?>已关闭！</strong>
		</h3>
		<?php }else{ ?>
		
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
			<div class="comt">
				<div class="comt-title">
					<?php 
						if ( is_user_logged_in() ) {
							global $current_user;
							aotonhemes_avatar($current_user->ID);
							echo '<p>'.$user_identity.'</p>';
						}else{
							if( $comment_author_email!=='' ) {
								aotonhemes_avatar($comment->comment_author_email);
							}else{
								aotonhemes_avatar();
							}
							if ( !empty($comment_author) ){
								echo '<p>'.$comment_author.'</p>';
								echo '<p><a href="javascript:;" class="comment-user-change">更换</a></p>';
							}
						}
					?>
					<p><a id="cancel-comment-reply-link" href="javascript:;">取消</a></p>
				</div>
				<div class="comt-box">
					<textarea placeholder="" class="comt-area" name="comment" id="comment" cols="100%" rows="3" tabindex="1" onkeydown="if(event.ctrlKey&amp;&amp;event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
				</div>
				<div class="comt-ctrl">
					<a class="comt-add-btn" href="javascript:;" id="addsmile"><i class="uil-smile-beam"></i></a>
					<script type="text/javascript" src="<?php bloginfo('template_url');?>/assets/js/qiandao.js"></script>
					<a class="comt-add-btn" href="javascript:SIMPALED.Editor.daka();" title="签到"><i class="ico ico-fabu"></i></a>
					<div class="smile"> <div class="clearfix"> <a href="javascript:grin(':razz:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/razz.png" alt="" class="d-block"></a><a href="javascript:grin(':evil:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/evil.png" alt="" class="d-block"></a><a href="javascript:grin(':exclaim:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/exclaim.png" alt="" class="d-block"></a><a href="javascript:grin(':smile:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/smile.png" alt="" class="d-block"></a><a href="javascript:grin(':redface:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/redface.png" alt="" class="d-block"></a><a href="javascript:grin(':biggrin:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/biggrin.png" alt="" class="d-block"></a><a href="javascript:grin(':eek:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/eek.png" alt="" class="d-block"></a><a href="javascript:grin(':confused:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/confused.png" alt="" class="d-block"></a><a href="javascript:grin(':idea:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/idea.png" alt="" class="d-block"></a><a href="javascript:grin(':lol:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/lol.png" alt="" class="d-block"></a><a href="javascript:grin(':mad:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/mad.png" alt="" class="d-block"></a><a href="javascript:grin(':twisted:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/twisted.png" alt="" class="d-block"></a><a href="javascript:grin(':rolleyes:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/rolleyes.png" alt="" class="d-block"></a><a href="javascript:grin(':wink:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/wink.png" alt="" class="d-block"></a><a href="javascript:grin(':cool:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/cool.png" alt="" class="d-block"></a><a href="javascript:grin(':arrow:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/arrow.png" alt="" class="d-block"></a><a href="javascript:grin(':neutral:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/neutral.png" alt="" class="d-block"></a><a href="javascript:grin(':cry:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/cry.png" alt="" class="d-block"></a><a href="javascript:grin(':mrgreen:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/mrgreen.png" alt="" class="d-block"></a><a href="javascript:grin(':drooling:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/drooling.png" alt="" class="d-block"></a><a href="javascript:grin(':persevering:')"><img src="<?php bloginfo('template_url');?>/assets/images/smilies/persevering.png" alt="" class="d-block"></a> </div> </div>
					<div class="comt-tips"><?php comment_id_fields(); do_action('comment_form', $post->ID); ?></div>
					<button class="comt-submit" type="submit" name="submit" id="submit" tabindex="5">提交<?php echo $tit;?></button>
				</div>

				<?php if ( !is_user_logged_in() ) { ?>
					<?php if( get_option('require_name_email') ){ ?>
						<div class="comt-comterinfo" id="comment-author-info" <?php if ( !empty($comment_author) ) echo 'style="display:none"'; ?>>
							<ul>
								<li><input class="ipt" type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" tabindex="2" placeholder="昵称">昵称 (必填)</li>
								<li><input class="ipt" type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" tabindex="3" placeholder="邮箱">邮箱 (必填)</li>
								<li><input class="ipt" type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" tabindex="4" placeholder="网址">网址</li>
							</ul>
						</div>
					<?php } ?>
				<?php } ?>
			</div>

		</form>
		<?php } ?>
	</div>
	<?php  
	if ( have_comments() ) { 
		?>
		<div id="postcomments" class="postcomments">
			<ol class="commentlist">
				<?php wp_list_comments('type=comment&callback=aotonThemes_comments_list'); ?>
			</ol>
			<div class="comments-pagination">
				<?php paginate_comments_links('prev_next=0');?>
			</div>
		</div>
		<?php 
	}?>
</div>



