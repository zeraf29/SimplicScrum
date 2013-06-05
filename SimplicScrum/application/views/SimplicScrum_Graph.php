<?include("common/header.php");?>
  <link href='<?=$css_path?>/fullcalendar.css' rel='stylesheet' />
  <link href='<?=$css_path?>/fullcalendar.print.css' rel='stylesheet' media='print' />
  <link rel='stylesheet' href='<?=$css_path?>/cupertino/theme.css' />
  <script src='<?=$js_path?>/fullcalendar.min.js'></script>
 </HEAD>
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
   <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});	//���� chart �ε�
   </script>
	<script type = "text/javascript">
	$(document).ready(function()
			{
				var $windowsWidth = ($(window).width());
				var $windowsHeight = ($(window).height());
				
				//graph_page ������(����)�� window ����� �°� ����
				$(".graph_page").css({'height':$windowsHeight - 160 + 'px'});
				$(".graph_left").css({'top': $windowsHeight/2 -160 + 'px'});	//��ư��ġ����
				
				$(".graph_discription").css({'height': ($windowsHeight-160)-60 + 'px'});	//graph_discription ������ ����
				
				//�׷��� ����Ʈ ũ�� ����
				$(".graph_show").css({'height': ($windowsHeight-160)-60 + 'px'});
				$(".graph_show").css({'width': ($windowsWidth-500 )+ 'px'});
				
				$(window).resize(function(){
					//graph_page ������ ũ�Ⱑ ����ɶ����� ����
					$(".graph_page").css({'height':($(window).height()) - 160 + 'px'});
					
					//��ư ��ġ ���� risize��
					$(".graph_left").css({'top': ($(window).height())/2 -160 + 'px'});	
					
					//graph_discription ������ ���� resize��
					$(".graph_discription").css({'height': (($(window).height())-160)-60 + 'px'});
					//�׷��� ����Ʈ ũ�� ����
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
			]);	/*Data�� ,�迭�� ����, for���� ���... ��¥�� ������Ʈ �Ⱓ��ŭ �ϴ����� �Է��ϸ�, ó�� �����ÿ��� 0���� �ʱ�ȭ, 
			DB�κ��� �����ִ� task����, ��¥, �̻����� ���°��� �޾ƿ�.*/
			//íƮ �ݹ� �Լ� ����
			
			var options = {
			  title : 'Scrum Burndown Chart',
			  vAxis: {title: "task"},	//y��
			  hAxis: {title: "date"},	//z��
			  seriesType: "bars",
			  series: {1: {type : "line"}, 2: {type: "line"}}
			};	//�ɼ�

			var chart = new google.visualization.ComboChart(document.getElementById('graph_div'));
			chart.draw(data, options);
      }
	  
      google.setOnLoadCallback(drawVisualization);
	</script>
	
  <link rel="stylesheet" type="text/css" href="SimplicScrum.css">
 </HEAD>
 <BODY>
	<!--��� �޴� ����-->
	<div id = "top" >
		<div class = "left_innerdiv"><img hspace=30px vspace = 15px src = "./image/top_logo.png"></div>
		<div class = "right_innerdiv"><a href = "#" id = "info"> 000 </a>�� ȯ���մϴ�.  LogOut</div>
	</div>

	<div id = "second_top">	
	</div>
	<!--��� �޴� ��-->
	<div class = "graph_page">
		<div class = "graph_left">	
		<img src = "./image/backbtn.png" usemap = "#back_button">
			<map name = "back_button">
				<area shape = "rect" coords = "10, 35, 38, 45" href = "http://www.naver.com">
			</map>
		</div>
			<div class = "graph_right">
				<div class = "graph_discription">
					<div class = "graph_Project_name">�����̸� ���׻���</div>
					<div class = "graph_User_name">����� �̸��� ���ϴ� ���׻���</div>
					<div class = "graph_Term">�Ⱓ�� ���ϴ� ���׻���</div>
					<div class = "graph_Term_bar">�Ⱓ�� ���� �ٰ� ���ϴ� ���׻���</div>
				</div>
				<div id = "graph_div" class = "graph_show">�ڷḦ ������ �׷����� ����</div>
			</div>
	</div>
	
 </BODY>
</HTML>
