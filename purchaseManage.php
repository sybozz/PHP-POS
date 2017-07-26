<?php require_once("include/header.php"); ?>
    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Purchase</h1>
          <h2 class="">manage purchase</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li>Customer</li>
            <li class="active">Customer Manage</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix">
       <div id="main-content">
       <div class="page-content">
            <div class="row">
        <div class="col-md-12">
          <div class="block-web">
           <div class="header">
              <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
              <h3 class="content-header">Latest Purchase List</h3>
            </div>
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

                          $query2 = $cls_purchase->purchase_list();

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
                                  <td class="center">
                                      <a id="" href="purdetails/pur_id/<?php echo $rep_row['pur_id']; ?>" name="abcd" class="btn btn-primary"  target='_new'">Details</a></td>
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


              <?php

              ?>
            
            
          </div><!--/block-web--> 
        </div><!--/col-md-12--> 
      </div><!--/row-->
      
           </div>
          </div>    
      </div>
    </div>
    
    
    <!--\\\\\\\ content panel end \\\\\\-->

<?php require_once("include/footer.php"); ?>