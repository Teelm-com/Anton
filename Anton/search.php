<?php 
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>

<!-- list -->
<?php if ('search_list'){ ?>
	<div class="main_content_inner">
		<div uk-grid>
			<div class="uk-width-2-3@m fead-area">
				<div class="post page-search">
					<ul class="search-page">
					<?php if ( have_posts() ) : ?><?php while ( have_posts() ) : the_post(); ?>
						<div><a href="<?php  echo get_permalink($post->ID); ?>"><?php the_title(); ?></a></div>
						<?php endwhile; ?><?php else : ?>
							<article>
								<header class="entry-header">
									<h1 class="entry-title">没有找到该文章</h1>
								</header>
								<div class="entry-content">
									<p>抱歉！没有找到该文章，可以试试其他关键词哦！</p>
								</div>
							</article>
							<?php endif; ?>
					</ul>
					<?php get_template_part('ad/ad', 'search'); ?>        
					
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php } ?>
<?php get_footer(); ?>
