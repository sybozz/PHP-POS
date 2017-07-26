<?php
//require_once("include/header.php");
require_once('functions/cls_dbconfig.php');
function __autoload($classname){
    require_once("functions/$classname.class.php");
}

$print_quentity=0;
if(!empty($_REQUEST['bar_item_id']) && !empty($_REQUEST['print_quantity'])) {
    $item_id = $_REQUEST['bar_item_id'];
    $print_quentity = $_REQUEST['print_quantity'];

    

    $query = DB::query("select tbl_items.id, tbl_items.item_code, tbl_items.item_name, tbl_item_price.price  from tbl_items inner join tbl_item_price on tbl_items.id=tbl_item_price.item_id and tbl_items.id=$item_id order by tbl_item_price.id desc limit 0,1");
    $row = $query->fetch_assoc();

    $cls_store = new cls_store();
    $shop_name = $cls_store->shop_name_view()->fetch_assoc();

}else{
    header("Location:barcode_print");
}
?>
<html>
<head>
    <script src="js/jquery.js"></script>
    <!-- income statement print only-->
    <script type="text/javascript">
        $("#btnPrint").live("click", function() {

            var params = [
                'height=' + screen.height,
                'width=' + screen.width,
                'fullscreen=yes' // only works in IE, but here for completeness
            ].join(',');

            var divContents = $("#barcode").html();
            // var companyName = $("#cname").html();

            var printWindow = window.open('', '', params);
            printWindow.document.write('<html><head><title>Barcode List</title>');
            printWindow.document.write('</head><body >');
            // printWindow.document.write(companyName);
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>
    <title>

    </title>
</head>
<body style="font-size:10px;font-family:verdana;">
<button class="btn btn-success" id="btnPrint">Print</button>
<div  id="barcode" style="width:100%;height: 842px;">

    <?php
    for($i=1;$i<=$print_quentity;$i++)
    {
        ?>
        <figure style="float:left;text-align:center;margin:3px 3px 10px;display:block;">
            <figcaption style="font-size:11px;font-weight: bold;"><?php echo (!empty($shop_name['company_name'])?$shop_name['company_name']:''); ?></figcaption>
            <figcaption style="font-size:11px"><?php echo (isset($row['item_name'])?$row['item_name']:''); ?></figcaption>
            <img src="functions/barcode.php?codetype=code128&size=50&text=<?php echo $row['item_code']; ?>"/>
            <figcaption style="font-size:11px"> <?php echo $row['item_code']; ?></figcaption>
            <figcaption style="font-size:11px;font-weight: bold;"><b>Tk. <?php echo  (!empty($row['price'])?$row['price']:' '); ?></b></figcaption>
        </figure>
        <?php
    }
    ?>
</div>


</body>
</html>
