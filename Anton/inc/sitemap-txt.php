<?php 
function aoton_get_txt_sitemap() {
	ob_start();
?>
<?php echo get_home_url(); ?>

<?php 
	$posts = get_posts('numberposts=' .aoton('sitemap_n') . '&orderby=post_date&order=DESC');
	foreach($posts as $post) : 
?>
<?php echo get_permalink($post->ID); ?>

<?php 
	endforeach;
	$posts = get_posts('post_type=bulletin&numberposts=' .aoton('sitemap_n') . '&orderby=post_date&order=DESC');
	foreach($posts as $post) : 
?>
<?php if (aoton('no_bulletin')) { ?>
<?php echo get_permalink($post->ID); ?>
<?php } ?>

<?php 
	endforeach;
	$categorys = get_terms('category', 'orderby=name&hide_empty=0');
	foreach ($categorys as $category) : 
?>
<?php echo get_term_link($category, $category->slug); ?>

<?php 
	endforeach;
	$tags = get_terms('post_tag', 'orderby=name&hide_empty=0');
	foreach ($tags as $tag) : 
?>
<?php if (aoton('no_sitemap_tag')) { ?>
<?php echo get_term_link($tag, $tag->slug); ?>
<?php } ?>

<?php 
	endforeach;
	$categorys = get_terms('notice', 'orderby=name&hide_empty=0');
	foreach ($categorys as $category) : 
?>
<?php if (aoton('no_bulletin')) { ?>
<?php echo get_term_link($category, $category->slug); ?>
<?php } ?>

<?php 
	endforeach;
?>
<?php 
	$sitemap_txt = ob_get_contents();
	ob_clean();
	return $sitemap_txt;
}