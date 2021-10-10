<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php get_header(); ?>                    
                <!-- content -->
                <div class="main_content_inner">
                    <div uk-grid>
                        <div class="uk-width-2-3@m" >
                            <?php if(is_home()&&!is_paged()) { ?> 
                                <?php if (aoton('slider')) { ?>
                                <?php get_template_part( 'pages/header-slider' ); ?>
                                <?php } ?>
                                <?php if (aoton('top_slider')) { ?>
                                <?php get_template_part( 'pages/two-slider' ); ?>
                                <?php } ?>
                            <?php } ?>
                            <!-- 文章 -->
                            <?php get_template_part( 'pages/content', 'index' ); ?>  
                            <ul class="uk-pagination">
                                <li><?php previous_posts_link('<span class="uk-margin-small-right" uk-pagination-previous></span>上一页', 0); ?></li>
                                <li class="uk-margin-auto-left"><?php next_posts_link('下一页<span class="uk-margin-small-left" uk-pagination-next>', 0); ?></li>
                            </ul>
                        </div>
                        <?php if (!aoton('sidebar_no') || ( !wp_is_mobile() ) ) { ?>
                            <?php get_sidebar(); ?>
                        <?php } ?>
                    </div>
                    <?php if (!aoton('footer_link_no') || ( !wp_is_mobile() ) ) { ?>
                        <?php echo links_footer(); ?>
                    <?php } ?>
                    
<?php get_footer(); ?>                
