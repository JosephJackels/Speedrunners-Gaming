<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Speedrunners Gaming</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" type="text/css" href="styles/modal.css">
	<link rel="stylesheet" type="text/css" href="styles/navbar.css">
	<link rel="stylesheet" type="text/css" href="styles/contact.css">
</head>
<body>
	<div id="page-header">
		<div id="page-title-container">
			<div id="page-title">
				<h1>Welcome to Speedrunners Gaming</h1>
				<p>This will be the main landing page for our project</p>
			</div>
			<button id="login-modal-window-open" onclick="getElementById('login-modal-window').style.display = 'block';">Click here to login/create an Account</button>

		</div>

		<?php include 'pageParts/navbar.php'; ?>
	</div>
	<div id="page-body">
		<form id="contact-form">
			<label for="message">Comment/Complaint</label>
			<div class="input-container">
				<textarea name="message" required></textarea>
			</div>
			<label name="client-email">Contact me back at:</label>
			<div class="input-container">
				<input type="email" name="client-email" required>
			</div>
			<div class="form-controls">
				<button type="submit">Submit</button>
				<button type="reset">Reset</button>
			</div>
		</form>
	</div>

	<?php include 'pageParts/loginModal.php'; ?>
</body>
</html>