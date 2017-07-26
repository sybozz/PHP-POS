<?php
	session_start();
    require_once('../functions/cls_dbconfig.php');
	function __autoload($classname){
		require_once("../functions/$classname.class.php");
	}
	
	$cls_purchase = new cls_purchase();
	
    //$user_id = $_SESSION['user_id'];
	$pur_table_id =  $_POST['pur_table_id'];
	$pur_price=  $_POST['pur_price'];
	$pur_subtotal_price =  $_POST['pur_subtotal_price'];

	echo $cls_purchase->purchase_price_update($pur_table_id, $pur_price, $pur_subtotal_price);
?> 