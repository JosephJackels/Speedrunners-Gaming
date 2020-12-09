
<!-- This is a template php page to be used to build any pages needed for the project-->
<?php
	$databaseCredentials = include('databaseCredentials.php');
	$pageHeader = 'Edit Game';
	$pageDescription = 'Results of Editing a Game';
	require('pageParts/loginCheck.php');

	if(!(isset($_SESSION['admin-privileges']) && $_SESSION['admin-privileges'])){
			//not logged in as admin
			header('Location:adminLogin.php');
	}
	$editType = $_POST['editType'];
	switch($editType){
		case 'add-game':
			$title = $_POST['title'];
			$genre = $_POST['genre'];
			$imagePath = $_POST['imagePath'];
			$rating = $_POST['rating'];
			$description = $_POST['description'];
			$success = addGame($databaseCredentials, $title, $genre, $imagePath, $description, $rating);
			$message = 'Game ' . $title . ' Added ';
			break;
		case 'remove-game':
			$gameId = $_POST['game-select'];
			$success = removeGame($databaseCredentials, $gameId);
			$message = 'Game ' . $gameId . ' Removed ';
			break;
		case 'add-instance':
			$gameId = $_POST['game-select'];
			$status = $_POST['status'];
			$storeId = $_POST['store_id'];
			$success = addInstance($databaseCredentials, $gameId, $status, $storeId);
			$message='Instance of Game ' . $gameId . ' Added ';
			break;
		case 'remove-instance':
			$gameId = $_POST['game-select'];
			$copyId = $_POST['instance-select'];
			$success = removeInstance($databaseCredentials, $gameId, $copyId);
			$message = 'Instance ' . $copyId . ' of Game ' . $gameId . ' Removed ';
			break;
	}
	function addGame($credentials, $title, $genre, $imagePath, $description, $rating){
		$query = "INSERT INTO GAME (title, genre, imagePath, description, rating) VALUES ( ?, ?, ?, ?, ?)";
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "ssssi", $title, $genre, $imagePath, $description, $rating);
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
	function removeGame($credentials, $gameId){
		$query = "DELETE FROM GAME WHERE game_id = ?";
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "i", $gameId);
			mysqli_stmt_execute($statement);
			mysqli_stmt_close($statement);
			mysqli_close($connection);
			return removeAllInstances($credentials, $gameId);
		} else{
			/// no games
			mysqli_close($connection);
			return false;
		}
	}
	function removeAllInstances($credentials, $gameId){
		$query = "DELETE FROM GAME_INSTANCE WHERE game_id = ?";
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "i", $gameId);
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
	function addInstance($credentials, $gameId, $status, $storeId){
		$query = "INSERT INTO GAME_INSTANCE (game_id, status, store_id) VALUES ( ?, ?, ?)";
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "iii", $gameId, $status, $storeId);
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
	function removeInstance($credentials, $gameId, $copyId){
		$query = "DELETE FROM GAME_INSTANCE WHERE game_id = ? AND copy_id = ?";
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "ii", $gameId, $copyId);
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
				<p><?php echo $message; ?>was Succesful!</p>
				<p>Click <a href="adminHome.php">here</a> to return to the admin home page</p>			
			</div>
		<?php } else { ?>
			<div>
				<p>Oh No, <?php echo $message; ?>was not succesful</p>
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