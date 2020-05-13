
function pay(id, amount) {
	var totalAmount = amount;
	var product_id =  id;
	var options = {
		"key": "rzp_test_xsoVV2QZnOK4Ah",
		"amount": (totalAmount*100), // 2000 paise = INR 20
		"name": "S.C.L.S.P",
		"description": "Payment",
		"image": "http://citylifemultiservices.com/public/assets/img/logo/logo1.jpg",
		"handler": function (response){
		     $.ajax({
				url: 'success',
				type: 'post',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data: {
					razorpay_payment_id: response.razorpay_payment_id , 
					totalAmount : totalAmount ,
					product_id : product_id,
				}, 
				success: function(data){  
			        swal({
					  title: "Your payment is successfully done.",
					  text: "",
					  icon: "success",
					  buttons: true,
					  dangerMode: true,
					  showCancelButton: false,
					})
					.then((willDelete) => {
						if(data == 'job') {
							var base_url = window.location.origin;
							var new_url = base_url+'/SCLSP/form-filler/job/list-view';
						    window.location.assign(new_url);
						} else {
							var base_url = window.location.origin;
							var new_url = base_url+'/form-filler/admissions';
						    window.location.assign(new_url);
						}
						
					});
			    },
			    error: function(XMLHttpRequest, textStatus, errorThrown) { 
			        alert("Status: " + textStatus); 
			        alert("Error: " + errorThrown); 
			    } 
		   });
		 
		},
		"theme": {
		   "color": "red"
		}
	};
	var rzp1 = new Razorpay(options);
	rzp1.open();
}