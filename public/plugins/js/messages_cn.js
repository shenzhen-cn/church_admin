(function($) {

	jQuery.validator.addMethod("regex",function(value, element, params) {  
	    var exp = new RegExp(params); 
	    return exp.test(value); 

	  },  "格式错误"); 


	$().ready(function() {
		$("#checkform").validate({
			rules: {
				currentPwd: {
					required:true,
					remote: {
					    url: "resetpassword/checkCurrentadminPwd",     //后台处理程序
					    type: "post",               //数据发送方式
					    dataType: "json",           //接受数据格式   
					    data: {                     //要传递的数据
					    	currentPwd: function() {
					    		return $("#currentPwd").val();
					    	}
					    }
					}
				},
				newPwd: {
					required: true,
					minlength: 6,
					maxlength:16,
					regex:"^(?![0-9]+$)(?![a-zA-Z]+$)[^\w\u4e00-\u9fa5]{6,16}$"
				},
				confirmNewPwd: {
					required: true,
					minlength: 6,
					maxlength:16,
					equalTo: "#newPwd"
				}
			},
			messages: {
				currentPwd: {
					required:"× 请输入您当前登录密码！",
					remote:"x 请输入您当前登录的密码！"
				},
				newPwd: {
					required: "× 新密码不能为空！",
					minlength: ("× 密码不能小于{0}个字 符"),
					maxlength: ("× 密码长度最多是 {0} 的字符"),
					regex: "× 请输入6-16个字符，请使用字母加数字或符号组成的密码，不能单独使用字母、数字、符号或相同数值！"
				},
				confirmNewPwd: {
					required: "× 请输入确认密码",
					minlength: "× 确认密码不能小于5个字符",
					maxlength: ("× 密码长度最多是 {0} 的字符"),
					equalTo: "× 两次输入密码不一致不一致"
				}
			},

			submitHandler:function(form){

				form.submit();
			}  
		});
	});
	

})(jQuery);

 




