<?php 
    require_once("include/header.php");
/*today sale query*/
if($user_type == "admin")
{
    $today_q = $cls_sales->today_sale_count();
	$total_sale_q = $cls_sales->total_sale_count();
    // $total_sale_q = $cls_sales->total_sale_count_admin();
	//$total_sale_row = $total_sale_q->fetch_assoc();
    
    $today_purchase = $cls_purchase->today_purchase_count();
    $today_purchase_count =$today_purchase->fetch_assoc();

    $total_pur_q = $cls_purchase->total_pur_count_admin();
	$total_pur_row = $total_pur_q->fetch_assoc();
    
} else {
    $today_q = $cls_sales->today_sale_count($user_id);
    $total_sale_q = $cls_sales->total_sale_count($user_id);
    
    $today_sales_item = $cls_sales->today_sale_item($user_id);
    $today_item_sale_row = $today_sales_item->fetch_assoc();    
    
	
	$total_sales_item = $cls_sales->total_sale_item_user($user_id);
    $total_item_sale_row = $total_sales_item->fetch_assoc();
}

    $today_row = $today_q->fetch_assoc();
    $total_sale_row = $total_sale_q->fetch_assoc();
	
	

/*end*/

?>
    <div class="contentpanel ">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Dashboard</h1>
          <h2 class="">Subtitle goes here...</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="dashboard">DASHBOARD</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix con_min_height">
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="row">
          <div class="col-sm-3 col-sm-6">
            <div class="information green_info">   
              <div class="information_inner">
              	<div class="info green_symbols"><i class="fa fa-users icon"></i></div>
                <span>TODAY SALES </span>
                <h2 class="bolded  heading_size"><?php echo number_format($today_row['today_sale']).'/='; ?></h2>
                <div class="infoprogress_green">
                  <div class="greenprogress"></div>
                </div>
                <b class=""><small>Better than yesterday ( 7,5% )</small></b>
                <div class="pull-right" id="work-progress1">
                  <canvas style="display: inline-block; width: 47px; height: 25px; vertical-align: top;" width="47" height="25"></canvas>
                </div>
              </div>
            </div>
          </div>
            <?php
            if($user_type == "admin")
            {
            ?>
            <div class="col-sm-3 col-sm-6">
                <div class="information green_info">
                    <div class="information_inner">
                        <div class="info green_symbols"><i class="fa fa-users icon"></i></div>
                        <span>TODAY PURCHASE </span>
                        <h2 class="bolded  heading_size"><?php echo number_format($today_purchase_count['today_purchase']).'/='; ?></h2>
                        <div class="infoprogress_green">
                            <div class="greenprogress"></div>
                        </div>
                        <b class=""><small>Better than yesterday ( 7,5% )</small></b>
                        <div class="pull-right" id="work-progress1">
                            <canvas style="display: inline-block; width: 47px; height: 25px; vertical-align: top;" width="47" height="25"></canvas>
                        </div>
                    </div>
                </div>
            </div>
           <?php }
    if($user_type == "admin")
    {
?>
          <div class="col-sm-3 col-sm-6">
            <div class="information green_info">   
              <div class="information_inner">
              	<div class="info green_symbols"><i class="fa fa-users icon"></i></div>
                <span>TOTAL SALES </span>
                <h2 class="bolded heading_size"><?php echo number_format($total_sale_row['total_sale']).'/='; ?></h2>
                <div class="infoprogress_green">
                  <div class="greenprogress"></div>
                </div>
                <b class=""><small>Better than yesterday ( 7,5% )</small></b>
                <div class="pull-right" id="work-progress1">
                  <canvas style="display: inline-block; width: 47px; height: 25px; vertical-align: top;" width="47" height="25"></canvas>
                </div>
              </div>
            </div>
          </div>
          <?php
    }
    if($user_type == "employee")
    {
?>
          <div class="col-sm-3 col-sm-6">
            <div class="information blue_info">
              <div class="information_inner">
              <div class="info blue_symbols"><i class="fa fa-shopping-cart icon"></i></div>
                <span>TODAY SALES ITEMS</span>
                <h1 class="bolded heading_size"><?php echo $today_item_sale_row['today_item']?> </h1>
                <div class="infoprogress_blue">
                  <div class="blueprogress"></div>
                </div>
                <b class=""><small>Better than yesterday ( 7,5% )</small></b>
                <div class="pull-right" id="work-progress2">
                  <canvas style="display: inline-block; width: 47px; height: 25px; vertical-align: top;" width="47" height="25"></canvas>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-sm-3 col-sm-6">
            <div class="information blue_info">
              <div class="information_inner">
              <div class="info blue_symbols"><i class="fa fa-shopping-cart icon"></i></div>
                <span>TOTAL SALES ITEMS</span>
                <h1 class="bolded heading_size"><?php echo $total_item_sale_row['total_item']?> </h1>
                <div class="infoprogress_blue">
                  <div class="blueprogress"></div>
                </div>
                <b class=""><small>Better than yesterday ( 7,5% )</small></b>
                <div class="pull-right" id="work-progress2">
                  <canvas style="display: inline-block; width: 47px; height: 25px; vertical-align: top;" width="47" height="25"></canvas>
                </div>
              </div>
            </div>
          </div>
          
          <?php } if($user_type == "admin") { ?>
          <div class="col-sm-3 col-sm-6">
            <div class="information red_info">
              <div class="information_inner">
              <div class="info red_symbols"><i class="fa fa-comments icon"></i></div>
                <span>TOTAL PURCHASE</span>
                <h2 class="bolded heading_size"><?php echo number_format($total_pur_row['total_purchase']).'/='; ?></h2>
                <div class="infoprogress_red">
                  <div class="redprogress"></div>
                </div>
                <b class=""><small>Better than yesterday ( 7,5% )</small></b>
                <div class="pull-right" id="work-progress3">
                  <canvas style="display: inline-block; width: 47px; height: 25px; vertical-align: top;" width="47" height="25"></canvas>
                </div>
              </div>
            </div>
          </div>
          <?php } if($user_type == "employee") { ?>
          <div class="col-sm-3 col-sm-6">
            <div class="information green_info">   
              <div class="information_inner">
              	<div class="info green_symbols"><i class="fa fa-users icon"></i></div>
                <span>TOTAL SALES </span>
                <h2 class="bolded  heading_size"><?php echo number_format($total_sale_row['total_sale']).'/='; ?></h2>
                <div class="infoprogress_green">
                  <div class="greenprogress"></div>
                </div>
                <b class=""><small>Better than yesterday ( 7,5% )</small></b>
                <div class="pull-right" id="work-progress1">
                  <canvas style="display: inline-block; width: 47px; height: 25px; vertical-align: top;" width="47" height="25"></canvas>
                </div>
              </div>
            </div>
          </div> <?php } ?>
        </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="block-web">
                            <div class="header">
                                <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
                                <h3 class="content-header">Item Low Stock Limit</h3>
                            </div>
                            <div class="porlets-content">
                                <div style="overflow:auto; height:400px;" class="table-responsive">
                                   <div id="result">
                                    <table class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Item Name</th>
                                                <th>Item Code</th>
                                                <th>Size</th>
                                                <th>Unit</th>
												<th>Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $item = $cls_stock->low_stock();
											$i = 1;
                                            $alerm=0;
                                            while ($item_list = $item->fetch_assoc()) {
                                                $alerm++;
                                                if($alerm == 1){ ?>
                                                <script>
                                                    var audio = new Audio('alert_tone/dingadongb_ho18zrjk.mp3');
                                                    audio.play();
                                                </script>
                                                <?php  } ?>
                                                <tr class="gradeX">
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $item_list['item_name'] ?></td>
                                                    <td><?php echo $item_list['item_code'] ?></td>
                                                    <td><?php echo $item_list['size'] ?></td>
                                                    <td><?php echo $item_list['unit'] ?></td>
													<td style="color:red;"><?php echo $item_list['available_stock']; ?></td>
                                                </tr>     
                                            <?php } ?>
                                        </tbody>
                                       
                                    </table>
                                    </div>
                                </div><!--/table-responsive-->
                            </div><!--/porlets-content-->
                        </div><!--/block-web--> 
                    </div><!--/col-md-12-->
                    <div class="col-md-6">
                        <div class="block-web">
                            <div class="header">
                                <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
                                <h3 class="content-header">Item Expire Date Info</h3>
                            </div>
                            <div class="porlets-content">
                                <div style="overflow:auto; height:400px;" class="table-responsive">
                                    <div id="result">
                                        <table class="display table table-bordered table-striped" id="dynamic-table">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Item Name</th>
                                                <th>Item Code</th>
<!--                                                <th>Mf Date</th>-->
<!--                                                <th>Exp. Date</th>-->
<!--                                                <th>Days Left</th>-->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
//                                            $item = $cls_stock->low_stock();
                                            $item = $cls_item->item_exdate();
                                            $i = 1;
                                            $alerm=0;
                                            while ($item_list = $item->fetch_assoc()) {
                                                $alerm++;
                                             ?>
                                                <tr class="gradeX">
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $item_list['item_name'] ?></td>
                                                    <td><?php echo $item_list['item_code'] ?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div><!--/table-responsive-->
                            </div><!--/porlets-content-->
                        </div><!--/block-web-->
                    </div><!--/col-md-12-->
                </div><!--/row-->

    

        
        
        

        <!--row end--> 
 
        
      </div>
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->
  </div>
  <!--\\\\\\\ inner end\\\\\\-->
</div>



<!-- /sidebar chats -->
<?php include_once('supplierShow.php'); ?>
   <script src="js/jquery-2.1.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/common-script.js"></script>
   
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/jquery.sparkline.js"></script>
<script src="js/sparkline-chart.js"></script>
<script src="js/graph.js"></script>
<script src="js/edit-graph.js"></script>


<script src="plugins/kalendar/kalendar.js" type="text/javascript"></script>
<script src="plugins/kalendar/edit-kalendar.js" type="text/javascript"></script>

<!--for chart-->
<script src="plugins/sparkline/jquery.sparkline.js" type="text/javascript"></script>
<script src="plugins/sparkline/jquery.customSelect.min.js" ></script> 
<script src="plugins/sparkline/sparkline-chart.js"></script> 
<script src="plugins/sparkline/easy-pie-chart.js"></script>

<script>
/*refresh*/
    $('.refresh').click(function(e){
      var h = $(this).parents(".header");
      var p = h.parent();
      var loading = $('<div class="loading"><i class="fa fa-refresh fa-spin"></i></div>');
      
      loading.appendTo(p);
      loading.fadeIn();
      setTimeout(function() {
        loading.fadeOut();
      }, 1000);
      
      e.preventDefault();
    });
    
    /*refresh end*/
</script>

<script src="plugins/morris/morris.min.js" type="text/javascript"></script> 
<script src="plugins/morris/raphael-min.js" type="text/javascript"></script>  
<script src="plugins/morris/morris-script.js"></script> 

<script src="js/jPushMenu.js"></script> 
<script src="js/side-chats.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="plugins/scroll/jquery.nanoscroller.js"></script>

<!--chart end-->


<?php //require_once("include/footer.php"); ?>
