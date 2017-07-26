<?php 
require_once("include/header.php");
/* if($user_type != "admin")
{
   echo "<script>location.replace('dashboard');</script>"; 
}*/

?>
<script>
$(function() {
  $("[name='empName']").focus();
});
</script>
<div class="contentpanel">
    <!--\\\\\\\ contentpanel start\\\\\\-->
    <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
            <h1>REPORT</h1>
            <h2 class="">Sales Report</h2>
        </div>
        <div class="pull-right">
            <ol class="breadcrumb">
                <li><a href="dashboard">Home</a></li>
                <li><a href="#">Report</a></li>
                <li class="active">Sales Report</li>
            </ol>
        </div>
    </div>
    <div class="container clear_both padding_fix">
        <section class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-web">
                            <div class="header">
                                <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a><a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
                                <h3 class="content-header">Sales Report</h3>
                            </div>

                        <div class="porlets-content">
                            <form action="" method="post" class="form-horizontal row-border" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="col-sm-4">
                               <label class="control-label">Employee</label>
                                <input type="text" class="form-control" name="empName" id="empName" placeholder="Select Employee name">
                             <select id="emp_show" required name="emp_id" size="15" style="height:150px!important;width:100%">
                             
                             <?php
                            $query = $cls_employee->view_emp_by_nameand_id($user_id);
                            $row  = $query->fetch_assoc();
if($user_type == "employee")
                                {
                            ?>
                            <option selected value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>

                            <?php } ?>

            </select>
                            </div>                        
                            <div class="col-sm-3">
                            <label class="control-label">Item</label>
                            <input type="text" name="itemName" required  class="form-control" id="" placeholder="Item Name" >
                                <select id="item_show" required name="item_id" size="15" style="height:150px!important;width:100%">

            </select>
                            </div>
                            
                            <div class="col-sm-4">
                            <label class="control-label">Date</label>
                    <div data-date-format="yyyy-mm-dd" data-date="2015-08-12" class="input-group input-large">
                      <input type="text" name="from_date" placeholder="From" class="form-control dpd1">
                      <span class="input-group-addon">To</span>
                      <input type="text" name="to_date" placeholder="To" class="form-control dpd2">
                    </div>
                            </div>
                        </div><!--/form-group-->

                        <div>
                            <input type="button" id="" name="view_sales_report" class="btn btn-primary" value="View Report">
                        </div><!--/form-group-->
                                </form>
                            </div><!--/porlets-content-->
    
                            <!--report view-->
                            <div id="sales_report_show"></div>
                             
                            <!--report view end-->
                        </div><!--/block-web--> 
                    </div><!--/col-md-12-->
                </div>

            </div>
        </section>
    </div>
</div>
<!--\\\\\\\ content panel end \\\\\\-->

<?php require_once("include/footer.php"); ?>