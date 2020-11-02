
<!-- This is a template php page to be used to build any pages needed for the project-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>***WINDOW/TAB TITLE HERE***</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" type="text/css" href="styles/modal.css">
	<link rel="stylesheet" type="text/css" href="styles/navbar.css">
	<!-- ADD ANY PAGE-SPECIFIC STYLESHEETS HERE-->
</head>
<body>
	<div id="page-header">
		<div id="page-title-container">
			<div id="page-title">
				<h1>***TITLE AT TOP OF PAGE</h1>
				<p>***SHORT DESCRIPTION</p>
			</div>
			<button id="login-modal-window-open" onclick="getElementById('login-modal-window').style.display = 'block';">Click here to login/create an Account</button>
		</div>

		<?php include 'pageParts/navbar.php';?>
	</div>

	<div id="page-body">
		
		<!-- THE PAGES MAIN CONTENT-->
	
	</div>

	<!-- This window exists outside of the main body, should only be seen as a popup window-->
	<?php include 'pageParts/loginModal.php';?>

	<!-- ADD ANY PAGE SPECFIC SCRIPTS HERE-->
</body>
</html>