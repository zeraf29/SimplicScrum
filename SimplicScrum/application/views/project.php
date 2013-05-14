<?include("common/header.php");?>
  <link href='<?=$css_path?>/fullcalendar.css' rel='stylesheet' />
  <link href='<?=$css_path?>/fullcalendar.print.css' rel='stylesheet' media='print' /> 
  <script src='<?=$js_path?>/fullcalendar.min.js'></script>
  
	<script type = "text/javascript">	
		$(document).ready(function()
			{

				$.pnotify({
								    title: 'Hi, <?=$this->session->userdata("ss_nickname")?>',
								    text: 'Welcome to SimplicScrum',
								    animate_speed: 'fast'
								});

				var $close_flag = 0;
				var $dialog_flag = 1; //1,2, 3, 4, 5....etc
				
				var $left_p = (($(window).width()) - 1080)/4;
				
					$(".make_product").css({'margin-left':$left_p + 'px'});
					$(".make_sprintbacklog").css({'margin-left':(($left_p)+360) +'px'});
					$(".make_sprint").css({'margin-left':(($left_p*2)+720) +'px'});
					
					$(".product_backlog").css({'margin-left':$left_p + 'px'});
					$(".sprint_backlog").css({'margin-left':(($left_p*2)+360) +'px'});
					$(".sprint").css({'margin-left':(($left_p*3)+720+30) +'px'});
				
				$(window).resize(function(){
				//	var top_p = ($(window).height()) -670+'px';
					var $left_p = (($(window).width()) - 1080)/4;
					
					//$("#make_project").css({top:top_p});
					
					$(".make_product").css({'margin-left':$left_p + 'px'});
					$(".make_sprintbacklog").css({'margin-left':(($left_p)+360) +'px'});
					$(".make_sprint").css({'margin-left':(($left_p*2)+720) +'px'});
					
					$(".product_backlog").css({'margin-left':$left_p + 'px'});
					$(".sprint_backlog").css({'margin-left':(($left_p*2)+360) +'px'});
					$(".sprint").css({'margin-left':(($left_p*3)+720+30) +'px'});
				});
				
				
				$( "#list_sortable" ).sortable();
				$( "#list_sortable" ).disableSelection();  
				
				$("#close_btn").click(function()
				{
					if($close_flag == 0){
						$("#project_list").animate({left:'-377px'},500);
						$("#project").css({background : 'rgba(56,54,60,0)'});
						$("#close_btn").text("open");
						$("#back_opacity").css({display: 'none'});
						$close_flag = 1;
					}else if($close_flag == 1){
						$("#project_list").animate({left:'0px'},500);
						$("#close_btn").text("close");
						$("#project").css({background : 'rgba(56,54,60,0.5)'});
						$("#back_opacity").css({display: 'block'});
						$close_flag = 0;
					}
				});

				$("#add_btn").click(function(){
					$("#make_project").animate({left: '400px', display: 'show'},500);
				});

				$("#add_cancel").click(function(){
					$("#make_project").animate({left:'-500px'},300);
				});

				if($dialog_flag == 0){ // 1,2,3,4...etc
					$( "#dialog-modal" ).dialog({ height: 140,  modal: false});
				}else{$( "#dialog-modal" ).hide();}
				
				$("#user_info").hide();
				$("#info").click(function(){
					$("#user_info").append("<p>Nickname</p>&nbsp;<?=$this->session->userdata('ss_nickname')?>");
					$("#user_info").append("<p>Email</p>&nbsp;<?=$this->session->userdata('ss_useremail')?>");
					$("#user_info").dialog({ height: 300,  modal: false});
				});
				
				var calendar = $('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek'
					},
					selectable: true,
					selectaHelper: true,
					select: function(title, start, end, clolor) {
						title = prompt();
						start = prompt();
						end = prompt();
						color = prompt();
						calendar.fullCalendar('renderEvent',
							{
								title: title,
								start: start,
								end: end,
								color: color
							},
							true // make the event "stick"
						);
					calendar.fullCalendar('unselect');
					},
					editable: false,
			//		events: [

			//		]
				});

				$(".listDelete").click(function(){
					alert(this.id);
				});
			});
	</script>
	
  <link rel="stylesheet" type="text/css" href="SimplicScrum.css">
 </HEAD>
 <BODY>
	<!--Top Menu Start-->
	<div id = "top" >
		<div class = "left_innerdiv"><img hspace=30px vspace = 15px src = "<?=$img_path?>/top_logo.png"></div>
		<div class = "right_innerdiv"><a href = "#" id = "info"> [EDIT] </a>Welcome to SSCRUM!  <a href="<?=$main_path?>/login/getLogout">LogOut</a></div>
		
		<div id = "user_info" title = "user_information">
		
		</div>
		<!--dialog-->
		<div id = "dialog-modal" title = "Basic modal dialog">
			<p>shit</p>
		</div>
	</div>

	<div id = "second_top">
		<div class="product_backlog"><a href="#" class = "p_backlog" id="product_btn">PRODUCT BACKLOG</a></div>
		<div class="sprint_backlog"><a href="#" class = "s_backlog">SPRINT BACKLOG</a></div>
		<div class="sprint"><a href="#" class = "s_backlog">SPRINT</a></div>
	</div>
	<!--Top Menu finish-->

	
	<!--left Project Menu start-->
	<div id = "project">
		<div id = "project_list">	
			<div class ="innerdiv_left">
			<!--getList-->
			<pro>MY PROJECT</pro>
			<p_add_btn><a href ="#" id = "add_btn"><img src ="<?=$img_path?>/project_addBtn.png"></a></p_add_btn>
			<ul id="list_sortable">  
					<?php
						foreach($list as $key){
							echo "<li class=\"ui-state-default\"><span style=\"width:90%;\">".$key["title"]."</span><span id=\"list_".$key["id"]."\" style=\"cursor:pointer;margin-right:-10px;\" class='listDelete'><img src=\"".$img_path."/delete.png\"></span></li>";
						}
					?>
			</ul>
			</div>
			<div id='calendar'></div>
			<div class ="innerdiv_top">
				<close>
				<a href = "#" id = "close_btn" class ="project_close">close</a>
				</close>
			</div>
		</div>
	</div>
	<!--left Project Menu finish-->
  
  <!--Opacity control-->
  <div id="back_opacity"></div> 
  
	<!--content start-->
	<div id = "content">
		<div class="make_product">
			<div class="ineer_product"><img src="<?=$img_path?>/product_btn.png">
		</div>
		
		<div class="make_sprintbacklog">sprint backlog</div>
		
		<div class="make_sprint">
			<div class="ineer_product"><img src="<?=$img_path?>/sprint_btn.png">
		</div>
	</div>
	</div>
	<!--content finish-->

	  
	<!--Creat project start-->
	<div id = "make_project" style="">
		<div class = "input_project">
			<label for = "project_name" class ="label_project">PROJECT NAME</label><input type ="text" id ="project_name" style="wieth=140px;"/>
		</div>
		<div class = "input_project">
			<label for = "add_member" class ="label_project">MEMBER</label><input type ="text" id ="member" style="wieth=140px; align=right;"/>
		</div>
		<div style="width:95px; height:25px; margin-left:10px; background-color:#3b3a3f; text-align:right;"><label for = "term" class ="label_project">TERM</label></div>
		<div class = "input_project">
			<label for = "product_backlog" class ="label_project">PRODUCT BACKLOG</label>
			<select name="product_backlog" style="width:120px;"/>	
				<option value="1">1day</option>
				<option value="2">2days</option>
			</select>

		</div>
		<div class = "input_project">
			<label for = "sprint_backlog" class ="label_project">SPRINT BACKLOG</label>
			<select name="sprint_backlog" style="width:120px;"/>	
				<option value="1">1day</option>
				<option value="2">2days</option>
			</select>
		</div>
		<div class = "input_project">
			<label for = "sprint" class ="label_project">SPRINT</label>
			<select name="sprint" style="width:120px;"/>	
				<option value="1">1day</option>
				<option value="2">2days</option>
			</select>
		</div>
		<div id = "submit_cancel">
		<a href ="#" class="submit" id = add_submit>make</a>
		<a href ="#" class="submit" id = add_cancel>cancel</a>
		</div>
	</div>
	<!--Creat project start-->
	
 </BODY>
</HTML>
