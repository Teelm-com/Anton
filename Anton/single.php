<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php get_header(); ?>
            <div class="main_content_inner">

                <div uk-grid>

                    <div class="uk-width-2-3@m fead-area">

                        <?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
                        <div class="post" id="post-<?php the_ID(); ?>">
                            <div class="post-heading">
                                <div class="post-avature">
                                    <?php echo get_avatar( get_the_author_meta('email'), '64' );?>
                                    <div class="dropdown-user-name"><?php the_author_posts_link(); ?></div>
                                </div>
                                <div class="post-title">
                                    <h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
                                    <p>
                                        <i class="uil-users-alt"></i> <?php the_time('y-m-d H:i:s') ?><i class="uil-eye"></i><?php aoton_views(); ?>
                                        <?php comments_popup_link('<i class="ico ico-icon"></i>0 条评论', '<i class="ico ico-icon"></i>1 条评论', '<i class="ico ico-icon"></i>% 条评论', '', '<i class="ico ico-icon"></i>评论已关闭'); ?>
                                        <span><?php echo word_num(); ?>个字</span> 
                                    </p>
                                    <div>
                                        <?php the_tags('tag：', ', ', ''); ?>
                                    </div>
                                </div>
                                <?php if( is_user_logged_in() ) { ?>
                                <div class="post-btn-action">
                                    <span class="icon-more uil-ellipsis-h"></span>
                                    <div class="mt-0 p-2" uk-dropdown="pos: top-right;mode:hover ">
                                        <ul class="uk-nav uk-dropdown-nav">
                                                <li>
                                                    <?php $url = get_bloginfo('url'); if (current_user_can('edit_post', $post->ID)){   
                                                            echo '<a class="text-danger" href="';
                                                            echo wp_nonce_url("$url/wp-admin/post.php?action=delete&post=$id", 'delete-post_' . $post->ID);
                                                            echo '"><i class="uil-trash-alt mr-1"></i>删除文章</a>';   
                                                        }   
                                                    ?>
                                                </li>
                                                <li><?php edit_post_link('<i class="uil-edit-alt mr-1"></i>编辑'); ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <?php echo aoton_today(); ?>
                            <?php get_template_part('ad/ad', 'body'); ?>
                            <div class="post-fulltext" id="post-fulltext">
                                <?php the_content(); ?>
                            </div>  
                            <?php require THEME_DIR . "/pages/sharing-box.php"; ?>
                            <div class="nav-single">
                                <?php
                                    if (get_previous_post( TRUE )) {
                                        previous_post_link( '%link','<span class="meta-nav uk-width-1-2">上一篇<br/>%title</span>', TRUE ); 
                                    } else {
                                            echo "<span class='meta-nav uk-width-1-2'>没有了<br/>已是最后文章</span>"; }
                                    if (get_next_post( TRUE )) {
                                        next_post_link( '%link', '<span class="meta-nav uk-width-1-2">下一篇<br/>%title</span>', TRUE );
                                    } else {
                                            echo "<span class='meta-nav uk-width-1-2'>没有了<br/>已是最新文章</span>"; 
                                        }
                                ?><div class="clear"></div>
                            </div>
                            <!-- post comments -->
                            <?php comments_template(); ?>

                        </div>
                        <?php else : ?>
                            <p>没有找到任何文章！</p>
                        <?php endif; ?>

                    </div>
                    <?php if (!aoton('sidebar_no') || ( !wp_is_mobile() ) ) { ?>
                        <?php get_sidebar(); ?>
                    <?php } ?>
                </div>


            </div>

        </div>
    <?php get_footer(); ?>