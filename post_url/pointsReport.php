<?php
	session_start();
	require_once('../functions/cls_dbconfig.php');
	function __autoload($classname){
		require_once("../functions/$classname.class.php");
	}
	
    $user_id = $_SESSION['user_id'];
	$cls_points = new cls_points();
	$cls_item = new cls_item();
	$cls_store = new cls_store();

	$starts_pts = "$_POST[starts_pts]";
	$end_pts = "$_POST[end_pts]";

    $query = $cls_points->pointsReport_by_points($starts_pts, $end_pts);
    $row_c = $query->num_rows;


    if($row_c > 0)
    {
?>
<div class="porlets-content">
            <div class="table-responsive">
                <table class="display table table-bordered table-striped" id="dynamic-table">
                  <thead>
                    <tr>
                      <th>SL.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Points</th>
                        <th>Customer Type</th>
<!--                      <th>Action</th>-->
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                    $sl = 1;
                    $g_total = 0.00;

                   $query2 = $cls_points->pointsReport_by_points($starts_pts, $end_pts);
					
                    while($rep_row = $query2->fetch_assoc()){


?>
                    <tr class="gradeC">
                      <td><?php if($sl < 10) { echo '0';} echo $sl++; ?></td>
                        <td><?php echo $rep_row['cus_name']; ?></td>
                        <td><?php echo $rep_row['email']; ?></td>
                        <td><?php echo $rep_row['mobile']; ?></td>
                        <td><?php echo $rep_row['points']; ?></td>
                        <td><?php echo $rep_row['customer_type']; ?></td>
<!--                      <td class="center">-->
<!--                      <a id="" href="pointsSale/id/--><?php //echo $rep_row['id']; ?><!--" name="abcd" class="btn btn-primary"  target='_new'">Sale by Points</a></td>-->
                    </tr>
                <?php
                    }
?>
                 
                  </tbody>
                  <tfoot>
                    <tr>
                      
                    </tr>
                  </tfoot>
                </table>
                
              </div><!--/table-responsive-->
            </div><!--/porlets-content-->

        <br><br>
        <br><br>
        <?php

        $query5 = $cls_store->viewstore();
        $com_info = $query5->fetch_assoc();
        ?>

        <!--invoice report-->
        <div class="row">
            <div class="col-md-12" style="!border:1px dashed #333;">
                <input type="button" name="pur_report_print" id="btnPrint" class="btn btn-primary" value="Print">
                <div class="block-web" id="content">
                    <div class="header">
                        <div style="height:auto;border-bottom:1px dashed #000;padding:5px; padding-bottom:10px;text-align:center;font-size:15px;">

                            <img src="images/logo.png" alt="" height="50" width="50" style="border-radius: 30px;">
                            <br>
                            <?php echo $com_info['company_name']; ?><br><?php echo $com_info['address']; ?>
                        </div>
                        <div align="center" style="border-top:1px dashed #333;border-bottom:1px dashed #333;font-size:16px;font-weight:bold;height:35px;line-height:35px;">PURCHASE REPORT</div>
                        <div style="border-bottom:1px dashed #333;"></div>
                    </div>
                    <div class="porlets-content">
                        <div class="table-responsive" >

                            <table class="display table table-bordered table-striped" id="dynamic-table" >
                                <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th class="hidden-phone">Cus ID</th>
                                    <th>Cus Name</th>
                                    <th>Points</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sl = 1;
                                $g_total = 0.00;

                                $query2 = $cls_points->pointsReport_by_points($starts_pts, $end_pts);

                                while($rep_row = $query2->fetch_assoc()){


                                    ?>
                                    <tr class="gradeC">
                                        <td><?php if($sl < 10) { echo '0';} echo $sl++; ?></td>
                                        <td class="hidden-phone"><?php echo $rep_row['id']; ?></td>
                                        <td><?php echo $rep_row['cus_name']; ?></td>
                                        <td><?php echo $rep_row['points']; ?></td>

                                    </tr>
                                    <?php
                                }
                                ?>

                                </tbody>
                                <tfoot>
                                <tr>

                                </tr>
                                </tfoot>
                            </table>


                        </div><!--/table-responsive-->
                    </div><!--/porlets-content-->


                </div><!--/block-web-->

            </div><!--/col-md-12-->
        </div>

        <!--invoice report End -->
          <?php
    } else { 
        echo "<h6 style='padding:14px 0 0 0;font-weight:bold;'>No Result Found!</h6>";
    }
?>




<script src="js/jquery-2.1.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/common-script.js"></script>
 
    <!-- income statement print only-->
    <script type="text/javascript">
        $("#btnPrint").on("click", function() {
		   var params = [
                'height=' + screen.height,
                'width=' + screen.width,
                'fullscreen=yes' // only works in IE, but here for completeness
            ].join(',');

            var divContents = $("#content").html();
            // var companyName = $("#cname").html();

            var printWindow = window.open('', '', params);
            printWindow.document.write('<html><head><title>Purchase report</title>');
            printWindow.document.write('</head><body >');
            // printWindow.document.write(companyName);
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>
	<script type="text/javascript" src="js/jspdf.debug.js"></script>
	 

<!--date picker-->
<script type="text/javascript" src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> 
<script type="text/javascript" src="js/form-components.js"></script> 
<!--date picker end-->


<script>
/*==Porlets Actions==*/
    $('.minimize').click(function(e){
      var h = $(this).parents(".header");
      var c = h.next('.porlets-content');
      var p = h.parent();
      
      c.slideToggle();
      
      p.toggleClass('closed');
      
      e.preventDefault();
    });
    
    $('.refresh').click(function(e){
      var h = $(this).parents(".header");
      var p = h.parent();
      var loading = $('&lt;div class="loading"&gt;&lt;i class="fa fa-refresh fa-spin"&gt;&lt;/i&gt;&lt;/div&gt;');
      
      loading.appendTo(p);
      loading.fadeIn();
      setTimeout(function() {
        loading.fadeOut();
      }, 1000);
      
      e.preventDefault();
    });
    
    $('.close-down').click(function(e){
      var h = $(this).parents(".header");
      var p = h.parent();
      
      p.fadeOut(function(){
        $(this).remove();
      });
      e.preventDefault();
    });
	
	$('#promo_from').datepicker({format: 'yyyy-mm-dd'});
         $('#promo_from').on('changeDate', function(ev){
             $(this).datepicker('hide');
        });
 $('#promo_to').datepicker({format: 'yyyy-mm-dd'});
         $('#promo_to').on('changeDate', function(ev){
             $(this).datepicker('hide');
        });


</script>

<!--date table-->

<script src="plugins/data-tables/jquery.dataTables.js"></script>
<script src="plugins/data-tables/DT_bootstrap.js"></script>
<script src="plugins/data-tables/dynamic_table_init.js"></script>
<script src="plugins/edit-table/edit-table.js"></script>
<script>
          jQuery(document).ready(function() {
              EditableTable.init();
          });
 </script>


<script src="plugins/demo-slider/demo-slider.js"></script>
<script src="plugins/knob/jquery.knob.min.js"></script> 
 
<?php //require_once("../include/footer.php"); ?>