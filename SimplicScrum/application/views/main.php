<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?include_once("common/header.php");?>
	<script type = "text/javascript">			
		
	$(document).ready(function()
		{
			var login_flag = 0;
			
			var left_p = ($(window).width()) - 300+'px';
			$("#sign_up").css({left:left_p});
			
			$(window).resize(function(){
				var left_p = ($(window).width())-300+'px';
				$("#sign_up").css({left:left_p});
			});
			
			$("#login_btn").click(function()
			{
				if(login_flag == 0){
					$("#container_Login").animate({top:'60px'},500);
					$("#container_mid").animate({top:'544px'},500);
					login_flag = 1;
				}
				
				else if(login_flag == 1){
					if(!($.trim($("#login_email").val())) && !($.trim($("#login_pwd").val()))){
						$("#container_Login").animate({top:'-424px'},500);
						$("#container_mid").animate({top:'60px'},500);
						login_flag = 0;
						}
					else if(!($.trim($("#login_email").val())) || !($.trim($("#login_pwd").val()))){
					//둘중 하나가 잘못된 값이면 에러 msg출력
					}
					else{//모두 값이 들어왔을 때
					//정상적으로 입력됬으면 로그인
					}
				}
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
		});

	</script>
 </HEAD>
 <BODY>
 
 <!--상단 메뉴 시작-->
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
		<menu_text><a class="top_menu" href = "">Log-In</a></menu_text>
		<menu_text><a class="top_menu" href = "#" id = signup_btn>SignUp</a></menu_text>
		</div>
	</div>
 </div>
  <!--상단 메뉴 끝-->
  
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
  
  <!-- 회원가입 -->
<div id = "sign_up" style="">
<div class = "input_signup"><label for = "user_name" class ="label_signup">NAME</label><input type ="text" id ="user_name"/></div>
<div class = "input_signup"><label for = "user_mail" class ="label_signup">E-MAIL</label><input type ="text" id ="user_mail"/></div>
<div class = "input_signup"><label for = "user_pwd" class ="label_signup">PASSWORD</label><input type ="password" id ="user_pwd"/></div>
<div class = "input_signup"><label for = "pwd_confirm" class ="label_signup">CONFIRM.PWD</label><input type ="password" id ="pwd_confirm"/></div>
<div id = "submit_cancel">
<a href ="#" class="submit" id = signup_submit>submit</a>
<a href ="#" class="submit" id = signup_cancel>cancel</a>
</div>
</div>
  <!-- 회원가입 끝-->
  
  
  <!--중앙 메뉴 시작-->
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
   <!--중앙 메뉴 끝-->
 </BODY>
</HTML>
