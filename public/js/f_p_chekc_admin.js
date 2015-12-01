
//登录表单验证
(function($) {
	$().ready(function() {
	 $("#f_p_chekc_admin").validate({
	  rules: {
	   f_user_email: "required",
	   checkcode: {
	    required: true,
	   }
	  },
	  messages: {
	   f_user_email: "*请输入用户名",
	   checkcode: {
	    required: "*请输入确认验证码",
	   }
	  }
	    });
	});

})(jQuery);






