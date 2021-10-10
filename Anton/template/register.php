<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 
/* Template Name: 注册 */ 
?>
<?php
	if( !empty($_POST['user_reg']) ) {
		$error = '';
		$sanitized_user_login = sanitize_user( $_POST['user_login'] );
		$user_email = apply_filters( 'user_registration_email', $_POST['user_email'] );

  // 检查名称
	if ( $sanitized_user_login == '' ) {
		$error .= '<i class="be be-info"></i>请输入用户名！<br />';
	} elseif ( ! validate_username( $sanitized_user_login ) ) {
		$error .= '<i class="be be-info"></i>此用户名包含无效字符，请输入有效的用户名！<br />';
		$sanitized_user_login = '';
	} elseif ( username_exists( $sanitized_user_login ) ) {
		$error .= '<i class="be be-info"></i>该用户名已被注册，请再选择一个！<br />';
	}

  // 检查邮件
	if ( $user_email == '' ) {
		$error .= '<i class="be be-info"></i>请填写电子邮件地址！<br />';
	} elseif ( ! is_email( $user_email ) ) {
		$error .= '<i class="be be-info"></i>电子邮件地址不正确！<br />';
		$user_email = '';
	} elseif ( email_exists( $user_email ) ) {
		$error .= '<i class="be be-info"></i>该电子邮件地址已经被注册，请换一个！<br />';
	}

	// 检查密码
	if(strlen($_POST['user_pass']) < 6)
		$error .= '<i class="be be-info"></i>密码长度至少6位!<br />';
		elseif($_POST['user_pass'] != $_POST['user_pass2'])
		$error .= '<i class="be be-info"></i>密码不一致!<br />';

	if($error == '') {
			$user_id = wp_create_user( $sanitized_user_login, $_POST['user_pass'], $user_email );

		if ( ! $user_id ) {
			$error .= sprintf( '<i class="be be-info"></i>无法完成您的注册请求... 请联系<a href=\"mailto:%s\">管理员</a>！<br />', get_option( 'admin_email' ) );
		}
		else if (!is_user_logged_in()) {
			$user = get_userdatabylogin($sanitized_user_login);
			$user_id = $user->ID;

	      // 自动登录
			wp_set_current_user( $user_id, $user->user_login );
			wp_set_auth_cookie( $user_id );
			do_action( 'wp_login', $user->user_login );
		}
	}
}
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
    <title>注册 - <?php bloginfo("name");?></title>
    <meta name="description" content="<?php echo aoton('description'); ?>" />
	<meta name="keywords" content="<?php echo aoton('keyword'); ?>" />
    <link rel="icon" href="<?php bloginfo('template_url'); ?>/assets/images/favicon.png">

    <!-- wordpress option
    ================================================== -->
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
</head>
<body class="bg-white wp_register_form">
<?php if(!empty($error)) {
    echo '
    <div class="uk-width-1-3 uk-alert-danger uk-animation-slide-top-small uk-position-large uk-position-top uk-overlay uk-overlay-default" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p class="user_error">'.$error.'</p></div>';
}
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
                        <h2 class="mb-0">您已登录，请勿重复注册！</h3>
                        <p class="my-2">立即<a href="<?php echo home_url(); ?>">前往首页</a>浏览网站内容。</p>
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
                        <p class="uk-align-right">已有帐户？<a href="<?php echo wp_login_url(); ?>">立即登录！</a></p>
                        <div class="clear"></div>
                    </div>
                    <div class="mb-4 uk-text-center">
                        <h2 class="mb-0"> 感谢注册！</h3>
                        <p class="my-2">请登录后管理您的帐户。</p>
                    </div>
                    
                    <div class="reg-content">
						<form name="registerform" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" id="registerform" class="user_reg">
							    <p>
									<label for="user_login">用户名*<br />
							        <input type="text" name="user_login" id="user_login" class="input" value="<?php if(!empty($sanitized_user_login)) echo $sanitized_user_login; ?>" size="30" />
							      </label>
							    </p>

							    <p>
									<label for="user_email">电子邮件地址*<br />
							        <input type="text" name="user_email" id="user_email" class="input" value="<?php if(!empty($user_email)) echo $user_email; ?>" size="30" />
							      </label>
							    </p>
                                
								    <p>
										<label for="user_pwd1">密码(至少6位)*<br />
								        <input id="user_pwd1" class="input" type="password" size="30" value="" name="user_pass" />
								      </label>
								    </p>

								    <p>
										<label for="user_pwd2">重复密码*<br />
								        <input id="user_pwd2" class="input" type="password" size="30" value="" name="user_pass2" />
								      </label>
								    </p>

								<?php do_action('register_form'); ?>

							    <p class="submit">
									<input type="hidden" name="user_reg" value="ok" />
							        <input id="submit" class="button button-primary" name="submit" type="submit" value="提交注册"/>
							    </p>
							</form>
					</div>
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
    <!-- javaScripts
    ================================================== -->
    <script src="<?php bloginfo('template_url'); ?>/assets/js/uikit.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/assets/js/simplebar.js"></script>

</body>

</html>