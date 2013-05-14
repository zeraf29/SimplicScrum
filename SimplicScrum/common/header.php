<?php
	$main_path = '/~sscrum/SimplicScrum';
	$index_path = $main_path.'/index.php';
	$img_path= $main_path.'/image';
	$css_path = $main_path.'/css';
	$js_path = $main_path.'/js';
	$common_path = $main_path.'/common';
	$title = "Simplic Scrum";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
 	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>  
  	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />  
	<link href="<?=$css_path?>/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?=$js_path?>/jquery.pnotify.min.js"></script>
	<link href="<?=$css_path?>/jquery.pnotify.default.css" media="all" rel="stylesheet" type="text/css" />
<!-- Include this file if you are using Pines Icons. -->
	<link href="<?=$css_path?>/jquery.pnotify.default.icons.css" media="all" rel="stylesheet" type="text/css" />
	<link href="<?=$css_path?>/bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
	<script src="<?=$js_path?>/bootstrap/bootstrap.min.js"></script>
	<title><?php echo $title;?></title>
