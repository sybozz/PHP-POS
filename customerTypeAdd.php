<?php require_once("include/header.php"); ?>
<script>
$(function() {
  $("[name='CategoryName']").focus();
});
</script>
<div class="contentpanel">
    <!--\\\\\\\ contentpanel start\\\\\\-->
    <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
            <h1>CUSTOMER</h1>
            <h2 class="">Add Customer Type</h2>
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
                                <h3 class="content-header">Add Customer Type </h3>
                            </div>

                            <div class="porlets-content">
                                <form  id="custype_add" action="" method="post" class="form-horizontal row-border" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Customer Type</label>
                                        <div class="col-sm-9">
                                            <input  type="text"  name="customertype" required  class="form-control" id="customertype" placeholder="Customer Type" >
											<span id ="custype_exist"></span>
                                        </div>
                                    </div><!--/form-group-->

                                    <div>
                                        <input type="submit" id="custype_add" name="custype_add" class="btn btn-primary" value="Save">

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