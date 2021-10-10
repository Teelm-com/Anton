<?php
/*
	template name: 个人中心
*/
if(!is_user_logged_in()){
	header("Location:".get_permalink(aotonThemes_page("template/login.php")));
	exit;
}
get_header();
	get_template_part("pages/user");
?>

<?php get_footer();?>