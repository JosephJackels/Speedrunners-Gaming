<?php  
		$output = <<<HEREDOC
			<div id="navbar-container">
				<svg height="100" width="100" id="logo-svg" xmlns="http://www.w3.org/2000/svg">
					<image href="imgs/logo.svg" id="logo" height="100" width="100" x="50%" y="50%" transform="translate(-50, -50)"></image>
				</svg>
				<ul id="navbar-links-list">
					<li><a href="index.php">Home</a></li>
					<li><a href="aboutUs.php">About Us</a></li>
					<li><a href="contact.php">Contact</a></li>
					<li><a href="myAccount.php">My Account Info</a></li>
				</ul>
				<div id="searchbarContainer">
					<input type="text" name="searchbar" placeholder="Search...">
					<input type="image" alt ="Search site now" src="imgs/search.jpeg" id="searchSubmitButton">
				</div>
			</div>
			<script type="text/javascript" src="scripts/navbar.js"></script>
HEREDOC;
		echo $output;
?>