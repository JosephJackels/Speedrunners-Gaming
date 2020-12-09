
<!-- This is a template php page to be used to build any pages needed for the project-->
<?php
	$databaseCredentials = include('databaseCredentials.php');
	$pageHeader = 'Order Update';
	$pageDescription = 'Results of Updating an Order/Delivery';
	require('pageParts/loginCheck.php');

	if(!(isset($_SESSION['admin-privileges']) && $_SESSION['admin-privileges'])){
			//not logged in as admin
			header('Location:adminLogin.php');
	}
	$orderType = $_POST['orderType'];
	switch($orderType){
		case 'assignOrder':
			$orderId = $_POST['assign-order-select'];
			$employeeId = $_POST['employee-select'];
			$message = 'Assignment of Order ' . $orderId . ' to employee ' . $employeeId;
			$success = assignOrder($databaseCredentials, $orderId, $employeeId);
			break;
		case 'updateOrder':
			$orderId = $_POST['assign-order-select'];
			$status = $_POST['new-status'];
			$message = 'Update of Order ' . $orderId . ' Status to ' . $status;
			$success = updateOrder($databaseCredentials, $orderId, $status);
			break;
	}
	function assignOrder($credentials, $orderId, $employeeId){
		$query = "INSERT INTO DELIVERIES (order_id, employee_id) VALUES (?, ?)";
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "ii", $orderId, $employeeId);
			mysqli_stmt_execute($statement);
			mysqli_stmt_close($statement);
			mysqli_close($connection);
			if(updateEmployeeStatus($credentials, $employeeId, 1)){
				return updateOrder($credentials, $orderId, 1);
			}
		} else{
			/// no games
		}
		mysqli_close($connection);
		return false;
	}
	function updateEmployeeStatus($credentials, $employeeId, $status){
		$query = "UPDATE DELIVERY_EMPLOYEE SET status = ? WHERE employee_id = ?";
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "ii", $status, $employeeId);
			mysqli_stmt_execute($statement);
			mysqli_stmt_close($statement);
			mysqli_close($connection);
			return true;
		} else{
			/// no games
			mysqli_close($connection);
			return false;
		}
	}
	function updateOrder($credentials, $orderId, $status){
		$resetEmployee = ($status == 0 || $status== 4);
			//remove item from deliveries
			//reset employee status to 0
		$resetGameInstance = ($status == 4);
			//reset game instance status to 0

		$query = "UPDATE ORDERS SET status = ? WHERE order_id = ?";
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "ii", $status, $orderId);
			mysqli_stmt_execute($statement);
			mysqli_stmt_close($statement);
			mysqli_close($connection);
			if($resetEmployee){
				if($resetGameInstance){
					if($copyId = getCopyIdFromOrderContents($credentials, $orderId)){
						return resetGameInstanceStatus($credentials, $copyId, 0);
					}
				}else {
					return removeFromDeliveries($credentials, $orderId);
				}
			} else{
				return true;
			}
		} else{
			/// no games
			mysqli_close($connection);
			return false;
		}
	}
	function getCopyIdFromOrderContents($credentials, $orderId){
		$query = 'SELECT copy_id FROM ORDERS LEFT JOIN ORDER_CONTENTS USING(order_id) WHERE order_id = ?';
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "i", $orderId);
			mysqli_stmt_execute($statement);
			$result = mysqli_stmt_get_result($statement);
			if(mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_row($result);
			}
			mysqli_stmt_close($statement);
			mysqli_close($connection);
			return $row[0];
		} else{
			/// no games
		}
		mysqli_close($connection);
		return false;
	}
	function resetGameInstanceStatus($credentials, $copyId, $status){
		$query = 'UPDATE GAME_INSTANCE SET status = ? WHERE copy_id = ?';
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "ii", $status, $copyId);
			mysqli_stmt_execute($statement);
			mysqli_stmt_close($statement);
			mysqli_close($connection);
			return true;
		} else{
			/// no games
		}
		mysqli_close($connection);
		return false;

	}
	function removeFromDeliveries($credentials, $orderId){
		if($employeeId = getEmployeeIdForDelivery($credentials, $orderId)){
			if(updateEmployeeStatus($credentials, $employeeId, 0)){
				$query = 'DELETE FROM DELIVERIES WHERE order_id = ?';
				$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
				if(!$connection){
					die('Connection failed ' . mysqli_connect_error());
				}
				if($statement = mysqli_prepare($connection, $query)){
					mysqli_stmt_bind_param($statement, "i", $orderId);
					mysqli_stmt_execute($statement);
					mysqli_stmt_close($statement);
					mysqli_close($connection);
					return true;
				} else{
					/// no games
				}
					mysqli_close($connection);
					return false;

			}
		}
	}
	function getEmployeeIdForDelivery($credentials, $orderId){
		$query = 'SELECT employee_id FROM DELIVERIES WHERE order_id = ?';
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "i", $orderId);
			mysqli_stmt_execute($statement);
			$result = mysqli_stmt_get_result($statement);
			if(mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_row($result);
			}
			mysqli_stmt_close($statement);
			mysqli_close($connection);
			return $row[0];
		} else{
			/// no games
		}
		mysqli_close($connection);
		return false;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Order Update</title>
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
				<p>Click <a href="adminHome.php">here</a> to return to the admin home page</p>			
			</div>
		<?php } else { ?>
			<div>
				<p>Oh No, <?php echo $message; ?> was not succesful</p>
				<p>Click <a href="adminHome.php"> to return to the admin home page and try again.</a></p>
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