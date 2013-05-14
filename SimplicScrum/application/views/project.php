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
				var $before_windowsWidth = ($(window).width());
				
				var $left_p = (($(window).width()) - 1080)/4;
				
					$(".make_product").css({'margin-left':$left_p + 'px'});
					$(".make_sprintbacklog").css({'margin-left':(($left_p)+360) +'px'});
					$(".make_sprint").css({'margin-left':(($left_p*2)+720) +'px'});
					
					$(".product_backlog").css({'margin-left':$left_p + 'px'});
					$(".sprint_backlog").css({'margin-left':(($left_p*2)+360) +'px'});
					$(".sprint").css({'margin-left':(($left_p*3)+720+30) +'px'});
					
					$("#project_background").css({'width' : ((($(window).width())*(7/10)))+'px'});
					$("#project_background").css({'background-position-x' : ((($(window).width())*(7/10))+2)+'px'});
					$("#_close").css({'margin-left':($("#project_background").width()-35)+'px'});
				
				$(window).resize(function(){
					var $left_p = (($(window).width()) - 1080)/4;
					
					$(".make_product").css({'margin-left':$left_p + 'px'});
					$(".make_sprintbacklog").css({'margin-left':(($left_p)+360) +'px'});
					$(".make_sprint").css({'margin-left':(($left_p*2)+720) +'px'});
					
					$(".product_backlog").css({'margin-left':$left_p + 'px'});
					$(".sprint_backlog").css({'margin-left':(($left_p*2)+360) +'px'});
					$(".sprint").css({'margin-left':(($left_p*3)+720+30) +'px'});
					
					if($close_flag == 0){
						$("#project_background").css({'width' : ((($(window).width())*(7/10)))+'px'});
						$("#project_background").css({'background-position-x' : ((($(window).width())*(7/10))+2)+'px'});
					}else if($close_flag == 1){
						$("#project_background").css({'width' : ((($(window).width())*(7/10)))+'px'});
						$("#project_background").css({'background-position-x' : ((($(window).width())*(7/10))+2)+'px'});
					}
					$("#_close").css({'margin-left':($("#project_background").width()-35)+'px'});
				});
				
				
				$( "#list_sortable" ).sortable();
				$( "#list_sortable" ).disableSelection();  
				
				$("#close_btn").click(function()
				{
					if($close_flag == 0){
						$("#project_background").animate({left:(-(($(window).width())*(7/10))+40)+'px'},500);
						$("#project").css({background : 'rgba(56,54,60,0)'});
						$("#close_btn").text("open");
						$("#back_opacity").css({display: 'none'});
						$close_flag = 1;
					}else if($close_flag == 1){
						$("#project_background").animate({left:'0px'},500);
						$("#close_btn").text("close");
						$("#project").css({background : 'rgba(56,54,60,0.5)'});
						$("#back_opacity").css({display: 'block'});
						$close_flag = 0;
					}
				});
				
				//second_top 시작
				$("#top_p_backlog_btn").click(function(){
					$("#second_top").css({'background-color': '#da125c', 'color':'white'});
					$("#top_p_backlog_btn").css({'color':'white'});
					$("#top_s_backlog_btn").css({'color':'black'});
					$("#top_sprint_btn").css({'color':'black'});
				});

				$("#top_s_backlog_btn").click(function(){
					$("#second_top").css({'background-color': '#f9b450', 'color':'#FFFFFF'});
					$("#top_p_backlog_btn").css({'color':'black'});
					$("#top_s_backlog_btn").css({'color':'white'});
					$("#top_sprint_btn").css({'color':'black'});
				});

				$("#top_sprint_btn").click(function(){
					$("#second_top").css({'background-color': '#33b0aa', 'color':'#FFFFFF'});
					$("#top_p_backlog_btn").css({'color':'black'});
					$("#top_s_backlog_btn").css({'color':'black'});
					$("#top_sprint_btn").css({'color':'white'});
				});
				//second_top 끝

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
					events: [
						<?php
							$str = "";
							$cnt = 0;
							foreach($list as $key){
								if($cnt>0)
									$str .=",";
								$sdate1 = date(  "Y-n-j", strtotime( $key["sdate"] ) );
								$edate1 = date(  "Y-n-j", strtotime( $key["sdate"] ) );
								$sdate2 = explode("-",$sdate1);
								$edate2 = explode("-",$edate1);
								$sdate2[1] = strval(intval($sdate2[1])-1);
								$edate2[1] = strval(intval($edate2[1])-1);
								$str .= "{";
								$str .= "title:".$key["title"].",";
								$str .= "start: new Date(".$sdate2[0].",".$sdate2[1].",".$sdate2[2]."),";
								$str .= "end: new Date(".$edate2[0].",".$edate2[1].",".$edate2[2].")";
								$str .= "}";
							}
							echo $str;
						?>
					]
				});

				$(".listDelete").click(function(){
					alert(this.id);
				});
			});
	</script>
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
		<div id = "project_background">	
			<pro>MY PROJECT</pro>
			<p_add_btn><a href ="#" id = "add_btn"><img src ="<?=$img_path?>/project_addBtn.png"></a></p_add_btn>
			<ul id="list_sortable">  
					<?php
						if(count($list)>0){
							foreach($list as $key){
								echo "<li class=\"ui-state-default\"><span style=\"width:90%;\">".$key["title"]."</span><span id=\"list_".$key["id"]."\" style=\"cursor:pointer;margin-right:-10px;\" class='listDelete'><img src=\"".$img_path."/delete.png\"></span></li>";
							}
						}
					?>
			</ul>
			<div id='calendar'></div>
				<close id="_close">
				<a href = "#" id = "close_btn" class ="project_close">close</a>
				</close>
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
		<div class="project_tiltle_bar">ADD PROJECT</div>
		<div class = "input_project">
			<label for = "project_name" class ="label_project">PROJECT NAME</label><input type ="text" id ="project_name" style="width=140px; align=right;"/>
		</div>

<!--
		<div class ="member_block">
			<div class = "input_member">
				<label for = "add_member" class ="label_project">MEMBER</label><input type ="text" id ="member" style="wieth=140px;"/>
				<input type ="button" id="search_btn" value="search">
			</div>
			<div class = "check_email">이메일 검색결과란</div>
			<div class = "member_list">
				<div class="label_projet"><label for = "add_member" class ="label_project">MEMBER LIST</label></div>
				<div class ="list"><input type ="text" id ="member_list" style="wieth=140px;"/></div>
			</div>
		</div>
-->		

		<div style="width:95px; height:25px; margin-left:10px; background-color:#3b3a3f; text-align:left;">
			<label for = "term" class ="label_project">TERM</label>
		</div>

		<div style=" width: 280px; height:25px; margin-left:10px; background-color:#3b3a3f; text-align:left; color:white">
			<label for = "start" class ="project_start">START DATE &nbsp;&nbsp;</label>
			<input type="text" id="project_year" style="width:50px;"/>
			<input type="text" id="project_month" style="width:50px;"/>
			<input type="text" id="project_day" style="width:50px;"/>
		</div>

		<div style=" width: 280px; height:25px; margin-left:10px; background-color:#3b3a3f; text-align:left; color:white">
			<label for = "start" class ="project_end">END DATE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<input type="text" id="project_year" style="width:50px;"/>
			<input type="text" id="project_month" style="width:50px;"/>
			<input type="text" id="project_day" style="width:50px;"/>
		</div>
		
		</br>
		<div id = "submit_cancel">
			<a href ="#" class="submit" id = add_submit>Make</a>
			<a href ="#" class="submit" id = add_cancel>Cancel</a>
		</div>
	</div>
	<!--Creat project start-->
	
 </BODY>
</HTML>
