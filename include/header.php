<?php
error_reporting(0);
    session_start();
    if($_SESSION['user_id'] == "" && $_SESSION['usertype'] == "")
    {
        header('location:http://localhost/posbo/');
        exit;
    }


    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['usertype'];
    require_once('functions/cls_dbconfig.php');
	function __autoload($classname){
		require_once("functions/$classname.class.php");
	}

    $cls_datetime = new cls_datetime();
    $cls_user_info = new cls_user_info();
    $cls_store = new cls_store();
    $cls_employee = new cls_employee();
	$cls_supplier = new cls_supplier();
    $cls_category = new cls_category();
    $cls_customer = new cls_customer();
    $cls_item = new cls_item();
    $cls_purchase = new cls_purchase();
    $cls_stock = new cls_stock();
	$cls_sales = new cls_sales();
	$cls_itemunit = new cls_itemunit();
	$cls_points = new cls_points();

    //store info//
    $query = $cls_store->viewstore($user_id);
    $row = $query->fetch_assoc();

    //user info//
    $user_query = $cls_user_info->get_user($user_id, $user_type);
    $us_row = $user_query->fetch_assoc();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Point of Sale</title>


<base href="<?php echo $cls_store::$base_url; ?>">
<META NAME="DCIT" CONTENT="DCIT">
<!--    favicon Icon set-->
 <link rel="icon" type="image/x-icon" href="images/dcit.ico">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />


<link href="css/animate.css" rel="stylesheet" type="text/css" />
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<link href="css/jquerysctipttop.css" rel="stylesheet" type="text/css">

<link href="plugins/kalendar/kalendar.css" rel="stylesheet">
<link rel="stylesheet" href="plugins/scroll/nanoscroller.css">
<link href="pluginsplugins/morris/morris.css" rel="stylesheet" />
<!--for file upload-->
<link rel="stylesheet" href="plugins/file-uploader/css/blueimp-gallery.min.css">
<link rel="stylesheet" href="plugins/file-uploader/css/jquery.fileupload.css">
<link rel="stylesheet" href="plugins/file-uploader/css/jquery.fileupload-ui.css">
<!--file upload end here-->

<!--plugin data table-->
<link href="plugins/data-tables/DT_bootstrap.css" rel="stylesheet">
<link href="plugins/advanced-datatable/css/demo_table.css" rel="stylesheet">
<link href="plugins/advanced-datatable/css/demo_page.css" rel="stylesheet">
<!--plugin data table end-->

<!--date picker-->
<link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/css/datepicker.css" />
<link rel="stylesheet" type="text/css" href="plugins/bootstrap-timepicker/compiled/timepicker.css" />
<link rel="stylesheet" type="text/css" href="plugins/bootstrap-colorpicker/css/colorpicker.css" />

<!--date picker end-->

<!--site script and css add here-->
<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/logout.js"></script>
<script type="text/javascript" src="js/shortcut.js"></script>
<script type="text/javascript" src="js/shortcut_key.js"></script>
<script type="text/javascript" src="ajax/supplier.js"></script>
<script type="text/javascript" src="ajax/user.js"></script>
<script type="text/javascript" src="ajax/employee.js"></script>
<script type="text/javascript" src="ajax/category.js"></script>
<script type="text/javascript" src="ajax/customer.js"></script>
<script type="text/javascript" src="ajax/item.js"></script>
<script type="text/javascript" src="ajax/purchase.js"></script>
<script type="text/javascript" src="ajax/sales.js"></script>
<script type="text/javascript" src="ajax/purchase_report.js"></script>
<script type="text/javascript" src="ajax/sales_report.js"></script>
<script type="text/javascript" src="ajax/profit_loss_report.js"></script>
<script type="text/javascript" src="ajax/itemUnit.js"></script>
<script type="text/javascript" src="ajax/damage.js"></script>
<script type="text/javascript" src="ajax/barcode.js"></script>
<script type="text/javascript" src="ajax/points.js"></script>
<script type="text/javascript" src="ajax/saleByPoints.js"></script>

<script>
    function PreviewImage(upname, prv_id) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementsByName(upname)[0].files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById(prv_id).src = oFREvent.target.result;
        };
    };


   // setTimeout(function(){
  // window.location.reload(1);
//}, 5000);
</script>


<!--site script and css end here-->
</head>
<body class="dark_theme  fixed_header left_nav_fixed">
<div class="wrapper">
  <!--\\\\\\\ wrapper Start \\\\\\-->
  <div class="header_bar">
    <!--\\\\\\\ header Start \\\\\\-->
    <div class="brand">
      <!--\\\\\\\ brand Start \\\\\\-->
      <div class="logo" style="display:block"><span class="theme_color"><?php echo substr($row['company_name'], 0 ,12); ?></span></div>
      <div class="small_logo" style="display:none"><img src="images/s-logo.png" width="50" height="47" alt="s-logo" /> <img src="images/r-logo.png" width="122" height="20" alt="r-logo" /></div>
    </div>
    <!--\\\\\\\ brand end \\\\\\-->
    <div class="header_top_bar">
      <!--\\\\\\\ header top bar start \\\\\\-->
      <a href="javascript:void(0);" class="menutoggle"> <i class="fa fa-bars"></i> </a>
      <div class="top_left">
        <div class="top_left_menu">
          <ul>
            <li> <a href="javascript:void(0);"><i class="fa fa-repeat"></i></a> </li>
            <li class="dropdown"> <a data-toggle="dropdown" href="javascript:void(0);"> <i class="fa fa-th-large"></i> </a>
			<ul class="drop_down_task dropdown-menu" style="margin-top:39px">
				<div class="top_left_pointer"></div>
				<li><div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember">
                    Remember me </label>
                </div></li>
				<li> <a><i class="fa fa-question-circle"></i> Help</a> </li>
				<li> <a href="storesetting"><i class="fa fa-cog"></i> Setting </a></li>
				<li> <a href="post_url/signout"><i class="fa fa-power-off"></i> Logout</a> </li>
		  </ul>
			</li>
          </ul>
        </div>
      </div>



        <div class="top_right_bar">
            <div class="top_right">
                    <div class="top_right_menu">
                         <ul>
                            <li class="dropdown"> <a href="javascript:void(0);" data-toggle="dropdown">
                                <?php
                                $cus_num = $cls_points->view_points_cus_num();
                                $noti_num = $cus_num->fetch_assoc();


                                ?>
                                 <span style="color:#fff;"> Points </span> <span class="badge"><?php echo (isset($noti_num['number']) && !empty($noti_num['number'])?$noti_num['number']:0) ?></span> </a>
                              <ul class="drop_down_task dropdown-menu">
                                    <div class="top_pointer"></div>
                                         <li>
                                               <p class="number"><?php echo (isset($noti_num['number']) && !empty($noti_num['number'])?$noti_num['number']:0) ?> customer found </p>
                                          </li>
                                  <?php
                                  $points_info = $cls_points->view_cus_points_details();

                                  $data = array();
                                  while($cus_points = $points_info->fetch_assoc()) {
                                      $data[] = $cus_points;
                                  }
                                  if(count($data)>0){
                                      foreach($data as $row_val){
                                  ?>
                                            <li> <a href="javascript:void(0);" class="task" >
                                                 <div class="green_status task_height" style="width:80%;"></div>
                                                  <div class="task_head"> <span class="pull-left"><?php echo (isset($row_val['cus_name']) && !empty($row_val['cus_name'])?$row_val['cus_name']:'') ?></span>
                                                      <span class="pull-right green_label"><?php echo (isset($row_val['points']) && !empty($row_val['points'])?$row_val['points']:'') ?></span> </div>
                                                  </a>
                                            </li>
                                  <?php } }?>
                                            <li> <span class="new">  </span> </li>
                                        </ul>
                                     </li>
                                 </ul>
                           </div>
                  </div>
        <div class="user_admin dropdown"> <a href="javascript:void(0);" data-toggle="dropdown"><img src="images/user.png" height="40" width="40"/><span class="user_adminname"><?php echo $_SESSION['name']; ?></span> <b class="caret"></b> </a>
          <ul class="dropdown-menu">
            <div class="top_pointer"></div>
            <li> <a href="profile"><i class="fa fa-user"></i> Profile</a> </li>
            <li> <a href="help.html"><i class="fa fa-question-circle"></i> Help</a> </li>
            <li> <a href="storesetting"><i class="fa fa-cog"></i> Setting </a></li>
            <li> <a href="post_url/signout"><i class="fa fa-power-off"></i><span id="">Logout</span></a> </li>
          </ul>
        </div>

        <a href="javascript:;" class="toggle-menu menu-right push-body jPushMenuBtn rightbar-switch"><i class="fa fa-comment chat"></i></a>

      </div>
    </div>
    <!--\\\\\\\ header top bar end \\\\\\-->
  </div>
  <!--\\\\\\\ header end \\\\\\-->
  <div class="inner">
    <!--\\\\\\\ inner start \\\\\\--><div class="left_nav con_min_height">

      <!--\\\\\\\left_nav start \\\\\\-->
      <div class="search_bar"> <i class="fa fa-search"></i>
        <input name="" type="text" class="search" placeholder="Search Dashboard..." />
      </div>
      <div class="left_nav_slidebar">
        <ul>
          <li class="left_nav_active theme_border"><a href="dashboard"><i class="fa fa-home"></i> DASHBOARD <span class="left_nav_pointer"></span> <span class="plus"><i class="fa fa-plus"></i></span> </a>
          </li>
            <?php
            if($user_type != "employee")
            {
                ?>
          <li> <a href="javascript:void(0);"> <i class="fa fa-edit"></i> SETTINGS <span class="plus"><i class="fa fa-plus"></i></span></a>
            <ul>

              <li> <a href="storesetting"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Store Settings</b> </a> </li>

              <li> <a href="profile"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Profile</b> </a> </li>

                    <!--<li> <a href="database_backup"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Database Backup</b> </a> </li>-->
            </ul>
          </li>
            <?php } ?>
          <!--employee-->
          <?php
                    if($user_type != "employee")
                    {
                ?>
          <li> <a href="javascript:void(0);"> <i class="fa fa-edit"></i> EMPLOYEE <span class="plus"><i class="fa fa-plus"></i></span></a>
            <ul>
              <li> <a href="employeeadd"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Add Employee</b> </a> </li>
              <li> <a href="employeemanage"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Manage Employee</b> </a> </li>
            </ul>
          </li>
          <?php } ?>
            <?php
            if($user_type != "employee")
            {
                ?>
          <!--employee end-->
          <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> CATEGORY <span class="plus"><i class="fa fa-plus"></i></span></a>
            <ul>
              <li> <a href="categoryAdd"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Add Category</b> </a> </li>
              <li> <a href="categoryManage"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Manage Category</b> </a> </li>
            </ul>
          </li>
          <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> ITEMS <span class="plus"><i class="fa fa-plus"></i></span></a>
            <ul>
              <li> <a href="itemAdd"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Add Items</b> </a> </li>
              <li> <a href="itemManage"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Manage Items</b> </a> </li>
			  <li> <a href="itemPrice"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Item Pricing</b> </a> </li>
			  <li> <a href="itemUnit"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Add Item Unit</b> </a> </li>
			  <li> <a href="itemUnitManage"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Manage Item Unit</b> </a> </li>
			   <li> <a href="itemDamageAdd"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Add Damage Item</b> </a> </li>
			   <li> <a href="itemDamageRecovery"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Recover Damage</b> </a> </li>
            </ul>
          </li>

          <!--supplier-->
          <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> SUPPLIER <span class="plus"><i class="fa fa-plus"></i></span></a>
            <ul>
              <li> <a href="supplierAdd"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Add Supplier</b> </a> </li>
              <li> <a href="supplierManage"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Manage Supplier</b> </a> </li>
              <li> <a href="supplierPayment"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Payment</b> </a> </li>

              <li> <a href="supDueReport"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Supplier Due Report</b> </a> </li>

            </ul>
          </li>
            <?php } ?>
          <!--supplier end-->

            <?php
            if($user_type != "employee")
            {
            ?>
          <!--customer-->
          <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> CUSTOMER <span class="plus"><i class="fa fa-plus"></i></span></a>
            <ul>
              <li> <a href="customerAdd"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Add Customer</b> </a> </li>
              <li> <a href="customerManage"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Manage Customer</b> </a> </li>
              <li> <a href="customerTypeAdd"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Add Customer Type</b> </a> </li>
              <li> <a href="custypemanage"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Mange Customer Type</b> </a> </li>
              <li> <a href="cutomerRecpay"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Receive Payment</b> </a> </li>
              <li> <a href="cusDueReport"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Customer Due Report</b> </a> </li>
            </ul>
          </li>
          <!--customer end-->



          <!--purchase-->

          <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> PURCHASE <span class="plus"><i class="fa fa-plus"></i></span></a>
              <ul>
              <li> <a href="purchase"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Purchase</b> </a> </li>
<!--              <li> <a href="purchaseManage"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Manage Purchase</b> </a> </li>-->
              <li> <a href="purchaseReport"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Purchase Report</b> </a> </li>
<!--              <li> <a href="purchaseInvReport"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Invoice Report</b> </a> </li>-->
              </ul>
          </li>
            <?php } ?>
          <!--purchase end-->

          <!--sale-->
          <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> SALES <span class="plus"><i class="fa fa-plus"></i></span></a>

          <ul>
              <li> <a href="sales"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Sales</b> </a> </li>
              <?php
              if($user_type != "employee")
              {
              ?>
              <li> <a href="salesReport"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Sales Report</b> </a> </li>
              <?php } ?>
            </ul>
          </li>
          <!--sale end-->

          <!--report-->
          <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> REPORT <span class="plus"><i class="fa fa-plus"></i></span></a>
            <ul>
              <li> <a href="availableStock"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Available Stock</b> </a> </li>
              <?php
                    if($user_type != "employee")
                    {
                ?>
			  <li> <a href="proftlossReport"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Profit Loss Report</b> </a>
              <li> <a href="barcode_print"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Barcode Print</b> </a>			  </li>
           <?php } ?>
            </ul>
          </li>
          <!--report end-->
            <?php
            if($user_type != "employee")
            {
            ?>
          <!--Points start-->
            <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> POINTS <span class="plus"><i class="fa fa-plus"></i></span></a>
                <ul>
                    <li> <a href="pointsAdd"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Add Points</b> </a> </li>
                    <li> <a href="pointsManage"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Manage Points</b> </a> </li>
                    <li> <a href="pointsSale"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Sale by Points</b> </a> </li>
                    <li> <a href="customerPoints"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Customer Points</b> </a> </li>
                    <li> <a href="pointsReport"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Points Report</b> </a> </li>
                </ul>
            </li>
            <!--Points end-->
            <!--exchange-->
<!--          <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Exchange <span class="plus"><i class="fa fa-plus"></i></span></a>
            <ul>
              <li> <a href="availableStock"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Exchange Product</b> </a> </li>
              <li> <a href="availableStock"> <span>&nbsp;</span> <i class="fa fa-circle"></i> <b>Manage Exchange</b> </a> </li>
            </ul>
          </li>-->
          <!--exchange end-->
            <?php } ?>
            <li style="border-bottom:2px solid #FFF;padding-top:10px;padding-bottom:10px;"></li>

            <li style="border-bottom:2px solid #FFF;"></li>
        </ul>
      </div>
    </div>
    <!--\\\\\\\left_nav end \\\\\\-->
