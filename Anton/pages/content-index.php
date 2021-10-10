<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php
$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$notcat = explode(',',aoton('not_cat_n'));
$args = array(
    'category__not_in' => $notcat,
    'ignore_sticky_posts' => 0, 
    'paged' => $paged
);
query_posts( $args );
?>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
    <div class="post uk-card">
        <div class="post-heading">
            <div class="post-avature">
                <?php echo get_avatar( get_the_author_meta('email'), '64' );?>
                <div class="dropdown-user-name"><?php the_author_posts_link(); ?></div>
            </div>
            <div class="post-title">
                <h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
                <p><i class="uil-users-alt"></i><?php the_time('y-m-d H:i:s') ?><i class="uil-eye"></i><?php aoton_views(); ?></p>
                <?php the_tags('tag：', ', ', ''); ?>
            </div>
            <?php if ( is_user_logged_in() ) : ?>
                <div class="post-btn-action">
                    <span class="icon-more uil-ellipsis-h"></span>
                    <div class="mt-0 p-2" uk-dropdown="pos: top-right;mode:hover ">
                        <ul class="uk-nav uk-dropdown-nav">
                            <li>
                                <?php $url = get_bloginfo('url'); if (current_user_can('edit_post', $post->ID)){
                                    echo '<a class="text-danger" href="';
                                    echo wp_nonce_url("$url/wp-admin/post.php?action=delete&post=$id", 'delete-post_' . $post->ID);
                                    echo '"><i class="uil-trash-alt mr-1"></i>删除文章</a>';
                                } ?>
                            </li>
                            <li><?php edit_post_link('<i class="uil-edit-alt mr-1"></i>编辑'); ?></li>
                        </ul>
                    </div>
                </div>
            <?php else : ?> 
                <div class="post-btn-action">
                    <span class="icon-more uil-ellipsis-h"></span>
                    <div class="mt-0 p-2" uk-dropdown="pos: top-right;mode:hover ">
                        <ul class="uk-nav uk-dropdown-nav">
                            <li><i class="uil-edit-alt mr-1"></i>谢谢</li>
                        </ul>
                    </div>
                </div>
            <?php endif ?>
        </div>

        <div class="post-description">
            <div class="fullsizeimg">
                <figure class="thumbnail">
                    <?php aoton_thumbnail(); ?>
                </figure>
                <div class="fullsizetxt">
                    <a href="<?php the_permalink($post->ID); ?>"><?php echo aoton_trim_words(); ?></a>
                </div>
            </div>
        </div>

        <div class="post-state sharing-box">
            <div class="post-state-btns like">
                <?php echo do_shortcode("[aoton_share]"); ?>
            </div>
            <div class="post-state-btns">
                <?php $shoucang1 = explode(',',get_post_meta(get_the_ID(),'shoucang',true)); $shoucang = array_filter($shoucang1); $user = get_current_user_id(); ?>
                <a class="shoucang <?php if(in_array($user,$shoucang)){ foreach($shoucang as $k=>$v){if($v==$user){echo "on";}}} ;?>" data-id="<?php the_ID();?>" href="javascript:;"><i class="uil-heart"></i><span>收藏</span></a>
            </div>
            <div class="post-state-btns">
                <?php comments_popup_link('<i class="ico ico-RectangleCopy28"></i> 0', '<i class="ico ico-RectangleCopy28"></i> 1', '<i class="ico ico-RectangleCopy28"></i> %', '', '评论已关闭'); ?>
            </div>
        </div>
    </div>
    <!-- 广告 -->
    <?php get_template_part('ad/ad', 'list'); ?>
    <!-- 广告 -->
    <?php endwhile; ?>

	<?php else : ?>
		<?php get_template_part( 'pages/content', 'none' ); ?>
	<?php endif; ?>            
