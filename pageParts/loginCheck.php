<?php
	session_start();
	if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
	}
	$userLoggedIn = checkLogin($databaseCredentials);
	$modalOpenMessage = 'Click here to login or create an Account';
	$modalCurrentWindow = 'login-modal-window';
	if($userLoggedIn){
		$modalOpenMessage = $_SESSION['name'] . ', click here to logout';
		$modalCurrentWindow = 'logout-modal-window';
	}
	$adminLoggedIn = false;
	if($userLoggedIn){
		if(isset($_SESSION['admin-privileges']) && $_SESSION['admin-privileges']){
			//already logged in as admin
			$adminLoggedIn = true;
		}
	}

	function checkLogin($credentials){
		if(isset($_SESSION['id'])){
			return true;
		}
		else if(isset($_POST["login-email"]) && isset($_POST["login-password"])){
			$query = "SELECT cust_id, fname, email FROM CUSTOMER WHERE email = ? AND password = ?";
			$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
			if(!$connection){
				die('Connection failed ' . mysqli_connect_error());
			}
			if($statement = mysqli_prepare($connection, $query)){
				mysqli_stmt_bind_param($statement, 'ss', $_POST['login-email'], $_POST['login-password']);
				mysqli_stmt_execute($statement);
				$result = mysqli_stmt_get_result($statement);
				if(mysqli_num_rows($result) > 0){
					$row = mysqli_fetch_assoc($result);
					$_SESSION['id'] = $row['cust_id'];
					$_SESSION['name'] = $row['fname'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['usertype'] = 'customer';
					mysqli_close($connection);
					return true;
				}
			}
		mysqli_close($connection);
		}
		else {
			return(checkAdmin($credentials));
		}
	}
	function checkAdmin($credentials){
		if(isset($_POST["admin-id"]) && isset($_POST["admin-password"])){
			$query = "SELECT EMPLOYEE.employee_id, fname FROM EMPLOYEE INNER JOIN STORE_ADMIN ON EMPLOYEE.employee_id = STORE_ADMIN.employee_id WHERE EMPLOYEE.employee_id = ? AND EMPLOYEE.password = ?";
			$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
			if(!$connection){
				die('Connection failed ' . mysqli_connect_error());
			}
			if($statement = mysqli_prepare($connection, $query)){
				mysqli_stmt_bind_param($statement, 'is', $_POST['admin-id'], $_POST['admin-password']);
				mysqli_stmt_execute($statement);
				$result = mysqli_stmt_get_result($statement);
				if(mysqli_num_rows($result) > 0){
					$row = mysqli_fetch_assoc($result);
					$_SESSION['id'] = $row['employee_id'];
					$_SESSION['name'] = $row['fname'];
					$_SESSION['admin-privileges'] = true;
					$_SESSION['usertype'] = 'employee';
					mysqli_close($connection);
					return true;
				}
			}
		}
		return false;
	}
?>