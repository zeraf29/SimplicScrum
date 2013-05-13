<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// 경고메세지를 경고창으로
function alert($msg='', $url='') {
	$CI =& get_instance();

	if (!$msg) $msg = '올바른 방법으로 이용하세요.';

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'>alert('".$msg."');";
	if (!$url)
        echo "history.go(-1);";
    echo "</script>";
    if ($url)
        goto_url($url);
	exit;
}

// 경고메세지 출력후 창을 닫음
function alert_close($msg) {
	$CI =& get_instance();

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'> alert('".$msg."'); window.close(); </script>";
	exit;
}

// 해당 url로 이동
function goto_url($url) {
	echo "<script type='text/javascript'> location.replace('".$url."'); </script>";
	exit;
}

// 불법접근을 막도록 토큰을 생성하면서 토큰값을 리턴
function get_token() {
	$CI =& get_instance();

	$token = md5(uniqid(rand(), TRUE));
	$CI->session->set_userdata('ss_token', $token);

	return $token;
}

// POST로 넘어온 토큰과 세션에 저장된 토큰 비교
function check_token($url=FALSE) {
	$CI =& get_instance();
	// 세션에 저장된 토큰과 폼값으로 넘어온 토큰을 비교하여 틀리면 에러
	if ($CI->input->post('token') && $CI->session->userdata('ss_token') == $CI->input->post('token')) {
		// 맞으면 세션을 지운다. 세션을 지우는 이유는 새로운 폼을 통해 다시 들어오도록 하기 위함
		$CI->session->unset_userdata('ss_token');
	}
	else
		alert('Access Error',($url) ? $url : $CI->input->server('HTTP_REFERER'));

	// 잦은 토큰 에러로 인하여 토큰을 사용하지 않도록 수정
	// $CI->session->unset_userdata('ss_token');
	// return TRUE;
}

function check_wrkey() {
	$CI =& get_instance();
	$key = $CI->session->userdata('captcha_keystring');
	if (!($key && $key == $CI->input->post('wr_key'))) {
		$CI->session->unset_userdata('captcha_keystring');
	    alert('정상적인 접근이 아닙니다.', '/');
	}
}

function getCountryList($code='',$mode=''){
	$code = trim($code);
	$CI =& get_instance();
	$CI->load->model('M_advertiser');
	$countries = $CI->M_advertiser->get_country_list($mode);
	?>
	<option value="">choose a country</option>
	<?
	foreach($countries as $country){
		if(!strnatcmp($code,$country['code'])){
			?>
			<option value="<?=$country['code']?>" selected><?=$country['name']?></option>
			<?
		}else{
			?>
			<option value="<?=$country['code']?>"><?=$country['name']?></option>
			<?
		}
	}
}
function getSignList($code=''){
	$code = trim($code);
	$CI =& get_instance();
	$CI->load->model('M_country');
	$signs = $CI->M_country->getSignList();
	?>
	<option value=""></option>
	<?
	foreach($signs as $sign){
		if(!strnatcmp($code,$sign['sign'])){
			?>
			<option value="<?=$sign['sign']?>" selected><?=$sign['sign']?></option>
			<?
		}else{
			?>
			<option value="<?=$sign['sign']?>"><?=$sign['sign']?></option>
			<?
		}
	}
}
function getLevel($level=''){
	$CI =& get_instance();
	$array = array(
			0 => array('name' =>'advertiser' , 'level' =>1),
			1 => array('name' =>'partner' , 'level' =>2),
			2 => array('name' =>'admin' , 'level' =>10)
		);
	
	for($i = 0 ; $i < sizeof($array); $i++){
		if($level == $array[$i]['level']){ ?>
		<option value="<?=$array[$i]['level']?>" selected><?=$array[$i]['name']?></option>
		<?			
		}else if( $array[$i]['level'] <= $CI->session->userdata('ss_mb_level_int') ){?>
		<option value="<?=$array[$i]['level']?>"><?=$array[$i]['name']?></option>
		<?
		}

	}

}

function getLeveltoName($level=''){
	$array = array(
			0 => array('name' =>'advertiser' , 'level' =>1),
			1 => array('name' =>'partner' , 'level' =>2),
			2 => array('name' =>'admin' , 'level' =>10)
		);
	for($i = 0 ; $i < sizeof($array); $i++){
		if($level == $array[$i]['level']){ 
			return $array[$i]['name'];
			break;
		}
	}
}

function str_compaignActive($s='',$e='',$active=''){
	if($active == "0"){
		return "X";
	}else{
		$vowels = array(" ", "-", ":");
		$stime = str_replace($vowels, "", $s);
		$etime = str_replace($vowels, "", $e);
		$now = date("YmdHis");
		if( $now < $etime && $now > $stime){
			return "O";
		}else{
			return "X";
		}
	}
	
}

function hc( $str, $n = 500, $end_char = ' ...' )
{
  $CI =& get_instance();
  $charset = $CI->config->item('charset');
  
  if ( mb_strlen( $str , $charset) < $n ) {
    return $str ;
  }

  $str = preg_replace( "/\s+/iu", ' ', str_replace( array( "\r\n", "\r", "\n" ), ' ', $str ) );

  if ( mb_strlen( $str , $charset) <= $n ) {
    return $str;
  }
  return mb_substr(trim($str), 0, $n ,$charset) . $end_char ;
}

?>