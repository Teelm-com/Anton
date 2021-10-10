<?php
// 标准缩略图
add_theme_support("post-thumbnails");//开启缩略图
function aoton_thumbnail() {
	global $post;
	if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<a href="'.get_permalink().'"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a>';
	} else {
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/thumbnail.php?src='.$strResult[1][0].'&w=400&h=200&a=t&zc=1" alt="'.$post->post_title .'" class="uk-animation-reverse uk-transform-origin-top-right" uk-scrollspy="cls: uk-animation-kenburns; repeat: true" /></a>';
		} else { 
			$random = mt_rand(1, 5);
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/assets/images/random/'. $random .'.jpg" alt="'.$post->post_title .'" class="uk-animation-reverse uk-transform-origin-top-right" uk-scrollspy="cls: uk-animation-kenburns; repeat: true" /></a>';
		}
	}
}
function slider_thumbnail() {
	global $post;
	if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<a href="'.get_permalink().'"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a>';
	} else {
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/thumbnail.php?src='.$strResult[1][0].'&w=1400&h=600&a=t&zc=1" alt="'.$post->post_title .'" class="uk-animation-reverse uk-transform-origin-top-right" uk-scrollspy="cls: uk-animation-kenburns; repeat: true" /></a>';
		} else { 
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/assets/images/one_s.jpg" alt="'.$post->post_title .'" class="uk-animation-reverse uk-transform-origin-top-right" uk-scrollspy="cls: uk-animation-kenburns; repeat: true" /></a>';
		}
	}
}
function two_slider_thumbnail() {
	global $post;
	if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<a href="'.get_permalink().'"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a>';
	} else {
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/thumbnail.php?src='.$strResult[1][0].'&w=150&h=160&a=t&zc=1" alt="'.$post->post_title .'" /></a>';
		} else { 
			$random = mt_rand(1, 5);
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/assets/images/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a>';
		}
	}
}
  function UserpostThemes_thumbnail() {
	global $post;
	if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<a href="'.get_permalink().'"><img src=';
		echo $image;
		echo ' alt="'.$post->post_title .'" /></a>';
	} else {
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);
		if($n > 0){
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/thumbnail.php?src='.$strResult[1][0].'&w=285&h=180&a=t&zc=1" alt="'.$post->post_title .'" /></a>';
		} else { 
			$random = mt_rand(1, 5);
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/assets/images/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a>';
		}
	}
}