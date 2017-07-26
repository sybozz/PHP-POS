var customer_events = {

    init : function(){
		    $('#customer_add').on('submit', function(e){
			   e.preventDefault();
            var cus_name = $('[name="cus_name"]').val();
            var email = $('[name="email"]').val();
            var mobile = $('[name="mobile"]').val();
            var address = $('[name="address"]').val();
            var date_of_birth = $('[name="birth_date"]').val();
            var customer_type = $('[name="customer_type"]').val();

            customer.customer_add(cus_name, email, mobile, address, date_of_birth, customer_type);

           // supplier.supplier_add(company_name, address, mobile, email, contact_person, contact_person_mobile, payable_amount, saved_by, remarks);
        });
        
        $('#customer_edit').on('submit', function(e){
			 e.preventDefault();
            var cus_id = $('[name="cus_id"]').val();
            var cus_name = $('[name="cus_name"]').val();
            var email = $('[name="email"]').val();
            var mobile = $('[name="mobile"]').val();
            var address = $('[name="address"]').val();
            var date_of_birth = $('[name="birth_date"]').val();
            var customer_type = $('[name="customer_type"]').val();

            customer.customer_update(cus_id, cus_name, email, mobile, address, date_of_birth, customer_type);
        });	
		
		$('[name="customerName"]').on('input', function(){
		  
            var customerName = $('[name="customerName"]').val();
           
            customer.customer_change(customerName);
        });
		
		$('#cutomer_show').change(function(){
            var customer_id = $('#cutomer_show option:selected').val();
			//alert(customer_id);
            customer.invoice_select(customer_id);
        });	
		
		$('#invoice_show').change(function(){
            var invoice = $('#invoice_show option:selected').val();
			//alert(invoice);
            customer.due_select(invoice);
        });	
		
		
        $('#customer_due_pay').on('submit', function(e){
			  e.preventDefault();
			  var fd = new FormData(this);
			  customer.customer_payment_add(fd);
			
        });
        $('#custype_add').on('submit', function(e){
            e.preventDefault();
            var customertype = $('[name="customertype"]').val();
            customer.customertype_add(customertype);
        });

        $('#custype_edit_form').on('submit', function(e){
            e.preventDefault();
            var customertype = $('[name="customertype"]').val();
            var custype_id = $('[name="custype_id"]').val();
            customer.customertype_edit(custype_id,customertype);
        });
		
		

    }
};


var customer = {
    customertype_add : function(customertype){
        var dataString =
            'customertype_name='+customertype;


        $.ajax({
            type:'post',
            url:'post_url/customertype_add',
            data:dataString,
            success:function(data){

                arr = new Array();
                arr = data.split("|");
                if(arr[0] == 0){
                    alert(arr[1]);
                    window.location = 'customerTypeAdd';
                }
                else {
                    alert(arr[1]);
                }

            },
            error:function(){

            }

        });
    },
    customertype_edit : function(custype_id,customertype){
        var dataString =
            'customertype_name='+customertype+
            '&customertype_id='+custype_id;


        $.ajax({
            type:'post',
            url:'post_url/customertype_edit',
            data:dataString,
            success:function(data){

                arr = new Array();
                arr = data.split("|");
                if(arr[0] == 0){
                    alert(arr[1]);
                    window.location = 'custypemanage';
                }
                else {
                    alert(arr[1]);
                }

            },
            error:function(){

            }

        });
    },
    customer_add : function(cus_name, email, mobile, address,date_of_birth,customer_type){
        var dataString = 
            'cus_name='+encodeURIComponent(cus_name)+
            '&email='+encodeURIComponent(email) +
            '&mobile='+encodeURIComponent(mobile) +
            '&address='+encodeURIComponent(address)+
            '&birth_date_val='+encodeURIComponent(date_of_birth)+
            '&customer_type_val='+encodeURIComponent(customer_type);

       // alert(dataString);

        $.ajax({
            type:'post',
            url:'post_url/customer_add',
            data:dataString,
            success:function(data){
                //alert(data);
                 arr = new Array();
                arr = data.split("|");
                if(arr[0] == 0){
                    alert(arr[1]);
                    window.location = 'customerManage';
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
    
    customer_update : function(cus_id, cus_name, email, mobile, address, date_of_birth, customer_type){
        var dataString = 
            'cus_id='+encodeURIComponent(cus_id)+
            '&cus_name='+encodeURIComponent(cus_name)+
            '&email='+encodeURIComponent(email) +
            '&mobile='+encodeURIComponent(mobile) +
            '&address='+encodeURIComponent(address)+
            '&birth_date_val='+encodeURIComponent(date_of_birth)+
            '&customer_type_val='+encodeURIComponent(customer_type);

        //alert(dataString);

        $.ajax({
            type:'post',
            url:'post_url/customer_update',
            data:dataString,
            success:function(data){
                //alert(data);
                arr = new Array();
                arr = data.split("|");
                if(arr[0] == 0){
                    alert(arr[1]);
                    window.location = 'customerManage';
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
	
	
	customer_change : function(customerName){
        var dataString = 
            'customerName='+encodeURIComponent(customerName);
        //alert(dataString);

        $.ajax({
				type:'post',
				url:'post_url/customerShow',
				data:dataString,
				success:function(res){
					$("#cutomer_show").empty();
					$("#cutomer_show").append(res);
					$('#customer_search_div').show();
					$('#total_amount').val('');
                    $("#paid").val('');
                    $("#due").val('');
				}
			});
    },
	
		invoice_select : function(customer_id){
        var dataString = 
            'customer_id='+encodeURIComponent(customer_id);
        //alert(dataString);

        $.ajax({
				type:'post',
				url:'post_url/invoiceShow',
				data:dataString,
				success:function(res){
					$("#invoice_show").empty();
					$("#invoice_show").append(res);
					$('#total_amount').val('');
                    $("#paid").val('');
                    $("#due").val('');
					//$('#invoice_search_div').show();
				}
			});
    },
	
		due_select : function(invoice){
        var dataString = 
            'invoice='+encodeURIComponent(invoice);
        //alert(dataString);

        $.ajax({
				type:'post',
				url:'post_url/dueInvoice',
				data:dataString,
				success:function(res){
			    var res_j = JSON.parse(res);
                    $('#total_amount').val(res_j.total);
                    $("#paid").val(res_j.paid);
					$due = parseFloat(res_j.total)-parseFloat(res_j.paid);
                    $("#due").val($due.toFixed(2));
				}
			});
    },
	
	
		 customer_payment_add : function(fd){
       //  var fd = new FormData(this);

		var xhr = new XMLHttpRequest();
        xhr.open('POST', 'post_url/customerPayment', true);

        xhr.onload = function() {
            if (this.status == 200) {
             
                alert(this.response);
				if(this.response=='Payment Inserted Successfully')
				{
						window.location = 'cutomerRecpay'; 
				}
			 
            };
        };

        xhr.send(fd);
     
    }
    
};
$(function(){
    customer_events.init();
});
