// object to handle php requests

function Dbs()
{
	// properties
	var isSaved = false;
	var xmlhttp;

	return {
		getSaved: function () { return isSaved; },
		
		request: function (resobj)
		{
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			} else { // older ie versions
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
	
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById(resobj).innerHTML = this.responseText;
				}
			}
			
			return;
		},
		
		// get data from db and show it on screen
		getItems: function ()
		{
			this.request("selprod");
			xmlhttp.open("GET", "dbs/getItems.php", true);
			xmlhttp.send();
		},
		
		// export data from db to xml
		toxml: function(id)
		{
			xmlhttp.open("GET", "dbs/toXml.php?id="+id, true);
			xmlhttp.send();
		},

		// save data to database
		save: function (objshop)
		{
			i_id = objshop.getId();
			arr_ratings = objshop.getRateArr();
			arr_rated = objshop.getUsedArr();
			f_credit = objshop.getCredit();
			
			this.request("showSav");
			xmlhttp.open("GET", "dbs/save.php?id="+i_id+"&s0="+arr_ratings[0]+"&s1="+arr_ratings[1]+"&s2="+arr_ratings[2]+"&s3="+arr_ratings[3]+"&s4="+arr_ratings[4]+"&r0="+arr_rated[0]+"&r1="+arr_rated[1]+"&r2="+arr_rated[2]+"&r3="+arr_rated[3]+"&r4="+arr_rated[4]+"&cr="+f_credit, true);
			xmlhttp.send();
			
			isSaved = true;
		}
	};
}
