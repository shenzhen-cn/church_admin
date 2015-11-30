	function getLength (str) {
		return str.replace(/[^\x00-xff]/g,"xx").length;	
	}

	function findStr(str,n){
		var temp = 0;
		for (var i = 0; i < str.length; i++) {
			if (str.charAt(i) == n ) {
				temp++;
			}
		}

		return temp;
	}

	var ainput   = document.getElementsByTagName('input');
	var Nick     = ainput[1];
	var pwd1     = ainput[2];
	var pwd2     = ainput[3];
	var aP       = document.getElementsByTagName('p');
	var name_msg = aP[1];
	var pwd1_msg = aP[2];
	var pwd2_msg = aP[3];
	var count    = document.getElementById('count');
	var aEm      = document.getElementsByTagName('em');


	var name_length = 0;
    Nick.value = "";
    

	var m = findStr(pwd1.value,pwd1.value[0]);
	var re_n = /[^\d]/g;//not numbers
	var re_t = /[^\a-zA-Z]/g;//not letters
	var re = /[^\w\u4e00-\u9fa5]/g;

 	var str1 = "<i class='ati'></i>昵称：请输入4-20个字符，一个汉字为两个字符，推荐不使用自己的真是姓名";
 	var str2 = "<i class='err'></i>× 含有非法字符!";
 	var str3 = "<i class='err'></i>× 昵称不能为空!";
 	var str4 = "<i class='err'></i>× 昵称长度不能大于20个字符!<br>";
 	var str5 = "<i class='err'></i>× 昵称长度不能小于4个字符!<br>";
 	var str6 = "<i class='ati'></i>密码：请输入6-16个字符，请使用字母加数字或符号组成的密码，不能单独使用字母、数字、符号或相同数值！";
 	var str7 = "<i class='err'></i>× 密码不能为空";
 	var str8 = "<i class='err'></i>× 密码不能为相同数值";
 	var str9 = "<i class='err'></i>× 密码为6-16位";
 	var str10 = "<i class='err'></i>× 密码不能都为数字";
 	var str11 = "<i class='err'></i>× 密码不能都为字母";
 	var str12 = "<i class='err'></i>× 两次输入的密码不一致";

 	var strOK = "<i class='ok'></i> √ OK!";

	window.onload =	function() {		

		Nick.onfocus = function () {
			name_msg.style.display = "block";
			//4-20个字符，一个汉字为两个字符，推荐不使用自己的真是姓名
			if (this.value == '') {
				name_msg.innerHTML = str1;	
			}	
		}

		  Nick.onkeyup = function () {

		 	count.style.visibility = "visible";
		 	name_length = getLength(this.value);
		 	count.innerHTML = "已输入" +name_length + "个字符";
		 	//4-20个字符，一个汉字为两个字符，推荐不使用自己的真是姓名
		 	if (name_length == 0) {
		 		count.style.visibility = "hidden";
			 	name_msg.innerHTML = str1;	

		 	}else{
		 		count.style.visibility = "none";
		 		
		 	}
		 }

		  Nick.onblur = function () {
		 	var re = /[^\w\u4e00-\u9fa5]/g;
		 	//含有非法字符
		 	if (re.test(this.value)) {
		 		name_msg.innerHTML = str2;
		 		count.style.visibility = "hidden";
		 	}

		 	//昵称不能为空
		 	else if (name_length == '') {
		 		name_msg.innerHTML = str3;
		 		count.style.visibility = "hidden";
		 	}

		 	//昵称长度不能大于20个字符
		 	else if (name_length >20) {
		 		name_msg.innerHTML = str4;
		 		count.style.visibility = "hidden";

		 	}
		 	//"昵称长度不能小于4个字符!"
		 	else if (name_length < 4) {
		 		name_msg.innerHTML = str5;
		 		count.style.visibility = "hidden";

		 	}
		 	else{
		 		name_msg.innerHTML = strOK;
		 		count.style.visibility = "hidden";

		 	}

		 }

		//pwd1 	
		  //6-16个字符，请使用字母加数字或符号组成的密码，不能单独使用字母、数字、或相同数值！*
		  pwd1.onfocus = function () {
		  	pwd1_msg.style.display = "block";	
		  	pwd1_msg.innerHTML = str6;		
		  }

		   pwd1.onkeyup = function () {
		   	if (this.value.length > 5) {
		   		aEm[1].className = "active";
		   		pwd2.removeAttribute("disabled");
		   		pwd2_msg.style.display = "block";
		   	}else {
		   		aEm[1].className = "";
		   		pwd2.setAttribute("disabled" ,"");
		   		pwd2_msg.style.display = "none";
		   	}

		  	if (this.value.length > 10) {
		   		aEm[2].className = "active";
		   	}else {
		   		aEm[2].className = "";
		   	}
		  	
		  }

		   pwd1.onblur = function () {
		   	var m = findStr(pwd1.value,pwd1.value[0]);
		   	var re_n = /[^\d]/g;
		   	var re_t = /[^\a-zA-Z]/g;
		   	// var re_s = /[^`~!@#$%^&*()_+<>?:"{},.\/;'[\]]/g;

		   	// 密码不能为空
		  	if (this.value == "") {
		  		pwd1_msg.innerHTML = str7;
		  	}

		  	//密码为6-12位	
		  	else if (this.value.length < 6 || this.value.length > 16) {
		  		pwd1_msg.innerHTML = str9;
		  	}

		  	// × 密码不能为相同数值
		  	else if (m == this.value.length) {
		  		pwd1_msg.innerHTML = str8;
		  	}

		  	//密码不能都为数字	
		  	else if (!re_n.test(this.value)) {
		  		pwd1_msg.innerHTML = str10;

		  	}
		  	// 密码不能都为字母
		  	else if (!re_t.test(this.value)) {
		  		pwd1_msg.innerHTML = str11;

		  	}
		  	else {
		  		pwd1_msg.innerHTML = strOK;

		  	}

		  }

		//pwd2
			// 两次输入的密码不一致
		   pwd2.onblur = function () {
		  	if (this.value != pwd1.value) {
				pwd2_msg.innerHTML = str12;	  		
		  	}else{
		  		pwd2_msg.innerHTML = strOK;
		  	}

		  }

	}

	function checkRegister () {

		var tempp = 1;
		var isCheNick = checkNick();
		var isChePwd1 = checkPwd1();
		var isChePwd2 = checkPwd2();

		// alert(isChePwd1);
		if(!isCheNick && tempp){
			Nick.focus();
			tempp = 0;
		}else {
			pwd1.focus();
		}

		if (!isChePwd1 && tempp) {
			pwd1.focus();
			tempp = 0;
		}else {
			pwd2.focus();
		}

		if (!isChePwd2 && tempp) {
			pwd2.focus();
			tempp = 0;
		}

		// alert("tempp=" + tempp);

		if (isCheNick && isChePwd1 && isChePwd2 && tempp ) {
			return true;
		}	
	}

	//nick
	function checkNick () {
			// alert(name_length);
		// if(name_length== "") {
		// 	return false;
		// }
		// else if (name_length > 20) {
		// 	return false;
		// }
		// else if ( name_length < 4) {
		// 	return false;
		// }
		// else if(re.test(Nick.value)) {
		// 	return false;
		// }else{
		// 	return true;	
		// }
		return true;
			
	}

	//pwd1
	function checkPwd1 () {

		if(pwd1.value == "") {
			// alert("value= " + pwd1.value);
			return false;
		}
		
		//6-16之间
		else if(pwd1.value.length < 6 || pwd1.value.length > 16) {
			return false;
		}
		//判断字符是否相同
		else if (m == pwd1.value) {
			// alert("value= " + pwd1.value);
			return false;
		}
		//不能全部为数字
		else if(!re_n.test(pwd1.value)) {
			return false;
		}
		//不能全部为字母
		else if (!re_t.test(pwd1.value)) {
			return false;
		}
		else{
			return true;
		}
	}

	//pwd2
	function checkPwd2 () {
		if(pwd2.value!= pwd1.value){
			pwd2.value = "";
			return false;
		}else {
			return true;
		}
	}

