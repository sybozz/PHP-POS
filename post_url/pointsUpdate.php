<?php 
require_once('../functions/cls_dbconfig.php');
	function __autoload($class_name){
		require_once("../functions/$class_name.class.php");
	}
	
	$db= new DB();
	$cls_points = new cls_points();
	
	$points_id = "$_POST[points_id]";
	$taka_from = $db->con()->real_escape_string("$_POST[taka_from]");
	$taka_to = $db->con()->real_escape_string("$_POST[taka_to]");
	$points = $db->con()->real_escape_string("$_POST[points]");
	$saved_by = "$_POST[saved_by]";

//echo $taka_from;
	
	echo $cls_points->update_points($points_id,$taka_from,$taka_to,$points,$saved_by);

?>