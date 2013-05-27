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
		  $("#sprint_done").css({'margin-left':(($left_p*3)+720) +'px'});
		  });

		  $('.nlClass').draggable({
//		connectToSortable: "#id_sprint_todo_list",
//		axis: 'x',
		stack: ".nlClass",
		cursor: "move",
		opacity: 0.7,
//		grid: [50,20]
	  });

	  

/*	  //When drag start,
	 $(".nlClass").bind("dragstart",function(event, ui){

	 });
*/
	 
	//When drag stop,
	 $(".nlClass").bind("dragstop", function(){
		 var list_position= $(this).position().left + $left_p + 37;

		 if((list_position > $left_p) && (list_position < $left_p+360)){
			 $(this).css({'left': '0px'});

		 }
		 else if((list_position > ($left_p*2)+360) && (list_position < ($left_p*2)+720)){
			 $(this).css({'left': ($left_p+360)+'px'});

		 }
		 else if((list_position > ($left_p*3)+720) && (list_position < ($left_p*3)+1080)){
			 $(this).css({'left': ($left_p*2+720)+'px'});

		 }
		 else{
			 alert("NO!!!!!!!");
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
			<div class="ineer_product"><img src="<?=$img_path?>/sprint_detail_btn.png"></div>
			<div class="sprint_content">TO DO</div>
			<div id="id_sprint_todo_list">
				<div id = "pList1" class = "nlClass"></div>
				<div id = "pList2" class = "nlClass"></div>
				<div id = "pList3" class = "nlClass"></div>
			</div>
		</div>

		<div id="sprint_doing" class="sprint">
			<div class="ineer_product" style='margin-top:30px;'></div>
			<div class="sprint_content">DOING</div>
			<div id="id_sprint_doing_list"></div>
		</div>
		
		<div id="sprint_done" class="sprint">
			<div class="ineer_product" style='margin-top:30px;'></div>
			<div class="sprint_content">DONE</div>
			<div id="id_sprint_done_list"></div>
		</div>
	</div>

	<!--content end-->
	
 </BODY>
</html>
