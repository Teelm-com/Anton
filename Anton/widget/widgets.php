<?php
// widgets title span
function title_i_w() {
	return '<span class="title-i"><span></span><span></span><span></span><span></span></span>';
}
// 标签云
class cx_tag_cloud extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'cx_tag_cloud',
			'description' => __( '可实现3D特效' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct('cx_tag_cloud', '热门标签', $widget_ops);
	}

	public function aoton_defaults() {
		return array(
			'show_3d'   => 1,
		);
	}

	function widget($args, $instance) {
		extract($args);
		$defaults = $this -> aoton_defaults();
		$title_w = title_i_w();
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( ! empty( $title ) )
		echo $before_title . $title_w . $title . $after_title;
		$number = strip_tags($instance['number']) ? absint( $instance['number'] ) : 20;
		@$tags_id = strip_tags($instance['tags_id']) ? absint( $instance['tags_id'] ) : 1;
?>
	<?php if(@$instance['show_icon']) { ?>
		<h3 class="widget-title-cat-icon cat-w-icon da"><i class="t-icon <?php echo $instance['show_icon']; ?>"></i><?php echo $instance['title_z']; ?></h3>
	<?php } ?>
	<?php if(@$instance['show_svg']) { ?>
		<h3 class="widget-title-cat-icon cat-w-icon da"><svg class="t-svg icon" aria-hidden="true"><use xlink:href="#<?php echo $instance['show_svg']; ?>"></use></svg><?php echo $instance['title_z']; ?></h3>
	<?php } ?>
	<?php if ($instance['show_3d']) { ?>
		<div id="tag_cloud_widget">
	<?php } else { ?>
		<div class="tagcloud">
	<?php } ?>
	<?php wp_tag_cloud( array ( 'smallest' => '14', 'largest' => 14, 'unit' => 'px', 'order' => 'RAND', 'hide_empty' => 0, 'number' => $number, 'include' => @$instance["tags_id"] ) ); ?>
	<div class="clear"></div>
	<?php if ($instance['show_3d']) : ?><?php wp_enqueue_script('3dtag'); ?><?php endif; ?>
</div>

<?php
	echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		if (!isset($new_instance['submit'])) {
			return false;
		}
		$instance = $old_instance;
		$instance = array();
		$instance['title_z'] = strip_tags($new_instance['title_z']);
		$instance['show_icon'] = strip_tags($new_instance['show_icon']);
		$instance['show_svg'] = strip_tags($new_instance['show_svg']);
		$instance['show_3d'] = $new_instance['show_3d']?1:0;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags($new_instance['number']);
		$instance['tags_id'] = strip_tags($new_instance['tags_id']);
		return $instance;
	}
	function form($instance) {
		$defaults = $this -> aoton_defaults();
		$instance = wp_parse_args( (array) $instance, $defaults );
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = '热门标签';
		}
		global $wpdb;
		$instance = wp_parse_args((array) $instance, array('number' => '20'));
		$number = strip_tags($instance['number']);
		$instance = wp_parse_args((array) $instance, array('tags_id' => ''));
		$tags_id = strip_tags($instance['tags_id']);
?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">标题：</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('title_z'); ?>">图标标题：</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title_z'); ?>" name="<?php echo $this->get_field_name('title_z'); ?>" type="text" value="<?php echo @$instance['title_z']; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('show_icon'); ?>">单色图标代码：</label>
		<input class="widefat" id="<?php echo $this->get_field_id('show_icon'); ?>" name="<?php echo $this->get_field_name('show_icon'); ?>" type="text" value="<?php echo @$instance['show_icon']; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('show_svg'); ?>">彩色图标代码：</label>
		<input class="widefat" id="<?php echo $this->get_field_id('show_svg'); ?>" name="<?php echo $this->get_field_name('show_svg'); ?>" type="text" value="<?php echo @$instance['show_svg']; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'number' ); ?>">显示数量：</label>
		<input class="number-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('tags_id'); ?>">输入标签ID调用指定标签：</label>
		<textarea style="height:50px;" class="widefat" id="<?php echo $this->get_field_id( 'tags_id' ); ?>" name="<?php echo $this->get_field_name( 'tags_id' ); ?>"><?php echo stripslashes(htmlspecialchars(( $instance['tags_id'] ), ENT_QUOTES)); ?></textarea>
	</p>

	<p>
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_3d') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_3d') ); ?>" <?php checked( (bool) $instance["show_3d"], true ); ?>>
		<label for="<?php echo esc_attr( $this->get_field_id('show_3d') ); ?>">显示3D特效</label>
	</p>
	<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php }
}

function cx_tag_cloud_init() {
	register_widget( 'cx_tag_cloud' );
}
add_action( 'widgets_init', 'cx_tag_cloud_init' );

// 关于作者
class about_author extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'about_author',
			'description' => __( '只显示在正文和作者页面' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct('about_author', '关于作者', $widget_ops);
	}

	public function aoton_defaults() {
		return array(
			'show_inf' => 1,
			'show_posts' => 1,
			'show_comment' => 1,
			'show_views' => 1,
			'show_like' => 1
		);
	}

	function widget($args, $instance) {
		extract($args);
		$title_w = title_i_w();
		if ( is_author() || is_single() ){ 
			$title = apply_filters( 'widget_title', $instance['title'] );
			echo $before_widget;
			if ( ! empty( $title ) )
			echo $before_title . $title_w . $title . $after_title;
     	}
?>

<?php if ( is_author() || is_single() ) { ?>
<?php
	global $wpdb;
	$author_id = get_the_author_meta( 'ID' );
	$comment_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->comments  WHERE comment_approved='1' AND user_id = '$author_id' AND comment_type not in ('trackback','pingback')" );
?>
<div id="about_author_widget">
	<div class="author-meta-box">
		<?php if ( $instance[ 'author_back' ]  ) { ?>
			<div class="author-back" style="background-image: url('<?php echo $instance['author_back']; ?>');"></div>
		<?php } ?>
		<div class="author-meta">
			<div class="author-avatar">
				<?php echo get_avatar( get_the_author_meta('user_email'), 96, '', get_the_author() ); ?>
				<div class="clear"></div>
			</div>
			<h4 class="author-the"><?php the_author(); ?></h4>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div class="author-th">
			<div class="author-description"><?php the_author_meta( 'user_description' ); ?></div>
			<?php if(@$instance['show_inf']) { ?>
				<div class="author-th-inf">
					<?php if (@$instance['show_posts'] ) { ?><div class="author-n author-nickname"><span><?php the_author_posts(); ?></span><br /><?php _e( '文章', 'aoton' ); ?></div><?php } ?>
					<?php if (@$instance['show_comment'] ) { ?><div class="author-n"><span><?php echo $comment_count;?></span><br /><?php _e( '评论', 'aoton' ); ?></div><?php } ?>
					<?php if (@$instance['show_views'] && function_exists( 'be_the_views' )) { ?><div class="author-n"><span><?php author_posts_views(get_the_author_meta('ID'));?></span><br /><?php _e( '浏览', 'aoton' ); ?></div><?php } ?>
					<?php if (@$instance['show_like'] && function_exists( 'be_the_views' )) { ?><div class="author-n author-th-views"><span><?php like_posts_views(get_the_author_meta('ID'));?></span><br /><?php _e( '点赞', 'aoton' ); ?></div><?php } ?>
				</div>
			<?php } ?>
			<div class="author-m"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php _e( '更多文章', 'aoton' ); ?></a></div>
			<div class="clear"></div>
		</div>
	<div class="clear"></div>
	</div>
</div>
<?php } ?>

<?php
	echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		if (!isset($new_instance['submit'])) {
			return false;
		}
			$instance = $old_instance;
			$instance = array();
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['author_back'] = $new_instance['author_back'];
			$instance['show_inf'] = $new_instance['show_inf']?1:0;
			$instance['show_posts'] = $new_instance['show_posts']?1:0;
			$instance['show_comment'] = $new_instance['show_comment']?1:0;
			$instance['show_views'] = $new_instance['show_views']?1:0;
			$instance['show_like'] = $new_instance['show_like']?1:0;
			// $instance['author_url'] = $new_instance['author_url'];
			return $instance;
		}
	function form($instance) {
		$defaults = $this -> aoton_defaults();
		$instance = wp_parse_args( (array) $instance, $defaults );
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = '关于作者';
		}
		global $wpdb;
		$instance = wp_parse_args((array) $instance, array('author_back' => 'https://s3.ax1x.com/2020/11/28/DsgTPI.jpg'));
		$author_back = $instance['author_back'];
		// $instance = wp_parse_args((array) $instance, array('author_url' => ''));
		// $author_url = $instance['author_url'];
?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">标题：</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('author_back'); ?>">背景图片：</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'author_back' ); ?>" name="<?php echo $this->get_field_name( 'author_back' ); ?>" type="text" value="<?php echo $author_back; ?>" />
	</p>
	<p>
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_inf') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_inf') ); ?>" <?php checked( (bool) $instance["show_inf"], true ); ?>>
		<label for="<?php echo esc_attr( $this->get_field_id('show_inf') ); ?>">显示信息</label>
	</p>
	<p>
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_posts') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_posts') ); ?>" <?php checked( (bool) $instance["show_posts"], true ); ?>>
		<label for="<?php echo esc_attr( $this->get_field_id('show_posts') ); ?>">文章</label>
	</p>
	<p>
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_comment') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_comment') ); ?>" <?php checked( (bool) $instance["show_comment"], true ); ?>>
		<label for="<?php echo esc_attr( $this->get_field_id('show_comment') ); ?>">评论</label>
	</p>
	<p>
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_views') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_views') ); ?>" <?php checked( (bool) $instance["show_views"], true ); ?>>
		<label for="<?php echo esc_attr( $this->get_field_id('show_views') ); ?>">浏览</label>
	</p>
	<p>
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_like') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_like') ); ?>" <?php checked( (bool) $instance["show_like"], true ); ?>>
		<label for="<?php echo esc_attr( $this->get_field_id('show_like') ); ?>">占赞</label>
	</p>
	<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php }
}
function about_author_init() {
	register_widget( 'about_author' );
}
add_action( 'widgets_init', 'about_author_init' );