<?php
class cls_purchase {

    //purchase insert//
    public function purchase_insert($user_id, $result, $supplier_id, $inovice_num, $pur_total_price_in, $pur_net_payable, $pur_amt_due) {
        $cls_datetime = new cls_datetime();
        $datetime = $cls_datetime->datetime();
        $pur_id = $cls_datetime->show_datetime();
        $pur_date = date("Y-m-d");
        
      //  try{
            
           // DB::beginTranstion();
        foreach($result as $values)
			{
				//$data  = "'" . implode("','", $values) . "'";
				//$data  = $data.",'$supplier_id', '$pur_ID', '$inovice_num', '$pur_date', '$user_id', '$datetime''";
//	            for mf and ex date
            if(isset($values[4]) && !empty($values[4])) {
                $result = DB::query("INSERT INTO `tbl_item_exdate` (`id`, `purchase_id`, `item_id`, `ex_date`, `saved_by`, `saved_date`) VALUES (NULL, '$pur_id', '$values[0]',  '$values[4]', '$user_id', '$datetime')");
            }

				$result = DB::query("insert into tbl_purchase(item_id, quantity, price, ttl_price, sup_id, pur_id, invoice, pur_date, saved_by, saved_date) values ('$values[0]', '$values[1]', '$values[2]', '$values[3]', '$supplier_id', '$pur_id', '$inovice_num', '$pur_date', '$user_id', '$datetime')");

            /*for stock*/
            $item_id = $values[0];
            $item_qnty = $values[1];
            
            $stock = 0;
            $item_q = DB::query("SELECT * from tbl_stock where item_id = '$item_id'");
            $it_row_count = $item_q->num_rows;            
            if($it_row_count != 0)
            {
               //$result = DB::query("update tbl_stock set available_stock = '$stock' where item_id = '$item_id'");
               $result = DB::query("update tbl_stock set available_stock = (available_stock + $item_qnty) where item_id = '$item_id'");
                
            } else {
            
            $result = DB::query("insert into tbl_stock (item_id, available_stock, last_tra_date, saved_by, saved_date) values ('$item_id', '$item_qnty', '$pur_date', '$user_id', '$datetime')");
            }
        
        }
        
        $tr_row_balnce = 0.00;
        $result = DB::query("select balance from tbl_supplier_trans where supp_id = '$supplier_id' order by id desc limit 1");
        $tr_row = $result->fetch_assoc();
        $tr_row_balnce = $tr_row['balance'];
        
        $pur_total_price = $pur_total_price_in - $pur_net_payable;
        
        $total_balance = $pur_total_price + $tr_row_balnce;
        
        $result = DB::query("insert into tbl_supplier_trans (supp_id, pur_id, total_amount, paid, balance, invoice_due, remarks, payment_date, saved_by, saved_date) values ('$supplier_id', '$pur_id', '$pur_total_price_in', '$pur_net_payable', '$total_balance', '$pur_amt_due', 'Purchase', '$pur_date', '$user_id', '$datetime')");
      
        
        if ($result) {
        return "0|Inserted";
        } else {
       return "1|Error";
        }
            
        
    }
    
    //purchase insert end//
    
    
    //purchase report//
     public function view_per_report($supplier_id, $item_id, $from_date, $to_date){
         
         $supplier_q = "";
         $item_q = "";
         $date_q = "";
         //$all_q = "";
        
         if($supplier_id != "null")
         {
            $supplier_q = "&& pur.sup_id = '$supplier_id'";
         }
         if($item_id != "null"){
             
            $item_q = "&& pur.item_id = '$item_id'";
         }
         if($from_date != "" || $to_date != ""){
             
            $date_q = "&& pur.pur_date between '$from_date' and '$to_date'";
         }
         
         $result = DB::query("select pur.*, user.name
         from tbl_purchase as pur 
         join tbl_user_info as user on user.id = pur.saved_by where pur.id != '' $supplier_q $item_q $date_q order by pur.pur_date desc")  ;
         
         return $result;
     }
    
    
    //supp wise report//
    public function view_report_supp($supplier_id, $from_date, $to_date){
        
        $supplier_q1 = "";
        $date_q1 = "";
        
        if($supplier_id != "null")
        {
            $supplier_q1 = "&& pur.sup_id = '$supplier_id'";
        }
        if($from_date != "" || $to_date != ""){
             
            $date_q1 = "&& pur.pur_date between '$from_date' and '$to_date'";
         }
        
    $result = DB::query("
        SELECT sum(ttl_price) as total, supp.c_name, us.name, pur.pur_id, pur.invoice, pur.pur_date,supp.id as sup_id
        FROM tbl_purchase as pur
        join tbl_supplier as supp on supp.id = pur.sup_id
        join tbl_user_info as us on us.id = pur.saved_by
        where pur.id != '' $supplier_q1 $date_q1
        group by pur.invoice
    ");
    
        return $result;
    }


    /*today sale count user wise*/
    public function today_purchase_count($user_id=false){
        $cls_datetime = new cls_datetime();
        $tra_date = $cls_datetime->exat_date();

        $result = DB::query("SELECT sum(ttl_price) as today_purchase from tbl_purchase where pur_date = '$tra_date'");
        return $result;
    }
    
    /*total purchase count admin*/
    public function total_pur_count_admin(){
    $result = DB::query("SELECT sum(ttl_price) as total_purchase FROM tbl_purchase");
        return $result;
    }
    
    /*end*/
    
    /*purchase report details*/
    public function pur_report_details($pur_id){
        
		$result = DB::query("SELECT  supp.c_name, us.name, it.item_name, it.unit, pur.quantity, pur.price, pur.pur_date, pur.pur_id, stra.invoice_due, stra.total_amount, stra.paid, pur.invoice, (pur.quantity * pur.price) as ttl_price 
		FROM `tbl_purchase` as pur
		join tbl_items as it on it.id = pur.item_id
		join tbl_supplier as supp on supp.id = pur.sup_id
		join tbl_user_info as us on us.id = pur.saved_by
		join tbl_supplier_trans as stra on stra.pur_id = pur.pur_id
		where pur.pur_id = '$pur_id' ORDER BY pur_date");
    
        return $result;
    }
    
    
    public function pur_report_detailssupp($pur_id){
        
    $result = DB::query("SELECT  supp.c_name, pur.invoice
    FROM `tbl_purchase` as pur
    join tbl_supplier as supp on supp.id = pur.sup_id
    where pur.pur_id = '$pur_id' ORDER BY pur_date");
    
        return $result;
    }
    /*end*/

    public function pur_info_byid($pur_id){

        $result = DB::query("SELECT tbl_purchase.id,tbl_purchase.quantity,tbl_purchase.price,tbl_purchase.ttl_price,tbl_purchase.item_id,tbl_items.item_name FROM `tbl_purchase` inner join tbl_items on tbl_purchase.item_id = tbl_items.id  where tbl_purchase.id = $pur_id");

        return $result;
    }
    public function purchase_price_update($pur_table_id, $pur_price, $pur_subtotal_price){

        $result = DB::query("UPDATE `tbl_purchase` SET `price` = '$pur_price', `ttl_price` = '$pur_subtotal_price' WHERE `tbl_purchase`.`id` = $pur_table_id");

        return $result;
    }
    

}
?>