<?php
	session_start();
	require_once('../functions/cls_dbconfig.php');
	function __autoload($classname){
		require_once("../functions/$classname.class.php");
	}
	
    $user_id = $_SESSION['user_id'];
	$cls_purchase = new cls_purchase();
	$cls_supplier = new cls_supplier();
	$cls_item = new cls_item();
	$cls_store = new cls_store();

	$supplier_id = "$_POST[supplier_id]";
	$item_id = "$_POST[item_id]";
	$from_date = "$_POST[from_date]";
	$to_date = "$_POST[to_date]";

    $query = $cls_purchase->view_per_report($supplier_id, $item_id, $from_date, $to_date);
    $row_c = $query->num_rows;

    //$query1 = $cls_purchase->view_report_supp($supplier_id);
   // $row_c1 = $query1->num_rows;

    if($row_c > 0)
    {
?>
<div class="porlets-content">
            <div class="table-responsive">
                <table class="display table table-bordered table-striped" id="dynamic-table">
                  <thead>
                    <tr>
                      <th>SL.</th>
                      <th class="hidden-phone">Date</th>
                      <th>Supplier</th>
                      <th>Invoice</th>
                      <th>Item</th>
                      <th>Qty</th>
                      
                      <th class="hidden-phone">Item Price</th>
                      <th style="text-align:center;" class="hidden-phone">Total</th>
                      <th class="hidden-phone">Saved by</th>
                      <th class="hidden-phone">Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                    $sl = 1;
                    $g_total = 0.00;
					
					 $query2 = $cls_purchase->view_per_report($supplier_id, $item_id, $from_date, $to_date);
					
                    while($rep_row = $query2->fetch_assoc()){
                    $supp = $rep_row['sup_id'];
                    $item = $rep_row['item_id'];
                        
                    $s_query = $cls_supplier->view_byid($supp);
                    $s_row = $s_query->fetch_assoc();
                        
                    $item_query = $cls_item->viewitemby_id($item);
                    $item_row = $item_query->fetch_assoc();
                        
                    $g_total = $g_total + $rep_row['ttl_price'];

?>
                    <tr class="gradeC">
                      <td><?php if($sl < 10) { echo '0';} echo $sl++; ?></td>
                      <td class="center"><?php echo $rep_row['pur_date']; ?></td> 
                      <td><?php echo $s_row['c_name']; ?></td>
                      <td><?php echo $rep_row['invoice']; ?></td>
                      <td><?php echo $item_row['item_name']; ?></td>
                      <td><?php echo $rep_row['quantity']; ?></td>
                      
                      <td class="center"><?php echo $rep_row['price']; ?></td>
                      <td class="center" style="text-align:right;"><?php echo number_format($rep_row['ttl_price'], 2, '.', ','); ?></td>
                      <td class="center"><?php echo $rep_row['name']; ?></td>
                      <td class="center" style="padding:8px 2px;width:15%;">
                          <a id="" href="puredit/pur_id/<?php echo $rep_row['id']; ?>" name="abcd" class="btn btn-primary"  target='_new' style="margin-top:2px;">Edit</a>
                          <a id="" href="purdetails/pur_id/<?php echo $rep_row['pur_id']; ?>" name="abcd" class="btn btn-primary"  target='_new'  style="margin-top:2px;">Details</a>
                      </td>
                    </tr>
                <?php
                    }
?>
                <tr class="gradeC">
                      <td></td>
                      <td class="center"></td>
                      <td class="center"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td class="center"></td>
                    <td class="center" style="text-align:center;"><span style="font-weight:bold;">Total: <?php echo number_format($g_total, 2, '.', ','); ?></span></td>
                      <td class="center"></td>
                      <td class="center"></td>
                    </tr>
                 
                  </tbody>
                  <tfoot>
                    <tr>
                      
                    </tr>
                  </tfoot>
                </table>
                
              </div><!--/table-responsive-->
            </div><!--/porlets-content-->
            
           
          <?php
    } else { 
        echo "<h6 style='padding:14px 0 0 0;font-weight:bold;'>No Result Found!</h6>";
    }
?>


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
                        <div style="width:100%;height:auto;border-bottom:1px dashed #000;padding:5px; padding-bottom:10px;text-align:center;font-size:15px;">

                            <img src="images/logo.png" alt="" height="50" width="50" style="border-radius: 30px;">
                            <br>
                            <?php echo $com_info['company_name']; ?><br><?php echo $com_info['address']; ?>
                        </div>
                        <div align="center" style="border-top:1px dashed #333;border-bottom:1px dashed #333;font-size:16px;font-weight:bold;height:35px;line-height:35px;">PURCHASE REPORT</div>
                        <div style="border-bottom:1px dashed #333;"></div>
                    </div>
                    <div class="porlets-content">
                        <div class="table-responsive" >
						
                            <table class="table table-hover font_sm" >
                                <thead>
									 <tr>
										  <th>SL.</th>
										  <th class="center">Date</th>
										  <th class="center">Invoice</th>
										  <th class="center">Supplier</th>
										  
										  <th class="center">Item</th>
										  <th class="center">Qty</th>
										  
										  <th class="center">Item Price</th>
										  <th style="text-align:center;" class="hidden-phone">Total</th>
										  <th class="center">Saved by</th>
										 
									</tr>
                                </thead>
								
                                <tbody>
								
								
								
								   <?php
									$sl = 1;
									$g_total = 0.00;
									while($rep_row = $query->fetch_assoc()){
									$supp = $rep_row['sup_id'];
									$item = $rep_row['item_id'];
										
									$s_query = $cls_supplier->view_byid($supp);
									$s_row = $s_query->fetch_assoc();
										
									$item_query = $cls_item->viewitemby_id($item);
									$item_row = $item_query->fetch_assoc();
										
									$g_total = $g_total + $rep_row['ttl_price'];

				?>
									<tr >
									  <td><?php if($sl < 10) { echo '0';} echo $sl++; ?></td>
									  <td class="center" style="font-size:12px;"><?php echo date('d-m-y',strtotime($rep_row['pur_date'])); ?></td> 
									  <td class="center" style="font-size:12px;"><?php echo $rep_row['invoice']; ?></td>
									  <td class="center" style="font-size:12px;"><?php echo $s_row['c_name']; ?></td>
									  
									  <td class="center" style="font-size:12px;"><?php echo $item_row['item_name']; ?></td>
									  <td class="center" style="font-size:12px;"><?php echo $rep_row['quantity']; ?></td>
									  
									  <td class="center" style="font-size:12px;"><?php echo $rep_row['price']; ?></td>
									  <td class="center" style="font-size:12px;"><?php echo number_format($rep_row['ttl_price'], 2, '.', ','); ?></td>
									  <td class="center" style="font-size:12px;"><?php echo $rep_row['name']; ?></td>
									   
									</tr>
								<?php
									}
				?>
										<tr>
										  <td> </td>
										  <td ></td>
										  <td ></td>
										  <td ></td>
										  
										  <td ></td>
										  <td ></td>
										  
										  <td >Total:</td>
										  <td ><span style="font-weight:bold;"> <?php echo number_format($g_total, 0, '.', ','); ?></span></td>
										  <td ></td>
										 
									</tr>
									
								  </tbody>
								   
                            </table>


                        </div><!--/table-responsive-->
                    </div><!--/porlets-content-->


                </div><!--/block-web-->
				 
            </div><!--/col-md-12-->
        </div>

        <!--invoice report End -->

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