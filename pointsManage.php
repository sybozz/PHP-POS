<?php require_once("include/header.php"); ?>
    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Points</h1>
          <h2 class="">Manage Points</h2>
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
        <div class="col-md-12">
          <div class="block-web">
           <div class="header">
              <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
              <h3 class="content-header">Manage Points</h3>
            </div>
         <div class="porlets-content">
            <div class="table-responsive">
                <table  class="display table table-bordered table-striped" id="dynamic-table">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>Taka From</th>
                      <th>Taka To</th>
                      <th>Points</th>
                    
					  <th  class="center hidden-phone">Action</th>
                    </tr>
                  </thead>
                  <tbody>
				  	<?php
                 $i=1;
                $points = $cls_points->view_points();
                while($points_list = $points->fetch_assoc()){
               
			?>
                    <tr class="gradeX">
                      <td><?php echo $i++; ?></td>
                      <td><?php echo $points_list['taka_from']?></td>
                      <td><?php echo $points_list['taka_to']?></td>
                      <td><?php echo $points_list['points']?></td>
					  
					  <td class="center hidden-phone"><a class="btn btn-primary" href="pointsEdit/p_id/<?php echo $points_list['id']?>">Edit</a></td>
                    </tr>     
				<?php }?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Supplier Name</th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th  class="center hidden-phone">Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div><!--/table-responsive-->
            </div><!--/porlets-content-->
            
            
          </div><!--/block-web--> 
        </div><!--/col-md-12--> 
      </div><!--/row-->
      
          </div>
        </section>
      </div>
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->

<?php require_once("include/footer.php"); ?>