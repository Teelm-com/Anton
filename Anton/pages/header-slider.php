<!-- 幻灯 -->
<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php if (aoton('slider')) { ?>
<div uk-scrollspy="cls: uk-animation-fade; target: .uk-card; delay: 5000; repeat: true">
	<div class="uk-position-relative uk-visible-toggle uk-light" uk-slideshow="ratio: 7:3; animation: fade; autoplay-interval: 5000" tabindex="-1" autoplay="true">
		<ul class="uk-slideshow-items">
					<?php
						$posts = get_posts( array(
							'numberposts' => aoton('slider_n'),
							'post_type' => 'any',
							'meta_key' => 'show',
							'order' => 'date',
							'ignore_sticky_posts' => 1
						) );
					?>
				<?php if($posts) : foreach( $posts as $post ) : setup_postdata( $post );$do_not_duplicate[] = $post->ID; $do_show[] = $post->ID; ?>
					<li id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
						<?php $image = get_post_meta($post->ID, 'show', true); ?>
						<?php $go_url = get_post_meta($post->ID, 'show_url', true); ?>
							<?php if ( get_post_meta($post->ID, 'show_url', true) ) : ?>
							<a href="<?php echo $go_url; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/thumbnail.php?src=<?php echo $image; ?>&w=1400&h=600&a=t&zc=1" alt="<?php the_title(); ?>" /></a>
							<?php else: ?>
							<a href="<?php the_permalink(); ?>" rel="bookmark"><img src="<?php echo get_template_directory_uri(); ?>/thumbnail.php?src=<?php echo $image; ?>&w=1400&h=600&a=t&zc=1" alt="<?php the_title(); ?>" /></a>
							<?php endif; ?>

						<?php if ( get_post_meta($post->ID, 'no_slide_title', true) ) : ?>
						<?php else: ?>
							<?php if ( get_post_meta($post->ID, 'slide_title', true) ) : ?>
							<?php $slide_title = get_post_meta($post->ID, 'slide_title', true); ?>
								<div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom slideshow-overlay">
									<p uk-slideshow-parallax="x: 200,-200; opacity: 1,1,0"><?php echo $slide_title; ?></p>
								</div>
							<?php else: ?>
								<div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom slideshow-overlay">
									<p uk-slideshow-parallax="x: 200,-200; opacity: 1,1,0"><?php the_title(); ?></p>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</li>
				<?php endforeach; endif; ?>
				<?php wp_reset_query(); ?>
		</ul>
		<div class="clear"></div>
		<div class="uk-visible@m">     
			<a class="uk-position-center-left-out slidenav-prev" href="#" uk-slideshow-item="previous"></a>
            <a class="uk-position-center-right-out slidenav-next" href="#" uk-slideshow-item="next"></a>
		</div>
	</div>
</div>
<?php } ?>