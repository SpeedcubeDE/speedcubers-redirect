<?php
if(!function_exists("array_column"))
{
    function array_column($array,$column_name)
    {
        return array_map(function($element) use($column_name){return $element[$column_name];}, $array);
    }
}
$name = 'forumdisplay';
$idname = 'fid';

$arr = array_map('str_getcsv', file($name.'.csv'));
$old = array_column($arr, 0);
$new = array_column($arr, 1);
$id = $_GET[$idname];
$newurl = 'https://speedcube.de/forum/'.$name.'.php?';
$index = array_search($id, $old);
foreach ($_GET as $var => $val)
{
	$newurl .= $var.'=';
	if($var == $idname && $index != NULL)
		$newurl .= $new[$index];
	else
		$newurl .= $val;
	$newurl .= '&';
}
$newurl = rtrim($newurl, '&');
header("HTTP/1.1 301 Moved Permanently");
header('Location: '.$newurl);
?>
