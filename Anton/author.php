<?php 
if ( ! defined( 'ABSPATH' ) ) { exit; } get_header(); ?>
            <div class="main_content_inner">
                <div uk-grid>
                    <div class="uk-width-2-3@m fead-area">
                        <div class="post" style="border-radius: 18px;">
                        <?php
                            if(isset($_GET['author_name'])) :
                            $curauth = get_userdatabylogin($author_name);
                            else :
                            $curauth = get_userdata(intval($author));
                            endif;
                            ?>
                        <div class="uk-card uk-card-default uk-width-*@m" style="border-radius: 18px;">
                            <div class="uk-card-header">
                                <div class="uk-grid-small uk-flex-middle" uk-grid>
                                    <div class="uk-width-auto">
                                        <?php echo get_avatar( get_the_author_meta('email'), '64' );?>
                                    </div>
                                    <div class="uk-width-expand">
                                        <h3 class="uk-card-title uk-margin-remove-bottom" style="text-transform: capitalize;font-weight: 600;">名称:<?php echo $curauth->display_name; ?></h3>
                                        <p class="uk-text-meta uk-margin-remove-top uk-margin-remove-bottom"><strong>QQ:</strong> <a href="tencent://message/?uin=<?php echo get_user_meta($current_user->ID, 'qq', true);?>&Menu=yes&Service=300&sigT=42a1e5347953b64c5ff3980f8a6e644d4b31456cb0b6ac6b27663a3c4dd0f4aa14a543b1716f9d45"><?php echo get_user_meta($current_user->ID, 'qq', true);?></a></p><p class="uk-text-meta uk-margin-remove-top"><strong>网站:</strong><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></p>
                                    </div> 
                                </div>
                            </div>
                            <div class="uk-card-body">
                                <p><strong>简介:</strong><?php echo $curauth->user_description; ?></p>
                            </div>
                            <div class="uk-card-footer">
                                <ul class="uk-list uk-list-bullet">
                                    <!-- The Loop -->
                                    <?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
                                    <li>
                                    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
                                    <?php the_title(); ?></a>
                                    </li>
                                    <?php endwhile; else: ?>
                                        <p>没有任何文章！</p>
                                    <?php endif; ?>
                                    <!-- End Loop -->
                                </ul>
                            </div>
                            <ul class="uk-pagination">
                                <li><?php previous_posts_link('<span class="uk-margin-small-right" uk-pagination-previous></span>上一页', 0); ?></li>
                                <li class="uk-margin-auto-left"><?php next_posts_link('下一页<span class="uk-margin-small-left" uk-pagination-next>', 0); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
<?php get_footer(); ?>