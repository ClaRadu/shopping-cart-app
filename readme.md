# Shopping cart example v.3.6
hosted on http://crsoft.cba.pl

First of all, I'd like to thank user5636597 on stackoverflow.com:

https://stackoverflow.com/questions/18602331/why-is-this-jquery-click-function-not-working

tutorialspoint.com ( https://www.tutorialspoint.com/php/php_mysql_login.htm )

w3schools.com

sourceforge.net


## Table of contents:
1. Project layout
2. License
3. Info / Contact


## 1. Project layout
### root folder
- readme.md			// info file
- license			// license
- index.php			// main file
- create.php		// create and manage the database used by the app ( run manually )
- login.php			// login / register forms

### data folder
- Products.xml		// contains data exported from the db 

### dbs folder
- gvars.php			// global variables and class needed in order to connect to the database
- getItems.php		// gets all data from the 'service' table
- reg.php			// insert ( register ) a new user in the 'users' table
- save.php			// saves data to the 'users' table
- session.php		// verifies the session and redirects accordingly
- logout.php		// logout from the session
- exportData.php	// class to handle data export from db
- toXml.php			// export data to xml using exportData class

### scripts folder
- cart.js		// object to handle all shopping cart-related actions
- cartCtrl.js	// cart controller - handles all logic related to the shopping cart modal form
- getset.js		// object to handle php requests
- interfaces.js	// UI - object to manage data shown on main menus
- shop.js		// object to hold data related to the shop
- controller.js	// handles input from user and output to screen

### styles folder
- style.css		// holds all the css styles used by the app


## 2. License
The license of this software and its source-code is based on the MIT License (MIT).

See `license` file for more info.


## 3. Info / Contact
Application developed by Claudiu Radu a.k.a. CRG using (thus requiring): 
php, mysql, javascript, jquery, ajax, w3.css and bootstrap.

using tools: 
XAMPP, Notepad++, Opera and Firefox.

C.R.G. 2019.
