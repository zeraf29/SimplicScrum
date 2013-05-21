<?include("common/header.php");?>
  <link href='<?=$css_path?>/fullcalendar.css' rel='stylesheet' />
  <link href='<?=$css_path?>/fullcalendar.print.css' rel='stylesheet' media='print' /> 
  <script src='<?=$js_path?>/fullcalendar.min.js'></script>
<?php
	$type = isset($_GET["type"])?$_GET["type"]:"";
	if($type=='delete'){
		$title = 'Delete Complete';
		$text = 'Confirm you Project';
	}else{
		$title = 'Hi, '.$this->session->userdata("ss_nickname");
		$text = 'Welcome to SimplicScrum';
	}
?>
	<script type = "text/javascript">	
		$(document).ready(function()
			{


				$.pnotify({
								    title: '<?=$title?>',
								    text: '<?=$text?>',
								    animate_speed: 'fast'
								});

				var $close_flag = 0;
				var $dialog_flag = 1; //1,2, 3, 4, 5....etc
				var $before_windowsWidth = ($(window).width());
				
				var $left_p = (($(window).width()) - 1080)/4;
				
				//---------추가-----------------------------------------------------------------------------------------
				var clareCalendar = {
					monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
					dayNamesMin: ['일','월','화','수','목','금','토'],
					weekHeader: 'Wk',
					dateFormat: 'yymmdd', //형식(20120303)
					autoSize: false, //오토리사이즈(body등 상위태그의 설정에 따른다)
					changeMonth: true, //월변경가능
					changeYear: true, //년변경가능
					showMonthAfterYear: true, //년 뒤에 월 표시
					buttonImageOnly: true, //이미지표시
					buttonText: '달력선택', //버튼 텍스트 표시
					buttonImage: 'image/datepicker.png', //이미지주소
					showOn: "both", //엘리먼트와 이미지 동시 사용(both,button)
					yearRange: '1990:2020' //1990년부터 2020년까지
					};

					//---------추가 끝------------------------------------------------------------------------------------
				$(".make_product").css({'margin-left':$left_p + 'px'});
				$(".make_sprintbacklog").css({'margin-left':(($left_p*2)+360) +'px'});
				$(".make_sprint").css({'margin-left':(($left_p*3)+720) +'px'});
					
					
				$(".product_backlog").css({'margin-left':$left_p + 'px'});
				$(".sprint_backlog").css({'margin-left':(($left_p*2)+360) +'px'});
				$(".sprint").css({'margin-left':(($left_p*3)+720+30) +'px'});
					/*backlog 위치 조정을 위한 Script*/
					
				$("#project_background").css({'width' : ((($(window).width())*(7/10)))+'px'});
				$("#project_background").css({'background-position-x' : ((($(window).width())*(7/10))+2)+'px'});
					/*프로젝트 현황 메뉴 위치 설정*/
				$("#_close").css({'margin-left':($("#project_background").width()-35)+'px'});
					/*close 버튼 위치 설정*/
				
				$(window).resize(function(){
					var $left_p = (($(window).width()) - 1080)/4;
					
					$(".make_product").css({'margin-left':$left_p + 'px'});
					$(".make_sprintbacklog").css({'margin-left':(($left_p)+360) +'px'});
					$(".make_sprint").css({'margin-left':(($left_p*2)+720) +'px'});
					
					$(".product_backlog").css({'margin-left':$left_p + 'px'});
					$(".sprint_backlog").css({'margin-left':(($left_p*2)+360) +'px'});
					$(".sprint").css({'margin-left':(($left_p*3)+720+30) +'px'});
					/*backlog 위치 조정을 위한 Script*/
						
					if($close_flag == 0){
						$("#project_background").css({'width' : ((($(window).width())*(7/10)))+'px'});
						$("#project_background").css({'background-position-x' : ((($(window).width())*(7/10))+2)+'px'});
					}else if($close_flag == 1){
						$("#project_background").css({'width' : ((($(window).width())*(7/10)))+'px'});
						$("#project_background").css({'background-position-x' : ((($(window).width())*(7/10))+2)+'px'});
						$("#project_background").css({'left':(-(($(window).width())*(7/10))+40)+'px'},500);
					}
					$("#_close").css({'margin-left':($("#project_background").width()-35)+'px'});
					/*close 버튼 위치 설정*/
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
						left: 'prev,next',
						center: 'title',
						right: ''
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
							if(count($list)>0){
								foreach($list as $key){
									if($cnt>0)
										$str .=",";
									$sdate1 = date(  "Y-n-j", strtotime( $key["sdate"] ) );
									$edate1 = date(  "Y-n-j", strtotime( $key["edate"] ) );
									$sdate2 = explode("-",$sdate1);
									$edate2 = explode("-",$edate1);
									$sdate2[1] = strval(intval($sdate2[1])-1);
									$edate2[1] = strval(intval($edate2[1])-1);
									$str .= "{";
									$str .= "title:'".$key["title"]."',";
									$str .= "start: new Date(".$sdate2[0].",".$sdate2[1].",".$sdate2[2]."),";
									$str .= "end: new Date(".$edate2[0].",".$edate2[1].",".$edate2[2].")";
									$str .= "}";
									$cnt++;
								}
								echo $str;
							}
						?>
					]
				});

				$(".listDelete").click(function(){
					temp = this.id.split("_");
					$.ajax({
					        url: '/~sscrum/SimplicScrum/project/deleteProject',
					        type: "POST",
					        async : false,
					        data: {id: temp[1]},
					        dataType: 'json',
					        success: function (rdata) {
					        	result = rdata.code;
					        	msg = rdata.msg;
					        }
						    });
						    if(result==100){
						    	location.href="/~sscrum/SimplicScrum/project/?type=delete";
						    }else{
						    	alert(msg);
						    	return false;
						    }
				});
				//---------추가-----------------------------------------------------------------------------------------
				$("#start_date").datepicker(clareCalendar);
				$("#end_date").datepicker(clareCalendar);
				$("img.ui-datepicker-trigger").attr("style"," vertical-align:middle; cursor:pointer;"); //이미지버튼 style적용
				$("#ui-datepicker-div").hide(); //자동으로 생성되는 div객체 숨김 
				

				$("#plus_projectbtn").click(function(){

					var $email_check_flag = 1;	//이메일이 DB에 존재하는지 여부 (0:존재X, 1:존재)
					
					count += 1;

					for(; count>1; count--){
						var add_textbox = document.createElement("input");

						add_textbox.type = "text";
						add_textbox.id = "member_name" + count;
						add_textbox.value ="";
						add_textbox.style.width = "272px";
						add_textbox.style.margin = "5px";

						var br = document.createElement("br");
						members.appendChild(add_textbox);

//						$("#project_height").css({'height' = '+30px'});
					}

					if($email_check_flag == 1){
						member_name.value += document.getElementById("email").value;
						check_email_box.value += "추가되었습니다";
						email.value = "";
					}else{
						check_email_box.value += "존재하지 않는 회원입니다.";}

				});
				//---------추가 끝------------------------------------------------------------------------------------
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

	<!--프로젝트 생성 메뉴 시작-->
	
	<div id = "make_project" style="">
		<div class="project_tiltle_bar">ADD PROJECT</div>
		<div class = "input_project">
			<label for = "project_name" class ="label_project">PROJECT NAME&nbsp;&nbsp;</label><input type ="text" id ="project_name" style="width:151px; align=right;"/>
		</div>

		<div id="project_member" style="height:110px; width:305px; margin-left:10px; background-color:#3b3a3f; color:white; margin-top:10px; margin-bottom:10px;">
			<div class="add_member">
				<label for = "add_member" class ="label_addmember" >ADD MEMBER&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<input type ="text" id ="email" style="width:151px;" value="E-mail을 입력하세요."/>
				<a href="#" id="plus_projectbtn"><img src="<?=$img_path?>/member_addbtn.png" style="vertical-align: middle; margin-top: -4px"/></a>
			</div>
			<div class="check_member">
				<input type="text" id="check_email_box" value="" style="background-color:#3b3a3f; width:305px; height:15px; border:none; color:#afafaf; font-size:8px; text-align:right; margin-right:8px;"></br>-------------------------------------</div>
			<div class="member_list">
				<div><label for = "member_list" class ="label_memberlist" style="margin-left:5px;">MY MEMBER</label></div>
				<div id="members">
					<input type ="text" id ="member_name" value="" style="width:272px; margin-left:5px;"/>
					<img src="<?=$img_path?>/member_deletebtn.png" style="vertical-align: middle; margin-top: -4px"/>
				</div>
			</div>
		</div>
		  
		<div style="width:305px; height:25px; margin-left:10px; background-color:#3b3a3f;">
			<label for = "term" class ="label_project">TERM</label>
		</div>

		<div style=" width: 305px; height:30px; margin-left:10px; background-color:#3b3a3f; color:white;">
			<input type="text" id="start_date" size="9" maxlength="8" title="START DATE" style="margin-left:5px; width:118px;"> ~ 
			<input type="text" id="end_date" size="9" maxlength="8" title="END DATE"style="width:118px;">
		</div>
		 
		
		</br>
		<div id = "submit_cancel">
			<a href ="#" class="submit" id ="add_submit">Make</a>
			<a href ="#" class="submit" id ="add_cancel">Cancel</a>
		</div>
	</div>
  <!--프로젝트 생성 메뉴 끝-->
	
	<!--Creat project start-->
	
 </BODY>
</HTML>
