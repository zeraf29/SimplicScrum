<?include("common/header.php");?>
  <link href='<?=$css_path?>/fullcalendar.css' rel='stylesheet' />
  <link href='<?=$css_path?>/fullcalendar.print.css' rel='stylesheet' media='print' />
  <link rel='stylesheet' href='<?=$css_path?>/cupertino/theme.css' />
  <script src='<?=$js_path?>/fullcalendar.min.js'></script>
 </HEAD>
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
   <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});	//구글 chart 로드
   </script>
	<script type = "text/javascript">
	$(document).ready(function()
			{
				var $windowsWidth = ($(window).width());
				var $windowsHeight = ($(window).height());
				
				//graph_page 사이즈(높이)를 window 사이즈에 맞게 설정
				$(".graph_page").css({'height':$windowsHeight - 160 + 'px'});
				$(".graph_left").css({'top': $windowsHeight/2 -160 + 'px'});	//버튼위치조정
				
				$(".graph_discription").css({'height': ($windowsHeight-160)-60 + 'px'});	//graph_discription 사이즈 조정
				
				//그래프 뷰포트 크기 조절
				$(".graph_show").css({'height': ($windowsHeight-160)-60 + 'px'});
				$(".graph_show").css({'width': ($windowsWidth-500 )+ 'px'});
				
				$(window).resize(function(){
					//graph_page 사이즈 크기가 변경될때마다 조절
					$(".graph_page").css({'height':($(window).height()) - 160 + 'px'});
					
					//버튼 위치 조정 risize시
					$(".graph_left").css({'top': ($(window).height())/2 -160 + 'px'});	
					
					//graph_discription 사이즈 조정 resize시
					$(".graph_discription").css({'height': (($(window).height())-160)-60 + 'px'});
					//그래프 뷰포트 크기 조절
					$(".graph_show").css({'height': (($(window).height())-160)-60 + 'px'});
					$(".graph_show").css({'width': (($(window).width())-500 )+ 'px'});
					drawVisualization();
				});
			});
			
						
		function drawVisualization() {
			// Some raw data (not necessarily accurate)
			var data = google.visualization.arrayToDataTable([
			  ['date', 'remind_task_bar','remind_task_line', 'ideal' ],
			  ['12-05-01',  1000,  1000, 1000],
			  ['12-05-02',  950,  950, 950],
			  ['12-05-03',  890,  890, 900],
			  ['12-05-04',  850,  850, 850],
			  ['12-05-05',  845,  845, 800],
			  ['12-05-06',  800,  800, 750],
			  ['12-05-07',  730,  730, 700],
			  ['12-05-08',  650,  650, 650],
			  ['12-05-09',  600,  600, 600],
			  ['12-05-10',  550,  550, 550],
			  ['12-05-11',  510,  510, 500],
			  ['12-05-12',  480,  480, 450],
			  ['12-05-13',  460,  460, 400],
			  ['12-05-14',  0,  0, 350],
			  ['12-05-15',  0,  0,  300],
			  ['12-05-16',  0,  0,  250],
			  ['12-05-17',  0,  0,  200],
			  ['12-05-18',  0,  0,  150],
			  ['12-05-19',  0,  0,  100],
			  ['12-05-20',  0,  0,  50],
			  ['12-05-21',  0,  0,  0]			  
			]);	/*Data는 ,배열로 지정, for문을 사용... 날짜는 프로젝트 기간만큼 일단위로 입력하며, 처음 생성시에는 0으로 초기화, 
			DB로부터 남아있는 task개수, 날짜, 이상적인 상태값을 받아옴.*/
			//챠트 콜백 함수 설정
			
			var options = {
			  title : 'Scrum Burndown Chart',
			  vAxis: {title: "task"},	//y축
			  hAxis: {title: "date"},	//z축
			  seriesType: "bars",
			  series: {1: {type : "line"}, 2: {type: "line"}}
			};	//옵션

			var chart = new google.visualization.ComboChart(document.getElementById('graph_div'));
			chart.draw(data, options);
      }
	  
      google.setOnLoadCallback(drawVisualization);
	</script>
	
  <link rel="stylesheet" type="text/css" href="<?=$css_path?>/SimplicScrum.css">
 </HEAD>
 <BODY>
	<!--상단 메뉴 시작-->
	<div id = "top" >
		<div class = "left_innerdiv"><img hspace=30px vspace = 15px src = "<?=$img_path?>/top_logo.png"></div>
		<div class = "right_innerdiv"><a href = "#" id = "info"> 000 </a>님 환영합니다.  LogOut</div>
	</div>

	<div id = "second_top">	
	</div>
	<!--상단 메뉴 끝-->
	<div class = "graph_page">
		<div class = "graph_left">	
		<img src = "<?=$img_path?>/backbtn.png" usemap = "#back_button">
			<map name = "back_button">
				<area shape = "rect" coords = "10, 35, 38, 45" href = "http://www.naver.com">
			</map>
		</div>
			<div class = "graph_right">
				<div class = "graph_discription">
					<div class = "graph_Project_name">플젝이름 뿌잉뿌잉</div>
					<div class = "graph_User_name">사용자 이름이 들어갑니다 뿌잉뿌잉</div>
					<div class = "graph_Term">기간이 들어갑니다 뿌잉뿌잉</div>
					<div class = "graph_Term_bar">기간에 따른 바가 들어갑니다 뿌잉뿌잉</div>
				</div>
				<div id = "graph_div" class = "graph_show">자료를 가지고 그래프를 생성</div>
			</div>
	</div>
	
 </BODY>
</HTML>
