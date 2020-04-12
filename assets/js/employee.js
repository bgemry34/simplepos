$( document ).ready(function() {
    fetch('http://localhost/simplepos/pos_api/get_item_all')
    .then(function(response) {
      return response.json();
    })
    .then(function(myJson) {
          let output = "";
                
          myJson.forEach(element => {
			if(element.qty>0){
				output += 
				"<div class='col-md-4 text-center'><p>"+element.name+"</p></div>"+
				"<div class='col-md-3 text-center'><p>"+element.price+"</p></div>"+
				"<div class='col-md-2 text-center'><p>"+element.qty+"</p></div>"+
              "<div class='col-md-2 text-center'><button class='btn btn-success' onclick='itemAdd("+element.id+","+element.qty+")'>+</button></div>";
			}	  
		});
  
          document.getElementById('itemGen').innerHTML = output;
      });
});




const getItem = (id, qty)=> {
	this.qty = qty;
	return fetch('http://localhost/simplepos/api/items/'+id)
	.then((response)=>{
		return response.json();
	})
	.then((myJson)=>{
			let output = '<div class="row">'+
              '<div class="col-md-5 text-center">'+
							'<p>'+myJson.name+'</p>'+
							'<input type="hidden" name="itemid[]" value="'+myJson.id+'">'+
              				'</div>'+
							'<div class="col-md-2 text-center">'+
							'<p>'+this.qty+'</p>'+
							'<input type="hidden" name="qty[]" value="'+this.qty+'">'+
							'</div>'+
							'<div class="col-md-3 text-center">'+
							'<p class="itemprice">'+parseFloat(this.qty)*parseFloat(myJson.price)+'</p>'+
							'<input class="itemPrice" type="hidden" name="itemprice[]" value="'+parseFloat(this.qty)*parseFloat(myJson.price)+'">'+
							'</div>'+
							'<div class="col-md-2 text-center">'+
							'<button type="button" class="btn btn-danger btn-sm" onclick="deleteitem('+myJson.id+')">X</button>'+
							'</div>'+
					'</div>';
				
				return output;			
	})
}

var itemlist = new Object();
var overallTotalPrice = 0;

const itemAdd =  (id, qty)=>{
	
	if(itemlist[id] == null){
		if(qty>0){
			itemlist[id] = 1;
		}else{alert('insuficient stock');}
	}
	else{
		if(itemlist[id]<qty){
			itemlist[id]++;
		}else{alert('insuficient stock');}
	}
	itemrefresh();
	
	console.log(itemlist.length)
}

	const itemrefresh = async ()=>{
		let itemcontainer = document.getElementById('addedItems');
		let output = '';
		
		for(let i in itemlist){
			if(itemlist[i] != null){
				output += await getItem(i, itemlist[i]);
			}
		}
		itemcontainer.innerHTML = output;
		let totalPrices = document.getElementsByClassName('itemprice');
		let pricesOutput = 0;
		for(let x=0; x<totalPrices.length;x++){
			pricesOutput+=parseFloat(totalPrices[x].innerHTML);
		}
		overallTotalPrice = pricesOutput;

		document.getElementById('totalPrice')
		.innerHTML = '<h4>Total: <span style="color:green;">&#8369;'+overallTotalPrice+'</span></h4>'+
					'<input type="hidden" name="totalPrice" value="'+overallTotalPrice+'">';
		
					if(parseInt(overallTotalPrice)>0){
						document.getElementById('cashReceived').disabled = false;
					}else{document.getElementById('cashReceived').disabled = true;}
	}


const deleteitem = (id)=>{
	itemlist[id] = null;
	itemrefresh();
}

	document.getElementById('toSearch').addEventListener('submit', (e)=>{
		console.log('hello')
		e.preventDefault();
	
		var name = document.getElementById('itemName').value;
		var params = "itemName="+name;
	
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'http://localhost/simplepos/pos_api/findItem', true);
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
		xhr.onload = function(){
			console.log(this.responseText);
			let myJson = JSON.parse(this.responseText)
			let output = '';
			for(let i in myJson){
				if(myJson[i].qty>0){
					output+="<div class='col-md-4 text-center'><p>"+myJson[i].name+"</p></div>"+
				"<div class='col-md-3 text-center'><p>"+myJson[i].price+"</p></div>"+
				"<div class='col-md-2 text-center'><p>"+myJson[i].qty+"</p></div>"+
							"<div class='col-md-2 text-center'><button class='btn btn-success' onclick='itemAdd("+myJson[i].id+","+myJson[i].qty+")'>+</button></div>";
				}
			}
			document.getElementById('itemGen').innerHTML = output;
		}
	
		xhr.send(params);
	})

//check receipt
if(document.getElementById('toSeeReceipt')!==null){
	document.getElementById('toSeeReceipt').addEventListener('click', ()=>{
		fetch('http://localhost/simplepos/pos_api/get_last_receipt')
	  .then(function(response) {
		return response.json();
	  })
	  .then(function(myJson) {
			let res =JSON.stringify(myJson);
			let thejson = JSON.parse(res);
			let itemContainer = document.getElementById('itemListContainer')
			console.log(thejson)
			let output = '';
			document.getElementById('receiptIdReceipt').innerHTML = thejson[0].receipt_id;
			document.getElementById('customerNameReceipt').innerHTML = thejson[0].customer_name;
			document.getElementById('paymentTypeReceipt').innerHTML = thejson[0].paymentType;
			document.getElementById('totalPriceReceipt').innerHTML = '&#8369;'+(thejson[0].totalPrice);
			document.getElementById('outputCashReceived').innerHTML ='&#8369;'+ (thejson[0].cashReceived);
			document.getElementById('cashChange').innerHTML = '&#8369;'+(thejson[0].cashReceived - thejson[0].totalPrice);
			

	
			for(let i in thejson){
			output+='<div><p>'+thejson[i].qty+'Pcs '+thejson[i].item_name+' - &#8369; '+thejson[i].totalPrice+'</p></div>'
			}
			
			itemContainer.innerHTML = output;
		});
	})
}

document.getElementById('cashReceived').addEventListener('keyup', ()=>{
	let cash = document.getElementById('cashReceived').value - overallTotalPrice;

	if(cash>=0){
		document.getElementById('toPurchase').disabled = false;
	}else{document.getElementById('toPurchase').disabled = true;}
})
