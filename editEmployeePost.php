
<!-- This is a template php page to be used to build any pages needed for the project-->
<?php
	$databaseCredentials = include('databaseCredentials.php');
	$pageHeader = 'Edit Employee';
	$pageDescription = 'Results of Editing an Employee';
	require('pageParts/loginCheck.php');

	if(!(isset($_SESSION['admin-privileges']) && $_SESSION['admin-privileges'])){
			//not logged in as admin
			header('Location:adminLogin.php');
	}
	$editType = $_POST['editType'];
	
	if($editType == 'edit-employee'){
		$id = $_POST['edit-employee-select'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$storeId = $_POST['store_id'];
		$success = editEmployee($databaseCredentials, $id, $fname, $lname, $storeId);
		$message='Edit of employee ' . $fname . ' ' . $lname;
	}else if($editType == 'grant-employee-priv'){
		$id = $_POST['edit-employee-select'];
		$priv = $_POST['priv'];//admin or delivery
		$success = grantEmployeePrivlidge($databaseCredentials, $id, $priv);
		$message = 'Employee ' . $id . ' grant of ' . $priv . ' privilidge';
	}else if($editType == 'revoke-employee-priv'){
		$id = $_POST['edit-employee-select'];
		$priv = $_POST['priv'];//admin or delivery
		$success = revokeEmployeePrivlidge($databaseCredentials, $id, $priv);
		$message = 'Employee ' . $id . ' revokal of ' . $priv . ' privilidge';
	}else if($editType == 'add-employee'){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$storeId = $_POST['store_id'];
		$password = $_POST['password'];
		$success = addEmployee($databaseCredentials, $fname, $lname, $storeId, $password);
		$message = 'New Employee ' . $fname . ' ' . $lname . ' addition';
	}else if($editType == 'remove-employee'){
		$id = $_POST['edit-employee-select'];
		$success = removeEmployee($databaseCredentials, $id);
		$message = 'Employee ' . $id . ' removal';
	}
	function editEmployee($credentials, $id, $fname, $lname, $storeId){
		$query = "UPDATE EMPLOYEE SET fname = ?, lname = ?, store_id = ? WHERE employee_id = ?";
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "ssii", $fname, $lname, $storeId, $id);
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
	function grantEmployeePrivlidge($credentials, $id, $priv){
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if($priv == 'admin'){
			$query = "INSERT INTO STORE_ADMIN employee_id VALUES (?)";
		}else if($priv == 'delivery'){
			$query = "INSERT INTO DELIVERY_EMPLOYEE (employee_id, status) VALUES (?, 0)";
		}
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "i", $id);
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
	function revokeEmployeePrivlidge($credentials, $id, $priv){
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if($priv == 'admin'){
			$query = "DELETE FROM STORE_ADMIN WHERE employee_id = ?";
		}else if($priv == 'delivery'){
			$query = "DELETE FROM DELIVERY_EMPLOYEE WHERE employee_id = ?";
		}
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "i", $id);
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
	function addEmployee($credentials, $fname, $lname, $storeId, $password){
		$query = "INSERT INTO EMPLOYEE (fname, lname, store_id, password) VALUES (?, ?, ?, ?)";
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "ssis", $fname, $lname, $storeId, $password);
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
	function removeEmployee($credentials, $id){
		if(revokeEmployeePrivlidge($credentials, $id, 'admin') && revokeEmployeePrivlidge($credentials, $id, 'delivery')){
			$query = "DELETE FROM EMPLOYEE WHERE employee_id = ?";
			$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
			if(!$connection){
				die('Connection failed ' . mysqli_connect_error());
			}
			if($statement = mysqli_prepare($connection, $query)){
				mysqli_stmt_bind_param($statement, "i", $id);
				mysqli_stmt_execute($statement);
				mysqli_stmt_close($statement);
				mysqli_close($connection);
				return true;
			} else{
				/// no games
				mysqli_close($connection);
			}
		}
		return false;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Edit Game</title>
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