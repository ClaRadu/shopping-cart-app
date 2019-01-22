// cart_controller
// handles all logic related to the shopping cart modal form
// * show button is on main page so show class is in 'controller.js' file
// * the shopping list is also created in 'controller.js' because it is used on the main page
// Thanks to user5636597 on stackoverflow.com
// https://stackoverflow.com/questions/18602331/why-is-this-jquery-click-function-not-working

var upsval = 5; // value for ups transport

// close form
$(document).on("click", "#btnClose", function() { $("#cartModal").hide(); });

// pay up bitch
$(document).on('click', '#btnPay', function() {
	var sv = $("#seltrn").val();
	if (sv > 0) {
		var it = cart.getTotItm();
		if (it > 0) {
			we_re_good = false;
			cart.calcTotal(); // update total
			var tot = cart.getTot();
			var cr = cart.getCredit();
			var ftot = tot+upsval;
			var msg = 'You are about to purchase '+it+' item(s). Total value: $'+tot.toFixed(2);
			if (sv > 1) { // ups
				if (ftot > cr) {
					alert("You don't have enough credit to ship the products by UPS");
				} else {
					we_re_good = true;
					msg = 'You are about to purchase '+it+' item(s). Total value: $'+ftot.toFixed(2)+
						' ( $'+tot.toFixed(2)+' + $'+upsval+' for UPS )';
					// update credit
					cr -= 5;
				}
			} else we_re_good = true;
			// pay the price
			if (we_re_good) {
				if (confirm(msg)) {
					shop.setCredit(cr); // update credit in shop class
					if (cart.getCredit() != cr) { // and in cart class, if the case
						cart.setCredit(cr);
						$('#ncredit1').html('( Credit: '+cr.toFixed(2)+' )'); // show changes on hud
					}
					// close modal form - activate close button
					$("#btnClose").click();
					// save data to db
					dbs.save(shop);
					// clear data
					cart.resAll();
					// show changes
					var items = cart.getItems();
					var prods = cart.getProds();
					var prices = cart.getPrices();
					shop.showList(prods, prices, items);
					// show totals
//					cart.calcTotal();
					var it = cart.getTotItm();
					var tot = cart.getTot();
					shop.showTot(tot, it);
					// update items
					$('#nitems').html(it);
				}
			}
		} else
			alert('Please add some items in the cart before purchasing');
	} else
		alert('Please select transportation method');
});

// sel. transp. method - select box
$(document).on('change', '#seltrn', function() {
	var v = this.value;
	if (v > 0) {
		$("#wrn").hide(); // hide warning message
		if (v == 2) // ups
			$("#totalnfo").html("You'll have to pay an extra $"+upsval+" for UPS");
		else
			$("#totalnfo").html('No charge'); // pick up
	} else {
		$("#totalnfo").html(''); // reset field
		$("#wrn").show(); // show warning msg.
	}
});
