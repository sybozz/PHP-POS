
var points_events = {

    init : function(){
          $('#points_add_form').on('submit', function(e){
			   e.preventDefault();
            var taka_from = $('[name="taka_from"]').val();
            var taka_to = $('[name="taka_to"]').val();
            var points = $('[name="points"]').val();
            var saved_by = $('[name="saved_by"]').val();
              if(parseInt(taka_from)>parseInt(taka_to)){
                  alert('Invalid range!');
                  return false;
              }
              points_info.add_points(taka_from,taka_to,points,saved_by);
        });

        $('#points_update_form').on('submit', function(e){
            e.preventDefault();
            var points_id = $('[name="points_id"]').val();
            var taka_from = $('[name="taka_from"]').val();
            var taka_to = $('[name="taka_to"]').val();
            var points = $('[name="points"]').val();
            var saved_by = $('[name="saved_by"]').val();
            if(parseInt(taka_from)>parseInt(taka_to)){
                alert('Invalid range!');
                return false;
            }
            points_info.update_points(points_id,taka_from,taka_to,points,saved_by);
        });

        /*view purchase report*/
        $('[name="view_points_report"]').click(function(){

            var start_pts = $('[name="start_pts"]').val();
            var end_pts = $('[name="end_pts"]').val();
            if(start_pts>end_pts){
                alert('Invalid Range !');
                return;
            }

            points_info.points_report(start_pts, end_pts);
            //alert(item_id);

        });
        /*end*/

        $('#point_cus_list').on('change',function(){
            var cus_id = $('[name="cus_id"]').val();
            points_info.get_customer_point(cus_id);
        });





    }
};

var points_info = {

    get_customer_point : function(cus_id){
        var dataString = 'cus_id_val='+cus_id;

        $.ajax({
            type:'post',
            url:'post_url/customerPointsInfo',
            data:dataString,
            success:function(res){
                $("#point_cus_list").empty();
                $("#point_cus_list").append(res);
            }
        });
    },

    get_item_id : function(item_code){

        var dataString = 'item_code='+item_code;
        $.ajax({
            type:'post',
            url:'post_url/sale_item_by_code',
            data:dataString,
            success:function(res){

                var res_j = JSON.parse(res);
                if(res_j.id == null)
                {
                    sale.sale_form_clear();
                    return;
                }
                $('#points_item_show').empty().append(res_j.option);
                $('#purchase_price').val(res_j.pur_price);

                //sale.item_select(res_j.id,0);

            }
        });
    },
    add_points: function(taka_from,taka_to,points,saved_by){
        var dataString =
            'taka_from='+taka_from+
            '&taka_to='+taka_to +
            '&points='+points +
            '&saved_by='+saved_by;
        $.ajax({
            type:'post',
            url:'post_url/pointsAdd',
            data:dataString,
            success:function(data){
                //alert(data);
                arr = new Array();
                arr = data.split("|");
                if(arr[0] == 0){
                    alert(arr[1]);
                    window.location = 'pointsAdd';
                }
                else {
                    alert(arr[1]);
                }

            },
            error:function(){
                //alert('Error');
            }

        });
    },

    update_points: function(points_id,taka_from,taka_to,points,saved_by){
        var dataString =
            'points_id='+points_id+
            '&taka_from='+taka_from+
            '&taka_to='+taka_to +
            '&points='+points +
            '&saved_by='+saved_by;

        $.ajax({
            type:'post',
            url:'post_url/pointsUpdate',
            data:dataString,
            success:function(data){
                //alert(data);
                arr = new Array();
                arr = data.split("|");
                if(arr[0] == 0){
                    alert(arr[1]);
                    window.location = 'pointsManage';
                }
                else {
                    alert(arr[1]);
                }

            },
            error:function(){
                //alert('Error');
            }

        });
    },
    points_report : function(starts_pts, end_pts){
        var dataString =
            '&starts_pts='+encodeURIComponent(starts_pts)+
            '&end_pts='+encodeURIComponent(end_pts);
        //alert(dataString);

        $.ajax({
            type:'post',
            url:'post_url/pointsReport',
            data:dataString,
            success:function(res){
                $("#points_report_show").empty().append(res);

            }

        });
    }





    
};
$(function(){
    points_events.init();
});


