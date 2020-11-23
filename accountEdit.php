<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	$cust_id = 1;

	$databaseCredentials = include('databaseCredentials.php');
	$updated = false;

	$updateArray = getUpdates();
	$setColumns = $updateArray[0];
	$paramaters = $updateArray[1];
	$typeString = $updateArray[2];

	$paramaters[] = [&$cust_id, 'ID'];
	$bind;
	foreach($paramaters as $param){
		$bind[] = &$param[0];
	}
	$typeString .= 'i';

	$connection = mysqli_connect($databaseCredentials['servername'], $databaseCredentials['username'], $databaseCredentials['password'], $databaseCredentials['database']);
	if(!$connection){
		die('Connection failed ' . mysqli_connect_error());
	}
	$query = "UPDATE CUSTOMER SET $setColumns WHERE cust_id = ?";
		if($statement = mysqli_prepare($connection, $query)){
			call_user_func_array('mysqli_stmt_bind_param', array_merge(array($statement), array($typeString), $bind));


			//mysqli_stmt_bind_param($statement, "sssssi", $accountFName, $accountLName, $accountEmail, $accountAddress, $accountBirthdate, $cust_id);
			mysqli_stmt_execute($statement);
			mysqli_stmt_close($statement);
			$updated = true;
		} else{
			//error?
			$gothere = mysqli_error($connection);
		}
	mysqli_close($connection);
	function getUpdates(){
		$setString = '';
		$paramString = '';
		$bindParams = [];
		$types = '';
		$updatedStuff = [];
		if($_POST['fname'] != null){
			$setString .= "fname = ?";
			$bindParams[] = [&$_POST['fname'], 'First Name'];
			$types .= 's';
		}
		if($_POST['lname'] != null){
			if($setString != ''){
				$setString .= ', ';
			}
			$setString .= "lname = ?";
			$bindParams[] = [&$_POST['lname'], 'Last Name'];
			$types .= 's';
		}
		if($_POST['email'] != null){
			if($setString != ''){
				$setString .= ', ';
			}
			$setString .= "email = ?";
			$bindParams[] = [&$_POST['email'], 'Email'];
			$types .= 's';
		}
		if($_POST['address'] != null){
			if($setString != ''){
				$setString .= ', ';
			}
			$setString .= "address = ?";
			$bindParams[] = [&$_POST['address'], 'Address'];
			$types .= 's';
		}
		if($_POST['birthdate'] != null){
			if($setString != ''){
				$setString .= ', ';
			}
			$setString .= "birthdate = ?";
			$bindParams[] = [&$_POST['birthdate'], 'Birthdate'];
			$types .= 's';
		}

		return array($setString, $bindParams, $types);
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Account Info Edited</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" type="text/css" href="styles/modal.css">
	<link rel="stylesheet" type="text/css" href="styles/navbar.css">
	<link rel="stylesheet" type="text/css" href="styles/accountCreationPost.css">
</head>
<body>
	<div id="page-header">
		<div id="page-title-container">
			<div id="page-title">
				<h1>Editting of Account Info</h1>
				<p>This page will attempt to update your account info</p>
			</div>
			<button id="login-modal-window-open" onclick="getElementById('login-modal-window').style.display = 'block';">Click here to login/create an Account</button>
		</div>

		<?php include 'pageParts/navbar.php';?>
	</div>

	<div id="page-body">
		
				<?php 
			if($updated){
				echo <<<HEREDOC
				<div class='results-container'>
					<h1 class='results-title'>Update Successful</h1>
					<div class='results-contents'>
HEREDOC;
					foreach($paramaters as $param){
						if($param[1] != 'ID'){
							echo '<span class="content-item">New Value for ' . $param[1] . ' - ' . $param[0] .'</span>';
						}
					}
					echo <<<HEREDOC
					</div>
				</div>
HEREDOC;
			}else {
				echo <<<HEREDOC
				<div class='results-container'>
					<h1 class='results-title'>Account Creation Unsuccessful</h1>
					<div class='results-contents'>
						<span class='content-item'>Oh No! That account could not be updated succesfully</span>
					</div>
				</div>
HEREDOC;
			}
		?>
	
	</div>

	<!-- This window exists outside of the main body, should only be seen as a popup window-->
	<?php include 'pageParts/loginModal.php';?>
	<?php include 'pageParts/sourcesFooter.php';?>
</body>
</html>