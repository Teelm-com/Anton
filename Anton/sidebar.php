<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<!-- 小工具 -->
<div class="uk-width-expand" style="position: relative;">
<?php if(is_home()&&!is_paged()) { ?> 
    <?php if ( ! dynamic_sidebar( 'fourth-sidebar' ) ) : ?>	
        <div class="sl_sidebar_sugs_title border-0">添加小工具<i class="icon-feather-rotate-cw"></i></div>
        <div class="list-group-item sl_htag">
            <span class="htag_top"><a href="<?php echo admin_url(); ?>widgets.php" target="_blank">点此为添加小工具</a></span>
        </div>
    <?php endif; ?>
<?php }else{ ?>
        <?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>	
        <div class="sl_sidebar_sugs_title border-0">添加小工具<i class="icon-feather-rotate-cw"></i></div>
        <div class="list-group-item sl_htag">
            <span class="htag_top"><a href="<?php echo admin_url(); ?>widgets.php" target="_blank">点此为添加小工具</a></span>
        </div>
    <?php endif; ?>
<?php } ?>
</div>