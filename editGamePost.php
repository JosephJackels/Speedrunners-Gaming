
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

	if($editType == 'edit-game'){
		$id = $_POST['edit-game-select'];
		$title = $_POST['title'];
		$genre = $_POST['genre'];
		$rating = $_POST['rating'];
		$imagePath = $_POST['imagePath'];
		$description = $_POST['description'];
		$updateSuccesful = updateGame($databaseCredentials, $id, $title, $genre, $imagePath, $description, $rating);
	}else if($editType == 'edit-instance'){
		$gameId = $_POST['edit-game-select'];
		$copyId = $_POST['instance-select'];
		$status = $_POST['status'];
		$storeId = $_POST['store_id'];
		$updateSuccesful = updateInstance($databaseCredentials, $gameId, $copyId, $status, $storeId);
		$title = 'Game ' . $gameId . ' Copy ' . $copyId;
	}
	function updateGame($credentials, $id, $title, $genre, $imagePath, $description, $rating){
		$query = "UPDATE GAME SET title = ?, genre = ?, imagePath = ?, description = ?, rating = ?  WHERE game_id = ?";
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "sssssi", $title, $genre, $imagePath, $description, $rating, $id);
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
	function updateInstance($credentials, $gameId, $copyId, $status, $storeId){
		$query = "UPDATE GAME_INSTANCE SET status = ?, store_id = ? WHERE game_id = ? AND copy_id = ?";
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "iiii", $status, $storeId, $gameId, $copyId);
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
		<?php if($updateSuccesful){ ?>
			<div>
				<p>Update of Game <?php echo $title; ?> was Succesful!</p>
				<p>Click <a href="adminHome.php">here</a> to return to the admin home page</p>			
			</div>
		<?php } else { ?>
			<div>
				<p>Oh No, Update of Gane <?php echo $title; ?> was not succesful</p>
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