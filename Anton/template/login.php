<?php 
/*
	template name: 登录页面
	description: template for www.teelm.com anton theme 
*/
	if(is_user_logged_in()){
		if(isset($_GET["redirect_to"])){
			header("Location:".$_GET["redirect_to"]);
		}else{
			header("Location:".get_permalink(aotonThemes_page('template/user.php')));
		}
	}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="referrer" content="never" />
    <title>欢迎！ - <?php bloginfo("name");?></title>
    <meta name="description" content="<?php echo aoton('description'); ?>" />
	<meta name="keywords" content="<?php echo aoton('keyword'); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="icon" href="<?php echo aoton('favicon'); ?>">

    <!-- wordpress option
    ================================================== -->
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
    <!--[if lt IE 9]><script src="<?php bloginfo("template_url");?>/static/js/html5.min.js"></script><![endif]-->
    <script>window._aoton = {uri: '<?php bloginfo('template_url') ?>', url:'<?php bloginfo('url');?>'}</script>
</head>
<body class="bg-white wp_login_form">
<?php 
 if ( is_user_logged_in() ) : ?>
    <!-- Content
    ================================================== -->
    <div uk-height-viewport class="uk-flex uk-flex-middle">
        <div class="uk-width-2-3@m uk-width-1-2@s m-auto rounded uk-overflow-hidden">
            <div class="uk-child-width-1-2@m uk-grid-collapse bg-gradient-primary" uk-grid>

                <!-- column one -->
                <div class="uk-margin-auto-vertical uk-text-center uk-animation-scale-up p-3 uk-light">
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php echo aoton('logo'); ?>" alt="<?php bloginfo('name'); ?>">
                    </a>
                    <h3 class="mb-3 mt-lg-4"><?php bloginfo('name'); ?></h3>
                    <p><?php bloginfo('description'); ?></p>
                </div>

                <!-- column two -->
                <div class="uk-card-default px-5 py-8">
                    <div class="uk-width-expand@s">
                        <p class="uk-align-right">更换帐户？
                            <a class="signin-loader" href="<?php echo wp_logout_url( get_permalink() ); ?>">退出</a>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="mb-4 uk-text-center">
                        <h2 class="mb-0"> 你已登陆！</h3>
                        <p class="my-2">请前往<a href="<?php echo home_url(); ?>">首页</a>查看网站内容。</p>
                    </div>
            </div>
        </div>
    </div>
    <?php else : ?>
	<div uk-height-viewport class="uk-flex uk-flex-middle login-wrap">
		<div class="uk-width-3-4@m uk-width-1-2@s m-auto rounded uk-overflow-hidden loginbox" id="loginbox">	
	    	<?php if(isset($_GET['action']) && $_GET['action'] == 'register'){?>
                <div uk-height-viewport class="uk-flex uk-flex-middle">
                    <div class="uk-width-3-4@m uk-width-1-2@s m-auto rounded uk-overflow-hidden">
                        <div class="uk-child-width-1-2@m uk-grid-collapse bg-gradient-primary" uk-grid>
                            <!-- column one -->
                            <div class="uk-margin-auto-vertical uk-text-center uk-animation-scale-up p-3 uk-light">
                                <a href="<?php echo home_url(); ?>">
                                    <img src="<?php echo aoton('logo'); ?>" alt="<?php bloginfo('name'); ?>">
                                </a>
                                <h3 class="mb-3 mt-lg-4"><?php bloginfo('name'); ?></h3>
                                <p><?php bloginfo('description'); ?></p>
                            </div>
                            <!-- column two -->
                            <?php if(aoton('register')){?>
                            <div class="uk-card-default px-5 py-5">
                                <div class="uk-width-expand@s">
                                    <p class="uk-align-right">已有帐户？<a class="signin-loader" href="<?php echo get_permalink(aotonThemes_page('template/login.php'));?>">返回登录</a></p>
                                    <div class="clear"></div>
                                </div>
                                <div class="mb-4 uk-text-center">
                                    <h2 class="mb-0">注册账号</h3>
                                    <p class="my-2">立即注册本站账号</p>
                                </div>
                                <p class="regPart"></p>
                                <form id="regform" class="loginform" method="post" novalidate="novalidate" onSubmit="return false;" autocomplete="off">
                                    <p class="input-item">
                                        <input class="input-control" id="regname" type="text" placeholder="用户名" name="regname" required="" ><i class="icon icon-user"></i>
                                    </p>
                                    <p class="input-item">
                                        <input class="input-control" id="regemail" type="email" placeholder="邮箱" name="regemail" required="" ><i class="icon icon-mail"></i>
                                    </p>
                                    <p class="input-item">
                                        <input class="input-control" id="regpass" type="password" placeholder="密码" name="regpass" required=""><i class="icon icon-lock"></i>
                                    </p>
                                    <?php if(aoton('captcha') == 'email'){?>
                                    <p class="input-item">
                                        <input class="input-control" id="captcha" type="text" placeholder="验证码" name="captcha" required="">
                                        <p class="captcha-clk">获取邮箱验证码</p>
                                    </p>
                                    <?php }elseif(aoton('captcha') == 'image'){?>
                                    <p class="input-item">
                                        <input class="input-control" style="width:calc(100% - 200px);display: inline-block;" id="captcha" type="text" placeholder="验证码" name="captcha" required="">
                                        <img src="<?php bloginfo("template_url");?>/assets/images/captcha.png" class="captcha-clk2" />
                                    </p>
                                    <?php }elseif(aoton('captcha') == 'invitation' && function_exists('ashuwp_check_invitation_code')){?>
                                    <p class="input-item">
                                        <input class="input-control" id="captcha" type="text" placeholder="邀请码" name="captcha" required="">
                                        <?php if(aoton('invitation_link')){?><a href="<?php echo aoton('invitation_link');?>" target="_blank" rel="nofollow" class="invitation-link">获取邀请码</a><?php }?>
                                    </p>
                                    <?php }?>
                                    <p class="sign-tips"></p>
                                    <p class="input-submit">
                                        <input class="submit register-loader btn" type="submit" value="注册账号">
                                        <input type="hidden" name="action" value="register">
                                        <input type="hidden" id="security" name="security" value="<?php echo  wp_create_nonce( 'security_nonce' );?>">
                                        <input type="hidden" name="_wp_http_referer" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                        <?php if(aoton('register_policy')){?>
                                        <div class="form-policy">
                                            <input type="checkbox" id="policy_reg" name="policy_reg" value="1" checked>
                                            <label for="policy_reg"> 我已阅读并同意《<a href="<?php get_privacy_policy_url()?>" target="_blank">用户注册协议</a>》</label>
                                        </div>
                                        <?php }?>
                                    </p>
                                    <?php if(aoton('sms_login')){?>
                                    <p class="safe"><a href="<?php echo add_query_arg('action','sms',get_permalink(aotonThemes_page('template/login.php')));?>" class="signsms-loader">手机号登录</a>
                                    </p>
                                    <?php }?>
                                    <?php if(aoton('social_login')){?>
                                        <?php if(aoton('qq_login') || aoton('weibo_login') || (aoton('weixin_login') || (aoton('weixin_mobile_login') && aoton_is_mobile())) || (aoton('weixin_mp_login') && function_exists('ews_login'))){?>
                                            <div class="social-login sign-social">
                                                <?php if(aoton('qq_login')){?>
                                                <a href="<?php bloginfo("url");?>/oauth/qq?rurl=<?php if(isset($_GET['redirect_to'])) echo $_GET['redirect_to'];else echo get_permalink(aotonThemes_page('template/user.php'));?>" rel="nofollow" class="login-qq"><i class="ico ico-qq"></i></a>
                                                <?php }?>
                                                <?php if(aoton('weibo_login')){?>
                                                <a href="<?php bloginfo("url");?>/oauth/weibo?rurl=<?php if(isset($_GET['redirect_to'])) echo $_GET['redirect_to'];else echo get_permalink(aotonThemes_page('template/user.php'));?>" rel="nofollow" class="login-weibo"><i class="ico ico-weibo"></i></a>
                                                <?php }?>
                                                <?php if(aoton('weixin_login') || aoton('weixin_mobile')){?>
                                                    <?php if(aoton_is_mobile() && aoton('weixin_mobile')){?>
                                                    <a class="login-weixin" href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=<?php echo aoton('oauth_weixinid_mobile');?>&redirect_uri=<?php echo home_url();?>/oauth/weixin/&response_type=code&scope=snsapi_userinfo&state=aoton_weixin_login#wechat_redirect" rel="nofollow"><i class="ico ico-weixin"></i></a>
                                                    <?php }elseif(aoton('weixin_login')){?>
                                                    <a class="login-weixin" href="https://open.weixin.qq.com/connect/qrconnect?appid=<?php echo aoton('oauth_weixinid');?>&redirect_uri=<?php echo home_url();?>/oauth/weixin/&response_type=code&scope=snsapi_login&state=aoton_weixin_login#wechat_redirect" rel="nofollow"><i class="ico ico-weixin"></i></a>
                                                    <?php }?>
                                                <?php }?>
                                                <?php if(aoton('weixin_mp_login') && function_exists('ews_login')){?>
                                                <a href="<?php echo add_query_arg('action','mp',get_permalink(aotonThemes_page('template/login.php')));?>" class="login-weixin"><i class="ico ico-weixin"></i></a>
                                                <?php }?>
                                            </div>
                                        <?php }?>
                                    <?php }?>
                                </form>
                                <?php }else{?>
                                <div class="uk-card-default px-5 py-5 part">
                                    <div class="uk-width-expand@s">
                                        <p class="uk-align-right"><a class="signin-loader" href="<?php echo get_permalink(aotonThemes_page('template/login.php'));?>">返回登录</a></p>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="mb-4 uk-text-center">
                                        <h2 class="mb-0">注册已关闭</h3>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
		    </div>
	    	<?php  }elseif(isset($_GET['action']) && $_GET['action'] == 'sign-sms'){?>
                <div uk-height-viewport class="uk-flex uk-flex-middle">
                    <div class="uk-width-2-3@m uk-width-1-2@s m-auto rounded uk-overflow-hidden">
                        <div class="uk-child-width-1-2@m uk-grid-collapse bg-gradient-primary" uk-grid>
                            <!-- column one -->
                            <div class="uk-margin-auto-vertical uk-text-center uk-animation-scale-up p-3 uk-light">
                                <a href="<?php echo home_url(); ?>">
                                    <img src="<?php echo aoton('logo'); ?>" alt="<?php bloginfo('name'); ?>">
                                </a>
                                <h3 class="mb-3 mt-lg-4"><?php bloginfo('name'); ?></h3>
                                <p><?php bloginfo('description'); ?></p>
                            </div>
                            <!-- column two -->
                            <div class="uk-card-default px-5 py-5 part">
                                <div class="uk-width-expand@s">
                                    <p class="uk-align-right"><a class="signin-loader" href="<?php echo get_permalink(aotonThemes_page('template/login.php'));?>">账户登录？</a></p>
                                    <div class="clear"></div>
                                </div>
                                <div class="mb-4 uk-text-center">
                                    <h2 class="mb-0">手机快速登录</h3>
                                    <p class="my-2">手机获取验证码快速登录</p>
                                </div>
                                <form id="sign-sms">
                                    <div class="form-item">
                                        <input type="text" name="user_mobile" class="form-control" id="user_mobile" placeholder="手机号"><i class="icon icon-mobile"></i>
                                    </div>	
                                    <div class="form-item">
                                        <input type="text" name="user_mobile_captcha" class="form-control" id="user_mobile_captcha" placeholder="验证码">
                                        <p class="captcha-sms-clk"><i class="ico ico-RectangleCopy5"></i>获取手机验证码</p>
                                    </div>		
                                    <div class="sign-tips"></div>	
                                    <div class="sign-submit">
                                        <input type="button" class="btn signsmssubmit-loader" name="submit" value="快速登录"> 
                                        <input type="hidden" name="action" value="signsms">	
                                        <div class="form-policy">
                                            <input type="checkbox" name="policy_sms" id="policy_sms" value="1" checked>
                                            <label for="policy_sms">我已阅读并同意《<a href="<?php get_privacy_policy_url()?>" target="_blank">用户注册协议</a>》</label>
                                        </div>
                                    </div>
                                    <?php if(aoton('social_login')){?>
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
                                    <?php }?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
		    <?php }elseif(isset($_GET['action']) && $_GET['action'] == 'password'){?>
                <div uk-height-viewport class="uk-flex uk-flex-middle">
                    <div class="uk-width-2-3@m uk-width-1-2@s m-auto rounded uk-overflow-hidden">
                        <div class="uk-child-width-1-2@m uk-grid-collapse bg-gradient-primary" uk-grid>
                            <!-- column one -->
                            <div class="uk-margin-auto-vertical uk-text-center uk-animation-scale-up p-3 uk-light">
                                <a href="<?php echo home_url(); ?>">
                                    <img src="<?php echo aoton('logo'); ?>" alt="<?php bloginfo('name'); ?>">
                                </a>
                                <h3 class="mb-3 mt-lg-4"><?php bloginfo('name'); ?></h3>
                                <p><?php bloginfo('description'); ?></p>
                            </div>
                            <!-- column two -->
                            <div class="uk-card-default px-5 py-5">
                                <div class="uk-width-expand@s">
                                    <p class="uk-align-right">已有帐户？<a class="signin-loader" href="<?php echo get_permalink(aotonThemes_page('template/login.php'));?>">返回登录</a></p>
                                    <div class="clear"></div>
                                </div>
                                <div class="mb-4 uk-text-center">
                                    <h2 class="mb-0"> 密码找回 </h3>
                                    <p class="my-2">你将收到重置账户密码链接，请注意查收！</p>
                                </div>
                                <form id="passform" class="loginform" method="post" novalidate="novalidate" onSubmit="return false;">
                                    <p class="input-item">
                                        <label>用户名/电子邮箱</label>
                                        <input class="input-control" id="passname" type="text" placeholder="用户名/电子邮箱" name="passname" required=""><i class="ico ico-user"></i>
                                    </p><p class="sign-tips"></p>
                                    <p class="input-submit">
                                        <input class="submit pass-loader btn" type="submit" value="找回密码">
                                        <input type="hidden" name="action" value="password">
                                        <input type="hidden" id="security" name="security" value="<?php echo  wp_create_nonce( 'security_nonce' );?>">
                                        <input type="hidden" name="_wp_http_referer" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
		    <?php }elseif(isset($_GET['action']) && $_GET['action'] == 'reset_password'){ ?>
                <div uk-height-viewport class="uk-flex uk-flex-middle">
                    <div class="uk-width-2-3@m uk-width-1-2@s m-auto rounded uk-overflow-hidden">
                        <div class="uk-child-width-1-2@m uk-grid-collapse bg-gradient-primary" uk-grid>
                            <!-- column one -->
                            <div class="uk-margin-auto-vertical uk-text-center uk-animation-scale-up p-3 uk-light">
                                <a href="<?php echo home_url(); ?>">
                                    <img src="<?php echo aoton('logo'); ?>" alt="<?php bloginfo('name'); ?>">
                                </a>
                                <h3 class="mb-3 mt-lg-4"><?php bloginfo('name'); ?></h3>
                                <p><?php bloginfo('description'); ?></p>
                            </div>
                            <!-- column two -->
                            <div class="uk-card-default px-5 py-5">
                                <div class="uk-width-expand@s">
                                    <p class="uk-align-right">没有帐户？
                                    <a href="<?php echo add_query_arg('action','register',get_permalink(aotonThemes_page('template/login.php')));?>">前往注册！</a>
                                     </p>
                                    <div class="clear"></div>
                                </div>
                                <div class="resetPart"><a class="signin-loader" href="<?php echo get_permalink(aotonThemes_page('template/login.php'));?>"> 返回登录</a></div>
                                <?php
                                    $reset_key = $_GET['key']; 
                                    $user_login = esc_sql($_GET['login']); 
                                    $user_data = $wpdb->get_row($wpdb->prepare("SELECT ID, user_login, user_email, user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));   
                                    $user_login = $user_data->user_login;   
                                    $user_email = $user_data->user_email;   
                                    if(!empty($reset_key) && !empty($user_data) && md5('mbt'.$user_data->user_activation_key) == $reset_key) {   
                                ?>

                                <form id="resetform" class="loginform" method="post" novalidate="novalidate" onSubmit="return false;">
                                    <p class="input-item">
                                        <input class="input-control" id="resetpass" type="password" placeholder="新密码" name="resetpass">
                                    </p>
                                    <p class="input-item">
                                        <input class="input-control" id="resetpass2" type="password" placeholder="确认新密码" name="resetpass2">
                                    </p>
                                    <div class="sign-tips"></div>
                                    <p class="input-submit">
                                        <input class="submit reset-loader btn" type="button" value="修改密码">
                                        <input type="hidden" name="action" value="reset">
                                        <input type="hidden" name="key" id="resetkey" value="<?php echo $reset_key;?>">
                                        <input type="hidden" name="user_login" id="user_login" value="<?php echo $user_login;?>">
                                        <input type="hidden" id="security" name="security" value="<?php echo  wp_create_nonce( 'security_nonce' );?>">
                                        <input type="hidden" name="_wp_http_referer" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                    </p>
                                </form>
                                <?php }else{?>
                                    <div class=regSuccess>错误的请求，请查看邮箱里的重置密码链接。</div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
		        </div>
		    <?php }else{?>
                <div uk-height-viewport class="uk-flex uk-flex-middle">
                    <div class="uk-width-2-3@m uk-width-1-2@s m-auto rounded uk-overflow-hidden">
                        <div class="uk-child-width-1-2@m uk-grid-collapse bg-gradient-primary" uk-grid>
                            <!-- column one -->
                            <div class="uk-margin-auto-vertical uk-text-center uk-animation-scale-up p-3 uk-light">
                                <a href="<?php echo home_url(); ?>">
                                    <img src="<?php echo aoton('logo'); ?>" alt="<?php bloginfo('name'); ?>">
                                </a>
                                <h3 class="mb-3 mt-lg-4"><?php bloginfo('name'); ?></h3>
                                <p><?php bloginfo('description'); ?></p>
                            </div>
                            <!-- column two -->
                            <div class="uk-card-default px-5 py-5 part">
                                <div class="uk-width-expand@s">
                                    <p class="uk-align-right">没有帐户？<a href="<?php echo add_query_arg('action','register',get_permalink(aotonThemes_page('template/login.php')));?>">立即注册！</a></p>
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
                                    <div class="sign-tip"></div>
                                    <p class="input-submit">
                                        <input class="submit login-loader btn" type="submit" value="登录">
                                        <input type="hidden" name="action" value="login">
                                        <input type="hidden" id="security" name="security" value="<?php echo  wp_create_nonce( 'security_nonce' );?>">
                                        <input type="hidden" name="_wp_http_referer" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                        <input type="hidden" id="redirect_to" value="<?php echo $_GET['redirect_to']; ?>">
                                    </p>
                                    <p class="safe">
                                        <a class="lostpwd-loader left" href="<?php echo add_query_arg('action','password',get_permalink(aotonThemes_page('template/login.php')));?>">忘记密码？!</a>
                                    </p>
                                    <?php if(aoton('sms_login')){?>
                                    <p class="safe">
                                        <a href="<?php echo add_query_arg('action','sign-sms',get_permalink(aotonThemes_page('template/login.php')));?>"><i class="ico ico-mobile"></i>手机号登录</a>
                                    </p>	
                                    <?php }?>
                                    
                                    <?php if(aoton('social_login')){?>
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
                                    <?php }?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
		    <?php }?>
		</div>
	</div>
    <?php endif ?>
	<script type="text/javascript" src="<?php bloginfo("template_url");?>/assets/js/login.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/uikit.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/simplebar.js"></script>
</body>
</html>