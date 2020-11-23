<?php 
/* update how these variables get their values once database and accounts are implemented*/
	$accountFName = 'none';
	$accountLName = 'none';
	$accountEmail = 'none';
	$accountAddress = 'none';
	$accountBirthDate = 'none';
	$databaseCredentials = include('databaseCredentials.php');

	//get current cust id from session/cookies?
	$cust_id = 1;

	$connection = mysqli_connect($databaseCredentials['servername'], $databaseCredentials['username'], $databaseCredentials['password'], $databaseCredentials['database']);
	if(!$connection){
		die('Connection failed ' . mysqli_connect_error());
	}
	$query = 'SELECT fname, lname, email, address, birthdate FROM CUSTOMER WHERE cust_id = ?';
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "i", $cust_id);
			mysqli_stmt_execute($statement);
			$result = mysqli_stmt_get_result($statement);
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_assoc($result)){
					$accountFName = $row['fname'];
					$accountLName = $row['lname'];
					$accountEmail = $row['email'];
					$accountAddress = $row['address'];
					$accountBirthdate = $row['birthdate'];
				}
			}
			mysqli_stmt_close($statement);
		} else{
			/// no account found
			$accountFName = 'bad statement';
		}
	mysqli_close($connection);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Speedrunners Gaming</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" type="text/css" href="styles/modal.css">
	<link rel="stylesheet" type="text/css" href="styles/navbar.css">
	<link rel="stylesheet" type="text/css" href="styles/accountInfo.css">
</head>
<body>
	<div id="page-header">
		<div id="page-title-container">
			<div id="page-title">
				<h1>Welcome to Speedrunners Gaming</h1>
				<p>Account Info</p>
			</div>
			<button id="login-modal-window-open" onclick="getElementById('login-modal-window').style.display = 'block';">Click here to login/create an Account</button>

		</div>

		<?php include 'pageParts/navbar.php'; ?>
	</div>
	<div id="page-body">
		<form class="account-info-container" autocomplete="off" action="accountEdit.php" method="post">
			
			<h2 class="container-title">Account Info</h2>

			<div class="account-info-values">
				<div class="value-item">
					<span class="value-label">First Name</span>
					<input name='fname' required type=text class="value-value" readonly placeholder='<?php echo $accountFName; ?>' pattern="[A-Za-z]+">
					<button type="button" class="value-edit" onclick="toggleEdit(this); return false;">Edit</button>
				</div>
				<div class="value-item">
					<span class="value-label">Last Name</span>
					<input name='lname' required type=text class="value-value" readonly placeholder='<?php echo $accountLName; ?>' pattern="[A-Za-z]+">
					<button type="button" class="value-edit" onclick="toggleEdit(this); return false;">Edit</button>
				</div>
				<div class="value-item">
					<span class="value-label">Email Address</span>
					<input name='email' required type=email class="value-value" readonly placeholder=<?php echo  $accountEmail; ?>>
					<button type="button" class="value-edit" onclick="toggleEdit(this); return false;">Edit</button>
				</div>
				<div class="value-item">
					<span class="value-label">Mailing Address</span>
					<input name='address' required type=text class="value-value" readonly placeholder='<?php echo "$accountAddress"; ?>' pattern="[0-9]+\s(([0-9]+(st|nd|rd|th))|([A-Za-z]+))\s[A-Za-z]+(/s([Nn][EeWw]?|[Ss][EeWw]?|[Ee]|[Ww]|[Nn]orth(\s?(([Ww]est)|([Ee]ast)))?|[Ss]outh(\s?(([Ww]est)|([Ee]ast)))?|[Ee]ast|[Ww]est))?\s[A-Za-z\s]+\s[0-9]{5}([- .]?[0-9]{5})?"><!-- Include state selector? This Regex is a mess but it worked the first time?-->
					<button type="button" class="value-edit" onclick="toggleEdit(this); return false;">Edit</button>
				</div>
				<div class="value-item">
					<span class="value-label">Birth Date</span>
					<input name='birthdate' required type=date class="value-value" readonly value=<?php echo $accountBirthDate; ?>>
					<button type="button" class="value-edit" onclick="toggleEdit(this); return false;">Edit</button>
				</div>
			</div>

			<div class="account-info-buttons">
				<button type="submit">Submit</button>
				<button type="reset">Cancel</button>
			</div>
		</form>
	</div>

	<?php include 'pageParts/loginModal.php'; ?>
	<?php include 'pageParts/sourcesFooter.php';?>

	<script type="text/javascript">
		function toggleEdit(buttonNode){
			if(buttonNode.previousElementSibling.hasAttribute("readonly")){
				buttonNode.previousElementSibling.removeAttribute("readonly");
				buttonNode.previousElementSibling.classList.add("value-value-edit");
				buttonNode.innerText = 'Cancel';
			} else {
				buttonNode.previousElementSibling.setAttribute("readonly", "");
				buttonNode.previousElementSibling.classList.remove("value-value-edit");
				buttonNode.innerText = 'Edit';
				buttonNode.previousElementSibling.value = buttonNode.previousElementSibling.placeholder;
			}
		}
	</script>
</body>
</html>