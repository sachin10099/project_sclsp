$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
 }); 

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
		       url: SITEURL + 'paysuccess',
		       type: 'post',
		       dataType: 'json',
		       data: {
		          razorpay_payment_id: response.razorpay_payment_id , 
		          totalAmount : totalAmount ,
		          product_id : product_id,
		       }, 
		       success: function (msg) {
		           window.location.href = SITEURL + 'razor-thank-you';
		       }
		   });
		 
		},
		"prefill": {
		   "contact": '9506519687',
		   "email":   'sachin@gmail.com',
		},
		"theme": {
		   "color": "red"
		}
	};
	var rzp1 = new Razorpay(options);
	rzp1.open();
	e.preventDefault();
      
}