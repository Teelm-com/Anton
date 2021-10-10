<?php 
session_start();
require( dirname(__FILE__) . '/../../../../wp-load.php' );
date_default_timezone_set('Asia/Shanghai');
global $wpdb;
if ( is_user_logged_in() ) { 
	global $current_user; 
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	if($_POST['action']=='user.edit'){
		
		$userdata = array();
		$userdata['ID'] = $uid;
		$userdata['nickname'] = str_replace(array('<','>','&','"','\'','#','^','*','_','+','$','?','!'), '', $wpdb->escape(trim($_POST['nickname'])) );
		$userdata['display_name'] = str_replace(array('<','>','&','"','\'','#','^','*','_','+','$','?','!'), '', $wpdb->escape(trim($_POST['nickname'])) );
		$userdata['description'] = $wpdb->escape(trim($_POST['description']));
		wp_update_user($userdata);
		update_user_meta($uid, 'qq', $wpdb->escape(trim($_POST['qq'])) );
		update_user_meta($uid, 'url', $wpdb->escape(trim($_POST['url'])) );
		$error = 0;	

		$arr=array(
			"error"=>$error, 
			"msg"=>$msg
		); 
		$jarr=json_encode($arr); 
		echo $jarr;
	}elseif($_POST['action']=='user.email'){
		$user_email = apply_filters( 'user_registration_email', $wpdb->escape(trim($_POST['email'])) );
		$error = 0;$msg = '';
		if ( $user_email == '' ) {
			$error = 1;
			$msg = '邮箱不能为空';
		} elseif ( $user_email == $current_user->user_email) {
			$error = 1;
			$msg = '请输入一个新邮箱账号';
		}elseif ( email_exists( $user_email ) && $user_email != $current_user->user_email) {
			$error = 1;
			$msg = '邮箱已被使用';
		}else{
			if(empty($_POST['captcha']) || empty($_SESSION['aoton_email_captcha']) || trim(strtolower($_POST['captcha'])) != $_SESSION['aoton_email_captcha']){
				$error = 1;
				$msg .= '验证码错误 ';
			}elseif($_SESSION['aoton_email_new'] != $user_email){
				$error = 1;
				$msg = '邮箱与验证码不对应';
			}else{
				unset($_SESSION['aoton_email_captcha']);
				unset($_SESSION['aoton_email_new']);
				$userdata = array();
				$userdata['ID'] = $uid;
				$userdata['user_email'] = $user_email;
				wp_update_user($userdata);
				$error = 0;	
			}
		}
		
		$arr=array(
			"error"=>$error, 
			"msg"=>$msg
		); 
		$jarr=json_encode($arr); 
		echo $jarr;
	}elseif($_POST['action']=='user.email.captcha'){
		$user_email = apply_filters( 'user_registration_email', $wpdb->escape(trim($_POST['email'])) );
		$error = 0;$msg = '';
		if ( $user_email == '' ) {
			$error = 1;
			$msg = '邮箱不能为空';
		} elseif ( $user_email == $current_user->user_email) {
			$error = 1;
			$msg = '请输入一个新邮箱账号';
		} elseif ( email_exists( $user_email ) && $user_email != $current_user->user_email) {
			$error = 1;
			$msg = '邮箱已被使用';
		}else{
			
			$originalcode = '0,1,2,3,4,5,6,7,8,9';
			$originalcode = explode(',',$originalcode);
			$countdistrub = 10;
			$_dscode = "";
			$counts=6;
			for($j=0;$j<$counts;$j++){
				$dscode = $originalcode[rand(0,$countdistrub-1)];
				$_dscode.=$dscode;
			}
			$_SESSION['aoton_email_captcha']=strtolower($_dscode);
			$_SESSION['aoton_email_new']=$user_email;
			$message .= '验证码：'.$_dscode;   
			wp_mail($user_email, '验证码-修改邮箱-'.get_bloginfo('name'), $message);    
			$error = 0;	
		}
		
		$arr=array(
			"error"=>$error, 
			"msg"=>$msg
		); 
		$jarr=json_encode($arr); 
		echo $jarr;
	}elseif($_POST['action']=='user.password'){
		$error = 0;$msg = '';
		$username = $wpdb->escape(wp_get_current_user()->user_login);   
    	$password = $wpdb->escape($_POST['passwordold']); 
		$login_data = array();
		$login_data['user_login'] = $username;   
		$login_data['user_password'] = $password;   
		$user_verify = wp_signon( $login_data, false );  
		if ( is_wp_error($user_verify) ) {    
			$error = 1;$msg = '原密码错误';   
		}else{
			$userdata = array();
			$userdata['ID'] = wp_get_current_user()->ID;
			$userdata['user_pass'] = $_POST['password'];
			wp_update_user($userdata);
		}
		$arr=array(
			"error"=>$error, 
			"msg"=>$msg
		); 
		$jarr=json_encode($arr); 
		echo $jarr; 
	}
}