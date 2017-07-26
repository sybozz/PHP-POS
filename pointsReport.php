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
            <h2 class="">Points Report </h2>
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
                                <h3 class="content-header">Points Report</h3>
                            </div>

                        <div class="porlets-content">
                            <form action="" method="post" class="form-horizontal row-border" enctype="multipart/form-data">
                        <div class="form-group">

                            <div class="col-sm-4">
                            <label class="control-label">Points</label>
                                <div  class="input-group input-large">
                                  <input type="text" name="start_pts" placeholder="Start Points" class="form-control" required onkeypress="return OnlyNumberKey(event);">
                                  <span class="input-group-addon">To</span>
                                  <input type="text" name="end_pts" placeholder="End Points" class="form-control" required onkeypress="return OnlyNumberKey(event);">
                                </div>
                            </div>
                        </div><!--/form-group-->

                        <div>
                            <input type="button" id="" name="view_points_report" class="btn btn-primary" value="View Report">
                        </div><!--/form-group-->
                                </form>
                            </div><!--/porlets-content-->
    
                            <!--report view-->
                            <div id="points_report_show"></div>
                             
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