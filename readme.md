# Speedrunners Gaming Web App Project

## About

This app is being created as a part of a project for the ICS325 class at metrostate University.
It is a group project with work being done by:
* Joseph Jackels
* Jack Wirtz

This project will be using a LAMP stack, this github page is a place to organize and collaborate, the final project is to be displayed at Metrostates ICS Web Server

This project utilizes:
* HTML
* CSS
* Javscript
* PHP
* MySQL

## TODO

- [ ] Implement Test Database
	- [x] ~~Game Table (a list of all games available - each game once)~~
		- [x] ~~Get Game Data~~
			- [x] ~~Titles~~
			- [x] ~~Images~~
			- [x] ~~Ratings~~
			- [x] ~~Descriptions~~
	- [x] ~~Game Instance Table (an instance 'physical' copy of a game, allows for multiple (or zero) copies of a game to exist)~~
	- [x] ~~Customer Table (Customer data)~~
	- [x] ~~Employee Table~~
	- [x] ~~Delivery Employee Table~~
	- [x] ~~Store Admin Table~~
	- [ ] Stores
	- [x] ~~Orders~~
	- [x] ~~Order Contents~~
	- [x] ~~Deliveries~~

- [ ] Main Page
	- [ ] Search functionality
	- [x] ~~Make login window only pop up if not logged in? AND/OR only on main page?~~
		- [x] ~~Not pop up immediately~~
		- [x] ~~Check if logged in or not~~
	- [ ] Improve Color Scheme?
		- [ ] contrast
		- [ ] light/dark mode
		- [ ] improve general color theme
		- [ ] accent colors 'pop' without being distracting
	- [ ] Game lists
		- [x] ~~scroll when swiped?~~
		- [ ] scroll when cursor is on far side?
		- [ ] Information on hover?

- [x] ~~'About Us' page~~
	- [x] ~~Create 'real' Content~~
	- [x] ~~Update Styling~~

- [ ] Contact Page
	- [ ] Update Styling
		- [ ] Page Body Appearance
		- [ ] Positioning of labels and buttons
	- [x] ~~Form Input Handling~~
		- [x] ~~Check for Empty/invalid inputs~~
	- [ ] Form Output Processing
		- [ ] make a basic 'show output' page for testing
		- [ ] make a new table in database for handling/processing?
		- [ ] check for injections etc. safe form handling!!!

- [ ] My Account Page
	- [x] ~~Styling~~
		- [x] ~~Form Inputs~~
			- [x] ~~color~~
			- [x] ~~positioning~~
			- [x] ~~borders~~
		- [x] ~~Improved button styling~~
	- [ ] Form Input Handling
		- [ ] Proper input check - empty, invalid etc.
			- [x] ~~First Name~~
			- [x] ~~Last Name~~
			- [x] ~~Email~~
			- [ ] Mailing Address
				- [ ] Parse address number
				- [ ] Parse Streetname
				- [ ] Parse Street Type
				- [ ] Parse Street modifier (ex 7th Street North, North 7th Street etc.)
				- [ ] Parse City Name
				- [ ] Parse Zip
				- [ ] Add State Selection input
				- [ ] Split address inputs into Address, City, Zip, State
			- [x] ~~Birth Date~~

- [ ] Account Creation Page
	- [ ] Styling
	- [ ] Form Input Handling
		- [ ] Mailing Address regex needs improvement/fixing

- [ ] Admin Pages
	- [ ] Edit/Add/Remove Employee Page
		- [x] ~~Structure~~
		- [ ] Style
		- [x] ~~Functionality~~
			- [x] ~~Form Handling~~
			- [x] ~~Integrate with database~~
	- [ ] Orders and Deliveries Page
		- [x] ~~Structure~~
		- [ ] Style
		- [x] ~~Functionality~~
			- [x] ~~Form Handling~~
			- [x] ~~Integrate with database~~
	- [ ] Edit/Add/Remove Game Page
		- [x] ~~Structure~~
		- [ ] Style
		- [x] ~~Functionality~~
			- [x] ~~Form Handling~~
			- [x] ~~Integrate with database~~