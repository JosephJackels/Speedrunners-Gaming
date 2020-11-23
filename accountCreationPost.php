<?php
//posted variables
	$fname = htmlspecialchars($_POST['fname']);
	$lname = htmlspecialchars($_POST['lname']);
	$email = htmlspecialchars($_POST['email']);
	$address = htmlspecialchars($_POST['address']);
	$zip = htmlspecialchars($_POST['zip']);
	$state = htmlspecialchars($_POST['state']);
	$birthdate = htmlspecialchars($_POST['birthdate']);
	$password = htmlspecialchars($_POST['password']);
	$attemptStatus = false;
	$databaseCredentials = include('databaseCredentials.php');
	$connection = mysqli_connect($databaseCredentials['servername'], $databaseCredentials['username'], $databaseCredentials['password'], $databaseCredentials['database']);
	if(!$connection){
		die('Connection failed ' . mysqli_connect_error());
	}
	if(isEmailNew($email, $connection)){
		if($statement = mysqli_prepare($connection, "INSERT INTO CUSTOMER (fname, lname, address, email, zip_code, state, birthdate, password) VALUES(?, ?, ?, ?, ?, ?, ?, ?)")){
				mysqli_stmt_bind_param($statement, "ssssisss", $fname, $lname, $address, $email, $zip, $state, $birthdate, $password);
				mysqli_stmt_execute($statement);
				mysqli_stmt_close($statement);
				$attemptStatus = true;
		} else {
			$attemptStatus = false;
		}
	}
	mysqli_close($connection);

	function isEmailNew($mail, $connection){
		//check database for existing email
		if($statement = mysqli_prepare($connection, "SELECT email FROM CUSTOMER WHERE email = ?")){
				mysqli_stmt_bind_param($statement, "s", $mail);
				mysqli_stmt_execute($statement);
				$result = mysqli_stmt_get_result($statement);
				mysqli_stmt_close($statement);
				return (mysqli_num_rows($result) == 0);
		}
		else {
			return false;
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Account Creation Response</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" type="text/css" href="styles/modal.css">
	<link rel="stylesheet" type="text/css" href="styles/navbar.css">
	<link rel="stylesheet" type="text/css" href="styles/accountCreationPost.css">
	<!-- ADD ANY PAGE-SPECIFIC STYLESHEETS HERE-->
</head>
<body>
	<div id="page-header">
		<div id="page-title-container">
			<div id="page-title">
				<h1>Account Creation Response</h1>
				<p>Results of attempt to create account</p>
			</div>
			<button id="login-modal-window-open" onclick="getElementById('login-modal-window').style.display = 'block';">Click here to login/create an Account</button>
		</div>

		<?php include 'pageParts/navbar.php';?>
	</div>

	<div id="page-body">
		
		<!-- THE PAGES MAIN CONTENT-->
		<?php 
			if($attemptStatus){
				//account creation succesful
				echo <<<HEREDOC
				<div class='results-container'>
					<h1 class='results-title'>Account Creation Successful</h1>
					<div class='results-contents'>
						<span class='content-item'>The first name given for the account is $fname</span>
						<span class='content-item'>The last name given for the account is $lname</span>
						<span class='content-item'>The email given for the account is $email</span>
						<span class='content-item'>The address given for the account is $address</span>
						<span class='content-item'>The zip code given for the account is $zip</span>
						<span class='content-item'>The state selected for the account is $state</span>
						<span class='content-item'>The birthdate given for the account is $birthdate</span>
						<span class='content-item'>The password given for the account is $password</span>
					</div>
				</div>
HEREDOC;
			}else {
				echo <<<HEREDOC
				<div class='results-container'>
					<h1 class='results-title'>Account Creation Unsuccessful</h1>
					<div class='results-contents'>
						<span class='content-item'>Oh No! That account could not be created succesfully</span>
						<span class='content-item'>The email address $email is already in use</span>
					</div>
				</div>
HEREDOC;
			}
		?>
	
	</div>

	<!-- This window exists outside of the main body, should only be seen as a popup window-->
	<?php include 'pageParts/loginModal.php';?>
	<?php include 'pageParts/sourcesFooter.php';?>
	<!-- ADD ANY PAGE SPECFIC SCRIPTS HERE-->
</body>
</html>