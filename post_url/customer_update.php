<?php 
    session_start();
    $user_id = $_SESSION['user_id'];

    require_once('../functions/cls_dbconfig.php');
        function __autoload($class_name){
            require_once("../functions/$class_name.class.php");
        }
	$db = new DB();
	$cls_datetime = new cls_datetime();
	$cls_customer = new cls_customer();
	
	$cus_id = $db->con()->real_escape_string("$_POST[cus_id]");
	$cus_name = $db->con()->real_escape_string("$_POST[cus_name]");
	$email = $db->con()->real_escape_string("$_POST[email]");
	$mobile = $db->con()->real_escape_string("$_POST[mobile]");
	$address = $db->con()->real_escape_string("$_POST[address]");
	$birth_date = $db->con()->real_escape_string("$_POST[birth_date_val]");
	$customer_type = $db->con()->real_escape_string("$_POST[customer_type_val]");
	
	echo $cls_customer->customer_update($user_id, $cus_id, $cus_name, $email, $mobile, $address,$birth_date,$customer_type);

?>