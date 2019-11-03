<?php
if(!function_exists("array_column"))
{
    function array_column($array,$column_name)
    {
        return array_map(function($element) use($column_name){return $element[$column_name];}, $array);
    }
}
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
$tarr = array_map('str_getcsv', file('showthread.csv'));
$told = array_column($tarr, 0);
$tnew = array_column($tarr, 1);
$tid = $_GET['tid'];
$tindex = array_search($tid, $told);
//$parr = array_map('str_getcsv', file('posts.csv'));
//$pold = array_column($parr, 0);
//$pnew = array_column($parr, 1);
//$pid = $_GET['pid'];
//$pindex = array_search($pid, $pold);
$newurl = 'https://speedcube.de/forum/showthread.php?';
foreach ($_GET as $var => $val)
{
	$newurl .= $var.'=';
	if($var == 'tid' && $tindex != NULL)
		$newurl .= $tnew[$tindex];
	//elseif($var == 'pid' && $pindex != NULL)
		//$newurl .= $pnew[$pindex];
	else
		$newurl .= $val;
	$newurl .= '&';
}
$newurl = rtrim($newurl, '&');
header("HTTP/1.1 301 Moved Permanently");
header('Location: '.$newurl);
?>
