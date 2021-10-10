jQuery(function($){

	document.onkeydown = function() {
		if (event.keyCode == 13) {
			$(".submit").click();
		}
	}

	$('.login-loader').on('click', function(){
											
		if( !$("#username").val() ){
			UIkit.notification('用户名/邮箱不能为空')
			return
		}
		
		if( !$("#password").val() ){
			UIkit.notification('密码不能为空')
			return
		}
		
		var currbtn = $(this);				
		currbtn.val("登录中...");
		$.post(
			_aoton.uri+'/action/login.php',
			{
				log: $("#username").val(),
				pwd: $("#password").val(),
				cpt: $("#captcha").val(),
				action: "aoton_login"
				
			},
			function (data) {
				if ($.trim(data) != "1") {
					UIkit.notification(data);
					currbtn.val("登录");
				}
				else {
					location.reload();                     
				}
			}
		);
	})
	$("#regname").bind("blur",function(){
		var currInput = $(this);		
		$.post(
			_aoton.uri+'/action/check.php',
			{
				user_register: $("#regname").val(),
				action: "name"
			},
			function (data) {
				if ($.trim(data) == "1") {
					currInput.parent().next(".sign-tip").remove();
				}else {
					/*currInput.focus();*/
					if(currInput.parent().next(".sign-tip").length){
						currInput.parent().next(".sign-tip").text(data);
					}else{
						currInput.parent().after("<p class='sign-tip' style='display:block'>"+data+"</p>");
					}
				}
			}
		);	
	});
	$("#regemail").bind("blur",function(){
		var currInput = $(this);		
		$.post(
			_aoton.uri+'/action/check.php',
			{
				user_email: $("#regemail").val(),
				action: "email"
			},
			function (data) {
				if ($.trim(data) == "1") {
					currInput.parent().next(".sign-tip").remove();
				}else {
					/*currInput.focus();*/
					if(currInput.parent().next(".sign-tip").length){
						currInput.parent().next(".sign-tip").text(data);
					}else{
						currInput.parent().after("<p class='sign-tip' style='display:block'>"+data+"</p>");
					}
				}
			}
		);	
	});
	$('.register-loader').on('click', function(){
		if( $("#regname").val().length < 4 ){
			UIkit.notification('用户名长度至少4位')
			return
		}
		
		if( !is_check_mail($("#regemail").val()) ){
			UIkit.notification('邮箱格式错误')
			return
		}

		if( $("#regpass").val().length < 6 ){
			UIkit.notification('密码太短，至少6位')
			return
		}
		

		if( $("#captcha").length && !$("#captcha").val() ){
			UIkit.notification('验证码不能为空')
			return
		}

		if( $(".form-policy").length && !$("input[name='policy_reg']").is(':checked')){
			UIkit.notification('请阅读并同意用户注册协议');
			return false;
		}
		
		var currbtn = $(this);				
		currbtn.val("注册中...");
		$.post(
			_aoton.uri+'/action/login.php',
			{
				user_register: $("#regname").val(),
				user_email: $("#regemail").val(),
				password: $("#regpass").val(),
				captcha: $("#captcha").val(),
				action: "aoton_register"
			},
			function (data) {
				if ($.trim(data) == "1") {
					location.reload(); 
				}
				else {
					UIkit.notification(data);
					currbtn.val("注册账号");
				}
			}
		);
		return false;										   
	});
	$('.mobile-loader').on('click', function(){
		if( !is_check_mobile($("#regmobile").val()) ){
			UIkit.notification('手机号格式错误');
			return false;
		}

		if( !$("#captcha").val() ){
			UIkit.notification('请输入验证码');
			return false;
		}
		if( $(".form-policy").length && !$("input[name='policy_reg']").is(':checked')){
			UIkit.notification('请阅读并同意用户注册协议');
			return false;
		}
        var currbtn = $(this);				
		currbtn.val("登录中...");
        $.post(
        	_aoton.uri+'/action/login.php',
        	{
        		mobile: $("#regmobile").val(),
        		captcha: $("#captcha").val(),
			    action: "aoton_mobile_login"
			},
			function (data) {
				if ($.trim(data) == "1") {
					UIkit.notification("登录成功，跳转中...");
					location.reload(); 
				}else {
					UIkit.notification(data);
					currbtn.val("快速登录");
				}
			}
		);	
		return false;									   
    });
	$('.pass-loader').on('click', function(){
		if( !$("#passname").val() ){
			UIkit.notification('用户名或邮箱不能为空');
			return
		}

		var currbtn = $(this);				
		currbtn.val("处理中...");
		$.post(
			_aoton.uri+'/action/login.php',
			{
				passname: $("#passname").val(),
				action: "password"
			},
			function (data) {
				if ($.trim(data) == "1") {
					$("#passform").remove();
					$(".sign-tips").after("<div class=regSuccess>确认链接已经发送到您的邮箱，请查收并确认。</div>");
					/*setTimeout(function(){location.reload(); }, 2000);*/
				}
				else {
					UIkit.notification(data);
					currbtn.val("找回密码");
				}
			}
		);								   
	});
	$('.reset-loader').on('click', function(){
		if( $("#resetpass").val().length < 6 ){
			UIkit.notification('密码太短，至少6位')
			return
		}
		
		if( $("#resetpass").val() != $("#resetpass2").val()){
			UIkit.notification('两次输入密码不一致')
			return
		}
		var currbtn = $(this);				
		currbtn.val("修改中...");
		$.post(
			_aoton.uri+'/action/login.php',
			{
				resetpass: $("#resetpass").val(),
				key: $("#resetkey").val(),
				username: $("#user_login").val(),
				action: "reset"
			},
			function (data) {
				if ($.trim(data) == "1") {
					$("#resetform").remove();
					$(".resetPart").after("<div class=regSuccess>密码修改成功，请牢记密码哦。</div>");
					/*setTimeout(function(){location.reload(); }, 2000);*/
				}
				else {
					UIkit.notification(data);
					currbtn.val("修改密码");
				}
			}
		);								   
	});	
	$('.captcha-clk').bind('click',function(){

		var captcha = $(this);

		if(captcha.hasClass("disabled")){

			UIkit.notification('您操作太快了，等等吧')

		}else{

			captcha.addClass("disabled");

			captcha.html("发送中...");

			$.post(

				_aoton.uri+'/action/captcha.php?'+Math.random(),

				{

					action: "aoton_captcha",

					email:$("#regemail").val()

				},

				function (data) {

					if($.trim(data) == "1"){
						
						UIkit.notification('已发送验证码至邮箱，可能会出现在垃圾箱里哦~')

						var countdown=60; 

						settime()

						function settime() { 

							if (countdown == 0) { 

								captcha.removeClass("disabled");   

								captcha.html("重新发送验证码");

								countdown = 60; 

								return;

							} else { 

								captcha.addClass("disabled");

								captcha.html("重新发送(" + countdown + ")"); 

								countdown--; 

							} 

							setTimeout(function() { settime() },1000) 

						}

					}else if($.trim(data) == "2"){

						UIkit.notification('邮箱已存在')

						captcha.html("发送验证码至邮箱");

						captcha.removeClass("disabled"); 

					}else{

						UIkit.notification('验证码发送失败，请稍后重试')

						captcha.html("发送验证码至邮箱");

						captcha.removeClass("disabled"); 

					}

				}

				);

		}

	});
	$('.captcha-clk2').bind('click',function(){
		var captcha = _aoton.uri+'/action/captcha2.php?'+Math.random();
		$(this).attr('src',captcha);
	});
	$('.captcha-sms-clk').bind('click',function(){
		if( !is_check_mobile($("#regmobile").val()) ){
			UIkit.notification('手机号格式错误');
			return false;
		}
		
		var captcha = $(this);
		if(captcha.hasClass("disabled")){
			UIkit.notification('您操作太快了，等等吧')
		}else{
			captcha.addClass("disabled");
			captcha.html("发送中...");
			$.post(
				_aoton.uri+'/action/login.php',
				{
					action: "aoton_captcha_sms",
					mobile:$("#regmobile").val()
				},
				function (data) {
					if($.trim(data) == "1"){
						UIkit.notification('已发送验证码至手机，请注意查收~')
						var countdown=60; 
						settime();
						function settime() { 
							if (countdown == 0) { 
								captcha.removeClass("disabled");   
								captcha.html("重新获取验证码");
								countdown = 60; 
								return;
							} else { 
								captcha.addClass("disabled");
								captcha.html("重新获取(" + countdown + ")"); 
								countdown--; 
							} 
							setTimeout(function() { settime() },1000) 
						}
						
					}else{
						UIkit.notification("验证码发送失败，请稍后重试")
						captcha.html("获取验证码");
						captcha.removeClass("disabled"); 
					}
				}

			);

		}

	});

	
});

function is_check_name(str) {    
	return /^[\w]{3,16}$/.test(str) 
}
function is_check_mail(str) {
	return /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/.test(str)
}
function is_check_url(str) {
    return /^((http|https)\:\/\/)([a-z0-9-]{1,}.)?[a-z0-9-]{2,}.([a-z0-9-]{1,}.)?[a-z0-9]{2,}$/.test(str)
}
function is_check_mobile(str){
    return /^[1][3,4,5,7,8,9][0-9]{9}$/.test(str);
}