<?php require_once("include/header.php"); ?>
    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Points</h1>
          <h2 class=""> customer points</h2>
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
              <h3 class="content-header">Customer points List</h3>
            </div>
         <div class="porlets-content">
            <div class="table-responsive">
                <table class="display table table-bordered table-striped" id="dynamic-table">
                  <thead>
                    <tr>
                      <th>SL NO.</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Points</th>
                      <th>Customer Type</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                    $sl = 1;
                    $query = $cls_customer->get_all_customer();
                    while($cus_row = $query->fetch_assoc())
                    {

?>
                    <tr class="gradeC">
                      <td><?php if($sl < 10) { echo '0';} echo $sl++; ?></td>
                      <td><?php echo $cus_row['cus_name']; ?></td>
                      <td><?php echo $cus_row['email']; ?></td>
                      <td><?php echo $cus_row['mobile']; ?></td>
                      <td><?php echo $cus_row['points']; ?></td>
                      <td><?php echo $cus_row['customer_type']; ?></td>
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
      </div><!--/row-->
      
           </div>
          </div>    
      </div>
    </div>
    
    
    <!--\\\\\\\ content panel end \\\\\\-->

<?php require_once("include/footer.php"); ?>