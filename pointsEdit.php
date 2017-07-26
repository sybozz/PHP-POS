<?php require_once("include/header.php");
$p_id = htmlspecialchars($_REQUEST['p_id'], ENT_QUOTES, 'UTF-8');
$query = $cls_points->view_points_by_id($p_id);
$points_row = $query->fetch_assoc();

?>
<script>
$(function() {
  $("[name='taka_from']").focus();
});
</script>
<div class="contentpanel">
    <!--\\\\\\\ contentpanel start\\\\\\-->
    <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
            <h1>POINTS</h1>
            <h2 class="">Add Points</h2>
        </div>
        <div class="pull-right">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Dashboard</a></li>
                <li class="active">Settings</li>
            </ol>
        </div>
    </div>
    <div class="container clear_both padding_fix">
        <section class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="block-web">
                            <div class="header">
                                <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a><a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
                                <h3 class="content-header">Points  Add Form</h3>
                            </div>
                            <div class="porlets-content">
                                <form action="" id="points_update_form" method="post" class="form-horizontal row-border">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Taka range</label>
                                        <div class="col-sm-9">
                                            <div class="input-group input-large">
                                                <input type="text" class="form-control" name="taka_from" required placeholder="From" onkeypress="return OnlyNumberKey(event);" value="<?php echo $points_row['taka_from']; ?>">
                                                <span class="input-group-addon">To</span>
                                                <input type="text" class="form-control" name="taka_to" required placeholder="To" onkeypress="return OnlyNumberKey(event);" value="<?php echo $points_row['taka_to']; ?>">
                                            </div>
                                        </div>
                                    </div><!--/form-group-->

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Points</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="points" placeholder="Points" required onkeypress="return OnlyNumberKey(event);" value="<?php echo $points_row['points']; ?>">
                                        </div>
                                    </div><!--/form-group-->


                                    <input type="hidden" name="points_id" value="<?php echo $points_row['id']; ?>">
                                    <input type="hidden" name="saved_by" value="<?php echo $_SESSION['user_id']; ?>">


                                    <div>
                                        <input type="submit" name="points_update_form" value="Update" class="btn btn-primary">
										   <a type="button" href="pointsManage" class="btn btn-default">Cancel</a>

                                    
                                    </div><!--/form-group-->
                                </form>
                            </div><!--/porlets-content-->
                        </div><!--/block-web--> 
                    </div><!--/col-md-6-->
                </div>

            </div>
        </section>
    </div>
</div>
<!--\\\\\\\ content panel end \\\\\\-->

<?php require_once("include/footer.php"); ?>