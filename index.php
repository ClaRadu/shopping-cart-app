<?php include 'dbs/session.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>CRG Shop v.3.6</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<script src="scripts/cart.js"></script>
<script src="scripts/getset.js"></script>
<script src="scripts/interfaces.js"></script>
<script src="scripts/shop.js"></script>
<script src="scripts/controller.js"></script>
<script src="scripts/cartctrl.js"></script>
<script>
// create objects
var elem = new Array();
elem[0] = <?php echo "'$id'"; ?>;
elem[1] = <?php echo "'$login_session'"; ?>;
elem[2] = <?php echo "'$credit'"; ?>;
elem[3] = <?php echo "'$use1'"; ?>;
elem[4] = <?php echo "'$rt1'"; ?>;
elem[5] = <?php echo "'$use2'"; ?>;
elem[6] = <?php echo "'$rt2'"; ?>;
elem[7] = <?php echo "'$use3'"; ?>;
elem[8] = <?php echo "'$rt3'"; ?>;
elem[9] = <?php echo "'$use4'"; ?>;
elem[10] = <?php echo "'$rt4'"; ?>;

var shop = new Shop();
shop.setAll(elem);

var cart = new Cart(shop.getCredit());

var hud = new Interfaces();
//hud.init();

var dbs = new Dbs();
dbs.getItems();
</script>
<body>

<div class="w3-top">
	<div class="w3-container w3-gray w3-bar w3-card">
		<a id='username' style='display:block;' class="w3-bar-item w3-cell">Wellcome <?php echo $login_session . "!"; ?></a>
		<div id='divcr' class="w3-bar-item w3-light-blue" style='display:block;'>
			<a id='ncredit1'>( Credit: <?php echo $credit . ' )'; ?></a>
		</div>
		<a id='logout' style='display:block;' class="w3-bar-item w3-cell w3-right" href="dbs/logout.php">Logout</a>
	</div>
	<div class="w3-container w3-black w3-bar w3-card">
		<div class="w3-bar-item">
			<p id='white'>
			&nbsp&nbsp
			Items in cart:
			&nbsp
			<span id='nitems' class="w3-badge w3-blue">0</span>
			</p>
		</div>
		<div class="w3-right w3-bar-item">
			<button id='btnCart' class="w3-button w3-blue w3-section w3-round">Shopping cart <i class="fa fa-shopping-cart"></i></button>
		</div>
	</div>
</div>

<div id='divu' class="w3-content w3-container w3-teal w3-round w3-bar" style='display:block; margin-top:142px;'>
	<form class="w3-bar-item">
		<select id='selprod' name="users"></select>
	</form>
	<div id="showDat" class="w3-bar-item">No value..</div>
	<div class='w3-padding-small w3-right-align'>
		<button id='btnXML'  class='w3-button w3-white w3-tiny w3-round w3-padding-small'>Export to xml</button>
	</div>
</div>
</br>

<div id='AddDiv' style='display:none;' class="w3-container w3-blue w3-round w3-bar">
	<div class="w3-bar-item">
		<input id='txtbQtty' class="w3-input w3-border w3-round" style="width:120px" type="text" placeholder="quantity" name="qtty">
	</div>
	<div class="w3-bar-item">
		<button id='btnAdd'  class='w3-button w3-white w3-round'>Add to cart</button>
	</div>
	<div id='ratediv' class="w3-container">
		</br>
		<p>Rate the product:</p>
		<table style='border:none;'><tr><td style='border:none;'>
		<i id='s1v' style='display:none;' class="fa fa-star slides">1</i></td><td style='border:none;'>
		<i id='s1e' style='display:block;' class="fa fa-star-o slides">1</i></td><td style='border:none;'>
		<i id='s2v' style='display:none;' class="fa fa-star slides">2</i></td><td style='border:none;'>
		<i id='s2e' style='display:block;' class="fa fa-star-o slides">2</i></td><td style='border:none;'>
		<i id='s3v' style='display:none;' class="fa fa-star slides">3</i></td><td style='border:none;'>
		<i id='s3e' style='display:block;' class="fa fa-star-o slides">3</i></td><td style='border:none;'>
		<i id='s4v' style='display:none;' class="fa fa-star slides">4</i></td><td style='border:none;'>
		<i id='s4e' style='display:block;' class="fa fa-star-o slides">4</i></td><td style='border:none;'>
		<i id='s5v' style='display:none;' class="fa fa-star slides">5</i></td><td style='border:none;'>
		<i id='s5e' style='display:block;' class="fa fa-star-o slides">5</i></td></tr></table>
	</div>
	<div class="w3-container">
		<p class='w3-teal w3-round w3-padding' id='nrate1'>Average Rating is: 0.00</p>
	</div>
</div>

<!-- the shopping cart modal form -->
<div id="cartModal" class="w3-modal">
	<div class="w3-modal-content w3-animate-top w3-card-4">
		<div class="w3-container">
		<h2 id="gray"><label><i class="fa fa-shopping-cart"></i> Shopping cart:</label></h2>
		<div id='prodinfo'></div>
		<div id='prodtot'></div>
		<br/><br/>
		<form>
			<label>Choose transport:</label>
			<select id='seltrn' name="trn">
				<option value="0" selected>Select</option>
				<option value="1">Pick up</option>
				<option value="2">UPS</option>
			</select>
		</form>
		<p id='totalnfo'>Total to pay: $0</p>
		<p id='wrn' style='color:red; background-color:lightgray;'>&nbspPlease select transportation method!</p>
		<button id='btnPay' class="w3-button w3-blue w3-section w3-right">Pay <i class="fa fa-check"></i></button>
		<button id="btnClose" class="w3-button w3-red w3-section">Close <i class="fa fa-remove"></i></button>
		</div>
	</div>
</div>

<div id="showSav"></div>
<div id='prodinfomain'></div>
<div id='prodtotmain' class='title'></div>

<a class="w3-display-bottomright w3-round w3-margin w3-padding-large" id="logo" href="http://crgames.elementfx.com" target="_blank">&nbspC.R.G. 2019&nbsp</a>

</body>
</html>
