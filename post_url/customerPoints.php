<?php
	require_once('../functions/cls_dbconfig.php');
	function __autoload($classname){
		require_once("../functions/$classname.class.php");
	}

    $cus_id = "$_POST[cus_id]";

//echo $cus_id;
	
	$cls_points = new  cls_points();
    $query = $cls_points->get_customer_points($cus_id);
    $row  = $query->fetch_assoc();
    echo $row['points'];
