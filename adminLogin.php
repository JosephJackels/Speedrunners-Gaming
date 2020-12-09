
<!-- This is a template php page to be used to build any pages needed for the project-->
<?php
	$databaseCredentials = include('databaseCredentials.php');
	$pageHeader = 'Login Page for Administrators';
	$pageDescription = 'Enter Credentials To Login As An Administrator';
	require('pageParts/loginCheck.php');
	$adminLoggedIn = false;
	if($userLoggedIn){
		if(isset($_SESSION['admin-privileges']) && $_SESSION['admin-privileges']){
			//already logged in as admin
			$adminLoggedIn = true;
			header('Location:adminHome.php');
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Admin Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" type="text/css" href="styles/modal.css">
	<link rel="stylesheet" type="text/css" href="styles/navbar.css">
	<!-- ADD ANY PAGE-SPECIFIC STYLESHEETS HERE-->
</head>
<body>
	<div id="page-header">
		<?php include 'pageParts/titleContainer.php'; ?>
		<?php include 'pageParts/navbar.php';?>
	</div>

	<div id="page-body">
		
		<!-- THE PAGES MAIN CONTENT-->
		<?php 
			if($adminLoggedIn){
		?>
			<div class='page-content-container'>
				<p class='page-content'>You are already logged in as an administrator. If the page did not redirect automatically, click <a href="adminHome.php">here</a> to be redirected to the page for administrators functions.</p>
			</div>
			<?php 
			}else{
			?>
			<div class="page-content-container">
				<h3>Enter Your login information to gain administrator privlideges. This will log you out of any customer account.</h3>
				<form method='post' action=''>
					<div class='input-container'>
						<label for='admin-id'>Employee Id: </label>
						<input type="text" name="admin-id">
					</div>
					<div class='input-container'>
						<label for='admin-password'>Password: </label>
						<input type="password" name="admin-password">
					</div>
					<button type='submit'>Log In</button>
				</form>
			</div>
	</div>
		<?php } ?>
	<!-- This window exists outside of the main body, should only be seen as a popup window-->
	<?php include 'pageParts/loginModal.php';?>
	<?php include 'pageParts/logoutModal.php'; ?>
	<?php include 'pageParts/sourcesFooter.php';?>
	<!-- ADD ANY PAGE SPECFIC SCRIPTS HERE-->
</body>
</html>