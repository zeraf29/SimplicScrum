<?include("common/header.php");?>
  <link href='<?=$css_path?>/fullcalendar.css' rel='stylesheet' />
  <link href='<?=$css_path?>/fullcalendar.print.css' rel='stylesheet' media='print' />
  <link rel='stylesheet' href='<?=$css_path?>/cupertino/theme.css' />
  <script src='<?=$js_path?>/fullcalendar.min.js'></script>
<script type = "text/javascript">	
  $(document).ready(function(){
	  var $left_p = (($(window).width()) - 1080)/4;

	  $("#sprint_todo").css({'margin-left':$left_p + 'px'});
	  $("#sprint_doing").css({'margin-left':(($left_p*2)+360) +'px'});
	  $("#sprint_done").css({'margin-left':(($left_p*3)+720) +'px'});
	  $("#sprint_todo").css({'margin-left':$left_p + 'px'});
	  $("#sprint_doing").css({'margin-left':(($left_p*2)+360) +'px'});
	  $("#sprint_done").css({'margin-left':(($left_p*3)+720) +'px'});

	  $(window).resize(function(){
		  
		  $("#sprint_todo").css({'margin-left':$left_p + 'px'});
		  $("#sprint_doing").css({'margin-left':(($left_p*2)+360) +'px'});
		  $("#sprint_done").css({'margin-left':(($left_p*3)+720) +'px'});
		  $("#sprint_todo").css({'margin-left':$left_p + 'px'});
		  $("#sprint_doing").css({'margin-left':(($left_p*2)+360) +'px'});
		  $("#sprint_done").css({'margin-left':(($left_p*3)+720) +'px/'});
	});

        $("#content .items").sortable({
                connectWith: "ul"  
        });

		
	 $(".nlClass").click(function()
	 {
		 if($(this).hasClass("extText")){
			 $(this).switchClass("extText","nlClass");
			 $(this).html("<div style = 'font-weight:bold; font-size:10'></div>")
		 }else{
			 $(this).switchClass("nlClass","extText");
			 $(this).html("<div style = 'font-weight:bold; font-size:10'>WHO</div><div style = 'font-weight:bold; font-size:10'>AUTHOR</div><div style = 'font-weight:bold; font-size:10'>DUE DATE</div><div style = 'font-weight:bold; font-size:10'>TARGET DATE</div><div style><div style = 'font-weight:bold; font-size:10 margin-top:15px'>discription</div><div><a href = '#'>vote</a> <a href = '#'>modify</div>");
		 }
	 });

  });
  </script>

 </head>

  <BODY>
	<!--Top Menu start-->
	<div id = "top" >
		<div class = "left_innerdiv"><img hspace=30px vspace = 15px src = "<?=$img_path?>/top_logo.png"></div>
		<div class = "right_innerdiv"><a href = "#" id = "info"> 000 </a>welcome  LogOut</div>
	</div>

	<div id = "second_top_sprint">
		<div class="sprint">SPRINT</div>
	</div>
	<!--Top Menu end -->
  
	<!--content start-->
	<div id = "content">
		<div id="sprint_todo" class="sprint">
			<div class="ineer_product"><img src="./image/sprint_detail_btn.png"></div>
			<div class="sprint_content">TO DO</div>
			<div id="id_sprint_todo_list">
			<ul class = "items">	
				<li class = "nlClass"></li>
				<li class = "nlClass"></li>
				<li class = "nlClass"></li>
				<li class = "nlClass"></li>
				<li class = "bottom" style = "visibility : hidden"></li>
			</ul>
			</div>
		</div>

		<div id="sprint_doing" class="sprint">
			<div class="ineer_product" style='margin-top:30px;'></div>
			<div class="sprint_content">DOING</div>
			<div id="id_sprint_doing_list">
				<ul class = "items">
					<li class = "nlClass"></li>
					<li class = "nlClass"></li>
					<li class = "nlClass"></li>
					<li class = "bottom" style = "visibility : hidden"></li>
				</ul>
			</div>
		</div>
		
		<div id="sprint_done" class="sprint">
			<div class="ineer_product" style='margin-top:30px;'></div>
			<div class="sprint_content">DONE</div>
			<div id="id_sprint_done_list">
				<ul class = "items">
					<li class = "nlClass"></li>
					<li class = "nlClass"></li>
					<li class = "nlClass"></li>
					<li class = "bottom" style = "visibility : hidden"></li>
				</ul>
			</div>
		</div>
	</div>

	<!--content end-->
	
 </BODY>
</html>
