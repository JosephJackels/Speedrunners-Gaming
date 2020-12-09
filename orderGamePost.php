
<!-- This is a template php page to be used to build any pages needed for the project-->
<?php
	$databaseCredentials = include('databaseCredentials.php');
	$pageHeader = 'Order Game';
	$pageDescription = 'Results of Ordering a Game';
	require('pageParts/loginCheck.php');
	$loggedInAsCustomer = false;
	if($userLoggedIn && !$adminLoggedIn){
		$loggedInAsCustomer = true;
	}
	$gameId = $_POST['game_id'];
	$copyId = $_POST['copy_id'];
	$custId = $_POST['cust_id'];
	$storeId = $_POST['store_id'];
	$success = true;
	$orderId = addToOrders($databaseCredentials, $storeId, $custId, $gameId, $copyId);
	$message = 'Order of Game ' . $gameId . ' Copy ' . $copyId;
	function addToOrders($credentials, $storeId, $custId, $gameId, $copyId){
		$query = "INSERT INTO ORDERS (store_id, cust_id) VALUES (?, ?)";
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "ii", $storeId, $custId);
			mysqli_stmt_execute($statement);
			mysqli_stmt_close($statement);
			$orderId = mysqli_insert_id($connection);
			mysqli_close($connection);
			return addToOrderContents($credentials, $orderId, $gameId, $copyId);
		} else{
			/// no games
			mysqli_close($connection);
			return false;
		}
	}
	function addToOrderContents($credentials, $orderId, $gameId, $copyId){
		$query = "INSERT INTO ORDER_CONTENTS (order_id, game_id, copy_id) VALUES (?, ?, ?)";
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "iii", $orderId, $gameId, $copyId);
			if(!$success = mysqli_stmt_execute($statement)){
				mysqli_stmt_close($statement);
				mysqli_close($connection);
				return mysqli_stmt_error($statement);
			}

			mysqli_stmt_close($statement);
			mysqli_close($connection);
			return updateGameStatus($credentials, $gameId, $copyId);
		} else{
			/// no games
			mysqli_close($connection);
			return false;
		}
	}
	function updateGameStatus($credentials, $gameId, $copyId){
		$query = "UPDATE GAME_INSTANCE SET status=1 WHERE game_id = ? AND copy_id = ?";
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "ii", $gameId, $copyId);
			if(!$success = mysqli_stmt_execute($statement)){
				mysqli_stmt_close($statement);
				mysqli_close($connection);
				return mysqli_stmt_error($statement);
			}

			mysqli_stmt_close($statement);
			mysqli_close($connection);
			return true;
		} else{
			/// no games
			mysqli_close($connection);
			return false;
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Order Game</title>
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
		<?php if($success){ ?>
			<div>
				<p><?php echo $message; ?> was Succesful!</p>
				<p>Click <a href="index.php">here</a> to return to the home page</p>			
			</div>
		<?php } else { ?>
			<div>
				<p>Oh No, <?php echo $message; ?> was not succesful</p>
				<p>Click <a href="index.php"> to return to the home page and try again.</a></p>
			</div>
		<?php } ?>
	</div>

	<!-- This window exists outside of the main body, should only be seen as a popup window-->
	<?php include 'pageParts/loginModal.php';?>
	<?php include 'pageParts/logoutModal.php'; ?>
	<?php include 'pageParts/sourcesFooter.php';?>
	<!-- ADD ANY PAGE SPECFIC SCRIPTS HERE-->
</body>
</html>