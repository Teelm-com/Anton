<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="head_search">
    <form method="get" role="search" id="searchform" action="<?php echo home_url('/'); ?>">
        <div class="head_search_cont">
            <input name="s" value="<?php if (is_search()) { echo get_search_query(); } ?>" type="text" class="form-control" placeholder="搜索“文章”，“新闻”等..." autocomplete="off"><i class="s_icon uil-search-alt"></i>
        </div>
        <!-- Search box dropdown -->
        <div uk-dropdown="pos: top;mode:click;animation: uk-animation-slide-bottom-small" class="dropdown-search display-hidden">
            <!-- User menu -->
            <ul class="dropdown-search-list">
                <li class="list-title"> 搜索热点 </li>
                <?php wp_tag_cloud('number=20&orderby=count&order=DESC&smallest=12&largest=12&unit=px'); ?>
                <div class="clear"></div>
            </ul>
        </div>
    </form>
</div>