<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php $term_id = ''; ?>
<?php if (aoton('wp_title')) { ?>

	<?php if ( aoton('home_title') == '' ) { ?>
      <?php if ( is_home() || is_front_page() ) { ?>
         <title><?php bloginfo('name'); ?><?php $description = get_bloginfo( 'description', 'display' ); if ( $description ) : ?><?php if (aoton('blog_info')) { ?><?php connector(); ?><?php bloginfo('description'); ?><?php } ?><?php endif; ?><?php if(get_query_var('paged')) {echo ' - 第';echo get_query_var('paged');echo '页';}?></title>
      <?php } ?>
	<?php } else { ?>
		<?php if ( is_home() || is_front_page() ) { ?>
         <title><?php echo aoton('home_title'); ?><?php if (aoton('home_info')) { ?><?php connector(); ?><?php echo aoton('home_info'); ?><?php } ?><?php if (get_query_var('paged')) { echo ' - 第'; echo get_query_var('paged'); echo '页'; } ?></title>
      <?php } ?>
	<?php } ?>

	<?php if ( is_search() ) { ?>
      <title><?php echo wp_get_document_title(); ?></title>
   <?php } ?>

	<?php if ( is_single() ) { ?>
      <title><?php if ( get_post_meta($post->ID, 'custom_title', true) ) { ?><?php echo trim(get_post_meta($post->ID, 'custom_title', true)); ?><?php if (get_query_var('page')) {echo ' - 第';echo get_query_var('page');echo '页';} ?><?php } else { ?><?php echo trim(wp_title('',0)); ?><?php if (get_query_var('page')) {echo ' - 第';echo get_query_var('page');echo '页';} ?><?php if (!aoton('blog_name')) {connector();bloginfo('name');} ?><?php } ?></title>
   <?php } ?>

	<?php if ( is_page() && !is_front_page() ) { ?>
      <title><?php if ( get_post_meta($post->ID, 'custom_title', true) ) { ?><?php echo trim(get_post_meta($post->ID, 'custom_title', true)); ?><?php } else { ?><?php echo trim(wp_title('',0)); ?><?php } ?><?php if ( get_post_meta($post->ID, 'custom_title', true) ) { ?><?php } else { ?><?php if (!aoton('blog_name')) {connector();bloginfo('name');} ?><?php } ?></title>
   <?php } ?>

	<?php if ( is_category() ) { ?>
      <?php $term_id = get_query_var('cat'); ?>
   <?php } ?>

	<?php if ( get_option( 'cat-title-'.$term_id )) : ?>
      <?php if ( is_category() ) { ?>
         <title><?php echo get_option( 'cat-title-'.$term_id ); ?><?php if (get_query_var('paged')) {echo ' - 第';echo get_query_var('paged');echo '页';} ?></title>
      <?php } ?>
	<?php else: ?>
      <?php if ( is_category() ) { ?>
         <title><?php single_cat_title(); ?><?php if (get_query_var('paged')) {echo ' - 第';echo get_query_var('paged');echo '页';} ?><?php if (!aoton('blog_name')) {connector();bloginfo('name');} ?></title>
      <?php } ?>
	<?php endif; ?>

	<?php if ( is_author() ) { ?>
      <title><?php the_author(); ?><?php _e( '发表的所有文章', 'begin' ); ?><?php if (!aoton('blog_name')) {connector();bloginfo('name');} ?></title>
   <?php } ?>

	<?php if ( is_404() ) { ?>
      <title><?php echo stripslashes( aoton('404_t') ); ?><?php if (!aoton('blog_name')) { connector();bloginfo('name'); ?><?php } ?></title>
   <?php } ?>

	<?php if ( is_tag() ) { ?>
      <?php $term_id = get_query_var('tag_id'); ?>
   <?php } ?>

	<?php if ( get_option( 'tag-title-'.$term_id )) : ?>
      <?php if ( is_tag() ) { ?>
         <title><?php echo get_option( 'tag-title-'.$term_id ); ?><?php if (get_query_var('paged')) {echo ' - 第';echo get_query_var('paged');echo '页';} ?><?php if (!aoton('blog_name')) {connector();bloginfo('name');} ?></title>
      <?php } ?>
	<?php else: ?>
      <?php if (function_exists('is_tag')) {if ( is_tag() ) { ?>
            <title><?php  single_tag_title("", true); ?><?php if (get_query_var('paged')) {echo ' - 第';echo get_query_var('paged');echo '页'; }?><?php if (!aoton('blog_name')) {connector();bloginfo('name');} ?></title>
         <?php } ?>
      <?php } ?>
	<?php endif; ?>

	<?php if ( ! is_single() && ! is_home() && ! is_category() && ! is_search() && ! is_tag() && ! is_author() ) { ?>
      
      <?php if ( has_post_format( 'aside' ) ) { ?>
         <title><?php echo get_post_format_string( 'aside' ); ?><?php if (!aoton('blog_name')) {connector();bloginfo('name');} ?></title>
      <?php } ?>
      
      <?php if ( has_post_format( 'image' ) ) { ?>
         <title><?php echo get_post_format_string( 'image' ); ?><?php if (!aoton('blog_name')) {connector();bloginfo('name');} ?></title>
      <?php } ?>
   <?php } ?>
   
   <?php if ( is_tax('notice') ) { ?>
      <title><?php setTitle(); ?><?php if (!aoton('blog_name')) {connector();bloginfo('name');} ?></title>
   <?php } ?>

	<?php if( is_single() || is_page() ) {
      if( function_exists('get_query_var') ) {
         $cpage = intval(get_query_var('cpage'));
         $commentPage = intval(get_query_var('comment-page'));
         }
      if( !empty($cpage) || !empty($commentPage) ) {
         echo '<meta name="robots" content="noindex, nofollow" />'; echo "\n";
         } 
   } ?>

	<?php if (!function_exists('utf8Substr')) {
      function utf8Substr($str, $from, $len) {
         return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'. '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s', '$1',$str); }
      }
   
      if ( is_single() ) {
         if ($post->post_excerpt) {
            $description  = $post->post_excerpt;
         } else {
            if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)) {
               $post_content = $result['1'];
            } else {
               $post_content_r = explode("\n",trim(strip_tags($post->post_content)));
               $post_content = $post_content_r['0'];
            }
            $description = utf8Substr($post_content,0,220);
         }
         $keywords = "";
         $tags = wp_get_post_tags($post->ID);
         foreach ($tags as $tag ) {
            $keywords = $keywords . $tag->name . ",";
         }
      }?>
   
   <?php echo "\n"; ?>

	<?php if ( is_single() ) { ?>

		<?php if ( get_post_meta($post->ID, 'description', true) ) : ?>
		   <meta name="description" content="<?php $description = get_post_meta($post->ID, 'description', true);{echo $description;}?>" />
		<?php else: ?>
			<meta name="description" content="<?php echo trim($description); ?>" />
		<?php endif; ?>

		<?php if ( get_post_meta($post->ID, 'keywords', true) ) : ?>
         <meta name="keywords" content="<?php $keywords = get_post_meta($post->ID, 'keywords', true);{echo $keywords;}?>" />
		<?php else: ?>
         <meta name="keywords" content="<?php echo trim($keywords,','); ?>" />
		<?php endif; ?>
	<?php } ?>

	<?php if ( is_page() ) { ?>
		<meta name="description" content="<?php $description = get_post_meta($post->ID, 'description', true);{echo $description;}?>" />
		<meta name="keywords" content="<?php $keywords = get_post_meta($post->ID, 'keywords', true);{echo $keywords;}?>" />
	<?php } ?>

	<?php if ( is_category() ) { ?>
		<meta name="description" content="<?php echo trim(strip_tags(wp_trim_words(tag_description(), 160))); ?>" />
		<?php if ( get_option( 'cat-words-'.$term_id )) : ?>
		   <meta name="keywords" content="<?php echo get_option( 'cat-words-'.$term_id ); ?>" />
		<?php else: ?>
		   <meta name="keywords" content="<?php single_cat_title(); ?>" />
		<?php endif; ?>
	<?php } ?>

	<?php if ( is_search() ) { ?>
		<meta name="description" content="在<?php bloginfo('name'); ?>网站搜索'<?php echo get_search_query(); ?>'结果" />
		<meta name="keywords" content="<?php echo get_search_query(); ?>" />
	<?php } ?>

	<?php if ( is_tag() ) { ?>
		<meta name="description" content="<?php echo trim(strip_tags(wp_trim_words(tag_description(), 160))); ?>" />
		<?php if ( get_option( 'tag-words-'.$term_id )) : ?>
		<meta name="keywords" content="<?php echo get_option( 'tag-words-'.$term_id ); ?>" />
		<?php else: ?>
		<meta name="keywords" content="<?php echo single_tag_title(); ?>" />
		<?php endif; ?>
	<?php } ?>
	<?php if ( is_home() ) { ?>
		<meta name="description" content="<?php echo aoton('description'); ?>" />
		<meta name="keywords" content="<?php echo aoton('keyword'); ?>" />
	<?php } ?>
<?php } ?>
<?php if (aoton('og_title')) { ?>
<?php require THEME_DIR . '/inc/og.php'; ?>
<?php } ?>