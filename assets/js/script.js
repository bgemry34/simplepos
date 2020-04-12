$(document).ready(function() {
	$('.nav-link-collapse').on('click', function() {
	  $('.nav-link-collapse').not(this).removeClass('nav-link-show');
	  $(this).toggleClass('nav-link-show');
	});
  });
  
function itemFunction(id){
	fetch('http://localhost/simplepos/api/items/'+id+'')
  .then(function(response) {
    return response.json();
  })
  .then(function(myJson) {
		let res =JSON.stringify(myJson);
		let thejson = JSON.parse(res);
		console.log(thejson)
		$('input[name=id]').val(thejson.id);
		$('input[name=name]').val(thejson.name);
		$('input[name=price]').val(thejson.price);
		$('input[name=discount]').val(thejson.discount);
		$('input[name=qty]').val(thejson.qty);
	});
}


function salesFunction(id){
	fetch('http://localhost/simplepos/api/sales/'+id+'')
  .then(function(response) {
    return response.json();
  })
  .then(function(myJson) {
		let res =JSON.stringify(myJson);
		let thejson = JSON.parse(res);
		console.log(thejson)
		$('input[name=id]').val(thejson.id);
		$('input[name=month]').val(thejson.month);
		//bugging shit
		// $('select option[value='+thejson.month+']').attr("selected",true);
		$('select').val(thejson.month);
		$('input[name=year]').val(thejson.year);
		$('input[name=revenue]').val(thejson.revenue);

	});
}

function receiptFunction(id){
	fetch('http://localhost/simplepos/api/receipts/'+id+'')
  .then(function(response) {
    return response.json();
  })
  .then(function(myJson) {
		let res =JSON.stringify(myJson);
		let thejson = JSON.parse(res);
		console.log(thejson)
		$('input[name=id]').val(thejson.id);
		//bugging shit
		// $('select option[value='+thejson.month+']').attr("selected",true);
		$('select').val(thejson.item_id);
		$('input[name=qty]').val(thejson.qty);
	});
}

function customerFunction(id){
	fetch('http://localhost/simplepos/api/customers/'+id+'')
  .then(function(response) {
    return response.json();
  })
  .then(function(myJson) {
		let res =JSON.stringify(myJson);
		let thejson = JSON.parse(res);
		console.log(thejson)
		$('input[name=customer_id]').val(thejson.id);
		//bugging shit
		// $('select option[value='+thejson.month+']').attr("selected",true);
		$('input[name=id]').val(thejson.id);
		$('input[name=Edited_name]').val(thejson.name);
		$('input[name=Edited_address]').val(thejson.address);
		$('input[name=Edited_contact]').val(thejson.contactno);
	});
}

if(document.getElementById('create_form')!=null){
	document.getElementById('create_form').addEventListener('submit', (e)=>{
		{ 
				let validate = document.getElementById('validation_error')
				let name = document.getElementById('Created_name')        
				let discount = document.getElementById('Created_discount') 
				let price = document.getElementById('Created_price') 
				let qty = document.getElementById('Created_qty')
				let valText = ""     
				
				 
				if (name.value.trim() == "")                                  
				{ 
					valText += "<p style='padding:0;' class='alert alert-danger'>*Please Enter Name</p>"
					e.preventDefault();
				}
		
				if(parseFloat(discount.value) >100 || parseFloat(discount.value)<0){
					valText += "<p style='padding:0;' class='alert alert-danger'>*Please enter within 1-100 on Discount</p>"
					e.preventDefault();
				} 
		
				if(price!=null && parseFloat(price.value)<=0){
					valText += "<p style='padding:0;' class='alert alert-danger'>*Price should be greater than zero.</p>"
					e.preventDefault();
				} 
		
				if(parseFloat(qty.value)<=0){
					valText += "<p style='padding:0;' class='alert alert-danger'>*Qty should be greater than zero.</p>"
					e.preventDefault();
				} 
				validate.innerHTML = valText;
				return true; 
			}
		})
}

if(document.getElementById('create_company_form')!=null){
	document.getElementById('create_company_form').addEventListener('submit', (e)=>{
			{ 
				let validate = document.getElementById('validation_error_company')
				let name = document.getElementById('Created_company_name')        
				let valText = ""     
				if (name.value.trim() == "")                                  
				{ 
					valText += "<p style='padding:0;' class='alert alert-danger'>*Please Enter Name</p>"
					console.log('fired')
					e.preventDefault();
				}
				validate.innerHTML = valText;
				return true; 
			}
		})
}

