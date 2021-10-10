
<?php if ( is_user_logged_in() ) : ?>
    <a class="opts_account" href="#"><?php global $current_user;wp_get_current_user();echo get_avatar( $current_user->user_email, 64); ?></a>
    <div uk-dropdown="mode:click ; animation: uk-animation-slide-bottom-small" class="dropdown-notifications rounded display-hidden">
        <a href="<?php echo home_url();?>/wp-admin">
            <div class="dropdown-user-details">
                <div class="dropdown-user-cover">
                    <img src="<?php bloginfo('template_url'); ?>/assets/images/author-cover.jpg" alt="">
                </div>
                <div class="dropdown-user-avatar">
                    <?php global $current_user;wp_get_current_user();echo get_avatar( $current_user->user_email, 64); ?>
                </div>
                <div class="dropdown-user-name"><?php echo $current_user->nickname;?></div>
            </div>
        </a>
        <ul class="dropdown-user-menu">
            <li><a href="<?php echo home_url();?>/wp-admin/post-new.php"><i class="fas fa-rocket"></i>发布新文章</a> </li>
            <li><a href="<?php echo get_permalink(aotonThemes_page('template/user.php'));?>"> <i class="fas fa-user-cog"></i>个人中心</a> </li>
            <li><a href="<?php echo get_permalink(aotonThemes_page('template/user.php'));?>?action=info"> <i class="fas fa-user-edit"></i>修改资料</a></li>
            <li>
                <a href="#" id="night-mode" class="btn-night-mode">
                    <i class="fas fa-moon"></i>暗影模式
                    <span class="btn-night-mode-switch">
                        <span class="uk-switch-button"></span>
                    </span>
                </a>
            </li>
            <li><a class="signin-loader" href="<?php echo wp_logout_url( home_url() ); ?>"><i class="fas fa-sign-out-alt"></i>退出</a></li>
        </ul>
        <?php if ( current_user_can('level_10') ) { ?>
        <hr class="m-0">
        <ul class="dropdown-user-menu">
            <li>
                <a href="<?php echo home_url();?>/wp-admin" target="_blank">
                    <i class="uil-bolt"></i>
                    <div>后台管理<span> 进入后台管理网站 </span></div>
                </a>
            </li>
        </ul>
        <?php } else { ?>
        <?php } ?>  
    </div>
<?php else : ?>
    <a class="opts_icon" uk-tooltip="title: 登录 ; pos: bottom ;offset:7" href="#"><img src="<?php bloginfo('template_url'); ?>/assets/images/icons/login.svg" alt=""></a>
    <div uk-dropdown="mode:click ; animation: uk-animation-slide-bottom-small" class="dropdown-notifications rounded display-hidden">
    <div class="uk-flex uk-flex-middle">
        <div class="uk-overflow-hidden uk-width-*">
            <div class="uk-width-*">
                <!-- column two -->
                <div class="uk-width-* .wp-submit">
                    <div class="uk-width-*">
                        <p class="uk-align-right uk-margin-small-top uk-margin-small-bottom">没有帐户？<a href="<?php echo get_permalink(aotonThemes_page('template/login.php'));?>">立即注册！</a></p>
                        <div class="clear"></div>
                    </div>
                    <div class="mb-4 uk-text-center">
                        <h2 class="mb-0"> 欢迎回来！</h3>
                        <p class="my-2">请登录后管理您的帐户。</p>
                    </div>
                    
                    <form id="loginform" class="loginform" method="post" novalidate="novalidate" onSubmit="return false;">
                        <p class="input-item">
                            <label for="user_login">用户名*</label>
                            <input class="input-control" id="username" type="text" placeholder="用户名/邮箱" name="username" required="" aria-required="true">
                        </p>
                        <p class="input-item">
                            <label for="user_pass">密码*</label>
                            <input class="input-control" id="password" type="password" placeholder="密码" name="password" required="" aria-required="true">
                        </p>
                        <?php if(aoton('login_captcha')){ ?>
                        <div class="form-item">
                            <input class="input-control" style="width:calc(100% - 200px);display: inline-block;" id="captcha" type="text" placeholder="验证码" name="captcha" required="">
                            <i class="ico ico-RectangleCopy5"></i>
                            <img src="<?php bloginfo("template_url");?>/assets/images/captcha.png" class="captcha-clk2"/>
                        </div>
                        <?php }?>
                        <p class="sign-tips"></p>
                        <p class="input-submit">
                            <input class="submit login-loader btn" type="submit" value="登录">
                            <input type="hidden" name="action" value="login">
                            <input type="hidden" id="security" name="security" value="<?php echo  wp_create_nonce( 'security_nonce' );?>">
                            <input type="hidden" name="_wp_http_referer" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <input type="hidden" id="redirect_to" value="<?php echo $_GET['redirect_to']; ?>">
                        </p>
                        <p class="safe">
                            <a class="lostpwd-loader left" href="<?php echo add_query_arg('action','password',home_url('/login'));?>">忘记密码？!</a>
                        </p>
                                    <?php if(aoton('sms_login')){?>
                                    <p class="safe">
                                        <a href="<?php echo add_query_arg('action','sign-sms',get_permalink(aotonThemes_page('template/login.php')));?>"><i class="ico ico-mobile"></i>手机号登录</a>
                                        <?php }?>
                                    </p>	
                                    <?php if(aoton('qq_login') || aoton('weibo_login') || (aoton('weixin_login') || (aoton('weixin_login_mobile') && aoton_is_mobile()))){?>	
                                        <div class="sign-social">
                                            <h6>社交账号快速登录</h6>
                                            <?php if(aoton('qq_login')){?><a class="login-qq" href="<?php echo home_url();?>/oauth/qq?rurl=<?php echo aoton_selfURL();?>"><i class="ico ico-qq"></i></a><?php }?>
                                            <?php if(aoton('weibo_login')){?><a class="login-weibo" href="<?php echo home_url();?>/oauth/weibo?rurl=<?php echo aoton_selfURL();?>"><i class="ico ico-weibo"></i></a><?php }?>
                                            <?php if(aoton('weixin_login') || aoton('weixin_login_mobile')){?>
                                                <?php if(aoton_is_mobile() && aoton('weixin_login_mobile')){?>
                                                    <a class="login-weixin" href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=<?php echo aoton('weixin_loginid_mobile');?>&redirect_uri=<?php echo home_url();?>/oauth/weixin/&response_type=code&scope=snsapi_userinfo&state=aoton_weixin_login#wechat_redirect" rel="nofollow"><i class="ico ico-weixin"></i></a>
                                                <?php }elseif(aoton('weixin_login')){?>
                                                    <a class="login-weixin" href="https://open.weixin.qq.com/connect/qrconnect?appid=<?php echo aoton('weixin_loginid');?>&redirect_uri=<?php echo home_url();?>/oauth/weixin/&response_type=code&scope=snsapi_login&state=aoton_weixin_login#wechat_redirect" rel="nofollow"><i class="ico ico-weixin"></i></a>
                                                <?php }?>
                                            <?php }?>	
                                        </div>	
                                    <?php }?>
                    </form>
                    <script type="text/javascript" src="<?php bloginfo("template_url");?>/assets/js/login.js"></script>
                </div><!--  End column two -->
            </div>
        </div>
    </div>
</div>
<?php endif ?>