<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title> Simplic Scrume </title>
  <meta Cahrset="utf-8">
  <link rel="stylesheet" href="style.css" />

  <script type = "text/javascript">
	$(document).ready(function()
	{
		var $left_p = (($(window).width()) - 1080)/4;

		$(".make_product").css({'margin-left':$left_p + 'px'});
		$(".make_sprintbacklog").css({'margin-left':(($left_p*2)+360) +'px'});
		$(".make_sprint").css({'margin-left':(($left_p*3)+720) +'px'});
					
		$(".product_backlog").css({'margin-left':$left_p + 'px'});
		$(".sprint_backlog").css({'margin-left':(($left_p*2)+360) +'px'});
		$(".sprint").css({'margin-left':(($left_p*3)+720+30) +'px'});

		$(window).resize(function(){

		var $left_p = (($(window).width()) - 1080)/4;	

		$(".make_product").css({'margin-left':$left_p + 'px'});
		$(".make_sprintbacklog").css({'margin-left':(($left_p)+360) +'px'});
		$(".make_sprint").css({'margin-left':(($left_p*2)+720) +'px'});
					
		$(".product_backlog").css({'margin-left':$left_p + 'px'});
		$(".sprint_backlog").css({'margin-left':(($left_p*2)+360) +'px'});
		$(".sprint").css({'margin-left':(($left_p*3)+720+30) +'px'});
		});
	});

  </script>

 </head>

 <body>
 <!--��� �޴� ����-->
	<div id = "top" >
		<div class = "left_innerdiv"><img hspace=30px vspace = 15px src = "<?=$img_path?>/top_logo.png"></div>
		<div class = "right_innerdiv"><a href = "#" id = "info"> [EDIT] </a>Welcome to SSCRUM!  <a href="<?=$main_path?>/login/getLogout">LogOut</a></div>
		
	</div>

	<div id = "second_top">
		<div class="product_backlog">SPRINT</div>
	</div>
	<!--��� �޴� ��-->
  
	<!--content ����-->
	<div id = "content">
		<div class="make_product">
			<div class="ineer_product">
				<img src="./image/productb_btn.png">
			</div>
			<div class="ineer_product_btn">
				<a href="#" id="pbacklog_add_btn"><img src="<?=$img_path?>/p_backlog_add.png"></a>
				<img src="<?=$img_path?>/p_backlog.png">
			</div>
			<div id="id_productBacklog_list">
			</div>
		</div>

		<div class="make_sprintbacklog">
			<div class="inner_sprintbacklog">
			</div>
		</div>
		
		<div class="make_sprint">
			<div class="ineer_product">
			</div>
		</div>
	</div>

	<!--content ��-->

	</div>
  
 </body>
</html>
