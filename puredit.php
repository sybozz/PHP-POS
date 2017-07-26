<?php require_once("include/header.php"); ?>
<?php
//$item_id = htmlspecialchars($_REQUEST['pur_id'], ENT_QUOTES, 'UTF-8');
//$item = $cls_item->viewitemby_id($item_id);
//$item_info = $item->fetch_assoc();
//$cat_id=$item_info['cat_id'];
//
$pur_id = htmlspecialchars($_REQUEST['pur_id'], ENT_QUOTES, 'UTF-8');
$query_details = $cls_purchase->pur_info_byid($pur_id);
$query_row = $query_details->fetch_assoc();

?>

    <script>
        $('document').ready(function(){
            purchase.pur_inv_control_dis();
        });
        $(function() {
            $("[name='pur_item_code']").focus();
        });
    </script>
    <div class="contentpanel">
        <!--\\\\\\\ contentpanel start\\\\\\-->
        <div class="pull-left breadcrumb_admin clear_both">
            <div class="pull-left page_title theme_color">
                <h1>Purchase</h1>
                <h2 class=""> Purchase Price Edit</h2>
            </div>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li>Purchase</li>
                    <li class="active">Purchase Item</li>
                </ol>
            </div>
        </div>
        <div class="container clear_both padding_fix">
            <section class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
<!--                        <div class="col-md-4">-->
<!--                            <div class="block-web">-->
<!--                                <div class="header">-->
<!--                                    <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a><a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>-->
<!--                                    <h3 class="content-header">Search Item</h3>-->
<!--                                </div>-->
<!--                                <div class="porlets-content">-->
<!--                                    <form action=""  method="post" class="form-horizontal row-border">-->
<!--                                        <div class="form-group">-->
<!--                                            <!--<input type="text" class="form-control" name="pur_item_code" id="pur_item_code" placeholder="Item Code">-->
<!--                                            <input type="text" class="form-control" name="pur_item_code"  placeholder="Item Code">-->
<!--                                        </div><!--/form-group-->
<!--                                        <div class="form-group">-->
<!--                                            <input type="text" class="form-control" name="itemName" placeholder="Search by Item name">-->
<!--                                        </div><!--/form-group-->
<!--                                        <div class="form-group">-->
<!--                                            <div id="itemShow" style="width:100%;border:1px solid #ccc;height:auto;">-->
<!--                                                <select id="pur_item_show" size="20" style="height:270px!important; width:100%;">-->
<!---->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div><!--/form-group-->
<!---->
<!--                                    </form>-->
<!--                                </div><!--/porlets-content-->
<!--                            </div><!--/block-web-->
<!--                        </div><!--/col-md-4-->
                        <div class="col-md-8">
                            <div class="block-web">
                                <div class="header">
                                    <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a><a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
                                    <h3 class="content-header">Update Purchase Price</h3>
                                </div>
                                <?php
                                $item_details = $cls_item->item__info($query_row['item_id']);
                                $items_info = $item_details->fetch_assoc();
                                ?>

                                <div class="porlets-content">
                                    <form action="" id="pur_price_update_form"  method="post" class="form-horizontal row-border">


                                        <!--select info-->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">
                                                <span id="pur_item_photo"><img src="images/itemimages/<?php echo $items_info['photo']; ?>" style="width:100%;" /></span>
                                            </label>
                                            <div class="col-sm-5">
                                                <span style="font-size:16px;font-weight:bold;" id="pur_item_name"><?php echo (isset($items_info['item_name']) && !empty($items_info['item_name'])?$items_info['item_name']:'Product Name'); ?></span><br>
                                                <span id="pur_item_barcode"><figure><img style="margin-left:-7px;" src="functions/barcode.php?codetype=code128&size=40&text='<?php echo $items_info['item_code']; ?>'"/><br><figcaption style="font-size:10px;"><?php echo $items_info['item_code']; ?></figcaption></figure></span>
                                                Category: <span id="pur_item_catname"><?php echo (isset($items_info['cat_name']) && !empty($items_info['cat_name'])?$items_info['cat_name']:''); ?></span><br>

                                            </div>

                                        </div><!--/form-group-->
                                        <hr>
                                        <!--select info end-->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Purchase Price</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="pur_price" required value="<?php echo $query_row['price'];  ?>" onkeypress="return OnlyNumberKey(event);">
                                            </div>

                                        </div><!--/form-group-->

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Quantity (<span id="pur_item_unit"></span>)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" required name="pur_quantity" value="<?php echo $query_row['quantity'];  ?>" onkeypress="return OnlyNumberKey(event);" readonly>
                                            </div>
                                        </div>

<!--                                        <div class="form-group">-->
<!--                                            <label class="col-sm-3 control-label">Bonus Qty</label>-->
<!--                                            <div class="col-sm-2">-->
<!--                                                <input type="text" class="form-control" name="bonus_quantity" placeholder="0" onkeypress="return OnlyNumberKey(event);">-->
<!--                                            </div>-->
<!--                                        </div>-->


                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Total Price</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="pur_subtotal_price" readonly value="<?php echo $query_row['ttl_price'];  ?>" onkeypress="return OnlyNumberKey(event);">
                                            </div>

                                        </div><!--/form-group-->

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9">
                                                <input type="hidden" name="pur_table_id" value="<?php echo $query_row['id'];  ?>" class="btn btn-primary btn-lg">
                                                <input type="submit" name="pur_price_update" value="Update" class="btn btn-primary btn-lg">
                                                <a href="purchaseReport"  class="btn btn-primary btn-lg">Cancel</a>

                                            </div>
                                        </div><!--/form-group-->

                                    </form>


                                </div><!--/porlets-content-->
                            </div><!--/block-web-->
                        </div><!--/col-md-6-->

                    </div>
<!--                    <table class="table table-hover" id="pur_item_table">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th style="display:none;"></th>-->
<!--                            <th class="text-center">SL NO.</th>-->
<!--                            <th>ITEM</th>-->
<!--                            <th>DESCRIPTION</th>-->
<!--                            <th>QUANTITY</th>-->
<!--<!--                            <th>BONUS QTY.</th>-->
<!--                            <th>PRICE</th>-->
<!--                            <th>SUBTOTAL</th>-->
<!--                            <th>ACTION</th>-->
<!--                            <th style="display:none">Ex date</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
                        <!--  <tr class="tr_border">
                           <th style="display:none;"></th>
                            <td class="text-center"><strong>1</strong></td>
                            <td><a href="javascript:void(0);">Invoice 1</a></td>
                            <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</td>
                            <td>5</td>
                            <td>720</td>
                            <td>720</td>
                            <td><a style="line-height:15px!important;" class="btn btn-primary" href="">Edit</a>&nbsp;&nbsp;
                            <a style="line-height:15px!important;background:#f00;" class="btn btn-primary" href="">Remove</a></td>
                          </tr>-->

<!---->
<!--                        <tr>-->
<!--                            <td style="display:none;"><strong></strong></td>-->
<!--                            <td><strong></strong></td>-->
<!--                            <td><strong></strong></td>-->
<!--                            <td><strong></strong></td>-->
<!--                            <td><strong></strong></td>-->
<!--<!--                            <td><strong></strong></td>-->
<!--                            <td>Total</td>-->
<!---->
<!--                            <td><strong><span id="pur_total_price">0.00</span></strong></td>-->
<!---->
<!--                            <td><strong></strong></td>-->
<!--                            <td style="display:none;"><strong></strong></td>-->
<!--                        </tr>-->
<!---->
<!--                        </tbody>-->
<!--                    </table>-->

<!--                    <div class="row">-->
<!--                        <div class="col-md-5">-->
<!--                            <div class="block-web">-->
<!--                                <div class="header">-->
<!--                                    <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a><a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>-->
<!--                                    <h3 class="content-header">Inovice Information</h3>-->
<!--                                </div>-->
<!--                                <div class="porlets-content">-->
<!--                                    <form action=""  method="post" class="form-horizontal row-border">-->
<!--                                        <div class="form-group">-->
<!--                                            <label style="text-align:left;" class="col-sm-2 control-label">Supplier</label>-->
<!--                                            <div class="col-sm-5">-->
<!--                                                <select class="form-control" id="dis_supp" name="sup_id">-->
<!--                                                    <option value="">Select Supplier</option>-->
<!---->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                            <a  class="btn btn-default btn-icon" href="supplierAdd" target='_blank'>Add new</a>-->
<!--                                        </div>-->
<!---->
<!--                                        <div class="form-group">-->
<!--                                            <label style="text-align:left;" class="col-sm-2 control-label">Invoice</label>-->
<!--                                            <div class="col-sm-5">-->
<!--                                                <input type="text" class="form-control" required name="inovice_num" style="width:100%;" placeholder="Invoice Number" onkeypress="return OnlyNumberKey(event);">-->
<!--                                            </div>-->
<!--                                        </div><!--/form-group-->
<!---->
<!---->
<!--                                        <div class="form-group">-->
<!--                                            <label style="text-align:left;" class="col-sm-2 control-label">Total</label>-->
<!--                                            <div class="col-sm-5">-->
<!--                                                <input type="text" readonly class="form-control" name="pur_total_price" placeholder="Total">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group">-->
<!--                                            <label style="text-align:left;" class="col-sm-2 control-label">Payable</label>-->
<!--                                            <div class="col-sm-5">-->
<!--                                                <input type="text" class="form-control" id="abcd" name="pur_net_payable" onkeypress="return OnlyNumberKey(event);" placeholder="0.00">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!---->
<!---->
<!--                                        <div class="form-group">-->
<!--                                            <label style="text-align:left;" class="col-sm-2 control-label">Due</label>-->
<!--                                            <div class="col-sm-5">-->
<!--                                                <input type="text" class="form-control" name="pur_amt_due" readonly placeholder="0.00" ><br>-->
<!--                                                <input type="button" name="pur_item_insert" value="Purchase" class="btn btn-primary">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!---->
<!---->
<!---->
<!---->
<!--                                    </form>-->
<!--                                </div><!--/porlets-content-->
<!--                            </div><!--/block-web-->
<!--                        </div><!--/col-md-7-->
<!--                    </div>-->
                </div>
            </section>
        </div>
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->

<?php require_once("include/footer.php"); ?>