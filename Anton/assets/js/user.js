jQuery(function($){
	var ajax_url = _aoton.uri+"/action/user.php";
	var _tipstimer;

	function tips(str, hide=1){
		if( !str ) return false
			_tipstimer && clearTimeout(_tipstimer)
		$('.user-tips').html(str).animate({
			top: 0
		}, 220);
		if(hide){
			_tipstimer = setTimeout(function(){
				$('.user-tips').animate({
					top: -30
				}, 220)
			}, 5000);
		}
	}





		/* click event

		 * ====================================================

		 */

		 $(".prices label:last-child").addClass('active');

		 $("#avatarphoto").change(function(){
	          $("#uploadphoto").ajaxSubmit({
	            dataType:  'json',
	            beforeSend: function() {
	              UIkit.notification('上传中...');	
	            },
	            uploadProgress: function(event, position, total, percentComplete) {

	            },
	            success: function(data) {
	              if (data == "1") {
	                UIkit.notification('头像修改成功');
	                location.reload();     
	              }else if(data == "2"){
	                UIkit.notification('图片大小至多1000K');	
	                return false;
	              }else if(data == "3"){
	                UIkit.notification('图片格式只支持.jpg .png .gif');
	                return false;	
	              }else{
	                UIkit.notification('上传失败');	
	                return false;
	              }
	            },
	            error:function(xhr){
	              UIkit.notification('上传失败');	
	              return false;
	            }
	          });				   
			
	        });

		 $('.container-user').on('click', function(e){

		 	e = e || window.event;

		 	var target = e.target || e.srcElement

		 	var _ta = $(target)



		 	if( _ta.parent().attr('evt') ){

		 		_ta = $(_ta.parent()[0])

		 	}else if( _ta.parent().parent().attr('evt') ){

		 		_ta = $(_ta.parent().parent()[0])

		 	}



		 	var type = _ta.attr('evt')



		 	if( !type || _ta.hasClass('disabled') ) return 

		 		
		 		switch( type ){

		 			case 'user.avatar.submit':
              			$("#avatarphoto").trigger("click");
                	break;

		 			case 'price.select':
		 				$(".prices label").removeClass('active');
		 				_ta.addClass('active');
		 			break;

		 			case 'user.data.submit':

		 			var form = _ta.parent().parent().parent()

		 			var inputs = form.serializeObject()



		 			var ispass = false

		 			if( inputs.action === 'user.password' ) ispass = true



		 				if( !inputs.action ){

		 					return

		 				}



		 				if( ispass ){

		 					if( !$.trim(inputs.passwordold) ){
		 						UIkit.notification('请输入原密码')
		 						return
		 					}

		 					if( !inputs.password || inputs.password.length < 6 ){

		 						UIkit.notification('新密码不能为空且至少6位')

		 						return

		 					}



		 					if( inputs.password !== inputs.password2 ){

		 						UIkit.notification('两次密码输入不一致')

		 						return

		 					}


		 				}else{

		 					if( !/.{2,20}$/.test(inputs.nickname) ){

		 						UIkit.notification('昵称限制在2-20字内')

		 						return

		 					}

		 					if( inputs.qq && !is_qq(inputs.qq) ){

		 						UIkit.notification('QQ格式错误')

		 						return

		 					}

		 				}

		 				UIkit.notification('修改中...')

		 				$.ajax({  

		 					type: 'POST',  

		 					url:  ajax_url,  

		 					data: inputs,  

		 					dataType: 'json',

						success: function(data){  

							if( data.error ){

								if( data.msg ){

									UIkit.notification(data.msg)

								}

								return

							}

							UIkit.notification('修改成功！')

							cache_userdata = null

							$('.user-meta:eq(1) input:password').val('')

						}  

					});  



		 				break;


		 				case 'user.email.submit':

		 				

		 				var form = _ta.parent().parent().parent()

		 				var inputs = form.serializeObject()

		 				

		 				if( !inputs.action ){

		 					return

		 				}

		 				

		 				if( !inputs.email ){

		 					UIkit.notification('邮箱不能为空')

		 					return

		 				}



		 				if( !is_mail(inputs.email) ){

		 					UIkit.notification('邮箱格式错误')

		 					return

		 				}

		 				

		 				if( !inputs.captcha ){

		 					UIkit.notification('请输入邮箱验证码')

		 					return

		 				}

		 				

		 				UIkit.notification('修改中...',0)

		 				$.ajax({  

		 					type: 'POST',  

		 					url:  ajax_url,  

							//data: inputs,  

							dataType: 'json',

							data: {

								action: inputs.action,

								captcha: inputs.captcha,

								email: inputs.email

							},

							success: function(data){  

								if( data.error ){

									if( data.msg ){

										UIkit.notification(data.msg)

									}

									return

								}

								

								UIkit.notification('邮箱修改成功！')

								location.reload();

							}  

						});

		 				

		 				break;

		 				

		 				case 'user.email.captcha.submit':

		 				

		 				var form = _ta.parent().parent().parent()

		 				var inputs = form.serializeObject()

		 				

		 				if( !inputs.action ){

		 					return

		 				}

		 				

		 				if( !inputs.email ){

		 					UIkit.notification('邮箱不能为空')

		 					return

		 				}



		 				if( !is_mail(inputs.email) ){

		 					UIkit.notification('邮箱格式错误')

		 					return

		 				}

		 				var captchabtn = $('#captcha_btn');

		 				

		 				if(captchabtn.hasClass("disabled")){

		 					UIkit.notification('您操作太快了，等等吧')

		 				}else{

		 					UIkit.notification('发送验证码中...')

		 					captchabtn.addClass("disabled");

		 					$.ajax({  

		 						type: 'POST',  

		 						url:  ajax_url,  

								//data: inputs,  

								dataType: 'json',

								data: {

									action: 'user.email.captcha',

									email: inputs.email

								},

								success: function(data){  

									if( data.error ){

										if( data.msg ){

											UIkit.notification(data.msg)

											captchabtn.removeClass("disabled");   

										}

										return

									}

									

									UIkit.notification('验证码已发送至新邮箱！')

									var countdown=60; 

									settime()

									function settime() { 

										if (countdown == 0) { 

											captchabtn.removeClass("disabled");   

											captchabtn.text("重新获取验证码");

											countdown = 60; 

											return;

										} else { 

											captchabtn.addClass("disabled");

											captchabtn.text("重新获取(" + countdown + ")"); 

											countdown--; 

										} 

										setTimeout(function() { settime() },1000) 

									}

								}  

							});

		 				}

		 				

		 				break;

		 				case 'user.mobile.captcha.submit':
		 				var form = _ta.parent().parent().parent();
		 				var inputs = form.serializeObject();

		 				if( !inputs.action ){
		 					return
		 				}

		 				if( !inputs.mobile ){
		 					UIkit.notification('新手机号不能为空');
		 					return
		 				}

		 				if( !is_mobile(inputs.mobile) ){
		 					UIkit.notification('手机号格式错误');
		 					return
		 				}
		 				var captchabtn = _ta;

		 				if(captchabtn.hasClass("disabled")){
		 					UIkit.notification('您操作太快了，等等吧')
		 				}else{
		 					UIkit.notification('发送验证码中...')
		 					captchabtn.addClass("disabled");
		 					$.ajax({  
		 						type: 'POST',  
		 						url:  ajax_url,  
								dataType: 'json',
								data: {
									action: 'user.mobile.captcha',
									mobile: inputs.mobile
								},
								success: function(data){  
									if( data.error ){
										if( data.msg ){
											UIkit.notification(data.msg);
											captchabtn.removeClass("disabled");   
										}
										return
									}

									UIkit.notification('验证码已发送至新手机号！')
									var countdown=60; 
									settime();
									function settime() { 
										if (countdown == 0) { 
											captchabtn.removeClass("disabled");   
											captchabtn.text("重新获取验证码");
											countdown = 60; 
											return;
										} else { 
											captchabtn.addClass("disabled");
											captchabtn.text("重新获取(" + countdown + ")"); 
											countdown--; 
										} 
										setTimeout(function() { settime() },1000) 
									}
								}  
							});
		 				}
	 				break;

		 				case 'user.social.cancel':
		 				UIkit.notification('解绑中...')
		 				var type = _ta.data('type');

	 					$.ajax({  

		 					type: 'POST',  

		 					url:  ajax_url,  

		 					dataType: 'json',

		 					data: {

		 						action: 'user.social.cancel',

		 						type: type,

		 					},

		 					success: function(data){  

		 						if( data.error ){

		 							if( data.msg ){

		 								UIkit.notification(data.msg)

		 							}

		 							return

		 						}

		 						UIkit.notification('解绑成功')
		 						location.reload();

		 					}  

		 				});  
		 				

		 			}

		 		})



});

function is_name(str) {    

	return /^[\w]{3,16}$/.test(str) 

}

function is_url(str) {

	return /^((http|https)\:\/\/)([a-z0-9-]{1,}.)?[a-z0-9-]{2,}.([a-z0-9-]{1,}.)?[a-z0-9]{2,}$/.test(str)

}

function is_qq(str) {

	return /^[1-9]\d{4,13}$/.test(str)

}

function is_mail(str) {

	return /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/.test(str)

}

function is_mobile(str){
    return /^[1][3,4,5,7,8,9][0-9]{9}$/.test(str);
}
		