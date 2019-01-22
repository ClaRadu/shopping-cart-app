// object to handle all shopping cart related actions

function Cart(ncr)
{
	// prop.
	var credit = ncr;
	var selected = 0;
	var prods = [ 'null' ]; // first pos. is null
	var prices = [ 0 ]; // first pos. is null
	var items = [ 0 ];
	var total, totitm;

	return {
		setCredit: function(nval) { credit = nval; },
		getCredit: function() { return credit; },
		
		getProds: function() { return prods; }, // returns array of products
		getPrices: function() { return prices; }, // array of prices
		getItems: function() { return items; }, // returns array of items
		
		getTotItm: function() { return totitm; },
		getTot: function() { return total; },
		
		additem: function(name, price, item) { // add new element
			var i = prods.indexOf(name);
			var p = parseFloat(price);
			var it = parseInt(item);
			var pr = it*p;
			if (pr > credit) // make sure the price won't exceed the credit amount
				alert('You have exceeded the available credit! ( Credit = '+credit+' )');
			else {
				if (i < 0) { // element not found so add it
					prods.push(name);
					prices.push(pr);
					items.push(it);
				} else { // el. found so update it
					prices[i] += pr;
					items[i] += it;
				}
				// either way, update credit
				credit -= pr;
			}
		},
		
		removeItem: function(spos) { // remove selected items from array
			// update credit
			credit += prices[spos];
			// remove items
			prods.splice(spos, 1);
			prices.splice(spos, 1);
			items.splice(spos, 1);
		},
		
		calcTotal: function() {
			var alen = prods.length; // all 3 arrays have the same length
			totitm = total = 0;
			var i = 0;
			for (i=1; i<alen; i++) { // pos. 0 = null
				totitm += items[i];
				total += prices[i];
			}
		},
		
		resAll: function() { // reset all data
//			credit = 0;
			selected = 0;
			prods = [ 'null' ]; // first pos. is null
			prices = [ 0 ]; // first pos. is null
			items = [ 0 ];
			total = totitm = 0;
		}
	};
}
