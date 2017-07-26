<?php

class cls_points {

    //view store//
    public function insert_points($taka_from,$taka_to,$points,$saved_by) {
        $cls_datetime = new cls_datetime();
        $datetime = $cls_datetime->datetime();
		
		$query = $this->get_points_range($taka_from,$taka_to);
		$row = $query->num_rows;
		if($row>0)
		{
			return "1|This Taka Range Already Exist";
		}
		else{

        $result = DB::query("INSERT INTO `tbl_points` (`id`, `taka_from`, `taka_to`, `points`, `saved_by`, `saved_date`) VALUES (NULL, '$taka_from', '$taka_to', '$points', '$saved_by', '$datetime')");

        if ($result) {
            return "0|Inserted";
        }
        return "1|error";
		}
    }

    public function get_points_range($taka_from,$taka_to)
    {
        $result = DB::query("SELECT * FROM `tbl_points` where ($taka_from>=taka_from and  $taka_from<=taka_to) or ($taka_to>=taka_from and  $taka_to<=taka_to)");
        return $result;
    }
    public function get_points_rangebyid($points_id,$taka_from,$taka_to)
    {
        $result = DB::query("SELECT * FROM `tbl_points` where id !='$points_id' and (($taka_from>=taka_from and  $taka_from<=taka_to) or ($taka_to>=taka_from and  $taka_to<=taka_to))");
        return $result;
    }

    //view all//
    public function view_points() {
        $result = DB::query("SELECT * FROM `tbl_points` order by taka_from asc");
        return $result;
    }

    public function view_points_by_id($p_id) {
        $result = DB::query("SELECT * FROM `tbl_points` where id='$p_id' order by taka_from asc");
        return $result;
    }




    public function update_points($points_id,$taka_from,$taka_to,$points,$saved_by) {
        $cls_datetime = new cls_datetime();
        $datetime = $cls_datetime->datetime();

        $query = $this->get_points_rangebyid($points_id,$taka_from,$taka_to);
        $row = $query->num_rows;
        if($row>0)
        {
            return "1|This Taka Range Already Exist";
        }
        else{

            $result = DB::query("UPDATE `tbl_points` SET `taka_from` = '$taka_from', `taka_to` = '$taka_to', `points` = '$points', `saved_by` = '$saved_by',  `saved_date` = '$datetime' WHERE id = '$points_id'");

            if ($result) {
                return "0|Updated";
            }
            return "1|error";
        }
    }

    public function view_points_cus_num() {
        $result = DB::query("SELECT id,cus_name,points,count(id) as number FROM `tbl_customer_info` where points>=1000");
        return $result;
    }
    public function view_cus_points_details() {
        $result = DB::query("SELECT id,cus_name,points  FROM `tbl_customer_info` where points>=1000 order by points desc");
        return $result;
    }

    public function pointsReport_by_points($starts_pts=false, $end_pts=false) {
        $result = DB::query("SELECT * FROM `tbl_customer_info` where points between $starts_pts and $end_pts");
        return $result;
    }

    public function get_customer_points($cus_id) {
        $result = DB::query("SELECT points FROM `tbl_customer_info` where id = $cus_id");
        return $result;
    }


    //purchase insert//
    public function salepoints_insert(
        $user_id, $resulttt, $cus_id, $points_app, $inovice_num, $sale_total_price, $total_vat, $total_discount, $rounding_amt,
        $sale_net_payable, $pay_type1,  $trans_num1, $trans_amt1, $pay_type2,
        $trans_num2, $trans_amt2, $return_amt, $sale_amt_due) {

        if($return_amt > 0)
        {
            $trans_amt1 = $sale_net_payable;
        }

        $invoice = $inovice_num;
        //$invoice = rand();





        foreach($resulttt as $values)
        {
            /*adjust stock*/
            $item_id =  $values[0];
            $item_qty =  $values[1];
            $resultt = DB::query("update tbl_stock set available_stock = (available_stock - $item_qty) where item_id = '$item_id'");

        }


        if(isset($cus_id) && !empty($cus_id)){
//            update points info
            $resultt = DB::query("UPDATE `tbl_customer_info` SET `points` = `points`-$points_app  WHERE `tbl_customer_info`.`id` = $cus_id");
        }



        if ($resultt) {
            return "0|Inserted|$invoice";
        } else {
            return "1|Error";
        }
    }
    //sale insert end//






}
?>