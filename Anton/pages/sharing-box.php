<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?> 
<!--分享组件-->
<?php if (wp_is_mobile()) : ?>
<div class="post-state sharing-box">
    <?php if(aoton('give')){?>
    <div class="post-state-btns"><a class="AoTon-btn-donate use-beshare-donate-btn" title="打赏"><i class="uil-moneybag"></i><span>打赏</span></a></div>
    <?php } ?>
    <?php if(aoton('praise')){?>
    <div class="post-state-btns like">         
        <?php echo do_shortcode("[aoton_share]"); ?>       
	</div>
    <?php } ?>
    <?php if(aoton('favorites')){?>
    <div class="post-state-btns">
        <?php
        $shoucang1 = explode(',',get_post_meta(get_the_ID(),'shoucang',true));
        $shoucang = array_filter($shoucang1);
        $user = get_current_user_id();
        ?>
        <a class="shoucang <?php if(in_array($user,$shoucang)){ foreach($shoucang as $k=>$v){if($v==$user){echo "on";}}} ;?>" data-id="<?php the_ID();?>" href="javascript:;"><i class="uil-heart"></i><span>收藏</span></a>      
	</div>
    <?php } ?>
    <?php if(aoton('share')){?>
    <div class="post-state-btns"><a class="AoTon-btn-share use-beshare-social-btn" title="分享"><i class="uil-share-alt"></i><span>分享</span></a></div>
    <?php } ?>
    <?php if(aoton('poster')){?>
    <div class="post-state-btns"><a class="AoTon-share-poster use-beshare-poster-btn" title="海报"><i class="uil-newspaper"></i><span>海报</span></a></div>
    <?php } ?>
</div>
<?php else : ?>
<div class="post-state sharing-box">
    <?php if(aoton('give')){?>
    <div class="post-state-btns"><a class="AoTon-btn-donate use-beshare-donate-btn" title="打赏"><i class="uil-moneybag"></i><span>打赏</span></a></div>
    <?php } ?>
    <?php if(aoton('praise')){?>
    <div class="post-state-btns like">         
        <?php echo do_shortcode("[aoton_share]"); ?>       
	</div>
    <?php } ?>
    <?php if(aoton('favorites')){?>
    <div class="post-state-btns">
        <?php
        $shoucang1 = explode(',',get_post_meta(get_the_ID(),'shoucang',true));
        $shoucang = array_filter($shoucang1);
        $user = get_current_user_id();
        ?>
        <a class="shoucang <?php if(in_array($user,$shoucang)){ foreach($shoucang as $k=>$v){if($v==$user){echo "on";}}} ;?>" data-id="<?php the_ID();?>" href="javascript:;"><i class="uil-heart"></i><span>收藏</span></a>      
	</div>
    <?php } ?>
    <!--<div class="post-state-btns">
        <?php $my_email = get_bloginfo ( 'admin_email' );$str = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_approved = '1' AND comment_type = '' AND comment_author_email";$count_t = $post->comment_count;echo "<i class='ico ico-RectangleCopy28'></i><span>",$count_t,"</span>";?>
    </div>-->
    <?php if(aoton('share')){?>
    <div class="post-state-btns"><a class="AoTon-btn-share use-beshare-social-btn" title="分享"><i class="uil-share-alt"></i><span>分享</span></a></div>
    <?php } ?>
    <?php if(aoton('print')){?>
    <div class="post-state-btns"><a href="javascript:printme()" target="_self"><i class="uil-print"></i><span>打印</span></a></div>
    <?php } ?>
    <?php if(aoton('link_copy')){?>
    <div class="post-state-btns"><span id="post-link"><?php echo get_permalink(); ?></span><a class="AoTon-btn-link" title="复制链接" onclick="copyLink()"><i class="uil-link"></i><span>复制链接</span></a></div>
    <?php } ?>
    <?php if(aoton('poster')){?>
    <div class="post-state-btns"><a class="AoTon-share-poster use-beshare-poster-btn" title="海报"><i class="uil-newspaper"></i><span>海报</span></a></div>
    <?php } ?>
</div>
<? endif ?>
<!--分享组件-->
<?php if(aoton('hitokoto')){?>
<!--添加一言功能-->
<script src="https://v1.hitokoto.cn/?encode=js&select=%23hitokoto" defer></script>
<div id="hitokoto"></div>
<!--添加一言功能-->
<?php } ?>