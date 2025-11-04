<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function find_between($string, $start, $end, $trim = true, $greedy = false) {
    $pattern = '/' . preg_quote($start) . '(.*';
    if (!$greedy) $pattern .= '?';
    $pattern .= ')' . preg_quote($end) . '/';
    preg_match($pattern, $string, $matches);
    $string = $matches[0];
    if ($trim) {
        $string = substr($string, strlen($start));
        $string = substr($string, 0, -strlen($start) + 1);
    }
    return $string;
}

	function js_redirect_parent($message=''){
		if($message!=''){
			echo "
			<script>alert(\"$message\");</script>
			<script language=\"javascript\">
			window.parent.location.href = window.parent.location.href;
			</script>";
		}
		else{
			echo "
			<script language=\"javascript\">
			window.parent.location.href = window.parent.location.href;
			</script>";
		}
	}

    function sha512($string) {
        return hash('sha512', $string);
    }

function inject_parentchildmenu($content, $parentchildmenu){
 return str_replace('<!--parentchildmenu-->',$parentchildmenu,$content);
}
	//----------------- encypted GET ----------------------

	function fixzy_encoder_($str, $key='W6$6MNeA!GjS7B=a'){
	  $str = bin2hex($str.$key);
		for($i=0; $i<5;$i++){
			$str=strrev(base64_encode($str));
		}
		return bin2hex($str);
	}


	function fixzy_decoder_($str, $key='W6$6MNeA!GjS7B=a'){
        $str = hex2bin($str);
		for($i=0; $i<5;$i++){
			$str=base64_decode(strrev($str));
		}
	return str_replace($key,'',hex2bin($str));
	}

function fixzy_encoder($plainText)
{
    return bin2hex(strtr(base64_encode($plainText), '+/=', '-_~'));
}

function fixzy_decoder($b64Text)
{
    return base64_decode(strtr(hex2bin($b64Text), '-_~', '+/='));
}

function bugme($value){
 echo $value.' <---- $value';
}

function printr($array){
 echo  '<pre>';
 print_r($array);
 echo '</pre>';
}

function stopme($value){
 echo $value.' <---- $value';
 exit();
}

function clientIP(){
$ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');

return trim($ip);
}

function shuffle_name($name = 'doc')
{
	$alpa = 'abcdefghijklmnopqrstuvwxyz1234567890';
	$str = str_shuffle($alpa);
	$strrun = substr($str,0,5);
	$pName = $strrun.'_'.$name;
	
	return $pName;
}

function dateserver($origDate){

$newDate = date("Y-m-d", strtotime($origDate));
return $newDate;
}

function datelocal($origDate){

$newDate = '-';
if(!empty($origDate) && $origDate != '-'){
$newDate = date("d-m-Y", strtotime($origDate));
}

return $newDate;
}

function datelocal_wordmonth($origDate){

$newDate = '-';
if(!empty($origDate) && $origDate != '-'){
$newDate = date("d M Y", strtotime($origDate));
}

return strtoupper($newDate);
}

function datetimeserver($origDate){

$newDate = date("Y-m-d H:i:s", strtotime($origDate));
return $newDate;
}

function datetimelocal($origDate){

$newDate = date("d-m-Y, g:i a", strtotime($origDate));
return $newDate;
}

function standardmoney($money){

    $data = explode(".", $money);
    if(count($data)>1){
     return $data[0].'.'.substr($data[1],0,2);
    }else{
     return $money;
    }

}

function extractNumber($str){
//$str = 'ADP000001209';
$onlyNumeric = filter_var($str, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
settype($onlyNumeric,"integer");

$result=($onlyNumeric);
return (int)$result;
}