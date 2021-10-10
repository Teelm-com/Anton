<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 
/* Template Name: 登录 */ 
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="referrer" content="never" />
    <title>欢迎！ - <?php bloginfo("name");?></title>
    <meta name="description" content="<?php echo aoton('description'); ?>" />
	<meta name="keywords" content="<?php echo aoton('keyword'); ?>" />   
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="icon" href="<?php bloginfo('template_url'); ?>/assets/images/favicon.png">

    <!-- wordpress option
    ================================================== -->
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
</head>
<body class="bg-white wp_login_form">
<?php 
 if ( is_user_logged_in() ) : ?>
    <!-- Content
    ================================================== -->
    <div uk-height-viewport class="uk-flex uk-flex-middle">
        <div class="uk-width-2-3@m uk-width-1-2@s m-auto rounded uk-overflow-hidden shadow-lg">
            <div class="uk-child-width-1-2@m uk-grid-collapse bg-gradient-primary" uk-grid>

                <!-- column one -->
                <div class="uk-margin-auto-vertical uk-text-center uk-animation-scale-up p-3 uk-light">
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php bloginfo('template_url'); ?>/assets/images/logo-light-icon.png" alt="<?php bloginfo('name'); ?>">
                    </a>
                    <h3 class="mb-3 mt-lg-4"><?php bloginfo('name'); ?></h3>
                    <p><?php bloginfo('description'); ?></p>
                </div>

                <!-- column two -->
                <div class="uk-card-default px-5 py-8">
                    <div class="mb-4 uk-text-center">
                        <h2 class="mb-0"> 你已登陆！</h3>
                        <p class="my-2">请前往<a href="<?php echo home_url(); ?>">首页</a>查看网站内容。</p>
                    </div>
            </div>
        </div>
    </div>
    <?php else : ?>
    <div uk-height-viewport class="uk-flex uk-flex-middle">
        <div class="uk-width-2-3@m uk-width-1-2@s m-auto rounded uk-overflow-hidden shadow-lg">
            <div class="uk-child-width-1-2@m uk-grid-collapse bg-gradient-primary" uk-grid>

                <!-- column one -->
                <div class="uk-margin-auto-vertical uk-text-center uk-animation-scale-up p-3 uk-light">
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php bloginfo('template_url'); ?>/assets/images/logo-light-icon.png" alt="<?php bloginfo('name'); ?>">
                    </a>
                    <h3 class="mb-3 mt-lg-4"><?php bloginfo('name'); ?></h3>
                    <p><?php bloginfo('description'); ?></p>
                </div>

                <!-- column two -->
                <div class="uk-card-default px-5 py-5">
                    <div class="uk-width-expand@s">
                        <p class="uk-align-right">没有帐户？<a href="<?php echo wp_registration_url(); ?>">立即注册！</a></p>
                        <div class="clear"></div>
                    </div>
                    <div class="mb-4 uk-text-center">
                        <h2 class="mb-0"> 欢迎回来！</h3>
                        <p class="my-2">请登录后管理您的帐户。</p>
                    </div>
                    
                    <?php 
                        $args = array(
                            'echo'           => true,
                            'remember'       => true,
                            'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
                            'form_id'        => 'loginform',
                            'id_username'    => 'user_login',
                            'id_password'    => 'user_pass',
                            'id_remember'    => 'rememberme',
                            'id_submit'      => 'wp-submit',
                            'label_username' => __( 'Username' ),
                            'label_password' => __( 'Password' ),
                            'label_remember' => __( 'Remember Me' ),
                            'label_log_in'   => __( 'Log In' ),
                            'value_username' => '',
                            'value_remember' => false
                        );
                        wp_login_form($args);
                    ?>
                    <div class="uk-width-expand@s">
                        <p>忘记密码？<a href="<?php echo wp_lostpassword_url( home_url() ); ?>">立即找回！</a></p>
                    </div>
                </div><!--  End column two -->

            </div>
        </div>
    </div>
    <!-- Content -End
    ================================================== -->
<?php endif ?>
    <script src="<?php bloginfo('template_url'); ?>/assets/js/uikit.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/assets/js/simplebar.js"></script>
</body>

</html>