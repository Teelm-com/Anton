<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<!-- 幻灯二 -->
<div class="uk-position-relative" uk-slider="finite: true" autoplay="true">
    <div class="uk-slider-container uk-width-* pb-3 mt-3 uk-inline">
        <div class="topslider uk-position-top-left uk-overlay uk-overlay-default">置顶文章</div>
        <ul class="uk-slider-items uk-child-width-1-5@m uk-child-width-1-3@s uk-child-width-1-3 story-slider uk-grid">
            
            <?php
                $query_post = array(
                    'posts_per_page' => aoton('top_slider_n'),
                    'post__in' => get_option('sticky_posts'),
                    'ignore_sticky_posts' => 1
                    );
                    query_posts($query_post);
            ?>
            
            <?php while(have_posts()):the_post(); ?>
            <li>
                <div class="stors-card" data-src="" uk-img>
                    <figure class="thumbnail uk-width-1-5@m" data-src="" uk-img>
                        <?php two_slider_thumbnail(); ?>
                    </figure>
                    <div class="stors-card-content">
                        <a href="<?php the_permalink() ?>" rel="bookmark" class="title"><? echo  get_the_title(); ?></a>
                    </div>
                </div>
            </li>
            <?php endwhile;?>
            <?php wp_reset_query(); ?>
        </ul>
        <div class="uk-visible@m">
            <a class="uk-position-center-left-out slidenav-prev" href="#" uk-slider-item="previous"></a>
            <a class="uk-position-center-right-out slidenav-next" href="#" uk-slider-item="next"></a>
        </div>
        <div class="uk-hidden@m">
            <a class="uk-position-center-left slidenav-prev" href="#" uk-slider-item="previous"></a>
            <a class="uk-position-center-right slidenav-next" href="#" uk-slider-item="next"></a>
        </div>
    </div>
</div>