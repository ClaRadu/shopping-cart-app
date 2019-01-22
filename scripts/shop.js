// object to hold data related to the shop

function Shop()
{
	var id, user, credit, used, rate, crtpos;
	var use1, rt1, use2, rt2, use3, rt3, use4, rt4;
	used = rate = crtpos = 0; // initial values
	
	return {
		setAll: function (values) { // set all values ( values are received as an array )
			id = values[0];
			user = values[1];
			credit = values[2];
			use1 = values[3];
			rt1 = values[4];
			use2 = values[5];
			rt2 = values[6];
			use3 = values[7];
			rt3 = values[8];
			use4 = values[9];
			rt4 = values[10];
		},
		
		setCredit: function(newval) { credit = newval; },
		getCredit: function() { return credit; },
		
		getId: function() { return id; },
		getUsr: function() { return user; },
		
		getus: function() { return used; },
		getrt: function() { return rate; },
		getpos: function() { return crtpos; }, // crt. pos.
		
		getUsedArr: function() {
			var arr = [];
			arr[0] = 0; // we don't use the first element to avoid ambiguity
			arr[1] = use1;
			arr[2] = use2;
			arr[3] = use3;
			arr[4] = use4;
			
			return arr;
		},
		
		getUsed: function(item) {
			var nitem = parseInt(item);
			var ret = 0;
			switch(nitem) {
				case 0: break;
				case 1: ret = use1; break;
				case 2: ret = use2; break;
				case 3: ret = use3; break;
				case 4: ret = use4; break;
				default: alert('Invalid value selected -> shop.getUse / val='+item);
			}
			used = ret;
			crtpos = item;
			
			return ret;
		},
		
		setUsed: function(item, newval) {
			var nitem = parseInt(item);
			used = newval;
			crtpos = item;
			switch(nitem) {
				case 0: break;
				case 1: use1 = newval; break;
				case 2: use2 = newval; break;
				case 3: use3 = newval; break;
				case 4: use4 = newval; break;
				default: alert('Invalid value selected -> shop.setUse / val='+item);
			}
		},
		
		getRateArr: function() {
			var arr = [];
			arr[0] = 0; // we don't use the first element to avoid ambiguity
			arr[1] = rt1;
			arr[2] = rt2;
			arr[3] = rt3;
			arr[4] = rt4;
			
			return arr;
		},
		
		getRate: function(item) {
			var nitem = parseInt(item);
			var ret = 0;
			switch(nitem) {
				case 0: break;
				case 1: ret = rt1; break;
				case 2: ret = rt2; break;
				case 3: ret = rt3; break;
				case 4: ret = rt4; break;
				default: alert('Invalid value selected -> shop.getRate / val='+item);
			}
			rate = ret;
			crtpos = item;
			
			return ret;
		},
		
		setRate: function(item, newval) {
			var nitem = parseInt(item);
			rate = newval;
			crtpos = item;
			switch(nitem) {
				case 0: break;
				case 1: rt1 = newval; break;
				case 2: rt2 = newval; break;
				case 3: rt3 = newval; break;
				case 4: rt4 = newval; break;
				default: alert('Invalid value selected -> shop.setRate / val='+item);
			}
		},
		
		// show shopping list on screen
		showList: function(itname, prices, quant) {
			// get the controls where data will be shown
			var modinfo = document.getElementById('prodinfo');
			var maininfo = document.getElementById('prodinfomain');
			
			var len = itname.length;
			var ln = '';
			maininfo.innerHTML = ln; // first, reset data
			modinfo.innerHTML = ln;
			if (len > 1) {
				for (var i=1; i<len; i++) { // start from 1 because 0 is null
					ln = "<li>"+itname[i]+" "+quant[i]+" items ( $"+prices[i].toFixed(2)+" ) "+
						"<button id='btnRem' class='w3-button w3-circle w3-red w3-tiny' "+
						"value='"+i+"' >X</button></li>";
					// show data on main page
					maininfo.innerHTML += ln;
					modinfo.innerHTML += ln;
				}
			}
		},
		
		// show totals
		showTot: function(tot, totitm) {
			var modtot = document.getElementById('prodtot');
			var maintot = document.getElementById('prodtotmain');

			if (tot > 0)
				ln = 'Total: '+totitm.toFixed(0)+' items ( $'+tot.toFixed(2)+' )';
			else
				ln = '';
			
			maintot.innerHTML = ln;
			modtot.innerHTML = ln;
		}
	};
}
