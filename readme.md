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
	- [ ] Game Table (a list of all games available - each game once)
		- [ ] Get Game Data
			- [ ] Titles
			- [ ] Images
			- [ ] Ratings
			- [ ] Descriptions
	- [ ] Game Instance Table (an instance 'physical' copy of a game, allows for multiple (or zero) copies of a game to exist)
	- [ ] Customer Table (Customer data)
	- [ ] Employee Table
	- [ ] Delivery Employee Table
	- [ ] Store Admin Table
	- [ ] Stores
	- [ ] Orders
	- [ ] Order Contents
	- [ ] Deliveries

- [ ] Main Page
	- [ ] Search functionality
	- [ ] Make login window only pop up if not logged in? AND/OR only on main page?
		- [x] ~~Not pop up immediately~~
		- [ ] Check if logged in or not
	- [ ] Improve Color Scheme?
		- [ ] contrast
		- [ ] light/dark mode
		- [ ] improve general color theme
		- [ ] accent colors 'pop' without being distracting
	- [ ] Game lists
		- [ ] scroll when swiped?
		- [ ] scroll when cursor is on far side?
		- [ ] Information on hover?

- [ ] 'About Us' page
	- [ ] Create 'real' Content
	- [x] ~~Update Styling~~

- [ ] Contact Page
	- [x] ~~Update Styling~~
		- [x] ~~Page Body Appearance~~
		- [x] ~~Positioning of labels and buttons~~
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
	- [x] ~~Styling~~
	- [ ] Form Input Handling
		- [ ] Mailing Address regex needs improvement/fixing

- [ ] Admin Pages
	- [ ] Edit/Add/Remove Employee Page
		- [ ] Structure
		- [ ] Style
		- [ ] Functionality
			- [ ] Form Handling
			- [ ] Integrate with database
	- [ ] Orders and Deliveries Page
		- [ ] Structure
		- [ ] Style
		- [ ] Functionality
			- [ ] Form Handling
			- [ ] Integrate with database
	- [ ] Edit/Add/Remove Game Page
		- [ ] Structure
		- [ ] Style
		- [ ] Functionality
			- [ ] Form Handling
			- [ ] Integrate with database