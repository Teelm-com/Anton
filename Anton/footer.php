<?php if (wp_is_mobile()) : ?>

<?php else : ?>
                <div style="z-index: 999;position: fixed;">
                <!-- 返回顶部 -->
                <a class="chat-plus-btn uk-buttontop uk-button" href="#top" uk-scroll><svg width="18" height="10" viewBox="0 0 18 10" xmlns="http://www.w3.org/2000/svg" data-svg="totop"><polyline fill="none" stroke="#fff" stroke-width="1.2" points="1 9 9 1 17 9 "></polyline></svg></a>
                <!-- 返回顶部END --> 
                <!-- Chat sidebar -->
                <a class="chat-plus-btn" href="#sidebar-chat" uk-toggle>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"></path>
                    </svg>
                    <!--  Chat -->
                </a>
                </div>
                <div id="sidebar-chat" class="sidebar-chat px-3" uk-offcanvas="flip: true; overlay: true">
                    <div class="uk-offcanvas-bar">
                        <img src="<?php bloginfo('template_url'); ?>/assets/images/author-cover.jpg" alt="">
                        <div class="sidebar-chat-head mb-2">

                            <div class="btn-actions">
                                <a href="<?php echo get_permalink(aotonThemes_page('template/user.php'));?>" uk-tooltip="title: 用户中心 ;offset:7"> <i class="icon-feather-settings"></i> </a>
                            </div>
                            
                        <?php if ( is_user_logged_in() ) : ?>
                            <a href="<?php echo get_permalink(aotonThemes_page('template/user.php'));?>" uk-tooltip="title: <?php echo user_identity(); ?> ;offset:7">
                            <div class="uk-offcanvas-list">
                                <div class="contact-list-media"><?php global $current_user;wp_get_current_user();echo get_avatar( $current_user->user_email, 64); ?> <span class="online-dot"></span> </div>
                                <h2><?php echo user_identity(); ?></h2>
                            </div>
                            </a>
                        <?php else : ?>
                            <a href="<?php echo get_permalink(aotonThemes_page('template/login.php'));?>" uk-tooltip="title: <?php echo user_identity(); ?> ;offset:7">
                            <div class="uk-offcanvas-list">
                                <div class="contact-list-media"><img src="<?php bloginfo('template_url'); ?>/assets/images/icons/login.svg" alt=""><span class="offline-dot"></span> </div>
                                <h5>未登录</h5>
                            </div>
                            </a>
                        <?php endif ?>
                            

                        <ul class="uk-child-width-expand sidebar-chat-tabs" uk-tab>
                            <li class="uk-active"><a href="#">用户</a></li>
                            <li><a href="#">其他</a></li>
                        </ul>

                        <a href="#">
                            <div class="contact-list">
                                <div class="contact-list-media"><span class="online-dot"></span> </div>
                                <h5>老刘</h5>
                            </div>
                        </a>




                    </div>
                </div>
<?php endif ?>
             <!-- 页脚javaScripts ================================================== -->
        
        <script>
            //评论框一
            jQuery.getJSON("https://v1.hitokoto.cn/?format=json",function(data){ 
            jQuery("#comment").text(data.hitokoto);
             });
            jQuery(function(){
            jQuery("#comment").click(function() {
                jQuery(this).select();
            })
            })
        </script>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>  