<?include("common/header.php");?>
  <link href='<?=$css_path?>/fullcalendar.css' rel='stylesheet' />
  <link href='<?=$css_path?>/fullcalendar.print.css' rel='stylesheet' media='print' />
  <link rel='stylesheet' href='<?=$css_path?>/cupertino/theme.css' />
  <script src='<?=$js_path?>/fullcalendar.min.js'></script>
<?php
	$type = isset($_GET["type"])?$_GET["type"]:"";
	$title="";
	$text="";
	if($type=='delete'){
		$title = 'Delete Complete';
		$text = 'Confirm you Project';
	}else if($project_id==-1){
		$title = 'Hi, '.$this->session->userdata("ss_nickname");
		$text = 'Welcome to SimplicScrum';
	}
	else if($this->input->get("pm")){
		$title = $this->input->get("pm");
		$text = 'Product Backlog was maked';
	}
?>
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
		<div class="product_backlog"><a href="#" class = "p_backlog" id="top_p_backlog_btn">PRODUCT BACKLOG</a></div>
		<div class="sprint_backlog"><a href="#" class = "s_backlog" id="top_s_backlog_btn">SPRINT BACKLOG</a></div>
		<div class="sprint"><a href="#" class = "s_backlog" id="top_sprint_btn">SPRINT</a></div>
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
								echo "<li class=\"ui-state-default listbar\"><span id='".$key["id"]."' style=\"width:90%;cursor:pointer;\">".$key["title"]."</span><span id=\"list_".$key["id"]."\" style=\"cursor:pointer;float:right;\" class='listDelete'><img src=\"".$img_path."/delete.png\"></span></li>";
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
		<div class="make_product" >
			<div class="ineer_product">
				<img src="<?=$img_path?>/product_btn.png">
			</div>
			<div class="ineer_product_btn">
				<a href="#" id="pbacklog_add_btn"><img src="<?=$img_path?>/p_backlog_add.png"></a>
				<img src="<?=$img_path?>/p_backlog.png">
			</div>
			<!-- 추가 20130605 0200 -->
			<div class = "plus_backlog" id = "make_pbacklog_window">
				<p>MAKE PRODUCT BACKLOG</p>
				<div class = "input_makeBacklog"><label for = "pbacklog_name" class ="label_backlog">NAME</label><input type ="text" id ="pbacklog_name" name="pbacklog_name" style="width:140px;"/></div>
				<div class = "input_makeBacklog"><label for = "pbacklog_discription" class ="label_backlog">DISCRIPTION</label><textarea id ="pbacklog_discription" name="pbacklog_discription" style="margin-left:40px; margin-top : 10px; padding : 10px; width:250px; height:150px"></textarea></div>
				<div class = "submit_cancel_class">
					<a href ="#" class="submit" id = "make_pbacklog_submit">submit</a>
					<a href ="#" class="submit" id = "make_pbacklog_cancel">cancel</a>
				</div>
			</div>

			<div id="id_productBacklog_list">
				<?php
					if(isset($backlog["porduct"])){
						$str = "";
						$cnt = 1;
						foreach($backlog["porduct"] as $key){
							$str .= "<div id=\"pList_".$key->pd_id."\" class=\"pbacklog_list nlClass\"><div id='no' style='font-weight:bold; display:inline; padding:8px; margin-left:5px'>NO:</div><div id='no_box' style=' display:inline;'>$key->pd_id</div><div style='width:100px; display:inline; margin-left:32px; font-weight: bold'>TITLE:</div><div class='title' style='width:100px; display:inline; padding:2px; border-bottom:1px solid; font-size:13px; margin-left:6px'>".word_limiter($key->pd_title,3)."</div>";
							$str .= "<div class='bContent'><div style='font-weight:bold; margin-left:8px'>Full Title:</div><div style = 'width:268px; font-size:10 margin-top:15px border:1px solid; background:white; margin-left:8px'>".$key->pd_title."</div><div style='font-weight:bold; margin-left:8px'>DESCRIPTION:</div><div style = 'width:270px; height:90px; font-size:10 margin-top:15px border:1px solid; background:white; margin-left:8px'><textarea style='height:90px;width:264px;' readonly>".$key->pd_desc."</textarea></div><div><a href = '#' style='margin-left:220px; font-size:8px'>MODIFY</a></div></div></div>";
							$cnt++;
						}
						echo $str;
					}
				?>
			</div>
		</div>
	
<!--수정 20130607 시작-->	
		<div class="make_sprintbacklog"><img src="<?=$img_path?>/sprintb_btn.png">
			<div class="ineer_product_btn">
				<a href="#" id="sbacklog_add_btn"><img src="<?=$img_path?>/s_backlog_add.png"></a>
				<img src="<?=$img_path?>/s_backlog.png">
			</div>
			<div class = "plus_backlog" id = "make_sbacklog_window">
				<p>MAKE SPRINT BACKLOG</p>
				<div class = "input_makeBacklog"><label for = "sbacklog_name" class ="label_backlog">NAME</label><input type ="text" id ="sbacklog_name" name="sbacklog_name" style="width:140px;"/></div>
				<div class = "input_makeBacklog"><label for = "sbacklog_level" class ="label_backlog">LEVEL</label>
				<select id = "sbacklog_level">
					<option value = "3">High</option>
					<option value = "2">Middle</option>
					<option value = "1">Low</option>
				</select>
				</div>
				
				<div class = "input_makeBacklog"><label for = "sbacklog_discription" class ="label_backlog">DISCRIPTION</label><textarea id ="sbacklog_discription" name="sbacklog_discription" style="margin-left:40px; margin-top : 10px; padding : 10px; width:250px; height:50px"></textarea></div>
				<div class = "input_makeBacklog label_backlog" style="border-bottom:3px solid #808080;">Relation_Backlog</div>
				<div class = "input_makeBacklog">
					<div id = "Relation_Backlog_List">
						<div class = "Relation_Backlog_offList">
							<?php

							$str = "";
							if(isset($backlog["porduct"])){
								$str .= "<select name='sfblist' id='sfblist'>";
								$str .= "<option value='' selected></option>";
								foreach($backlog["porduct"] as $key){
									$str .= "<option value='".$key->pd_id."'>".word_limiter($key->pd_title,5)."</option>";
								}
								$str .= "</select>";
								echo $str;
							}
						?>
					<!--모든 프로덕트 백로그 리스트가 들어가는 DIVISION(from DB)-->
						</div>
					</div>
	
					<div class = "submit_cancel_class">
						<a href ="#" class="submit" id = "make_sbacklog_submit">submit</a>
						<a href ="#" class="submit" id = "make_sbacklog_cancel">cancel</a>
					</div>
				</div>
			</div>
			
			<div id="id_sprintBacklog_list">
				<?php
					if(isset($backlog["sprintlog"])){
						$str = "";
						$cnt = 1;
						foreach($backlog["sprintlog"] as $key){
							$str .= "<div id=\"pList_".$key->id."\" class=\"sbacklog_list nlClass\"><div id='no' style='font-weight:bold; display:inline; padding:8px; margin-left:5px'>NO:</div><div id='no_box' style=' display:inline;'>$key->id</div><div style='width:100px; display:inline; margin-left:32px; font-weight: bold'>TITLE:</div><div class='title' style='width:100px; display:inline; padding:2px; border-bottom:1px solid; font-size:13px; margin-left:6px'>".word_limiter($key->title,3)."</div><div style='font-size:8px; display:inline;'><a>vote</a></div><div style='font-size:8px; display:inline;'>0</div>";
							$str .= "<div class='bContent'><div style='font-weight:bold; margin-left:8px'>Full Title:</div><div style = 'width:270px; font-size:10 margin-top:15px border:1px solid; background:white; margin-left:8px'>".$key->title."</div><div style='font-weight:bold; margin-left:8px'>DESCRIPTION:</div><div style = 'width:268px; height:90px; font-size:10 margin-top:15px border:1px solid; background:white; margin-left:8px'><textarea style='height:90px;width:264px;' readonly>".$key->sdesc."</textarea></div><div style='display:inline'>Level:</div><div display:inline>level(0, 1, 2)</div><div display:inline><a href = '#' style='margin-left:204px; font-size:8px'>MODIFY</a></div></div></div>";
							$cnt++;
						}
						echo $str;
					}
				?>
				<div id = "new_slist1" class = "sbacklog_list nlClass"><div class = "sprintBacklog_card_name">TestData1</div>
						<div class = "sprintBacklog_vote_now">12</div><div class = "sprintBacklong_vote_total">25</div></div>
				<div id = "new_slist2" class = "sbacklog_list nlClass"><div class = "sprintBacklog_card_name">TestData2</div>
						<div class = "sprintBacklog_vote_now">12</div><div class = "sprintBacklong_vote_total">25</div></div>
				<div id = "new_slist3" class = "sbacklog_list nlClass"><div class = "sprintBacklog_card_name">TestData3</div>
						<div class = "sprintBacklog_vote_now">12</div><div class = "sprintBacklong_vote_total">25</div></div>
			</div>
		</div>
<!--수정 20130607 끝-->	

		<div class="make_sprint">
			<div class="ineer_product"><img src="<?=$img_path?>/sprint_btn.png">
		<div class="ineer_product_btn">
				<a href="#" id="splint_add_btn"><img src="<?=$img_path?>/splint_add.png"></a>
				<img src="<?=$img_path?>/splint.png">
			</div>
			<div class = "plus_backlog" id = "make_splint_window">
				<p>MAKE SPRINT</p>
				<div class = "input_makeBacklog"><label for = "splint_name" class ="label_backlog">NAME</label><input type ="text" id ="splint_name" style="width:140px;"/></div>
				<div class = "input_makeBacklog"><label for = "splint_dueDate" class ="label_backlog">Due-Date</label><input type="text" id="sprint_dueDate" size="9" maxlength="8" title="START DATE" style="margin-left:5px; width:118px;"></div>
				<div class = "input_makeBacklog"><label for = "splint_discription" class ="label_backlog">DISCRIPTION</label><textarea id ="splint_discription" style="margin-left:40px; margin-top : 10px; padding : 10px; width:250px; height:50px"></textarea></div>
				<div class = "input_makeBacklog label_backlog">SPLINT BACKLOG</div>
				<div class = "input_makeBacklog label_backlog" style = "margin-top:-15px;">===================================</div>
					<div id = "splint_backlog_list" style = "margin-top:-15px;" >
						<div class = "splint_Backlog_onList">
						
						</div>
				</div>
				<div class = "input_makeBacklog label_backlog"  style = "margin-top:-10px;">===================================</div>
				<div class = "input_makeBacklog label_backlog"  style = "margin-top:-15px;">Splint_Backlog_List</div>
				<div class = "input_makeBacklog label_backlog"  style = "margin-top:-15px;">===================================</div>
				<div class = "input_makeBacklog">
					
					</div>
	
				<div class = "submit_cancel_class">
					<a href ="#" class="submit" id = "make_splint_submit">submit</a>
					<a href ="#" class="submit" id = "make_splint_cancel">cancel</a>
				</div>
				</div>
			</div>
			
			<div id="id_sprint_list">
				<div id = "new_slist1" class = "splint_list nlClass">TestData1</div>
				<div id = "new_slist2" class = "splint_list nlClass">TestData2</div>
				<div id = "new_slist3" class = "splint_list nlClass">TestData3</div>
			</div>
		</div>
		
	</div>
	<!--content finish-->

	<!--프로젝트 생성 메뉴 시작-->
	
	<div id = "make_project" style="">
		<div id = "submit_cancel">
			<a href ="#" class="submit" id ="add_submit">Make</a>
			<a href ="#" class="submit" id ="add_cancel">Cancel</a>
		</div>
		<div class="project_tiltle_bar">ADD PROJECT</div>
		<div class = "input_project">
			<label for = "project_name" class ="label_project">PROJECT NAME&nbsp;&nbsp;</label><input type ="text" id ="project_name" style="width:151px; align=right;"/>
		</div>
		<div id="id_desc">
			<label for = "desc" class ="label_project">DESC</label>
			<div>
				<textarea id="mpDesc"></textarea>
			</div>
		</div>
		<div id="id_term">
			<label for = "term" class ="label_project">TERM</label>
		</div>
		<div id="id_date">
			<input type="text" id="start_date" size="9" maxlength="8" title="START DATE" style="margin-left:5px; width:118px;"> ~ 
			<input type="text" id="end_date" size="9" maxlength="8" title="END DATE"style="width:118px;">
		</div>
		
		<div id="project_member">
			<div class="add_member">
				<label for = "add_member" class ="label_addmember" >ADD MEMBER&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<div>
					<input type ="text" id ="amEmail" style="width:270px;" placeholder = "E-mail을 입력하세요."/>
					<a href="#" id="plus_projectbtn"><img src="<?=$img_path?>/member_addbtn.png" style="vertical-align: middle; margin-top: -4px"/></a>
				</div>
			</div>
			<div class="check_member">
			</br>-------------------------------------</div>
			<div class="member_list">
				<div><label for = "member_list" class ="label_memberlist" style="margin-left:5px;">MY MEMBER</label></div>
				<div id="members">
				</div>
			</div>
		</div>
		
	</div>
  <!--프로젝트 생성 메뉴 끝-->
	
	<!--Creat project start-->

 </BODY>
 <script type = "text/javascript">	
		$(document).ready(function()
			{
				var $project_id = <?=$project_id?>;
				$(".listbar").click(function(){
					pid = $(this).children("span").attr("id");
					location.href="/~sscrum/SimplicScrum/project/?pid="+pid;
				});
				<?php
				if($title!=""){
					echo "$.pnotify({title: '".$title."',text: '".$text."',animate_speed: 'fast'});$.pnotify.defaults.delay -= 3000;";
				}
				?>
				
				var $close_flag = 0;

				var $dialog_flag = 1; //1,2, 3, 4, 5....etc
				
				/*--------추가(20130605_0200)시작---------*/
				var $make_pbacklog_flag = 0;	//backlog 생성창 위한  flag
				var $make_sbacklog_flag = 0;	//backlog 생성창 위한  flag
				/*--------추가(20130605_0200) 끝---------*/
				
				var $before_windowsWidth = ($(window).width());
				var count = 1;	//멤버 입력하는 div추가하기위한 변수
				var productBacklog_count = 0; //product backlog에서 list 추가 위한 변수
				
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
					buttonImage: '<?=$img_path?>/datepicker.png', //이미지주소
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
				
				/**/
				if($project_id!=-1){
					$("#project_background").css({left:(-(($(window).width())*(7/10))+40)+'px'});
					$("#project").css({background : 'rgba(56,54,60,0)'});
					$("#close_btn").text("open");
					$("#back_opacity").css({display: 'none'});

					$close_flag = 1;
				}
				/**/

				$("#make_pbacklog_submit").click(function(){
					if($("#pbacklog_name").val() == ""){
						alert("product backlog name 넣어주세요");
						$("#project_name").focus();
						return false;
					}
					if($("#pbacklog_discription").val() == ""){
						alert("product backlog description 넣어주세요");
						$("#start_date").focus();
						return false;
					}
					datafilter = new Array();
					datafilter[0] = "title";
					datafilter[1] = "desc";
					datafilter[2] = "pid";
					datafilter[3] = "mid";
					data = new Object();
					data.title = $("#pbacklog_name").val();
					data.desc = $("#pbacklog_discription").val();
					data.pid = $project_id;
					data.mid = '<?=$this->session->userdata("ss_userid")?>';
					sub  = new Array();
					jsonObject = JSON.stringify(data,datafilter,"\t");
					
					$.ajax({
					        url: '/~sscrum/SimplicScrum/backloglist/makeProduct',
					        type: "POST",
					        async : false,
					        data: {data:jsonObject},
					        dataType: 'json',
					        success: function (rdata) {
					        	result = rdata.code;
					        	msg = rdata.msg;
					        	}
						    });
							if(result==100){
						    	location.href="/~sscrum/SimplicScrum/project/?pid="+$project_id+"&pm="+$("#pbacklog_name").val();
						    }else{
						    	alert("생성실패");
						    }
					});

				$(window).resize(function(){
					var $left_p = (($(window).width()) - 1080)/4;
					
					$(".make_product").css({'margin-left':$left_p + 'px'});
					$(".make_sprintbacklog").css({'margin-left':(($left_p*2)+360) +'px'});
					$(".make_sprint").css({'margin-left':(($left_p*3)+720) +'px'});
					
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
					if($project_id == -1){
						alert("Selecting your Project.");
						return false;
					}

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
					theme: true,
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
				
				$(".delAddMem").click(function(){
					alert(1)
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

				//달력
				$("#start_date").datepicker(clareCalendar);
				$("#end_date").datepicker(clareCalendar);
				$("img.ui-datepicker-trigger").attr("style"," vertical-align:middle; cursor:pointer;"); //이미지버튼 style적용
				$("#ui-datepicker-div").hide(); //자동으로 생성되는 div객체 숨김 
				
				$('#members').on('click', '.delAddMem', function() {
					if(confirm("정말로 삭제하시겠습니까?"))
						$(this).parent().remove();
				});
				$("#amEmail").click(function(){
					$(this).val("");
				});
				$("#plus_projectbtn").click(function(){

					$.ajax({
					        url: '/~sscrum/SimplicScrum/project/isMember',
					        type: "POST",
					        async : false,
					        data: {email: $("#amEmail").val()},
					        dataType: 'json',
					        success: function (rdata) {
					        	result = rdata.code;
					        	msg = rdata.msg;
					        	nickname = rdata.nickname;
					        	email = rdata.email;
					        	}
						    });
						    if(result==100){
						    	check=true;
						    	if(email=='<?=$this->session->userdata("ss_useremail")?>'){
						    		check = false;
						    	}else{
							    	$(".addMlists .addEmail").each(function() {
									    if($(this).html()==email)
									    	check = false;
									});
							    }
						    	if(check==false){
						    		$("#amEmail").val("");
						    		$("#amEmail").attr("placeholder", "이미 등록되어 있는 멤버입니다.");
						    	}else{
						    		$("#members").append("<div class='addMlists'><span class='addEmail'>"+email+"</span><span class='delAddMem'>&nbsp;</span></div>");
						    	}
								
						    }else{
						    	$("#amEmail").val("");
						    	$("#amEmail").attr("placeholder", "없는 Email 정보입니다.");
						    }
				});
				
				$("#add_submit").click(function(){
					if($("#project_name").val() == ""){
						alert("프로젝트 이름을 넣어주세요");
						$("#project_name").focus();
						return false;
					}
					if($("#start_date").val() == ""){
						alert("시작날짜를 정해주세요");
						$("#start_date").focus();
						return false;
					}
					if($("#end_date").val() == ""){
						alert("완료날짜를 정해주세요");
						$("#end_date").focus();
						return false;
					}
					if($("#start_date").val() > $("#end_date").val() ){
						alert("잘못된 기간 입니다.");
						$("#end_date").focus();
						return false;
					}
					datafilter = new Array();
					datafilter[0] = "title";
					datafilter[1] = "start_date";
					datafilter[2] = "end_date";
					datafilter[3] = "master";
					datafilter[4] = "member";
					datafilter[5] = "desc"
					data = new Object();
					data.title = $("#project_name").val();
					data.start_date = $("#start_date").val();
					data.end_date = $("#end_date").val();
					data.master = '<?=$this->session->userdata("ss_useremail")?>';
					data.desc = $("#mpDesc").val();
					sub  = new Array();
					cnt = 0;
					$(".addMlists .addEmail").each(function() {
						sub[cnt] = $(this).html();
						cnt++;
					});
					data.member = sub;
					jsonObject = JSON.stringify(data,datafilter,"\t");
					
					$.ajax({
					        url: '/~sscrum/SimplicScrum/project/makeProject',
					        type: "POST",
					        async : false,
					        data: {data:jsonObject},
					        dataType: 'json',
					        success: function (rdata) {
					        	result = rdata.code;
					        	msg = rdata.msg;
					        	}
						    });
							if(result==100){
						    	location.href="/~sscrum/SimplicScrum/project/";
						    }else{
						    	alert("생성실패");
						    }
					});

					
				//product_backlog list 동적생성
				$("#make_pbacklog_submit").click(function()
				{
					productBacklog_count ++;

					var new_list = document.createElement("div");
					
					 new_list.id = "new_plist" + productBacklog_count;
					 new_list.className = "pbacklog_list nlClass";
					 
				 id_productBacklog_list.appendChild(new_list);
				});
			
							//splint_backlog list 동적생성
				$("#make_sbacklog_submit").click(function()
				{
					productBacklog_count ++;

					var new_list = document.createElement("div");
					 new_list.id = "new_slist" + productBacklog_count;
					 new_list.className = "sbacklog_list nlClass";
					 new_list.innerHTML = "<div class = 'sprintBacklog_card_name'>TestData1</div><div class = 'sprintBacklog_vote_now'>12</div><div class = 'sprintBacklong_vote_total'>25</div>"
					id_sprintBacklog_list.appendChild(new_list);
				});
			

			$("#id_productBacklog_list").children(".pbacklog_list").click(function(){
				if($(this).hasClass("extText")){
					$(this).switchClass("extText","nlClass");
					$(this).children(".pbacklog_list").children(".bContent").hide();
				}else{
					$(this).switchClass("nlClass","extText");
				}
			});
			
			$("#id_sprintBacklog_list").children(".sbacklog_list").click(function(){
				if($(this).hasClass("extText")){
					$(this).switchClass("extText","nlClass");
					$(this).children(".pbacklog_list").children(".bContent").hide();
				}else{
					$(this).switchClass("nlClass","extText");
				}
			});
			
			/*make product backlog*/
			/*플러스 버튼 눌렀을떙*/
			$(".Relation_Backlog_offList").delegate("img", "click", function()
			{
				$(".Relation_Backlog_onList").append("<div><div style = 'float:left; width:250px; height:24px'>Product_Backlog_name</div><div style = 'float:Right; width:70px;'><a href='#' id='remove_relation_backlog'><img src='<?=$img_path?>/member_deletebtn.png' style='vertical-align: middle;'/></a></div></div>");
			});
			
			/*마이너스 버튼 눌렀을떙*/
			$(".Relation_Backlog_onList").delegate("img", "click", function()
			{
				$(this).parent().parent().parent().remove();
			});
			
			/*splint backlog*/
			/*플러스 버튼 눌렀을떙*/
			$(".splint_Backlog_offList").delegate("img", "click", function()
			{
				$(".splint_Backlog_onList").append("<div><div style = 'float:left; width:250px; height:24px'>Splint_Backlog_name</div><div style = 'float:Right; width:70px;'><a href='#' id='remove_relation_backlog'><img src='<?=$img_path?>/member_deletebtn.png' style='vertical-align: middle;'/></a></div></div>");
			});
			
			/*마이너스 버튼 눌렀을떙*/
			$(".splint_Backlog_onList").delegate("img", "click", function()
			{
				$(this).parent().parent().parent().remove();
			});
			
			
			$("#make_pbacklog_cancel").click(function(){
				$( "#make_pbacklog_window" ).hide( "fold","", 1000);
				$make_pbacklog_flag = 0;
			});
			
			$("#make_sbacklog_cancel").click(function(){
				$( "#make_sbacklog_window" ).hide( "fold","", 1000);
				$make_sbacklog_flag = 0;
			});
			
			/*--------추가(2013-06-05, 0200)시작----------*/
			//프로덕트 백로그 생성창 컨트롤=========
				$( "#make_pbacklog_window" ).hide();
				$( "#pbacklog_add_btn" ).click(function() {
					if($make_pbacklog_flag == 1){
						$( "#make_pbacklog_window" ).hide( "fold","", 1000);
						$make_pbacklog_flag = 0;
						}
					else if($make_pbacklog_flag ==0){
						$( "#make_pbacklog_window" ).show( "fold","", 1000);
						$make_pbacklog_flag = 1;
					}
				});
				
				$( "#make_sbacklog_window" ).hide();
				$( "#sbacklog_add_btn" ).click(function() {
					if($make_sbacklog_flag == 1){
						$( "#make_sbacklog_window" ).hide( "fold","", 1000);
						$make_sbacklog_flag = 0;
						}
					else if($make_sbacklog_flag ==0){
						$( "#make_sbacklog_window" ).show( "fold","", 1000);
						$make_sbacklog_flag = 1;
					}
				});
				
				$( "#make_splint_window" ).hide();
				$( "#splint_add_btn" ).click(function() {
					if($make_sbacklog_flag == 1){
						$( "#make_splint_window" ).hide( "blind","", 1000);
						$make_sbacklog_flag = 0;
						}
					else if($make_sbacklog_flag ==0){
						$( "#make_splint_window" ).show( "blind","", 1000);
						$make_sbacklog_flag = 1;
					}
				});
				
				
				$("#backlog_dueDate").datepicker(clareCalendar);
				$("#sprint_dueDate").datepicker(clareCalendar);
				//=====================================
				
				
			/*--------추가(2013-06-05, 0200)끝----------*/
	});
	</script>
</HTML>
