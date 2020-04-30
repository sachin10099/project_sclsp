
function pay(id, amount) {
	var totalAmount = amount;
	var product_id =  id;
	alert();
	return false;
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
					  title: data,
					  text: "",
					  icon: "success",
					  buttons: true,
					  dangerMode: true,
					})
					.then((willDelete) => {
						var base_url = window.location.origin;
						var new_url = base_url+'/SCLSP/form-filler/job/list-view';
					    window.location.assign(new_url);
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