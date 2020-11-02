<?php 
/* update how these variables get their values once database and accounts are implemented*/
	$accountFName = "John";
	$accountLName = "Smith";
	$accountEmail = "js@mail.com";
	$accountAddress = "1234 Street st, City, State, Zip";
	$accountBirthDate = "2020-01-01";

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
		<form class="account-info-container" autocomplete="off" action="" method="post">
			
			<h2 class="container-title">Account Info</h2>

			<div class="account-info-values">
				<div class="value-item">
					<span class="value-label">First Name</span>
					<input type=text class="value-value" readonly value='<?php echo $accountFName; ?>'>
					<button type="button" class="value-edit" onclick="toggleEdit(this); return false;">Edit</button>
				</div>
				<div class="value-item">
					<span class="value-label">Last Name</span>
					<input type=text class="value-value" readonly value=<?php echo $accountLName; ?>>
					<button type="button" class="value-edit" onclick="toggleEdit(this); return false;">Edit</button>
				</div>
				<div class="value-item">
					<span class="value-label">Email Address</span>
					<input type=email class="value-value" readonly placeholder=<?php echo  $accountEmail; ?>>
					<button type="button" class="value-edit" onclick="toggleEdit(this); return false;">Edit</button>
				</div>
				<div class="value-item">
					<span class="value-label">Mailing Address</span>
					<input type=text class="value-value" readonly placeholder=<?php echo "$accountAddress"; ?>>
					<button type="button" class="value-edit" onclick="toggleEdit(this); return false;">Edit</button>
				</div>
				<div class="value-item">
					<span class="value-label">Birth Date</span>
					<input type=date class="value-value" readonly value=<?php echo $accountBirthDate; ?>>
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
	<script type="text/javascript">
		function toggleEdit(buttonNode){
			if(buttonNode.previousElementSibling.hasAttribute("readonly")){
				buttonNode.previousElementSibling.removeAttribute("readonly");
				buttonNode.previousElementSibling.classList.add("value-value-edit");
			} else {
				buttonNode.previousElementSibling.setAttribute("readonly", "");
				buttonNode.previousElementSibling.classList.remove("value-value-edit");
			}
		}
	</script>
</body>
</html>