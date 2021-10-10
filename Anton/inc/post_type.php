<?php 

if (aoton('notiviation')) {
	// 公告
	add_action( 'init', 'post_type_bulletin' );
	function post_type_bulletin() {
		$type_url = aoton('bull_url');
		$labels = array(
			'name'               => '公告',
			'singular_name'      => '公告',
			'menu_name'          => '公告',
			'name_admin_bar'     => '公告',
			'add_new'            => '发布公告',
			'add_new_item'       => '发布新公告', 
			'new_item'           => '新公告',
			'edit_item'          => '编辑公告',
			'view_item'          => '查看公告',
			'all_items'          => '所有公告',
			'search_items'       => '搜索公告',
			'parent_item_colon'  => 'Parent 公告:',
			'not_found'          => '你还没有发布公告。',
			'not_found_in_trash' => '回收站中没有公告。'
		);
	
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $type_url ),
			'capability_type'    => 'post',
			'menu_icon'          => 'dashicons-controls-volumeon',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 10,
			'show_in_rest'       => true,
			'supports'           => array( 'title', 'editor', 'author', 'excerpt', 'comments', 'custom-fields' )
		);
	
		register_post_type( 'bulletin', $args );
	}
	}
	
	// 公告分类
	add_action( 'init', 'create_bulletin_taxonomies', 0 );
	function create_bulletin_taxonomies() {
		$type_url = aoton('bull_cat_url');
		$labels = array(
			'name'              => '公告分类目录',
			'singular_name'     => '公告分类',
			'search_items'      => '搜索公告目录',
			'all_items'         => '所有公告目录',
			'parent_item'       => '父级分类目录',
			'parent_item_colon' => '父级分类目录:',
			'edit_item'         => '编辑公告目录',
			'update_item'       => '更新公告目录',
			'add_new_item'      => '添加新公告目录',
			'new_item_name'     => 'New Genre Name',
			'menu_name'         => '公告分类',
		);
	
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => $type_url ),
		);
	
		register_taxonomy( 'notice', array( 'bulletin' ), $args );
	}

// 添加到幻灯
$show_post_meta_boxes =
array(
	"show" => array(
		"name" => "show",
		"std" => "",
		"title" => "输入图片链接地址，则显示在首页幻灯中，默认宽度大于800px，尺寸必须相同",
		"type"=>"upload"),

	"go_url" => array(
		"name" => "show_url",
		"std" => "",
		"title" => "输入链接地址，可让幻灯跳转到任意链接页面",
		"type"=>"text"),

	"slide_title" => array(
		"name" => "slide_title",
		"std" => "",
		"title" => "自定义标题内容",
		"type"=>"text"),

	"no_slide_title" => array(
		"name" => "no_slide_title",
		"std" => "",
		"title" => "不显示标题文字",
		"type"=>"checkbox"),
);

function show_post_meta_boxes() {
	global $post, $show_post_meta_boxes;

	foreach ($show_post_meta_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'] . '', true);
		if ($meta_box_value != "")

		$meta_box['std'] = $meta_box_value;
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';

		switch ($meta_box['type']) {
			case 'title':
				echo '<h4>' . $meta_box['title'] . '</h4>';
			break;
			case 'upload':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field file-uploads"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /><a href="javascript:;" class="begin_file button">选择图片</a></span><br />';
			break;
			case 'text':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field"><input type="text" size="40" name="' . $meta_box['name'] . '" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'number':
				echo '<h4>' . $meta_box['title'] . '</h4>';
				echo '<span class="form-field meta-number"><input type="number" size="0" name="' . $meta_box['name'] . '" step="1" min="0" value="' . $meta_box['std'] . '" /></span><br />';
			break;
			case 'checkbox':
				if (isset($meta_box['std']) && $meta_box['std'] == 'true') $checked = 'checked = "checked"';
				else $checked = '';
				echo '<br /><label><input type="checkbox" class="checkbox" name="' . $meta_box['name'] . '" value="true"  ' . $checked . ' />';
				echo '' . $meta_box['title'] . '</label><br />';
				break;
			}
		}
}

function show_post_meta_box() {
	global $theme_name;
	if (function_exists('add_meta_box')) {
		add_meta_box('show_post_meta_box', '将文章添加到首页幻灯', 'show_post_meta_boxes', 'post', 'normal', 'high');
	}
}

function save_show_post_postdata($post_id) {
	global $post, $show_post_meta_boxes;
	foreach ($show_post_meta_boxes as $meta_box) {
		if (!wp_verify_nonce(@$_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
		$data = $_POST[$meta_box['name'] . ''];
		if (get_post_meta($post_id, $meta_box['name'] . '') == "") add_post_meta($post_id, $meta_box['name'] . '', $data, true);
		elseif ($data != get_post_meta($post_id, $meta_box['name'] . '', true)) update_post_meta($post_id, $meta_box['name'] . '', $data);
		elseif ($data == "") delete_post_meta($post_id, $meta_box['name'] . '', get_post_meta($post_id, $meta_box['name'] . '', true));
	}
}

add_action('admin_menu', 'show_post_meta_box');
add_action('save_post', 'save_show_post_postdata');
function upload_js() { ?>
	<script>
	jQuery(document).ready(function() {
		var $ = jQuery;
		if (typeof wp !== 'undefined' && wp.media && wp.media.editor) {
			$(document).on('click', '.begin_file',
			function(e) {
				e.preventDefault();
				var button = $(this);
				var id = button.prev();
				wp.media.editor.send.attachment = function(props, attachment) {
					if ($.trim(id.val()) != '') {
						id.val(id.val() + '\n' + attachment.url);
					} else {
						id.val(attachment.url);
					}
				};
				wp.media.editor.open(button);
				return false;
			});
		}
	});
	</script>
<?php };
add_action('admin_head', 'upload_js');
