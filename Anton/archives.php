<?php
// 文章归档| http://zww.me 
if ( ! defined( 'ABSPATH' ) ) { exit; }
function cx_archives_list() {
	if( !$output = get_option('cx_archives_list') ){
		$output = '<div id="all_archives">';
        $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' );
		$year=0; $mon=0; $i=0; $j=0;
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$year_tmp = get_the_time('Y');
			$mon_tmp = get_the_time('m');
			$y=$year; $m=$mon;
			if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
			if ($year != $year_tmp && $year > 0) $output .= '</ul>';
			if ($year != $year_tmp) {
				$year = $year_tmp;
				$output .= '<h3 class="year">'. $year .' 年</h3><ul class="mon_list">';
			}
			if ($mon != $mon_tmp) {
				$mon = $mon_tmp;
				$output .= '<li><span class="mon">'. $mon .'月</span><ul class="post_list">';
			}
			$output .= '<li>'. get_the_time('d日 ') .'<a href="'. get_permalink() .'">'. get_the_title() .'</a>';
		endwhile;
		wp_reset_postdata();
		$output .= '</ul></li></ul></div>';
		update_option('cx_archives_list', $output);
	}
	echo $output;
}
?>