<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?include("common/header.php");?>
<?php
	if($this->session->userdata("ss_userid")){
		echo "<script>location.href='/~sscrum/SimplicScrum/project/'</script>";
	}
?>
	<script type = "text/javascript">			
	$(document).ready(function()
		{
			var login_flag = 0;
			var result;
			var left_p = ($(window).width()) - 300+'px';
			$("#sign_up").css({left:left_p});
			
			$("#Cancel_btn").hide();
			$(window).resize(function(){
				var left_p = ($(window).width())-300+'px';
				$("#sign_up").css({left:left_p});
			});
			
			$("#login_btn").click(function()
			{
				if(login_flag == 0){
					$("#container_Login").animate({top:'60px'},500);
					$("#container_mid").animate({top:'544px'},500);
					$("#Cancel_btn").show();
					login_flag = 1;
				}
				
				else if(login_flag == 1){
					if(!($.trim($("#login_email").val())) && !($.trim($("#login_pwd").val()))){
						$("#container_Login").animate({top:'-424px'},500);
						$("#container_mid").animate({top:'60px'},500);
						$("#Cancel_btn").hide();
						login_flag = 0;
						}
					/*else if(!($.trim($("#login_email").val())) || !($.trim($("#login_pwd").val()))){
					//둘중 하나가 잘못된 값이면 에러머시지출력
					}*/
					else{//로그인 하면 되겠지
						$.ajax({
					        url: '/~sscrum/SimplicScrum/login/getLogin',
					        type: "POST",
					        async : false,
					        data: {email: $.trim($("#login_email").val()), pw: $.trim($("#login_pwd").val()) },
					        dataType: 'json',
					        success: function (rdata) {
					        	result = rdata.code;
					        }
					    });
					    if(result==100){
					    	location.href="/~sscrum/SimplicScrum/project/";
					    }else{
					    	alert("Confirming Your Email or Password, Please.");
					    }
					}
				}
			});
			
			$("*").keypress(function(e){
				if(login_flag == 1){				
					if(e.keyCode == 13)
					{
						if(!($.trim($("#login_email").val())) && !($.trim($("#login_pwd").val()))){
							$("#container_Login").animate({top:'-424px'},500);
							$("#container_mid").animate({top:'60px'},500);
							$("#Cancel_btn").hide();
							login_flag = 0;
						}
						else{//로그인 하면 되겠지
							$.ajax({
					        url: '/~sscrum/SimplicScrum/login/getLogin',
					        type: "POST",
					        async : false,
					        data: {email: $.trim($("#login_email").val()), pw: $.trim($("#login_pwd").val()) },
					        dataType: 'json',
					        success: function (rdata) {
					        	result = rdata.code;
					        }
						    });
						    if(result==100){
						    	location.href="/~sscrum/SimplicScrum/project/";
						    }else{
						    	alert("Confirming Your Email or Password, Please.");
						    	return false;
						    }
						}
					}
				}
			});
			/*
			$("#login_email").keypress(function(e){
			   if(e.keyCode==13)
			   {
					//함수 실행
			   }
			 });
			$("#login_pwd").keypress(function(e){
			   if(e.keyCode==13)
			   {
					//함수 실행
			   }
			 });
			*/
			$("#Cancel_btn").click(function()
			{
					$("#container_Login").animate({top:'-424px'},500);
					$("#container_mid").animate({top:'60px'},500);
					$("#Cancel_btn").hide();
			});
			
			$("#signup_btn").click(function()
			{
				$("#sign_up").animate({top:'60px'},500);
			});
			
			$("#signup_cancel").click(function()
			{
				$("#sign_up").animate({top:'-300px'},500);
				$("#user_name").val("");
				$("#user_mail").val("");
				$("#user_pwd").val("");
				$("#pwd_confirm").val("");
			});
			$("#signup_submit").click(function()
			{

				email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
	
				if($("#user_pwd").val()!=$("#pwd_confirm").val()){
					alert("password not match");
					$("#pwd_confirm").focus();
					return false;
				}
				if($("#user_name").val()==""){
					alert("input nickname,please");
					$("#user_name").focus();
					return false;
				}

				if(!email_regex.test($("#user_mail").val())){ 
					alert("check your email,please");
					$("#user_mail").focus();
					return false; 
				}

				var user_name = $("#user_name").val();
				var user_mail = $("#user_mail").val();
				var user_pwd = $("#user_pwd").val();
				var pwd_confirm = $("#pwd_confirm").val();
				var result;
				$.ajax({
					        url: '/~sscrum/SimplicScrum/login/signUp/',
					        type: "POST",
					        async : false,
					        data: {email: user_mail, pw: user_pwd, nickname: user_name },
					        dataType: 'json',
					        success: function (rdata) {
					        	result = rdata.code;
					        }
						    });
						    if(result==100){
						    	$("#sign_up").animate({top:'-300px'},500);
						    	
						    	$.pnotify({
								    title: 'SingUp Success',
								    text: 'Please,Try login.',
								    animate_speed: 'fast'
								});

								$("#user_name").val("");
								$("#user_mail").val("");
								$("#user_pwd").val("");
								$("#pwd_confirm").val("");
						    }else{
						    	alert("Error");
						    }

			});
			
		});

		
	</script>
 </HEAD>
 <BODY>
 
 <!--상단메뉴 시작-->
 <div id = "container_top">
	<div id = "top_left">
		<div class="innerdiv">
		<a href = "./">
		<img hspace=30px vspace = 15px src = "<?=$img_path?>/top_logo.png">
		</a>
		</div>
	</div>
	<div id = "top_menu" style=""></div>
	<div id = "top_right">
		<div class="innerdiv">
		<menu_text><a class="top_menu" href = "#" id = "Cancel_btn">Cancel</a></menu_text>
		<menu_text><a class="top_menu" href = "#" id = "signup_btn">SignUp</a></menu_text>
		</div>
	</div>
 </div>
  <!--상단메뉴 끝-->
  
  <!--로그인 메뉴 시작-->
  <div id = "container_Login">
	<div id = "Login_left">
		<div class="innerdiv"></div>
	</div>
		<div id = "Login_menu"> 
			<div class ="Login_input">
				<label for = "login_email" class ="label_login">E - M A I L</label>
				<input type ="text" id ="login_email"/>
			</div>
			<div class ="Login_input">
				<label for = "login_pwd" class ="label_login">PASSWORD</label>
				<input type ="password" id ="login_pwd"/>
			</div>
		</div>
		<div id = "Login_right">
			<div class="innerdiv"></div>
		</div>
 </div>
 <!--로그인 메뉴 끝-->
  
  <!-- SignUp start -->
<div id = "sign_up" style="">
<div class = "input_signup"><label for = "user_name" class ="label_signup">NICKNAME</label><input type ="text" id ="user_name"/></div>
<div class = "input_signup"><label for = "user_mail" class ="label_signup">E-MAIL</label><input type ="text" id ="user_mail"/></div>
<div class = "input_signup"><label for = "user_pwd" class ="label_signup">PASSWORD</label><input type ="password" id ="user_pwd"/></div>
<div class = "input_signup"><label for = "pwd_confirm" class ="label_signup">CONFIRM.PWD</label><input type ="password" id ="pwd_confirm"/></div>
<div id = "submit_cancel">
<a href ="#" class="submit" id = "signup_submit">submit</a>
<a href ="#" class="submit" id = "signup_cancel">cancel</a>
</div>
</div>
  <!-- SignUp finish-->
  
  
  <!--Center_menu_start-->
<div id = "container_mid">
	<div id = "mid_left">
		<div class="innerdiv"></div>
	</div>
	<div id = "mid_menu" style="">
	<Login><a class="login" href = "#" id = login_btn>Log In</a></Login>
	</div>
	<div id = "mid_right">
		<div class="innerdiv"></div>
	</div>
 </div>
   <!--Center_menu_finish-->
 </BODY>
</HTML>
