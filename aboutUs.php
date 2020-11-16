<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Speedrunners Gaming</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" type="text/css" href="styles/modal.css">
	<link rel="stylesheet" type="text/css" href="styles/navbar.css">
	<link rel="stylesheet" type="text/css" href="styles/about.css">
</head>
<body>
	<div id="page-header">
		<div id="page-title-container">
			<div id="page-title">
				<h1>Welcome to Speedrunners Gaming</h1>
				<p>About Us</p>
			</div>
			<button id="login-modal-window-open" onclick="getElementById('login-modal-window').style.display = 'block';">Click here to login/create an Account</button>

		</div>

		<?php include "pageParts/navbar.php"; ?>
	</div>
	<div id="page-body">
		<div id="about-us-message">
			<div class="message">
				<h2 class="message-heading">Heading</h2>
				<p class="message-content">Back in the early days in the 80's, both me and my friend Josh were impress of a 
				smashing hit game called: "Supar Mario Bros" on the NES.  Begged our parents to buy for the two of us as kids
				in any store that had the system and the game too.  We were both total game nerds at the time of our lives and 
				we will never let that go for the both of us as we grew older till now.
				</p>
			</div>

			<div class="message">
				<h2 class="message-heading">Heading</h2>
				<p class="message-content">As a kid, I always dreamed about starting a company that will always have games for
				those who never own any money or possibly missed out an opportunity and I always feel bad for them!  As a dedicated business
				owner and a gamer too, I decided to open up a private business that would deliver these wonderful games at a quick speed 
				of delivery to any gamer in the world young and old.  After all, we never run out of time (if you get the reference.)!
				</p>
			</div>
		</div>
	</div>
	<?php include "pageParts/loginModal.php"; ?>
	<?php include 'pageParts/sourcesFooter.php';?>
</body>
</html>