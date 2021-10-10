<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
        <!-- Wrapper -->
        <div id="wrapper">
            <!-- sidebar --> 
            <div class="main_sidebar">
                <div class="side-overlay" uk-toggle="target: #wrapper ; cls: collapse-sidebar mobile-visible"></div>
                <!-- sidebar header -->
                <div class="sidebar-header">
                    <!-- Logo-->
                    <div id="logo">
                        <a href="<?php echo get_option('home'); ?>/"><img src="<?php echo aoton('logo'); ?>" alt="<?php bloginfo('name'); ?>"></a>
                    </div>
                    <span class="btn-close" uk-toggle="target: #wrapper ; cls: collapse-sidebar mobile-visible"></span>
                </div>
                <!-- sidebar Menu -->
                <?php if (wp_is_mobile()) : ?>
                <div class="sidebar">
                    <div class="sidebar_innr" data-simplebar>
                        <div class="sections">
                            <?php wp_nav_menu( array(
                                'theme_location'  => 'mobile',
                                'menu_class'      => '',
			                    'fallback_cb'		=> 'default_menu'
                            ));
                            ?>
                        </div>
                        <div class="sections">
                            <h3> 其他 </h3>
                            <ul>
                                <?php
                                wp_nav_menu( array(
                                    'theme_location'	=> 'header',
                                    'menu_class'		=> '',
			                        'fallback_cb'		=> 'default_menu'
                                    ) ); 
                                ?>
                            </ul>
                        </div>
                        <!--  Optional Footer -->
                        <?php get_navfooter(); ?>
                    </div>
                </div>
                <?php else : ?>
                <div class="sidebar">
                    <div class="sidebar_innr" data-simplebar>
                        <div class="sections">
                            <?php wp_nav_menu( array(
                                'theme_location'  => 'navigation',
                                'menu_class'      => 'uk-active',
                                'menu_id'         =>'nav',
                                'container'       =>'ul',
                                'fallback_cb'     => 'false',
                            ));
                            ?>
                            <script type="text/javascript">
                            jQuery(document).ready(function($) {
                                $('#nav li').hover(function() {
                                    $('ul', this).slideDown(300)
                                },
                                function() {
                                    $('ul', this).slideUp(300)
                                });
                            });
                        </script>
                        </div>
                        <div class="sections">
                            <h3> 其他 </h3>
                            <ul>
                                <?php
                                wp_nav_menu( array(
                                    'theme_location'	=> 'header',
                                    'menu_class'		=> 'uk-nav nav-menu',
			                        'fallback_cb'		=> 'default_menu'
                                    ) ); 
                                ?>
                            </ul>
                        </div>
                        <!--  Optional Footer -->
                        <?php get_navfooter(); ?>
                    </div>
                </div>
                <? endif ?>
            </div>
            <!-- contents -->
            <div class="main_content">
                <!-- header -->
                <div id="main_header">
                    <header>
                        <div class="header-innr">
                            <!-- Logo-->
                            <div class="header-btn-traiger is-hidden" uk-toggle="target: #wrapper ; cls: collapse-sidebar mobile-visible">
                                <span></span>
                            </div>
                            <!-- Logo-->
                            <div id="logo">
                                <a href="<?php echo get_option('home'); ?>/"> <img src="<?php echo aoton('logo_small'); ?>" alt="<?php bloginfo('name'); ?>"></a>
                            </div>
                            <!-- form search-->
                            <?php get_search_form(); ?>
                            <!-- user icons -->
                            <div class="head_user">
                                <!-- browse apps  -->
                                <a href="#" class="opts_icon uk-visible@s" uk-tooltip="title: Create ; pos: bottom ;offset:7">
                                    <img src="<?php bloginfo('template_url'); ?>/assets/images/icons/apps.svg" alt="">
                                </a>
                                <!-- browse apps dropdown -->
                                <div uk-dropdown="mode:click ; pos: bottom-center ; animation: uk-animation-scale-up" class="icon-browse display-hidden">
                                    <a href="#" class="icon-menu-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#9c27b0" d="M12,8H4A2,2 0 0,0 2,10V14A2,2 0 0,0 4,16H5V20A1,1 0 0,0 6,21H8A1,1 0 0,0 9,20V16H12L17,20V4L12,8M21.5,12C21.5,13.71 20.54,15.26 19,16V8C20.53,8.75 21.5,10.3 21.5,12Z"></path></svg>制作广告</a>
                                    <a href="#" class="icon-menu-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#009da0" d="M18,20H6V18H4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V18H18V20M14,2H6A2,2 0 0,0 4,4V12H6V4H14V8H18V12H20V8L14,2M11,16H8V14H11V16M16,16H13V14H16V16M3,14H6V16H3V14M21,16H18V14H21V16Z"></path></svg>网页制作</a>
                                    <a href="#" class="icon-menu-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#f25e4e" d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"></path></svg>活动策划</a>
                                    <a href="#" class="icon-menu-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#03A9F4" d="M12,6A3,3 0 0,0 9,9A3,3 0 0,0 12,12A3,3 0 0,0 15,9A3,3 0 0,0 12,6M6,8.17A2.5,2.5 0 0,0 3.5,10.67A2.5,2.5 0 0,0 6,13.17C6.88,13.17 7.65,12.71 8.09,12.03C7.42,11.18 7,10.15 7,9C7,8.8 7,8.6 7.04,8.4C6.72,8.25 6.37,8.17 6,8.17M18,8.17C17.63,8.17 17.28,8.25 16.96,8.4C17,8.6 17,8.8 17,9C17,10.15 16.58,11.18 15.91,12.03C16.35,12.71 17.12,13.17 18,13.17A2.5,2.5 0 0,0 20.5,10.67A2.5,2.5 0 0,0 18,8.17M12,14C10,14 6,15 6,17V19H18V17C18,15 14,14 12,14M4.67,14.97C3,15.26 1,16.04 1,17.33V19H4V17C4,16.22 4.29,15.53 4.67,14.97M19.33,14.97C19.71,15.53 20,16.22 20,17V19H23V17.33C23,16.04 21,15.26 19.33,14.97Z"></path></svg>公司注册</a><a href="#" class="icon-menu-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#f79f58" d="M14.4,6L14,4H5V21H7V14H12.6L13,16H20V6H14.4Z"></path></svg>平面设计</a>
                                    <a href="#" class="icon-menu-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#8bc34a" d="M22,16V4A2,2 0 0,0 20,2H8A2,2 0 0,0 6,4V16A2,2 0 0,0 8,18H20A2,2 0 0,0 22,16M11,12L13.03,14.71L16,11L20,16H8M2,6V20A2,2 0 0,0 4,22H18V20H4V6"></path></svg>专辑制作</a></div>
                                    <?php if(aoton('notiviation')) { ?>
                                    <!-- notificiation icon  -->
                                    <a href="#" class="opts_icon" uk-tooltip="title: 公告 ; pos: bottom ;offset:7">
                                        <img src="<?php bloginfo('template_url'); ?>/assets/images/icons/bell.svg" alt="">
                                    </a>
                                    <!-- notificiation dropdown -->
                                    <div uk-dropdown="mode:click ; animation: uk-animation-slide-bottom-small" class="dropdown-notifications display-hidden">
                                        <!-- notification contents -->
                                        <div class="dropdown-notifications-content" data-simplebar>
                                            <!-- notivication header -->
                                            <div class="dropdown-notifications-headline">
                                                <h4>站内公告 </h4>
                                                <a href="#bulletin">
                                                    <i class="uil-cloud-sun-meatball"
                                                    uk-tooltip="title: 所有公告 ; pos: left"></i>
                                                </a>
                                            </div>
                                            <!-- notiviation list -->
                                            <ul>
                                                <?php 
                                                $args = array(
                                                    'tax_query' => array(
                                                        array(
                                                            'taxonomy' => 'notice',
                                                            'field' => 'id',
                                                            'terms' => explode(' ',''.aoton("notiviation_id").'' )
                                                            )
                                                        ),
                                                        'posts_per_page' => '10');
                                                        $the_query = new WP_Query( $args );
                                                ?>
                                                <?php if ( $the_query->have_posts() ) : ?>
                                                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                                <li>
                                                    <a href="<?php echo get_permalink(aotonThemes_page('template/user.php'));?>">
                                                        <?php echo get_avatar( get_the_author_email(), '64' );?>
                                                    </a>
                                                    <a href="<?php echo esc_url( get_permalink() ); ?>" target="_blank"><?php the_title(); ?></a>
                                                    <span><?php the_time('Y.n.j'); ?></span>
                                                </li>
                                                <?php endwhile; ?>
                                                <?php wp_reset_postdata(); ?>
                                                <?php else : ?>
                                                    <li>管理员并没有发布公告哦！</li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php } ?>
                                
                                <!-- profile -image -->
                                <?php get_template_part('pages/profile', 'profile'); ?>
                            </div>
                        </div>
                        <!-- / heaader-innr -->
                    </header>
                </div>
                <!-- header -->