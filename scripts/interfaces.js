// UI - object manage data on main menus

function Interfaces()
{
	return {
		// initial state
		init: function () {
			var displ = 'none'; // hide
			
			// hide all menus
			document.getElementById("AddDiv").style.display = displ;
			document.getElementById("cartModal").style.display = displ;
		},
		
		// show/hide form to input data
		toggleInput: function(show) {
			if (show)
				document.getElementById("AddDiv").style.display = 'block';
			else
				document.getElementById("AddDiv").style.display = 'none';
		},
		
		// show/hide modal form
		toggleModal: function(show) {
			var modal = document.getElementById('cartModal');
			var display = 'none';
			if (show) display = 'block';
			modal.style.display = display;
		},
		
		// show new credit
		updateCredit: function(newval) {
			var cr = document.getElementById('ncredit1');
			cr.innerHTML = "( Credit: "+newval+" )";
		},
		
		// items in cart
		updateItems: function(newval) {
			var itm = document.getElementById('nitems');
			itm.innerHTML = newval;
		},
		
		// show the value of each item selected by user
		updateItmVal: function(recval) {
			var itm = document.getElementById("showDat");
			if (recval == 0)
				itm.innerHTML = 'No value..';
			else
				itm.innerHTML = 'Value: $'+recval+' per item';
		},
		
		// toggle rating stars: visible / hidden
		showRatingStars: function(show) {
			disp = 'none';
			if (show) disp = 'block';
			document.getElementById('ratediv').style.display = disp;
		},
		
		// loop trough all stars and validate only the correct one
		valStar: function(min, max, sno) { 
			for (var i=min; i<=max; i++) {
				var sv = 's'+i+'v';
				var se = 's'+i+'e';
				if (i == sno) {
					document.getElementById(sv).style.display = 'block';
					document.getElementById(se).style.display = 'none';
				} else {
					document.getElementById(sv).style.display = 'none';
					document.getElementById(se).style.display = 'block';
				}
			}
		},
		
		// select star
		selStar: function(no) {
			var sv = 's'+no+'v';
			var se = 's'+no+'e';
			document.getElementById(sv).style.display = 'block';
			document.getElementById(se).style.display = 'none';
		},
		
		// show rating info text
		ratingInfo: function(recval) {
			var rt = document.getElementById("nrate1");
			rt.innerHTML = 'Average rating is: '+recval;
		}
	};
}
