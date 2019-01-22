// handles input from user and output to screen
// this is where all the app's logic takes place

// mouse events
$(document).ready( function () {
	// logout button clicked
	$("#logout").click(function() { dbs.save(shop); /* update data */ });

	// show shopping cart modal - cart is controlled from 'cart.js' file
	$('#btnCart').click(function() {
		// reset values
		$("#seltrn").val(0);
		$("#totalnfo").html('');
		$("#wrn").show(); // show warning msg.
		// show modal frm.
		$("#cartModal").show();
	});
	
	// export to xml
	$("#btnXML").click(function() {
		var v = $('#selprod').val();
		if (v == '0#0')
			alert('Please select a product');
		else {
			var val = v.split('#');
			dbs.toxml(val[0]);
			alert('Data exported successfully to xml');
			//location.reload(); // refresh page
			// reset main controls to default
			dbs.getItems();
			hud.toggleInput(false);
			hud.updateItmVal(0);
		}
	});
	
	// select product - select box
	$('#selprod').change(function() {
		if (this.value == '0#0') {
			hud.toggleInput(false); // hide AddDiv
			hud.updateItmVal(0); // reset item value
		} else {
			hud.toggleInput(true); // show AddDiv
			var val = (this.value).split('#'); // initially, value looks like: id#price
			hud.updateItmVal(val[1]); // show item value
			// get values
			var used = shop.getUsed(val[0]);
			var rate = shop.getRate(val[0]);
			// show them on hud
			hud.valStar(1, 5, used);
			hud.ratingInfo(rate);
		}
	});
	
	// check if rating stars have been clicked
	$('i').click(function() {
		var used = shop.getus(); // run function getUsed() first to get valid results
		if (used == 0) { // no star selected
			var rate = shop.getrt(); // get old rating
			var pos = shop.getpos(); // get the position of the selectbox
			// find which star has been clicked
			for (var i=1; i<6; i++) {
				var star = 's'+i+'e'; // we only care about empty stars
				if (star == this.id) { // if star found
					// update data
					shop.setUsed(pos, i);
					// calculate new rating
					var oldr = parseFloat(rate);
					var newr = parseFloat(i);
					var avg = (oldr+newr)/2;
					shop.setRate(pos, avg); // update rating
					// now show changes on hud
					hud.selStar(i); // select star
					hud.valStar(1, 5, i);
					hud.ratingInfo(avg);
				}
			}
		} // end used
	});
	
	// add to cart
	$("#btnAdd").click(function() {
		// get items from textbox
		var qtty = $("#txtbQtty").val();
		if (qtty == 0) alert('Plese select the quantity');
		else {
			// get item name, price and quant.
			var itname = $("#selprod option:selected").text();
			var itmpr = $("#selprod option:selected").val();
			var price = itmpr.split('#');
			cart.additem(itname, price[1], qtty);
			// show items list
			var items = cart.getItems();
			var prods = cart.getProds();
			var prices = cart.getPrices();
			shop.showList(prods, prices, items);
			// show totals
			cart.calcTotal();
			var it = cart.getTotItm();
			var tot = cart.getTot();
			shop.showTot(tot, it);
			// clear control
			$("#txtbQtty").val('');
			// update items
			$('#nitems').html(it);
			// update credit
			var cr = cart.getCredit();
			$('#ncredit1').html('( Credit: '+cr.toFixed(2)+' )');
		}
	});

}); // end doc.ready

// remove product from cart
$(document).on('click', '#btnRem', function() {
//	if (confirm('Are you sure you want to remove entry #' + this.value + '?')) {
		cart.removeItem(this.value);
		// update list
		var items = cart.getItems();
		var prods = cart.getProds();
		var prices = cart.getPrices();
		shop.showList(prods, prices, items);
		// upd. totals
		cart.calcTotal();
		var tot = cart.getTot();
		var it = cart.getTotItm();
		shop.showTot(tot, it);
		// update items
		$('#nitems').html(it);
		// update credit
		var cr = cart.getCredit();
		$('#ncredit1').html('( Credit: '+cr.toFixed(2)+' )');
/*		alert('Record deleted');
	}*/
});
