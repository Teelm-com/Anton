<?php
class AoTon_Front {
	public function __construct() {
		if ( !is_admin() ) {
			add_filter( 'the_content', array( $this, 'AoTon_share_content' ), 100 );
			add_action( 'wp_head', array( $this, 'AoTon_share_head' ), 50 );
		}
		add_action( 'wp_ajax_beshare_ajax', array( $this,'AoTon_ajax_handler' ) );
		add_action( 'wp_ajax_nopriv_beshare_ajax', array($this,'AoTon_ajax_handler') );
	}

	public function AoTon_ajax_handler() {
		switch ( $_POST['do'] ) {
			case 'like':
				$post_id = intval( $_REQUEST['post_id'] );
				if( !$post_id ) {
					break;
				}
				$like = get_post_meta( $post_id,'aoton_like',true );
				if( $like ) {
					$like = intval( $like );
				} else {
					$like = 0;
				}
				$like++;
				update_post_meta( $post_id,'aoton_like', $like );
				echo $like;
				break;
			case 'AoTon_share_poster':
				self::AoTon_share_post_handler();
				break;
		}
		exit();
	}

	function AoTon_share_head() {
		if ( is_singular() ) {
			$ajax_url = admin_url( 'admin-ajax.php' );
			$curr_uid = wp_get_current_user()->ID;
			$post_id = get_the_ID();
			wp_enqueue_script( 'social-share', THEME_URI . '/assets/js/social-share.js', array( 'jquery' ), 1.0, true );

			$beshare_opt = '';
			$beshare_opt .= 'var beshare_opt="|'. urlencode( THEME_URI ). '|'. $curr_uid .'|'. urlencode( $ajax_url ).'|'. $post_id .'";';
			wp_add_inline_script( 'social-share', $beshare_opt ,'before' );
		}
	}

	public function AoTon_share_content( $content ) {
		if ( is_singular() ) {
			$content .= $this->donateHtml();
		}
		return $content;
	}

	// 按钮
	private function donateHtml() {
		$post_id = get_the_ID();

		$like = get_post_meta( $post_id,'aoton_like',true );
		$like = $like ? intval( $like ) : 0;
		$like = $like > 999 ? intval( $like / 1000 ) . 'K+' : $like;

			@$tab_html .= '<div class="share-tab-nav-item item-alipay current da"><i class="fab fa-alipay cx-alipay"></i><span class="bgt">支付宝</span></div>';
			@$tab_html .= '<div class="share-tab-nav-item item-weixin da"><i class="fa fa-weixin cx-weixin"></i><span class="bgt">微信</span></div>';
			@$cont_html .= '<div class="share-tab-cont current"><div class="give-qr"><img src="' . aoton('qr_a') . '" alt="支付宝二维码"></div><p>支付宝扫描二维码打赏作者</p></div>';
			@$cont_html .= '<div class="share-tab-cont"><div class="give-qr"><img src="' . aoton('qr_w') . '" alt="微信二维码"></div><p>微信扫描二维码打赏作者</p></div>';
			@$inline_script .= 'var AoTon_beshare_donate_html=\'<div class="tab-navs">'.$tab_html.'</div><div class="share-tab-conts">'.$cont_html.'</div>\';';
		

		@$img_url = $this->AoTon_first_image();
		@$opt_def_img = aoton( 'poster_img' );
		@$def_cover = aoton( 'poster_img' );
		@$share_cover = $img_url ? $img_url['src'] : ( $opt_def_img ? $opt_def_img : $def_cover );

		@$AoTon_beshare_html = '<div class="AoTon-share-list" data-cover="' . $share_cover . '">';
		@$AoTon_beshare_html .= '<a class="share-logo ico-weixin bk" data-cmd="weixin" title="分享到微信" rel="nofollow"></a>';
		@$AoTon_beshare_html .= '<a class="share-logo ico-weibo bk" data-cmd="weibo" title="分享到微博" rel="nofollow"></a>';
		@$AoTon_beshare_html .= '<a class="share-logo ico-qzone bk" data-cmd="qzone" title="分享到QQ空间" rel="nofollow"></a>';
		@$AoTon_beshare_html .= '<a class="share-logo ico-qq bk" data-cmd="qq" title="分享到QQ" rel="nofollow"></a>';

		@$inline_script .= 'var AoTon_beshare_html=\''.$AoTon_beshare_html.'\';';
		wp_add_inline_script( 'social-share', $inline_script,'before' );
	}

	// 图片
	public function AoTon_first_image() {
		global $post;
		$first_img = array();
		if(has_post_thumbnail() && get_the_post_thumbnail( get_the_ID() )!='') {
			$first_img['src'] = wp_get_attachment_image_src( get_post_thumbnail_id( $post ), 'post-thumbnail' )[0];
			return $first_img;
		}

		if( preg_match_all( '#<img[^>]+>#is', $post->post_content, $match ) ) {
			$match_frist = $match[0][0];
			if( $match_frist ) :
				preg_match( '#src=[\'"]([^\'"]+)[\'"]#', $match_frist, $src );
				preg_match( '#width=[\'"]([^\'"]+)[\'"]#', $match_frist, $width );
				preg_match( '#height=[\'"]([^\'"]+)[\'"]#', $match_frist, $height );

				$first_img['src'] = $src ? $src[1] : '';
				$first_img['width'] = $width ? $width[1] : '';
				$first_img['height'] = $height ? $height[1] : '';
			endif;
		} else {
			$first_img = 0;
		}
		return $first_img;
	}

	// 海报
	public function AoTon_share_post_handler() {
		global $post;
		if( isset( $_POST['id'] ) && $_POST['id'] && $post = get_post( $_POST['id'] ) ) {
			setup_postdata( $post );
			$img_url = $this->AoTon_first_image();

			$opt_def_img = aoton( 'poster_img' );
			$def_cover = aoton( 'poster_img' );
			$share_head = $img_url ? $img_url['src'] : ( !empty($opt_def_img) ? $opt_def_img : $def_cover );

			$share_logo = aoton( 'poster_logo' );
			if (has_excerpt('')){
				$excerpt = wp_trim_words( get_the_excerpt(), '56', '...' );
			} else {
				$content = get_the_content();
				$content = wp_strip_all_tags(str_replace(array('[',']'),array('<','>'),$content));
				$excerpt = wp_trim_words( $content, '56', '...' );
			}
			$titles = wp_trim_words( get_the_title(), 34 );

			$category = get_the_category();

			$warn = sprintf(__( '长按识别二维码查看详细内容', 'AoTon' ));
			$res = array(
				'head' => $this->AoTon_image_to_base64( $share_head ),
				'logo' => $this->AoTon_image_to_base64( $share_logo ),
				'ico_cat' => '✪',
				'post_cat' => $category[0]->cat_name,
				'title' => $titles,
				'excerpt' => $excerpt,
				'warn' => $warn,
				'get_name' => get_bloginfo( 'name' ),
				'web_home' => get_bloginfo( 'description' ),
				'day' => get_the_time( 'd', $post_id ),
				'year' => get_the_time( 'm / Y', $post_id )
			);
			wp_reset_postdata();
			echo wp_json_encode($res);
			exit;
		}
	}

	public function AoTon_image_to_base64( $image ){
		$site_domain = parse_url(get_bloginfo('url'), PHP_URL_HOST);
		$img_domain = parse_url($image, PHP_URL_HOST);
		if ( $img_domain != $site_domain ) {
			$http_options = array(
				'httpversion' => '1.0',
				'timeout' => 20,
				'redirection' => 20,
				'sslverify' => FALSE,
				'user-agent' => 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; MALC)'
			);
			if( preg_match('/^\/\//i', $image ) ) $image = 'http:' . $image;
			$get = wp_remote_get( $image, $http_options );
			if ( !is_wp_error($get) && 200 === $get ['response'] ['code'] ) {
				$img_base64 = 'data:' . $get['headers']['content-type'] . ';base64,' . base64_encode( $get ['body'] );
				return $img_base64;
			}
		}
		$image = preg_replace( '/^(http:|https:)/i', '', $image );
		return $image;
	}
}

new AoTon_Front();

// [AoTon_share1]
add_shortcode( 'AoTon_share1','AoTon_share1_social' );
function AoTon_share1_social() {
	return share_poster();
}

function share_poster() { ?>
<div class="sharing-box">
	<a class="AoTon-btn-beshare AoTon-btn-donate use-beshare-donate-btn bk" title="打赏"></a>
	<a class="AoTon-btn-beshare AoTon-btn-like use-beshare-like-btn bk" data-count="<?php global $wpdb, $post; $aoton_like = get_post_meta($post->ID, 'aoton_like', true);{echo $aoton_like;}?>" title="点赞">
		<span class="like-number">
			<?php 
				global $wpdb, $post;
				if( get_post_meta($post->ID,'aoton_like',true) ){
					echo '';
					echo get_post_meta($post->ID,'aoton_like',true);
				} else {
					echo sprintf(__( '点赞', 'AoTon' )) ;
				}
			?>
		</span>
		<div class="triangle-down"></div>
	</a>
	<a class="AoTon-btn-beshare AoTon-btn-share use-beshare-social-btn bk" title="分享"></a>
	<span id="post-link"><?php echo get_permalink(); ?></span>
	<a class="AoTon-btn-beshare AoTon-btn-link use-beshare-link-btn bk" title="复制链接" onclick="copyLink()"></a>
	<a class="AoTon-btn-beshare AoTon-share-poster use-beshare-poster-btn bk" title="海报"></a>
</div>
<?php }

// [aoton_share]
add_shortcode( 'aoton_share','aoton_share_social' );
function aoton_share_social() {
	return aoton_share_poster();
}
function aoton_share_poster() { ?>
<a  title="点赞" class="AoTon-btn-like use-beshare-like-btn" data-count="<?php global $wpdb, $post; $aoton_like = get_post_meta($post->ID, 'aoton_like', true);{echo $aoton_like;}?>">
<i class="uil-thumbs-up"></i>
<span>赞</span>
<i class="count like-number">
<?php global $wpdb, $post;
if( get_post_meta($post->ID,'aoton_like',true) ){
	echo '';
	echo get_post_meta($post->ID,'aoton_like',true);
} else {
	echo '0';
}
?></i>
</a> 
<?php }