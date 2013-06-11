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

		
	 $(".nlClass_sprint").click(function()
	 {
		 if($(this).hasClass("extText_sprint")){
			 $(this).switchClass("extText_sprint","nlClass_sprint");
			 $(this).html("<div style = 'font-weight:bold; font-size:10'></div>")
		 }else{
			 $(this).switchClass("nlClass_sprint","extText_sprint");
			 $(this).html("<div style='background-image:URL('/~sscrum/SimplicScrum/image/sprint_bar.png'); font-size:14px; padding-left:20px; padding-top:20px';><div><div style='font-weight:bold; margin-top:15px; display:inline;'>WHO</div><div style='display:inline; left-margin:10px; dorder-bottom:1px solid'>Admin</div></div><div><div style='display:inline; padding:7px;' >AUTHOR</div><div style='display:inline'>author_admin</div></div><div><div display='inline'>DUE DATE</div><div style='display:inline; border-bottom:1px solid'>2013-02-01</div></div><div><div style='display:inline'>TARGET DATE</div><div style='display:inline; border-bottom:1px solid;'>2013-08-08</div></div><div>DISCRIPTION</div></div>");
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
	<div id = "content" style="overflow-y:auto">
		<div id="sprint_todo" class="sprint">
			<div class="ineer_product"><img src="<?=$img_path?>/sprint_detail_btn.png"></div>
			<div class="sprint_content">TO DO</div>
			<div id="id_sprint_todo_list">
			<ul class = "items">	
				<li class = "nlClass_sprint"></li>
				<li class = "nlClass_sprint"></li>
				<li class = "nlClass_sprint"></li>
				<li class = "nlClass_sprint"></li>
				<li class = "nlClass_sprint"></li>
				<li class = "nlClass_sprint"></li>
				<li class = "nlClass_sprint"></li>
				<li class = "bottom" style = "visibility : hidden"></li>
			</ul>
			</div>
		</div>

		<div id="sprint_doing" class="sprint">
			<div class="ineer_product" style='margin-top:30px;'></div>
			<div class="sprint_content">DOING</div>
			<div id="id_sprint_doing_list">
				<ul class = "items">
					<li class = "nlClass_sprint"></li>
					<li class = "nlClass_sprint"></li>
					<li class = "nlClass_sprint"></li>
					<li class = "nlClass_sprint"></li>
					<li class = "bottom" style = "visibility : hidden"></li>
				</ul>
			</div>
		</div>
		
		<div id="sprint_done" class="sprint">
			<div class="ineer_product" style='margin-top:30px;'></div>
			<div class="sprint_content">DONE</div>
			<div id="id_sprint_done_list">
				<ul class = "items">
					<li class = "nlClass_sprint"></li>
					<li class = "nlClass_sprint"></li>
					<li class = "nlClass_sprint"></li>
					<li class = "bottom" style = "visibility : hidden"></li>
				</ul>
			</div>
		</div>
	</div>

	<!--content end-->
	
 </BODY>
</html>
