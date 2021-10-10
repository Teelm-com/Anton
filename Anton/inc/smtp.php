<?php
add_action('phpmailer_init', 'mail_smtp');
function mail_smtp( $phpmailer ) {
	$phpmailer->FromName = ''. aoton('email_name') . '';
	$phpmailer->Host = ''. aoton('email_smtp') . '';
	$phpmailer->Port = 465;
	$phpmailer->Username = ''. aoton('email_account') . '';
	$phpmailer->Password = ''. aoton('email_authorize') . '';
	$phpmailer->From = ''. aoton('email_account') . '';
	$phpmailer->SMTPAuth = true;
	$phpmailer->SMTPSecure = 'ssl';
	$phpmailer->IsSMTP();
}