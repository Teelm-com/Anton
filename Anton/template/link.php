<?php
/*
Template Name: 友情链接
*/

if ( ! defined( 'ABSPATH' ) ) { exit; }
if (aoton('add_link')) {
if( isset($_POST['aoton_form']) && $_POST['aoton_form'] == 'send'){
global $wpdb;

$link_name = isset( $_POST['aoton_name'] ) ? trim(htmlspecialchars($_POST['aoton_name'], ENT_QUOTES)) : '';
$link_url = isset( $_POST['aoton_url'] ) ? trim(htmlspecialchars($_POST['aoton_url'], ENT_QUOTES)) : '';
$link_description = isset( $_POST['aoton_description'] ) ? trim(htmlspecialchars($_POST['aoton_description'], ENT_QUOTES)) : '';
$link_notes = isset( $_POST['link_notes'] ) ? trim(htmlspecialchars($_POST['link_notes'], ENT_QUOTES)) : '';
$link_target = "_blank";
$link_visible = "N";

if ( empty($link_name) || mb_strlen($link_name) > 20 ){
	wp_die('连接名称必须填写，且长度不得超过30字<a href="'.get_permalink( aoton('link_url') ).' "><p class="link-return">重写</p></a>');
}

if ( empty($link_description) || mb_strlen($link_description) > 100 ){
	wp_die('网站描述必须填写，且长度不得超过100字<a href="'.get_permalink( aoton('link_url') ).' "><p class="link-return">重写</p></a>');
}

if ( empty($link_notes)){
	wp_die('QQ必须填写<a href="'.get_permalink( aoton('link_url') ).' "><p class="link-return">重写</p></a>');
}

if ( empty($link_url) || strlen($link_url) > 60 || !preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $link_url)){
	wp_die('链接地址必须填写<a href="'.get_permalink( aoton('link_url') ).' "><p class="link-return">重写</p></a>');
}

$sql_link = $wpdb->insert(
$wpdb->links,
	array(
		'link_name' => $link_name.' — 待审核',
		'link_url' => $link_url,
		'link_target' => $link_target,
		'link_description' => $link_description,
		'link_notes' => $link_notes,
		'link_visible' => $link_visible
	)
);

$result = $wpdb->get_results($sql_link);
	wp_die('提交成功，等待站长审核中！<a href="'.get_permalink( aoton('link_url') ).' "><p class="link-return">返回</p></a>');
}
}
?>

<?php get_header(); ?>
<div id="offcanvas-flip" uk-offcanvas="flip: true; overlay: true" style="display:none;">
<?php if(aoton("link_bing")) { ?>
    <div class="uk-offcanvas-bar px-3" style="background: url(https://v1.teelm.com/v1/bing);">
	<div class="uk-overlay-primary uk-position-cover"></div>
<?php }else{ ?>
    <div class="uk-offcanvas-bar px-3">
<?php } ?>
		<div>
			<h2>提交友链</h2>
			<ul class="nav nav-tabs sl_srch_tabs uk-tab" uk-switcher="connect: #component-nav; animation: uk-animation-fade">
				<form method="post" class="add-link-form" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
					<p class="add-link-label">
						<label for="aoton_name"><i class="be be-personoutline"></i>链接名称 *</label>
						<input type="text" size="40" value="" class="form-control uk-input" id="aoton_name" name="aoton_name" required="required" />
					</p>
					<p class="add-link-label">
						<label for="aoton_url"><i class="be be-anchor"></i>链接地址 *</label>
						<input type="text" size="40" value="" class="form-control uk-input" id="aoton_url" name="aoton_url" required="required" />
					</p>
					<p class="add-link-label">
						<label for="link_notes"><i class="be be-qq"></i>QQ *</label>
						<input type="text" size="40" value="" class="form-control uk-input" id="link_notes" name="link_notes" required="required" />
					</p>
					<p class="add-link-label">
						<label for="aoton_description"><i class="be be-editor"></i>网站描述 *</label>
						<textarea id="aoton_description" class="form-control uk-textarea" name="aoton_description" rows="2" tabindex="1" required="required" ></textarea>
					</p>
					<p class="add-link-label">
						<input type="hidden" value="send" name="aoton_form" />
						<button type="submit" class="add-link-btn uk-input">提交申请</button>
					</p>
				</form>
            </ul>
		</div>
	</div>
</div>
<div class="sl_filter_btn" uk-toggle="target: #offcanvas-flip">  <i class="uil-filter"></i>申请友链</div>
<ul id="component-nav" class="uk-switcher">
	<li>
	<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		<div class="uk-child-width-1-6@m uk-child-width-1-2@s uk-grid-small" uk-grid>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if (!aoton('links_model') || (aoton("links_model") == 'links_ico')) {
					echo aoton_get_link_items();
				}  if (aoton('links_model') == 'links_default') {
						echo links_page();
				} ?>
    </li>
</ul>
		<?php endwhile; ?>
		<?php if ( comments_open() || get_comments_number() ) : ?>
			<?php comments_template( '', true ); ?>
		<?php endif; ?>
<?php get_footer(); ?>