<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php get_header(); ?>
<div class="main_content_inner">
    <div uk-grid>
        <div class="uk-width-2-3@m fead-area">
            <?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
                <div class="post">
                    <div class="page-title">
                        <h4><?php the_title(); ?></h4>
                    </div>
                    <div class="page-fulltext">
                        <?php the_content(); ?>
                    </div>
                    <!-- post comments
                    <?php comments_template(); ?> -->
            <?php else : ?>
                <p>没有找到任何文章！</p>
            <?php endif; ?>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
<?php get_footer(); ?>